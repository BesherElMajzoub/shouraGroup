<?php

/*
 * رسائل التحقق بالعربية.
 * تغطي القواعد المستخدمة فعلياً في نماذج الموقع ولوحة الإدارة؛
 * أي قاعدة غير مذكورة تعود تلقائياً إلى الرسالة الإنجليزية الافتراضية.
 */

return [
    'required' => 'حقل :attribute مطلوب.',
    'email' => 'حقل :attribute يجب أن يكون بريداً إلكترونياً صحيحاً.',
    'url' => 'حقل :attribute يجب أن يكون رابطاً صحيحاً.',
    'integer' => 'حقل :attribute يجب أن يكون رقماً صحيحاً.',
    'numeric' => 'حقل :attribute يجب أن يكون رقماً.',
    'boolean' => 'حقل :attribute يجب أن يكون صح أو خطأ.',
    'array' => 'حقل :attribute يجب أن يكون مصفوفة.',
    'date' => 'حقل :attribute يجب أن يكون تاريخاً صحيحاً.',
    'image' => 'حقل :attribute يجب أن يكون صورة.',
    'file' => 'حقل :attribute يجب أن يكون ملفاً.',
    'in' => 'القيمة المختارة في :attribute غير صحيحة.',
    'exists' => 'القيمة المختارة في :attribute غير موجودة.',
    'unique' => 'قيمة :attribute مستخدمة من قبل.',
    'mimes' => 'حقل :attribute يجب أن يكون ملفاً من نوع: :values.',
    'confirmed' => 'تأكيد :attribute غير مطابق.',

    'max' => [
        'numeric' => 'حقل :attribute يجب ألا يزيد عن :max.',
        'file' => 'حجم ملف :attribute يجب ألا يزيد عن :max كيلوبايت.',
        'string' => 'حقل :attribute يجب ألا يزيد عن :max حرفاً.',
        'array' => 'حقل :attribute يجب ألا يحتوي أكثر من :max عنصراً.',
    ],
    'min' => [
        'numeric' => 'حقل :attribute يجب ألا يقل عن :min.',
        'file' => 'حجم ملف :attribute يجب ألا يقل عن :min كيلوبايت.',
        'string' => 'حقل :attribute يجب ألا يقل عن :min حرفاً.',
        'array' => 'حقل :attribute يجب أن يحتوي على :min عناصر على الأقل.',
    ],

    'custom' => [],

    'attributes' => [
        // نموذج اتصل بنا
        'name' => 'الاسم',
        'phone' => 'رقم الهاتف',
        'email' => 'البريد الإلكتروني',
        'subject' => 'موضوع الرسالة',
        'message' => 'نص الرسالة',
        'department_name' => 'القسم المختص',
        'department_email' => 'بريد القسم',

        // نموذج مبيعات الجملة
        'product_interest' => 'المنتجات المهتم بها',
        'governorate' => 'المحافظة',
        'address' => 'عنوان المحل / المنطقة',

        // نموذج التوظيف
        'full_name' => 'الاسم الثلاثي',
        'department' => 'المجال الوظيفي',
        'preferred_branch' => 'فرع العمل المفضل',
        'cover_letter' => 'نبذة عن الخبرات',
        'cv' => 'السيرة الذاتية',

        // لوحة الإدارة
        'title' => 'العنوان',
        'slug' => 'المعرّف في الرابط',
        'tagline' => 'العنوان الفرعي',
        'intro' => 'النبذة',
        'specialties' => 'التخصصات والمعدات',
        'description' => 'الوصف',
        'icon' => 'الأيقونة',
        'image' => 'الصورة',
        'logo' => 'الشعار',
        'country' => 'بلد المنشأ',
        'city' => 'المدينة',
        'order' => 'الترتيب',
        'group' => 'مكان العرض',
        'sectors' => 'القطاعات',
        'map_top' => 'موضع الخريطة من الأعلى',
        'map_left' => 'موضع الخريطة من اليسار',
        'map_embed' => 'رابط الخريطة',
        'body' => 'النص الكامل',
        'excerpt' => 'المقتطف',
        'category_id' => 'التصنيف',
        'published_at' => 'تاريخ النشر',
        'contact_email' => 'البريد الرسمي',
        'sales_email' => 'بريد المبيعات',
        'hr_email' => 'بريد الموارد البشرية',
        'phone_main' => 'الهاتف الرئيسي',
        'contact_whatsapp' => 'رقم واتساب التواصل',
        'wholesale_whatsapp' => 'رقم واتساب الجملة',
        'working_hours' => 'أوقات الدوام',
    ],
];
