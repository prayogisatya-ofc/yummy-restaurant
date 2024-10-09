<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'price',
        'status',
        'description',
        'image',
    ];

    static public function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            $event->uuid = (string) Str::uuid();
        });
    }
}
