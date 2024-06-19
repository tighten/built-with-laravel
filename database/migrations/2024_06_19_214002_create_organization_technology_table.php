<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organization_technology', function (Blueprint $table) {
            $table->foreignId('organization_id')->constrained('organizations');
            $table->foreignId('technology_id')->constrained('technologies');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_technology');
    }
};
