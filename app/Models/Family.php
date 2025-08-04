<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'association_id',
        'father_id',
        'family_card_number',
        'registration_date',
        'housing_status',
        'address',
        'notes',
    ];

    protected $casts = [
        'registration_date' => 'date',
    ];

    protected $with = ['father', 'association'];

    /**
     * Get the association that owns the family.
     */
    public function association(): BelongsTo
    {
        return $this->belongsTo(Association::class);
    }

    /**
     * Get the family head (father).
     */
    public function father(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'father_id');
    }

    /**
     * Get all persons in the family.
     */
    public function persons(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    /**
     * Get the family name in Arabic (father's name).
     */
    public function getNameArAttribute(): ?string
    {
        return $this->father ? $this->father->name_ar : null;
    }

    /**
     * Get the family tree starting from this family.
     */
    public function getFamilyTree()
    {
        $tree = [];
        $this->buildFamilyTree($this->father, $tree);
        return $tree;
    }

    /**
     * Recursively build the family tree.
     */
    protected function buildFamilyTree($person, &$tree, $level = 0)
    {
        if (!$person) return;

        $tree[] = [
            'person' => $person,
            'level' => $level,
        ];

        foreach ($person->children as $child) {
            $this->buildFamilyTree($child, $tree, $level + 1);
        }
    }
}