<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory, HasApiTokens;

    protected $primaryKey = 'userId';

    protected $fillable = [
        'name',
        'email',
        'dob',
        'mobile',
        'password',
        'gender',
    ];

    protected $hidden = [
        'password',
    ];
}
