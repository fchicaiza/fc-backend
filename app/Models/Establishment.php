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
    'subchannel_id',
    'chain_id',
    'in_route',
    'client_project_id',
];

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

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }


    public function chanel()
    {
        return $this->belongsTo(Chanel::class, 'channel_id');
    }

    public function subchanel()
    {
    return $this->belongsTo(Subchanel::class, 'subchannel_id');
    }

    public function chain()
    {
        return $this->belongsTo(Chain::class);
    }

    // public function identity()
    // {
    //     return $this->belongsTo(Identity::class, 'identity_id');
    // }
}
