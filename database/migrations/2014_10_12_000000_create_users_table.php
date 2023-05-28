<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('user_id')->unique();
            $table->string('email')->unique();
            $table->string('join_date')->unique();
            $table->string('phone_number')->nullable();
            $table->string('status')->nullable();
            $table->string('role_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('position')->nullable();
            $table->string('department')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        // Create default admin 
        DB::table('users')->insert([
            'name' => 'admin',
            'user_id' => 'KH_00001',
            'email' => 'admin@email.com',
            'join_date' => now(),
            'phone_number' => '0688671114',
            'status' => 'Active',
            'role_name' => 'Admin',
            'avatar' => 'photo_defaults.jpg',
            'password' => Hash::make('mourad12345'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
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
