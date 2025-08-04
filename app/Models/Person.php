<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use SoftDeletes;

    protected $table = 'persons';

    protected $fillable = [
        'name_ar',
        'name_en',
        'national_id',
        'birth_date',
        'phone',
        'gender',
        'marital_status',
        'occupation',
        'address',
        'family_id',
        'father_id',
        'mother_id',
        'is_family_head',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_family_head' => 'boolean',
    ];

    protected $with = ['father', 'mother'];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function father(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'father_id');
    }

    public function mother(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'mother_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Person::class, 'father_id');
    }
}