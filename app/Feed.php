<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Feed extends Model implements HasMedia
{
    use HasMediaTrait;
   
    

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
        });

        static::updating(function ($model) {
        });

        static::saving(function ($model) {
        });
    }

    public $fillable = [
        'title',
        'body',
        'image',
        'source',
        'publisher',
    ];

    protected $casts = [
        'title' => 'string',
        'body' => 'string',
        'image' => 'string',
        'source' => 'string',
        'publisher' => 'string',
    ];

}
