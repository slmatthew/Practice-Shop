<?php

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained('orders')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Product::class)->constrained('products')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedInteger('quantity');
            $table->timestamp('created_at')->useCurrent()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->useCurrentOnUpdate()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders_items');
    }
};
