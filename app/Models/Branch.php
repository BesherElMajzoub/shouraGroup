<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasLocalizedFields;

    protected array $localizedFields = ['name', 'city', 'address', 'description'];

    protected $fillable = [
        'name', 'name_en', 'city', 'city_en', 'address', 'address_en', 'description', 'description_en', 'phone', 'mobile',
        'map_top', 'map_left', 'map_embed', 'order', 'is_active',
    ];

    protected $casts = [
        'map_top' => 'float',
        'map_left' => 'float',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * رابط الخريطة كما حفظه المحرر، بعد استخراج الـ src إن ألصق وسم iframe كاملاً.
     */
    protected function rawMapUrl(): string
    {
        $embed = trim((string) $this->map_embed);

        if (str_contains($embed, '<iframe') && preg_match('/src=["\x27]([^"\x27]+)["\x27]/i', $embed, $m)) {
            return $m[1];
        }

        return $embed;
    }

    /**
     * وجهة الخريطة: إحداثيات تُستخرج من الرابط المحفوظ، وإلا العنوان مع المدينة.
     */
    public function getMapQueryAttribute(): string
    {
        $embed = $this->rawMapUrl();

        // رابط جوجل بصيغة ?q=33.51,36.29 أو ?q=اسم المكان
        if (preg_match('/[?&]q=([^&]+)/i', $embed, $m)) {
            return urldecode($m[1]);
        }

        // روابط المشاركة الحديثة تحمل الإحداثيات بالشكل !2d<lng>!3d<lat>
        if (preg_match('/!3d(-?\d+(?:\.\d+)?)/', $embed, $lat) && preg_match('/!2d(-?\d+(?:\.\d+)?)/', $embed, $lng)) {
            return $lat[1] . ',' . $lng[1];
        }

        // أو بالشكل @lat,lng
        if (preg_match('/@(-?\d+(?:\.\d+)?),(-?\d+(?:\.\d+)?)/', $embed, $m)) {
            return $m[1] . ',' . $m[2];
        }

        return trim($this->address . ($this->city ? ', ' . $this->city : ''));
    }

    /**
     * رابط الإطار (iframe) لخرائط جوجل — يعمل دون مفتاح API.
     * يُحترم رابط التضمين المخصص القادم من لوحة التحكم إن وُجد.
     */
    public function getMapEmbedUrlAttribute(): string
    {
        $embed = $this->rawMapUrl();

        if ($embed !== '' && (str_contains($embed, '/maps/embed') || str_contains($embed, 'output=embed'))) {
            return $embed;
        }

        return 'https://www.google.com/maps?' . http_build_query([
            'q' => $this->map_query,
            'hl' => app()->getLocale(),
            'z' => 16,
            'output' => 'embed',
        ]);
    }

    /** فتح موقع الفرع في خرائط جوجل */
    public function getMapUrlAttribute(): string
    {
        return 'https://www.google.com/maps/search/?' . http_build_query([
            'api' => 1,
            'query' => $this->map_query,
        ]);
    }

    /** الحصول على الاتجاهات إلى الفرع */
    public function getMapDirectionsUrlAttribute(): string
    {
        return 'https://www.google.com/maps/dir/?' . http_build_query([
            'api' => 1,
            'destination' => $this->map_query,
        ]);
    }
}
