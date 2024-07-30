<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('suggested_organizations', function (Blueprint $table) {
            $table->string('ip_address', 128)->default('old entry');
        });
    }

    public function down(): void
    {
        Schema::table('suggested_organizations', function (Blueprint $table) {
            $table->dropColumn('ip_address');
        });
    }
};
