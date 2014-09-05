<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUOM extends Model {

    protected $table      = "product_uom";
    protected $primaryKey = ["product_id", "uom_code"];
    public $incrementing  = false;
    public $timestamps    = false;
    protected $fillable   = [
        'product_id', 'uom_code', 'price_per_uom'
    ];

    public function scopeFind($query, $productId, $uomCode) {
        return $query
                        ->where("product_id", $productId)
                        ->where("uom_code", $uomCode)
                        ->first();
    }

    public function product() {
        return $this->belongsTo(Product::class, 'id', 'product_id');
    }

    public function uom() {
        return $this->hasOne(UOM::class, 'code', 'uom_code');
    }

}
