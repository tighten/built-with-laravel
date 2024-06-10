<?php

use App\Models\Organization;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('image');
            $table->text('public_source')->nullable();
            $table->text('private_source')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->foreignId('submitter_id')->constrained('users');
            $table->foreignIdFor(Organization::class);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
