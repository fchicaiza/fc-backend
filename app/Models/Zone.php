<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Zone extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['name','code', 'city_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
