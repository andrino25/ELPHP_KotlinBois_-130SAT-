<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Update the foreign key reference to use spiderId
            $table->unsignedBigInteger('spider_id')->nullable();
            $table->foreign('spider_id')
                  ->references('spiderId')  // Changed from 'id' to 'spiderId'
                  ->on('spiders')
                  ->nullOnDelete();
            $table->string('notifName');
            $table->string('notifContent');
            $table->string('notifType');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
