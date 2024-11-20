<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spiders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('spiderSpecies');
            $table->string('spiderHealthStatus');
            $table->float('spiderBuyCost');
            $table->float('spiderSellPrice');
            $table->integer('spiderQuantity');
            $table->string('spiderImageRef');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spiders');
    }
};
