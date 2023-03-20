<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $magic_category = Category::create([
            'id' => 0,
            'name' => 'Все товары',
            'slug' => 'all',
            'image_url' => '/img/camera_200.png'
        ]);

        $mc_id = $magic_category->id;

        $magic_category->id = 0;
        $magic_category->save();

        DB::unprepared("ALTER TABLE categories AUTO_INCREMENT = {$mc_id};");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Category::where('slug', '=', 'all')->first()->delete();
    }
};
