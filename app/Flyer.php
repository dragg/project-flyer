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

    /**
     * Scope query to those located at a given address.
     *
     * @param Builder $query
     * @param string $zip
     * @param string $street
     * @return Builder mixed
     */
    public function scopeLocatedAt($query, $zip, $street)
    {
        $street = str_replace('-', ' ', $street);
        return $query->where(compact('zip', 'street'));
    }

    public function getPriceAttribute($price)
    {
        return '$' . number_format($price);
    }
}
