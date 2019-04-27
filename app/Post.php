<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Post extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [
        'author', 'title', 'image', 'body'
    ];

    public function registerMediaCollections()
    {
        $this->addMediaCollection('postsImages')->singleFile()
            ->acceptsFile(function (File $file){
                if ($file->mimeType === 'image/jpeg' || $file->mimeType === 'image/png' || $file->mimeType === 'image/jpg' || $file->mimeType === 'image/webp'){
                    if ($file->size < 30000000){
                        return $file;
                    }
                }
            })->registerMediaConversions(function (Media $media = null){
                $this->addMediaConversion('newsHome')
                    ->width(640)
                    ->height(480);

                $this->addMediaConversion('card')
                    ->height(325);

                $this->addMediaConversion('thumb')
                    ->height(65);
            });
    }
}
