<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $table = 'profiles';
    protected $fillable = [
        'user_id',
        'avatar_url',
        'avatar_public_id',
        'avatar_encode',
        'employee_nik',
        'gender',
        'birth_place',
        'birth_date',
        'mother_name',
        'npwp_number',
        'marriage_status',
        'address',
        'employee_status',
        'join_date',
        'resign_date',
        'bank_name',
        'account_name',
        'account_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
