# دليل رفع موقع Shora Group على سيرفر لينكس عبر FTP

هالدليل مكتوب لأسوأ حالة: **استضافة مشتركة، FTP فقط، بدون SSH**.
إذا طلع عندك SSH فالأمور أسهل — في ملاحظات بآخر الملف.

---

## المرحلة ٠ — قبل ما تبلش

### ٠.١ احفظ شغلك على Git
عندك ٥٨ ملف معدّل موجودين بس على جهازك. إذا صار شي بالجهاز بيروحوا.

```bash
git add -A
git commit -m "Prepare production release"
```

### ٠.٢ جهّز عدّة الرفع

```bash
bash deploy/build-release.sh   # بيعمل مجلد release/ جاهز للرفع
bash deploy/export-db.sh       # بيعمل deploy/shora-database.sql
```

`release/` حجمه ~63 ميغا و ~6600 ملف. الملفات التطويرية (node_modules, tests, docs,
حزم phpunit/boost) مستثناة، والاعتماديات مبنية بـ `--no-dev --optimize-autoloader`.

> `build-release.sh` بينزّل حزم الإنتاج وبعدين بيرجّع الحزم التطويرية تلقائياً،
> فنسخة العمل عندك بتضل متل ما هي.

---

## المرحلة ١ — افحص السيرفر قبل ما ترفع ٦٣ ميغا

١. افتح `deploy/server-check.php` وغيّر السطر:
   ```php
   $token = 'CHANGE_ME_BEFORE_UPLOAD';
   ```
   لأي كلمة طويلة عشوائية.

٢. ارفع **هالملف لحالو** على جذر الموقع (عادةً `public_html/`).

٣. افتحه بالمتصفح:
   ```
   https://YOUR-DOMAIN/server-check.php?token=الكلمة-اللي-حطيتها
   ```

٤. اقرأ التقرير. إذا طلع أي سطر `[FAIL]` **وقّف** — لازم تنحل أول.
   أهم النقاط اللي بيفحصها:

   | النقطة | ليش مهمة |
   |---|---|
   | PHP >= 8.3 | Laravel 13 ما بيشتغل بأقل من هيك — هاد الشرط الوحيد اللي ما إلو التفاف |
   | `pdo_mysql`, `mbstring`, `openssl`, `fileinfo` ... | بدونها التطبيق ما بيقلع |
   | `symlink()` | لو معطّل، سكربت التنصيب بيركّب بديل PHP لمسارات `/storage` |
   | `mod_rewrite` | لو معطّل، كل الصفحات غير الرئيسية بترجع 404 |
   | صلاحيات الكتابة | Laravel لازم يكتب بـ `storage/` و `bootstrap/cache/` |
   | `upload_max_filesize` | رفع الشعارات والسير الذاتية من لوحة الأدمن |

٥. **احذف الملف** بعد ما تقرأ التقرير.

---

## المرحلة ٢ — قاعدة البيانات

١. من لوحة التحكم (cPanel → MySQL Databases): أنشئ قاعدة بيانات + مستخدم،
   وأعطي المستخدم كل الصلاحيات عليها. سجّل الاسم/المستخدم/كلمة السر.

٢. من phpMyAdmin → اختار القاعدة → تبويب **Import** → ارفع
   `deploy/shora-database.sql` (حجمه ~84KB).

   الملف فيه ٢٥ جدول: كل المحتوى (القطاعات، العلامات، الفروع، الخدمات، الأخبار،
   المشاريع، الإعدادات) + جدول `migrations` عشان التطبيق ما يعيد الهجرات.
   جداول التشغيل (`cache`, `sessions`, `jobs`) مصدّرة **بنيتها فقط** —
   بياناتها المحلية ما إلها معنى على السيرفر.

٣. **ملاحظة خصوصية:** الملف فيه صفوف من جدول `job_applications` (طلبات توظيف
   من الاختبار المحلي). إذا مو بدك ياها على السيرفر، احذف أسطر
   `INSERT INTO \`job_applications\`` من ملف الـ SQL قبل الاستيراد.

---

## المرحلة ٣ — اضبط `.env` قبل الرفع

افتح `release/.env` (على جهازك، قبل ما ترفع) واملأ:

