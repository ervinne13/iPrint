<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoreLogoAndInfoFields extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('stores', function($table) {
            $table->text('description')->nullable();
            $table->text('logo_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('stores', function($table) {
            $table->dropColumn('description');
            $table->dropColumn('logo_url');
        });
    }

}
