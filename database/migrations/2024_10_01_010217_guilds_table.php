<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guilds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('motto');
            $table->boolean('is_public');
            $table->boolean('is_open');
            $table->timestamps();
        });
    }
};
