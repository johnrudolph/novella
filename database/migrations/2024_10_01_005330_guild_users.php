<?php

use App\Models\User;
use App\Models\Guild;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guild_users', function (Blueprint $table) {
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Guild::class);
            $table->timestamps();
        });
    }
};
