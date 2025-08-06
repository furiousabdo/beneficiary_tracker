<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AidRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficiary_id',
        'association_id',
        'aid_type',
        'amount',
        'date',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

    public function association()
    {
        return $this->belongsTo(Association::class);
    }
} 