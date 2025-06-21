<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // sales_orders migration
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->decimal('total_amount', 10, 2);
                $table->enum('status', ['pending', 'confirmed'])->default('pending');
            $table->timestamps();
        });

    }

    public function down(): void {
        Schema::dropIfExists('sales_orders');
    }
};
