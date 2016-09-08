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
        $admin->role_code = Role::CODE_ADMIN;
        $admin->email     = "administrator@ebrochure.com";
        $admin->name      = "Administrator";
        $admin->api_token = str_random(60);
        $admin->password  = \Hash::make("password");

        $admin->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        User::where("email", "administrator@ebrochure.com")->delete();
    }

}
