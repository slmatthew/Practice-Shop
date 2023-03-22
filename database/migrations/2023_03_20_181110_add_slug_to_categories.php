<?php

use App\Models\Category;
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
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique('categories_name_unique');
            $table->string('slug')->unique()->nullable()->after('image_url');
        });

        Category::all()->each(function ($category) {
            DB::table('categories')
                ->where('id', '=', $category->id)
                ->update(['slug' => str_slug($category->name)]);
        });
    }

    /**
     * Reverse the migrations.1
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->unique('name');
            $table->dropColumn('slug');
        });
    }
};
