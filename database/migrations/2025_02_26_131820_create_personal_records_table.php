<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('personal_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relacionamento com a tabela user
            $table->foreignId('movement_id')->constrained('movements')->onDelete('cascade'); // Relacionamento com movements
            $table->float('value'); // Valor do recorde pessoal
            $table->dateTime('date'); // Data do recorde
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_records');
    }
};
