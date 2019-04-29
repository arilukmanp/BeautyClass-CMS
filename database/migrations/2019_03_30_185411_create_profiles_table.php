<?php

use App\Models\Profile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->collation = 'utf8_general_ci';
            $table->charset = 'utf8';
            $table->increments('id');
            $table->integer('user_id')->length(10)->unsigned();
            $table->string('name', 100);
            $table->string('place_of_birth', 100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone', 20)->nullable();;
            $table->text('address')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


        // Create EO Account
        $profile = new Profile();
        $profile->user_id = '1';
        $profile->name = 'admin';
        $profile->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
