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
        'spouse_id',
        'is_family_head',
        'relationship_to_family_head',
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

    public function spouse(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'spouse_id');
    }

    public function spouses(): HasMany
    {
        return $this->hasMany(Person::class, 'spouse_id');
    }

    /**
     * Get all children (from both father and mother relationships)
     */
    public function allChildren(): HasMany
    {
        return $this->hasMany(Person::class, 'father_id')->orWhere('mother_id', $this->id);
    }

    /**
     * Get the family tree data for this person
     */
    public function getFamilyTreeData()
    {
        $tree = [
            'id' => $this->id,
            'name' => $this->name_ar,
            'gender' => $this->gender,
            'isFamilyHead' => $this->is_family_head,
            'birthDate' => $this->birth_date ? $this->birth_date->format('Y-m-d') : null,
            'children' => []
        ];

        // Add spouse data if exists
        if ($this->spouse) {
            $tree['spouse'] = [
                'id' => $this->spouse->id,
                'name' => $this->spouse->name_ar,
                'gender' => $this->spouse->gender,
                'birthDate' => $this->spouse->birth_date ? $this->spouse->birth_date->format('Y-m-d') : null,
            ];
        }

        // Get children
        $children = $this->children()->with(['spouse', 'children'])->get();
        foreach ($children as $child) {
            $tree['children'][] = $child->getFamilyTreeData();
        }

        return $tree;
    }

    /**
     * Get the family head of this person's family
     */
    public function getFamilyHead()
    {
        if ($this->is_family_head) {
            return $this;
        }

        return $this->family->father;
    }

    /**
     * Determine the relationship to family head
     */
    public function determineRelationshipToFamilyHead()
    {
        $familyHead = $this->getFamilyHead();
        
        if (!$familyHead || $familyHead->id === $this->id) {
            return 'رب الأسرة';
        }

        // Direct relationships
        if ($this->father_id === $familyHead->id) {
            return $this->gender === 'ذكر' ? 'ابن' : 'ابنة';
        }

        if ($this->mother_id === $familyHead->id) {
            return $this->gender === 'ذكر' ? 'ابن' : 'ابنة';
        }

        if ($this->spouse_id === $familyHead->id) {
            return 'زوجة';
        }

        if ($familyHead->spouse_id === $this->id) {
            return 'زوجة';
        }

        // Sibling relationships
        if ($this->father_id && $this->father_id === $familyHead->father_id) {
            return $this->gender === 'ذكر' ? 'أخ' : 'أخت';
        }

        if ($this->mother_id && $this->mother_id === $familyHead->mother_id) {
            return $this->gender === 'ذكر' ? 'أخ' : 'أخت';
        }

        // Parent relationships
        if ($familyHead->father_id === $this->id) {
            return 'أب';
        }

        if ($familyHead->mother_id === $this->id) {
            return 'أم';
        }

        // Grandparent relationships
        if ($familyHead->father && $familyHead->father->father_id === $this->id) {
            return 'جد';
        }

        if ($familyHead->father && $familyHead->father->mother_id === $this->id) {
            return 'جدة';
        }

        // Uncle/Aunt relationships
        if ($familyHead->father && $familyHead->father->father_id === $this->father_id && $this->id !== $familyHead->father_id) {
            return $this->gender === 'ذكر' ? 'عم' : 'عمة';
        }

        if ($familyHead->mother && $familyHead->mother->father_id === $this->father_id) {
            return $this->gender === 'ذكر' ? 'خال' : 'خالة';
        }

        // Nephew/Niece relationships
        if ($this->father_id && $familyHead->father_id === $this->father_id && $this->id !== $familyHead->id) {
            return $this->gender === 'ذكر' ? 'ابن الأخ' : 'ابنة الأخ';
        }

        if ($this->mother_id && $familyHead->mother_id === $this->mother_id && $this->id !== $familyHead->id) {
            return $this->gender === 'ذكر' ? 'ابن الأخت' : 'ابنة الأخت';
        }

        // Grandchild relationships
        if ($this->father_id === $familyHead->id || $this->mother_id === $familyHead->id) {
            return $this->gender === 'ذكر' ? 'حفيد' : 'حفيدة';
        }

        return 'أخرى';
    }

    /**
     * Update the relationship to family head automatically
     */
    public function updateRelationshipToFamilyHead()
    {
        $this->relationship_to_family_head = $this->determineRelationshipToFamilyHead();
        $this->save();
    }
}