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
        Schema::create('likes_matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liker_id'); // Foreign key for the user who liked
            $table->unsignedBigInteger('liked_id'); // Foreign key for the user who was liked
            $table->char('match', 1)->default('n'); // 'y' for match, 'n' for no match
            $table->timestamps(); // Tracks created_at & updated_at
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes_matches');
    }
};
