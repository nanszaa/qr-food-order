<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_item_id');

            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('menu_id');

            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders')
                ->cascadeOnDelete();

            $table->foreign('menu_id')
                ->references('menu_id')
                ->on('menus')
                ->cascadeOnDelete();

            $table->integer('quantity');

            $table->decimal('price', 12, 2);

            $table->decimal('subtotal', 12, 2);

            $table->text('item_notes')->nullable();

            $table->enum('kitchen_status', [
                'pending',
                'cooking',
                'ready',
                'served'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
