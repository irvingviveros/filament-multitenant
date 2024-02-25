<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipt extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sheet',
        'payment_method',
        'payment_concept',
        'amount',
        'amount_text',
        'payment_date',
        'note',
        'create_by',
        'modified_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
    ];

    public function studentReceipts(): HasMany
    {
        return $this->hasMany(StudentReceipt::class);
    }
}
