<?php

use App\Models\Story;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->foreignIdFor(Story::class);
            $table->timestamps();
        });
    }
};
