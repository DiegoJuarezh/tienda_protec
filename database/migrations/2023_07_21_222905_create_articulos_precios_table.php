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
        Schema::create('articulos_precios', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('articulo_id');
            $table->string('nombre', 200);
            $table->float('precio', 10, 2);
            $table->unsignedInteger('usuario_id');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos_precios');
    }
};
