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
        Schema::create('issue_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Issue::class, 'issue_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Tag::class, 'tag_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_tag');
    }
};
