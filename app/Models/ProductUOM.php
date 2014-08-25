<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUOM extends Model {

    protected $table      = "product_uom";
    protected $primaryKey = ["product_id", "uom_code"];
    public $incrementing  = false;

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function uom() {        
        return $this->hasOne(UOM::class, 'code', 'uom_code');
    }

}
