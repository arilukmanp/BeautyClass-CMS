<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->increments('id');
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('token')->nullable();
            $table->rememberToken();
            $table->tinyInteger('role')->default('1');
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });

        
        // Create EO Account
        $user = new User();
        $user->email = 'admin@beautyclass.com';
        $user->password = bcrypt('admin123');
        $user->token = str_random(20);
        $user->role = '3';
        $user->status = '2';
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
