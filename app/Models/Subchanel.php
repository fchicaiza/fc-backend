<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subchanel extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['name', 'code', 'chanel_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    public function canal()
    {
        return $this->belongsTo(Chanel::class);
    }

    public function establishments()
    {
        return $this->hasMany(Establishment::class);
    }
}
