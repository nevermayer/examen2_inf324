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
        Schema::create('orden', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('apellido_pat')->nullable();
            $table->double('total');
            $table->string('estado');
            $table->date('fecha');
            $table->dateTime('hora')->nullable();
            $table->integer('telefono')->nullable();
            $table->foreignId('chef_id')
                ->nullable()
                ->constrained('chef')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('camarero_id')
                ->nullable()
                ->constrained('camarero')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('mesa_id')
                ->nullable()
                ->constrained('mesa')
                ->cascadeOnUpdate()
                ->nullOnDelete();
                $table->foreignId('factura_id')
                ->nullable()
                ->constrained('factura')
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
        Schema::dropIfExists('orden');
    }
};
