<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Flyer extends Model
{
    protected $fillable = [
        'street',
        'city',
        'state',
        'country',
        'zip',
        'price',
        'description'
    ];

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }
    
    /**
     * Find the flyer at a given address.
     *
     * @param string $zip
     * @param string $street
     * @return Flyer
     */
    public static function LocatedAt($zip, $street)
    {
        $street = str_replace('-', ' ', $street);
        return static::where(compact('zip', 'street'))->first();
    }

    public function getPriceAttribute($price)
    {
        return '$' . number_format($price);
    }
}
