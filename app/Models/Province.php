<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Str;

class Province extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['name', 'code'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function establishments()
    {
        return $this->hasMany(Establishment::class);
    }
}
