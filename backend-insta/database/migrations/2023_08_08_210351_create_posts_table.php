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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('image_url');
            $table->unsignedInteger('likes')->default(0);
            $table->timestamps();
        });

        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follower_id'); 
            $table->unsignedBigInteger('following_id'); 
            $table->timestamps();
        });

        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();
        });
    
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('followers');
        Schema::dropIfExists('likes');
    }
};
