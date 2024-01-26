<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class City extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['name', 'code', 'province_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function zones()
    {
        return $this->hasMany(Zone::class);
    }

    public function establishments()
    {
        return $this->hasMany(Establishment::class);
    }
}
