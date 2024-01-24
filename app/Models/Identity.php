<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'iss',
        'sub',
        'aud',
        'typ',
        'uuid',
        'name',
        'surname',
        'email',
        'password',
        'avatar',
        'iat',
        'exp',
    ];
    protected $hidden = ['id', 'created_at', 'updated_at'];
}
