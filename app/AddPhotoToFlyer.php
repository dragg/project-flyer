<?php

namespace App;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddPhotoToFlyer
{
    protected $flyer;

    protected $file;

    protected $thumbnail;

    /**
     * AddPhotoToFlyer constructor.
     * @param $flyer
     * @param $file
     */
    public function __construct(Flyer $flyer, UploadedFile $file, Thumbnail $thumbnail = null)
    {
        $this->flyer = $flyer;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;
    }

    public function save()
    {
        $photo = $this->flyer->addPhoto($this->makePhoto());

        $this->file->move($photo->baseDir(), $photo->name);

        $this->thumbnail->make($photo->path, $photo->thumbnail_path);

    }

    /**
     * @return Photo
     */
    public function makePhoto()
    {
        return new Photo(['name' => $this->makeFileName()]);
    }

    public function makeFileName()
    {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return $this->fileName = "{$name}.{$extension}";
    }

}
