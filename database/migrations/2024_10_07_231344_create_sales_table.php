<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_sales_table.php
public function up()
{
    Schema::create('sale', function (Blueprint $table) {
        $table->id();
        $table->string('tour_name', 50);
        $table->integer('pax');
        $table->decimal('price', 8, 2);
        $table->string('fecha');
        $table->string('email', 100);
        $table->string('phone', 15);
        $table->string('comments', 255)->nullable();
        $table->string('nombre', 50);
        //$table->timestamps(); Esto agregará campos para manejar fechas de creación y actualización
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
