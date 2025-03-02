<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->id(); // Cria a coluna id como chave primária
            $table->string('name'); // Nome do movimento
            $table->timestamps(); // Cria as colunas created_at e updated_at automaticamente
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};
