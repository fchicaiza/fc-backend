<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['id', 'name', 'code', 'province_id'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function zones()
    {
        return $this->hasMany(Zone::class);
    }
}
