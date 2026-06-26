<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $fillable = [
        'full_name',
        'nickname',
        'gender',
        'birth_place',
        'birth_date',
        'address',
        'city',
        'province',
        'postal_code',
        'whatsapp',
        'email',
        'class',
        'major',
        'medical_history',
        'organization_experience',
        'motivation',
        'status',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';
}
