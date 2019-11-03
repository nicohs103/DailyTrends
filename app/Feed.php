<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\User;

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
        'source',
        'publisher',
        'last_editor_id',
    ];

    protected $casts = [
        'title' => 'string',
        'body' => 'string',
        'source' => 'string',
        'publisher' => 'string',
        'last_editor_id' => 'integer',
    ];

    public function lastEditor(){
        return $this->belongsTo(User::class, 'last_editor_id');
    }

}
