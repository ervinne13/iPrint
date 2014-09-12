<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddPaymentSupportingAttachment extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('job_orders', function($table) {
            $table->string('payment_supporting_attachment_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('job_orders', function($table) {
            $table->dropColumn('payment_supporting_attachment_url');
        });
    }

}
