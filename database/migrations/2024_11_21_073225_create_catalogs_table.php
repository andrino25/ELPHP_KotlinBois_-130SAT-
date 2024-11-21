<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id('catalogId');
            $table->string('catalogName');
            $table->text('catalogDescription');
            $table->text('catalogImageRef')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalogs');
    }
};
