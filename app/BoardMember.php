<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class BoardMember extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable = [
        'name', 'title', 'email', 'mobile_number', 'image',
    ];

    public function registerMediaCollections()
    {
        $this->addMediaCollection('boardMembersImages')->singleFile()
            ->acceptsFile(function (File $file){
                if ($file->mimeType === 'image/jpeg' || $file->mimeType === 'image/png' || $file->mimeType === 'image/jpg' || $file->mimeType === 'image/webp'){
                    if ($file->size < 30000000){
                        return $file;
                    }
                }
            })->registerMediaConversions(function (Media $media = null){
                $this->addMediaConversion('card')
                    ->height(325)
                    ->withResponsiveImages();

                $this->addMediaConversion('thumb')
                    ->height(65)
                    ->withResponsiveImages();
            });
    }
}
