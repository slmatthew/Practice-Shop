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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('image_url')->default('/img/camera_200.png');
            $table->timestamps();
        });

        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Смартфоны',
                'image_url' => '/storage/categories/CqQLkKTRWrud5z04euwkUyT4WECkmKyMM8Pysif1.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Клавиатуры',
                'image_url' => '/storage/categories/NuFUwdjW8hdBFBkYXyHwvWDrzcxfYWXC14EJtAZW.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Наушники',
                'image_url' => '/storage/categories/EkM3GVQa2OIaOTUbAG2taqZ6aBL2gf4CxJve48B7.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Мышки',
                'image_url' => '/storage/categories/Wu4N8HGHbgRVBlLugO8SXqiLDTzf8RLvMsaKTmaK.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'name' => 'Мониторы',
                'image_url' => '/storage/categories/cAUvdnuKGIhYVVKg8s2Yjhvple6ySLatqvh6iNM0.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'name' => 'Смарт-часы и браслеты',
                'image_url' => '/storage/categories/S4mbcu0QXx0s79M2PAX8ggeTrh8GUfByLahre2uL.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
