<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('url');
            $table->string('description');
            $table->string('image')->nullable();
            $table->string('favicon');
            $table->text('public_source')->nullable();
            $table->text('private_source')->nullable();
            $table->datetime('featured_at')->nullable();
            $table->foreignId('submitter_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
