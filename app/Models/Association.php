<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Association extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name_ar',
        'name_en',
        'address',
        'phone',
        'email',
        'website',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['name'];

    /**
     * Get the name based on the current locale.
     */
    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    /**
     * Get all families belonging to this association.
     */
    public function families(): HasMany
    {
        return $this->hasMany(Family::class);
    }

    /**
     * Scope a query to only include active associations.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}