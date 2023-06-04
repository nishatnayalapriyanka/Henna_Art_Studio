<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AppointmentModel extends Model
{
    use HasFactory;

    protected $table = "appointment";
    protected $primaryKey = "appointment_id";
    public $timestamps = false;

    

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = Str::random(10);
            }
        });
    }
}
