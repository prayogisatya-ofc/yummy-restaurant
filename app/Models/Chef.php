<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Chef extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'position',
        'description',
        'insta_link',
        'linked_link',
        'photo'
    ];

    static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
