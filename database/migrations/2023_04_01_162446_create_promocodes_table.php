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
        Schema::create('promocodes', function (Blueprint $table) {
            $table->id();

            $table->string('promocode')->unique();
            $table->integer('activation_limit')->default(0);

            $table->integer('discount')->default(5);

            $table->timestamp('created_at')->useCurrent()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->timestamp('expires_at')->nullable()->default(DB::raw('NULL'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promocodes');
    }
};
