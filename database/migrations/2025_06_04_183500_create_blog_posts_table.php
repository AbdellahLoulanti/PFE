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

        Schema::create('blog_posts', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->text('content');

            $table->enum('status', ['draft', 'published']);

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();

            $table->string('slug')->unique();

            $table->string('image')->nullable();

            $table->string('tags')->nullable();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('blog_posts');

    }
};
