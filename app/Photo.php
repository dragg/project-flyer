<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $fillable = ['name', 'path', 'thumbnail_path'];

    /**
     * @var UploadedFile
     */
    protected $file;

    protected $fileName;

    public static function boot()
    {
        static::creating(function ($photo) {
            return $photo->upload();
        });
    }

    public static function fromFile(UploadedFile $file)
    {
        $photo = new static;

        $photo->file = $file;

        return $photo->fill([
            'name' => $photo->fileName(),
            'path' => $photo->filePath(),
            'thumbnail_path' => $photo->thumbnailPath()
        ]);
    }

    public function fileName()
    {
        if (!$this->fileName) {
            $name = sha1(
                time() . $this->file->getClientOriginalName()
            );

            $extension = $this->file->getClientOriginalExtension();

            $this->fileName = "{$name}.{$extension}";
        }

        return $this->fileName;
    }

    public function filePath()
    {
        return $this->baseDir() . '/' . $this->fileName();
    }

    public function baseDir()
    {
        return 'images/photos';
    }

    public function thumbnailPath()
    {
        return $this->baseDir() . '/th-' . $this->fileName();
    }

    public function flyer()
    {
        return $this->belongsTo(Flyer::class);
    }

    public function upload()
    {
        $this->file->move($this->baseDir(), $this->fileName());

        $this->makeThumbnail();

        return $this;
    }

    protected function makeThumbnail()
    {
        Image::make($this->filePath())
            ->fit(200)
            ->save($this->thumbnailPath());
    }
}
