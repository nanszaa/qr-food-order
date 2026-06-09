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
        Schema::create('menus', function (Blueprint $table) {
            $table->id('menu_id');

            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')
                ->cascadeOnDelete();

            $table->string('name');

            $table->text('description')->nullable();

            $table->decimal('price', 12, 2);

            $table->string('image')->nullable();

            $table->integer('stock')->default(0);

            $table->boolean('is_available')->default(true);

            $table->boolean('is_best_seller')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
