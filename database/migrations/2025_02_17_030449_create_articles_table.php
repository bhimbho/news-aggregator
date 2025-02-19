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
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->string('source')->nullable();
            $table->longText('author')->nullable();
            $table->mediumText('title');
            $table->mediumText('description')->nullable();
            $table->mediumText('url');
            $table->mediumText('urlToImage')->nullable();
            $table->longText('content')->nullable();
            $table->string('category')->nullable();
            $table->dateTime('publishedAt');
            $table->string('platform');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
