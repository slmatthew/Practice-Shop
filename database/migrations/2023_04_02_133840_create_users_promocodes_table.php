<?php

use App\Models\Promocode;
use App\Models\User;
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
        Schema::create('users_promocodes', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Promocode::class)->constrained('promocodes')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_promocodes');
    }
};
