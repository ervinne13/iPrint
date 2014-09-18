<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobOrderTimeEstimation extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('job_orders', function($table) {
            $table->text('estimated_time_of_completion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('job_orders', function($table) {
            $table->dropColumn('estimated_time_of_completion');
        });
    }

}
