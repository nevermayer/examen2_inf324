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
        Schema::create('solicitud_chef', function (Blueprint $table) {
            $table->id();
            $table->string('cantidad');
            $table->string('status');
            $table->date('fecha');
            $table->foreignId('chef_id')
                ->constrained('chef')
                ->cascadeOnDelete();
            $table->foreignId('ingredientes_id')
                ->constrained('ingredientes')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_chef');
    }
};
