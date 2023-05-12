<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// database/migrations/2023_05_12_000000_create_posts_table.php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();          // created_at + updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
