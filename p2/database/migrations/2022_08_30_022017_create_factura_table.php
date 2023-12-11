<?php

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
        Schema::create('factura', function (Blueprint $table) {
            $table->id();
            $table->double('total');
            $table->date('fecha');
            $table->foreignId('cajero_id')
                ->nullable()
                ->constrained('cajero')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('cliente_id')
                ->nullable()
                ->constrained('cliente')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura');
    }
};
