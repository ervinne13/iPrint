<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model {

    protected $fillable = [
        "store_id", "requested_by_user_id", "total_item_qty", "total_cost", "payment_ref_no", "status", "remarks", "attachment_url", "payment_supporting_attachment_url"
    ];

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        $this->status = "Open";
    }

    public static function CurrentYearSales($storeId) {
        return JobOrder::TotalSales()->statusClosed()->store($storeId)->currentYear()->first()["total_sales"];
    }

    public static function CurrentMonthSales($storeId) {
        return JobOrder::TotalSales()->statusClosed()->store($storeId)->currentMonth()->first()["total_sales"];
    }

    public static function PastMonthSales($storeId) {
        $previousMonth = date('m', strtotime('-1 month'));
        return JobOrder::TotalSales()->statusClosed()->store($storeId)->month($previousMonth)->first()["total_sales"];
    }

    public static function SalesSummaryReport($storeId) {

        $previousMonth = date('m', strtotime('-1 month'));
        $sales         = [];

        for ($i = 0; $i < $previousMonth; $i ++) {
            $monthlySales = JobOrder::TotalSales()->store($storeId)->statusClosed()->month($i + 1)->first();
            array_push($sales, $monthlySales["total_sales"] ? $monthlySales["total_sales"] : 0);
        }

        return $sales;
    }

    //
    //  <editor-fold defaultstate="collapsed" desc="Relationships">

    public function productJunctions() {
        return $this->hasMany(JobOrderProduct::class, 'job_order_id');
    }

    public function products() {
        return $this->hasManyThrough(Product::class, JobOrderProduct::class, 'job_order_id', 'id', 'product_id');
    }

    public function requestedBy() {
        return $this->belongsTo(User::class, 'requested_by_user_id');
    }

    //  </editor-fold>
    //
    //  <editor-fold defaultstate="collapsed" desc="Scopes">    

    public function scopeStatusClosed($query) {
        return $query->whereIn("status", [
                    "Ready for Pickup",
                    "Fullfilled"
        ]);
    }

    public function scopeTotalSales($query) {
        return $query->selectRaw('SUM(total_cost) AS total_sales');
    }

    public function scopeCurrentMonth($query) {
        //  TODO: check if this sould be fullfilled at instead
        return $query->whereMonth('created_at', '=', date('m'));
    }

    public function scopeMonth($query, $monthIndex) {
        //  TODO: check if this sould be fullfilled at instead
        return $query->whereMonth('created_at', '=', $monthIndex);
    }

    public function scopeCurrentYear($query) {
        return $query->whereYear('created_at', '=', date('Y'));
    }

    public function scopeYear($query, $year) {
        return $query->whereYear('created_at', '=', $year);
    }

    public function scopeStore($query, $storeId) {
        return $query->where("store_id", $storeId);
    }

    public function scopeAwaitingStoreAction($query) {
        return $query->whereIn("status", ["Open"]);
    }

    public function scopeNewestOrders($query, $limit) {

        return $query
                        ->orderBy("created_at", "DESC")
                        ->limit($limit)
        ;
    }

    public function scopeStoreDatatable($query, $store) {
        return $query
                        ->with('requestedBy')
                        ->with(['productJunctions' => function($query) {
                                $query->leftJoin('products', 'product_id', '=', 'id');
                            }]);
    }

    //  </editor-fold>
}
