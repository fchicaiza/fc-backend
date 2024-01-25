<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = ['id', 'name','code', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
