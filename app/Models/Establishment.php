<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Establishment extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
    'name',
    'block_address',
    'main_street_address',
    'address_number',
    'cross_address',
    'reference_address',
    'administrator',
    'contact_phones',
    'contact_email',
    'location',
    'province_id',
    'city_id',
    'zone_id',
    'channel_id',
    'id_subchannel',
    'chain_id',
    'en route',
    'client_project_id',
];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }
}
