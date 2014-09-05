<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOrderProduct extends Model {

    public $timestamps  = false;
//    protected $primaryKey = ["job_order_id", "product_id"];   
    protected $fillable = [
        "job_order_id", "product_id", "product_uom_code", "qty", "sub_total"
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
    
    public function uom() {
        return $this->belongsTo(UOM::class, 'product_uom_code');
    }

    /**
     * "Hacky" implem to support has many through with a junction table that has composite key
     */
    public function scopeWithProducts($query) {
        return $query
                        ->leftJoin('products', 'product_id', '=', 'id');
        ;
    }

}
