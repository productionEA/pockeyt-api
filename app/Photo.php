<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model {

    /**
     * Fillable fields for a photo
     *
     * @var array
     */
    protected $fillable = ['path', 'logo', 'name', 'thumbnail_path'];

    /**
     * The UploadedFile instance
     *
     * @var UploadedFile
     */
    protected $file;

    /**
     * When a photo is created, prepare a thumbnail
     *
     * @return void
     */
    protected static function boot() {
        static::creating(function ($photo) {
            return $photo->upload();
        });
    }

    /**
     * A photo belongs to a profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile() {
        return $this->belongsTo('App\Profile');
    }

    /**
     * Make a new photo instance from an uploaded file
     *
     * @var $file
     * @var $logoBool
     * @return self
     */
    public static function fromForm($file, $logoBool) {
        $photo = new static;

        $photo->file = $file;

        return $photo->fill([
            'name' => $photo->fileName(),
            'path' => $photo->filePath(),
            'thumbnail_path' => $photo->thumbnailPath(),
            'logo' => $logoBool
        ]);
    }

    /**
     * Get the file name for the photo
     *
     * @return string
     */
    public function fileName() {
        $name = sha1(
            $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }

    /**
     * Get the path to the photo
     *
     * @return string
     */
    public function filePath() {
        return $this->baseDir() . '/' . $this->fileName();
    }

    /**
     * Get the base directory for photo uploads
     *
     * @return string
     */
    public function baseDir() {
        return 'images/photos';
    }

    /**
     * Get the path to the photo's thumbnail
     *
     * @return string
     */
    public function thumbnailPath() {
        return $this->baseDir() . '/tn-' . $this->fileName();
    }

    /**
     * Move the photo to the proper folder
     *
     * @return self
     */
    public function upload() {
        $this->file->move($this->baseDir(), $this->fileName());

        $this->makeThumbnail();

        return $this;
    }

    /**
     * Create a thumbnail for the photo
     *
     * @return void
     */
    protected function makeThumbnail() {
        Image::make($this->filePath())
            ->fit(200)
            ->save($this->thumbnailPath());
    }

    public function delete() {
        \File::delete([
            $this->path,
            $this->thumbnail_path
        ]);

        parent::delete();
    }

    public function getUrlAttribute() {
        return \URL::to($this->path);
    }

    public function getThumbnailUrlAttribute() {
        return \URL::to($this->thumbnail_path);
    }
}
