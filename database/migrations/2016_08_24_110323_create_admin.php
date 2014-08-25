<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Foundation\Auth\User;

class CreateAdmin extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $admin            = new User();
        $admin->name      = "administrator";
        $admin->role_code = Role::CODE_ADMIN;
        $admin->email     = "administrator@iprint.com";
        $admin->password  = \Hash::make("password");

        $admin->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        User::where("email", "administrator@iprint.com")->delete();
    }

}
