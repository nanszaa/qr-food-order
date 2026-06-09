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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');

           $table->unsignedBigInteger('customer_session_id');

            $table->foreign('customer_session_id')
                ->references('customer_session_id')
                ->on('customer_sessions')
                ->cascadeOnDelete();

            $table->string('order_code')->unique();

            $table->decimal('total_price', 12, 2)->default(0);

            $table->enum('order_status', [
                'pending',
                'processing',
                'completed',
                'paid',
                'cancelled'
            ])->default('pending');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
