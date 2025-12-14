<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Exhibition extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'venue',
        'start_date',
        'end_date',
        'featured_image',
        'meta_title',
        'meta_description',
        'is_published',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($exhibition) {
            if (empty($exhibition->slug)) {
                $exhibition->slug = Str::slug($exhibition->title);
            }
        });
    }

    public function artworks(): BelongsToMany
    {
        return $this->belongsToMany(Artwork::class, 'exhibition_artwork')
            ->withPivot('order')
            ->withTimestamps()
            ->orderByPivot('order');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    public function scopePast($query)
    {
        return $query->where('end_date', '<', now());
    }

    public function scopeCurrent($query)
    {
        return $query->where('start_date', '<=', now())
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            });
    }

    public function isUpcoming(): bool
    {
        return $this->start_date > now();
    }

    public function isPast(): bool
    {
        return $this->end_date && $this->end_date < now();
    }

    public function isCurrent(): bool
    {
        return $this->start_date <= now() && (!$this->end_date || $this->end_date >= now());
    }
}
