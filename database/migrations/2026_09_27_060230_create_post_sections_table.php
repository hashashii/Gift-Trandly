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
    Schema::create('post_sections', function (Blueprint $table) {
        $table->id();

        $table->foreignId('post_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('heading');
        $table->longText('content');
        $table->unsignedInteger('sort_order')->default(0);

        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_sections');
    }
};
