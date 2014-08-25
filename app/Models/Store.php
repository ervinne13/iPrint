<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Store extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'location_lat', 'location_long'
    ];

    public function owner() {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

}