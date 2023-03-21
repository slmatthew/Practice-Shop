<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::update("UPDATE brands SET image = REPLACE(image, '/storage/', '" . env('APP_URL', 'https://shop.slmatthew.ru') . "/storage/') WHERE image LIKE '/storage/%'");
        DB::update("UPDATE categories SET image_url = REPLACE(image_url, '/storage/', '" . env('APP_URL', 'https://shop.slmatthew.ru') . "/storage/') WHERE image_url LIKE '/storage/%'");
        DB::update("UPDATE products SET image_url = REPLACE(image_url, '/storage/', '" . env('APP_URL', 'https://shop.slmatthew.ru') . "/storage/') WHERE image_url LIKE '/storage/%'");
        DB::update("UPDATE users SET image = REPLACE(image, '/storage/', '" . env('APP_URL', 'https://shop.slmatthew.ru') . "/storage/') WHERE image LIKE '/storage/%'");
    }
    public function down()
    {
        DB::update("UPDATE brands SET image = REPLACE(image, '" . env('APP_URL', 'https://shop.slmatthew.ru') . "/storage/', '/storage/') WHERE image LIKE '" . env('APP_URL', 'https://shop.slmatthew.ru') . "/storage/%'");
        DB::update("UPDATE categories SET image_url = REPLACE(image_url, '" . env('APP_URL', 'https://shop.slmatthew.ru') . "/storage/', '/storage/') WHERE image_url LIKE '" . env('APP_URL', 'https://shop.slmatthew.ru') . "/storage/%'");
        DB::update("UPDATE products SET image_url = REPLACE(image_url, '" . env('APP_URL', 'https://shop.slmatthew.ru') . "/storage/', '/storage/') WHERE image_url LIKE '" . env('APP_URL', 'https://shop.slmatthew.ru') . "/storage/%'");
        DB::update("UPDATE users SET image = REPLACE(image, '" . env('APP_URL', 'https://shop.slmatthew.ru') . "/storage/', '/storage/') WHERE image LIKE '" . env('APP_URL', 'https://shop.slmatthew.ru') . "/storage/%'");
    }
};
