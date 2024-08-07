<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suggested_organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->text('public_source')->nullable();
            $table->text('private_source')->nullable();
            $table->json('sites');
            $table->json('technologies');
            $table->string('suggester_name');
            $table->string('suggester_email');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suggested_organizations');
    }
};
