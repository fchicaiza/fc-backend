<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Province extends Model
{
    protected $fillable = ['id', 'name', 'code'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
