<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_of_birth',
        'contact_info',
        'family_id',
    ];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function aidRecords()
    {
        return $this->hasMany(AidRecord::class);
    }
} 