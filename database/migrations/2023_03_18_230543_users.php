<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->timestamps();
            $table->string('phone')->nullable();
            $table->string('image')->default('/img/camera_200.png');
            $table->integer('logout')->default(0);
        });

        /**
         * username: admin
         * password: 12345678
         */

        DB::table('users')->insert([
            'id' => 1,
            'username' => 'admin',
            'password' => '$2y$10$XkjUW8tHXovDf7MwNhv1a.1ffTyFEYH4YWlu21eUASvC/Yoan5FTO',
            'role' => 'admin',
            'name' => 'Admin',
            'surname' => 'Admin',
            'created_at' => '2023-03-06 18:11:32',
            'updated_at' => '2023-03-16 06:20:12',
            'phone' => '9999999999',
            'image' => '/img/camera_200.png',
            'logout' => 0,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();
    }
};