| المتغير | القيمة |
|---|---|
| `APP_URL` | `https://YOUR-DOMAIN` — بدون سلاش بالآخر |
| `DB_DATABASE` / `DB_USERNAME` / `DB_PASSWORD` | من المرحلة ٢ |
| `MAIL_*` | بيانات SMTP حقيقية — الموقع بيبعت إيميل عند كل طلب توظيف ([CareerController.php:46](../app/Http/Controllers/CareerController.php#L46)) |
| `SESSION_SECURE_COOKIE` | خليها `true` إذا في SSL، `false` إذا لسا ما في |

`APP_KEY` و `DEPLOY_TOKEN` مولّدين أصلاً — لا تغيّرهم.

**لا تلمس هدول:** `APP_ENV=production` و `APP_DEBUG=false`.
`APP_DEBUG=true` على موقع حيّ بيعرض كلمة سر قاعدة البيانات لأي زائر عند أول خطأ.

---

## المرحلة ٤ — الرفع

ارفع **محتويات** `release/` (مو المجلد نفسه) على جذر الموقع.

```
public_html/
├── .env            ← المعدّل بالمرحلة ٣
├── .htaccess
├── app/
├── bootstrap/
├── config/
├── database/
├── lang/
├── public/         ← فيها index.php و deploy-setup.php
├── resources/
├── routes/
├── storage/
├── vendor/
├── artisan
├── composer.json
└── composer.lock
```

الـ `.htaccess` الموجود بالجذر بيحوّل كل الطلبات على `public/`، فهالترتيب بيشتغل
حتى لو ما فيك تغيّر الـ document root.

### إعدادات FileZilla
- **Transfer type: Binary** — مو Auto. الـ ASCII بيخرّب الصور والخطوط.
- Transfer → Preferences → concurrent transfers = **4-8** (٦٦٠٠ ملف صغير).
- تأكد إنو **الملفات المخفية ظاهرة** (`.env` و `.htaccess` ما بيبينوا بشكل افتراضي).

### تأكد إنو `.env` انرفع
أكتر غلطة شائعة: FileZilla بيتجاهل الملفات اللي بتبدأ بنقطة.
Server → Force showing hidden files.

### الصلاحيات
بعد ما يخلص الرفع، من File Manager أو FileZilla:
- `storage/` → **775** مع "apply to subdirectories"
- `bootstrap/cache/` → **775**
- `.env` → **600** (لا تخليه مقروء للعالم)

---

## المرحلة ٥ — التنصيب من المتصفح

ما في SSH، فأوامر artisan بتنعمل من هون.

افتح (الـ token موجود بـ `.env` تحت `DEPLOY_TOKEN`):

```
https://YOUR-DOMAIN/deploy-setup.php?token=TOKEN&action=all
```

`action=all` بينفّذ بالترتيب:
1. فحص صلاحيات الكتابة وإنشاء المجلدات الناقصة
2. `migrate --force`
3. إعادة إنشاء `public/storage` — هاد **ضروري**: المجلد symlink بالمشروع
   والـ FTP ما بينقل الـ symlinks. لو الاستضافة مانعة `symlink()`،
   السكربت بيركّب بديل PHP بيخدم نفس الملفات فبتضل روابط `/storage/...` شغالة
4. `optimize:clear` بعدين `config:cache` + `route:cache` + `view:cache`

في كمان أزرار منفصلة: `info` (تشخيص)، `migrate`، `link`، `optimize`، `clear`.

> **كل ما تعدّل `.env` بعد هيك، لازم تفتح `action=optimize` مرة تانية**،
> وإلا الموقع بيضل شغال على الإعدادات القديمة المخزّنة بالكاش.

---

## المرحلة ٦ — غيّر كلمة سر الأدمن ⚠️

كلمة السر الحالية لـ `admin@shora.sy` هي حرفياً **`password`**
(من [AdminUserSeeder.php](../database/seeders/AdminUserSeeder.php)).

```
https://YOUR-DOMAIN/deploy-setup.php?token=TOKEN&action=password
```

املأ الفورم بكلمة سر ١٢ حرف أو أكتر. لا تفوّت هالخطوة.

---

## المرحلة ٧ — تأكد إنو كل شي ماشي

| الفحص | الرابط |
|---|---|
| الصفحة الرئيسية بالعربي | `https://YOUR-DOMAIN/` |
| النسخة الإنجليزية | `https://YOUR-DOMAIN/en` |
| صفحة داخلية (يعني mod_rewrite شغال) | `https://YOUR-DOMAIN/about` |
| الصور المرفوعة (يعني رابط storage شغال) | افتح صفحة فيها شعارات علامات |
| لوحة الأدمن | `https://YOUR-DOMAIN/admin/login` |
| فورم التواصل + طلب التوظيف | جرّبهم فعلياً — بيختبروا الـ SMTP |
| صفحة غير موجودة | `https://YOUR-DOMAIN/xyz` → لازم ترجع 404 نظيفة مو صفحة خطأ Laravel |

إذا طلعت صفحة بيضا أو خطأ 500: افتح `storage/logs/laravel-*.log` عبر FTP —
هناك سبب الخطأ الحقيقي. (`APP_DEBUG=false` بيخفي التفاصيل عن الزوار، وهاد المطلوب.)

---

## المرحلة ٨ — نظّف ⚠️

بعد ما يشتغل كل شي:

1. **احذف `public/deploy-setup.php`** — هالملف بيقدر يعدّل قاعدة بياناتك
   ويغيّر كلمات السر.
2. احذف `server-check.php` إذا لسا موجود.
3. احذف سطر `DEPLOY_TOKEN` من `.env`.

---

## التحديثات اللاحقة

```bash
bash deploy/build-release.sh
```

بعدين ارفع بس اللي تغيّر (عادةً `app/`, `resources/views/`, `public/build/`,
`lang/`, `routes/`)، وافتح `deploy-setup.php?action=optimize` بعدها.
لا ترفع `.env` فوق النسخة الموجودة على السيرفر.

---

## إذا طلع عندك SSH

كل المرحلة ٥ بتصير أنضف وما بتحتاج `deploy-setup.php` أبداً:

```bash
cd ~/public_html
php artisan migrate --force
php artisan storage:link
php artisan optimize:clear
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

وكمان — إذا فيك تظبّط الـ **document root** على `public/` بدل جذر الحساب،
اعملها. هيك بيصير `.env` و `vendor/` و `storage/` خارج مجال الويب أساساً،
وهاد أأمن من الاعتماد على `.htaccess` للحماية. عندها احذف `.htaccess` يلي بالجذر.

---

## مرجع سريع لملفات العدّة

| الملف | الوظيفة |
|---|---|
| `deploy/server-check.php` | فحص توافق السيرفر — يُرفع أول شي، ويُحذف بعدها |
| `deploy/build-release.sh` | يبني `release/` الجاهز للرفع |
| `deploy/export-db.sh` | يصدّر قاعدة البيانات لـ phpMyAdmin |
| `deploy/deploy-setup.php` | منفّذ أوامر artisan من المتصفح — يُحذف بعد التنصيب |
| `.env.production.example` | قالب إعدادات الإنتاج |
