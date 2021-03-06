<?php

namespace App;

use File;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $fillable = ['name', 'path', 'thumbnail_path'];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->path = $this->baseDir() . '/' . $name;
        $this->thumbnail_path = $this->baseDir() . '/th-' . $name;
    }

    public function baseDir()
    {
        return 'images/photos';
    }

    public function flyer()
    {
        return $this->belongsTo(Flyer::class);
    }

    public function delete()
    {
        File::delete([$this->path, $this->thumbnail_path]);

        parent::delete();
    }
}
