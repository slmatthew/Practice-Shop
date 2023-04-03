<?php

use App\Models\Promocode;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('orders', function (Blueprint $table) {
            //$table->foreignIdFor(Promocode::class)->nullable()->constrained('promocodes')->cascadeOnUpdate()->onDelete('set null');
            $table->integer('discounted')->default(0)->after('checkout');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //$table->dropConstrainedForeignIdFor(Promocode::class);
            $table->dropColumn('discounted');
        });
    }
};
