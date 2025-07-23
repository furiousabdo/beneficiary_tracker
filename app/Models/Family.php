<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_name',
    ];

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }

    public function totalAid()
    {
        return $this->beneficiaries->flatMap->aidRecords->sum('amount');
    }
} 