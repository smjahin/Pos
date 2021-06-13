<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Admin;

class AddAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         $admin = [
          'name' => 'Jone Done',
          'email' => 'jone@example.com',
          'password' => Hash::make(12345678),
          'phone' => '2342349',
          'email_verified_at' => null,
         ];
        Admin::create($admin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
