<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->string('address');
            $table->enum('payment_method', ['МИР', 'VISA', 'MASTERCARD']);
            $table->enum('delivery_method', ['courier', 'pickup']);
            $table->enum('status', ['Новая', 'В работе', 'Отменена'])->default('Новая');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('delivery_cost', 10, 2);
            $table->string('promo_code')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};