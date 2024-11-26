<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spiders', function (Blueprint $table) {
            $table->id('spiderId');
            $table->foreignId('userId')->constrained('users')->cascadeOnDelete();
            $table->string('spiderName');
            $table->string('spiderImageRef');
            $table->string('spiderSize');
            $table->decimal('spiderEstimatedMarketValue', 10, 2);
            $table->string('spiderHealthStatus');
            $table->text('spiderDescription');
            $table->boolean('spiderIsFavorite')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spiders');
    }
};
