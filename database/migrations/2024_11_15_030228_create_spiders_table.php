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
        Schema::create('spiders', function (Blueprint $table) {
            $table->id('spiderID');
            $table->foreignId('userID')->constrained('users')->onDelete('cascade');
            $table->string('spiderName');
            $table->enum('spiderSize', ['Small', 'Medium', 'Large']);
            $table->enum('spiderHealthStatus', ['Healthy', 'Sick', 'Critical']);
            $table->decimal('spiderCostPrice', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spiders');
    }
};
