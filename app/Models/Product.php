<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    public $timestamps  = false;
    protected $fillable = [
        'name', 'description', 'image_url'
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function productUOM() {
        return $this->hasMany(ProductUOM::class, 'product_id');
    }

    /**
     * Alias for productUOM
     * @return type
     */
    public function product_uom() {
        return $this->hasMany(ProductUOM::class, 'product_id');
    }

     /**
     * Alias for productUOM
     * @return type
     */
    public function productuomlist() {
        return $this->hasMany(ProductUOM::class, 'product_id');
    }
    
}
