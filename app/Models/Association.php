<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function aidRecords()
    {
        return $this->hasMany(AidRecord::class);
    }
} 