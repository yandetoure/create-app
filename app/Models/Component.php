<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Component extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'preview_image',
        'html_code',
        'css_code',
        'js_code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($component) {
            if (empty($component->slug)) {
                $component->slug = Str::slug($component->name);
            }
        });
    }

    // Relationships
    public function templates()
    {
        return $this->belongsToMany(Template::class, 'template_components')
            ->withPivot('section_name', 'sort_order', 'default_settings')
            ->withTimestamps();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Component types constants
    const TYPE_HEADER = 'header';
    const TYPE_HERO = 'hero';
    const TYPE_FEATURE = 'feature';
    const TYPE_FOOTER = 'footer';
    const TYPE_SECTION = 'section';
    const TYPE_CTA = 'cta';
    const TYPE_GALLERY = 'gallery';
    const TYPE_TESTIMONIAL = 'testimonial';

    public static function getTypes()
    {
        return [
            self::TYPE_HEADER => 'Header',
            self::TYPE_HERO => 'Hero Section',
            self::TYPE_FEATURE => 'Features',
            self::TYPE_FOOTER => 'Footer',
            self::TYPE_SECTION => 'Section',
            self::TYPE_CTA => 'Call to Action',
            self::TYPE_GALLERY => 'Gallery',
            self::TYPE_TESTIMONIAL => 'Testimonials',
        ];
    }
}
