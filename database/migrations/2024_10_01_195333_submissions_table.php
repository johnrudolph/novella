<?php

use App\Models\User;
use App\Models\Round;
use App\Models\Story;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->string('type');
            $table->integer('applause')->default(0);
            $table->foreignIdFor(Story::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Round::class);
            $table->timestamps();
        });
    }
};
