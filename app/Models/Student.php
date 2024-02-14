<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'national_id',
        'enrollment',
        'admission_no',
        'admission_date',
        'payment_reference',
        'first_name',
        'paternal_surname',
        'maternal_surname',
        'birth_date',
        'occupation',
        'nationality',
        'personal_email',
        'personal_phone',
        'marital_status',
        'address',
        'street_number',
        'interior_number',
        'neighborhood',
        'between_streets',
        'zip',
        'city',
        'state',
        'inscription_date',
        'sex',
        'gender',
        'blood_group',
        'allergies',
        'ailments',
        'guardian_relationship',
        'status',
        'team_id',
        'user_id',
        'guardian_id',
        'scholarship_id',
        'career_id',
        'created_by',
        'modified_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'admission_date' => 'date',
        'birth_date' => 'date',
        'status' => 'integer',
        'team_id' => 'integer',
        'user_id' => 'integer',
        'guardian_id' => 'integer',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function guardian(): BelongsTo
    {
        return $this->belongsTo(Guardian::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
