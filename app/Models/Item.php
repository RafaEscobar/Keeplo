<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Item extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'status',
        'observation',
        'vahul_id'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('item_cover')->singleFile();
    }

    public function vahul()
    {
        return $this->belongsTo(Vahul::class);
    }
}
