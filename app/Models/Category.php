<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->slug = (string) Str::slug($model->title);
        });

        static::updating(function ($model) {
            $model->slug = (string) Str::slug($model->title);
        });
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
