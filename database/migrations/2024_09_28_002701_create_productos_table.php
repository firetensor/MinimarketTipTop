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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre_producto');
            $table->text('descripcion_producto');
            $table->integer('stock');
            $table->integer('stock_minimo');
            $table->integer('stock_maximo');
            $table->decimal('precio_compra', 10, 2);
            $table->decimal('precio_venta', 10, 2);
            $table->date('fecha_ingreso');
            $table->text('imagen');
            $table->timestamps();
//claves foraneas
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_usuario');
             // Estableciendo las relaciones
             $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');
             $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
