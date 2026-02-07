<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_template_customizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('template_id')->constrained()->cascadeOnDelete();
            $table->string('primary_color')->default('#6366f1'); // Indigo
            $table->string('secondary_color')->default('#8b5cf6'); // Purple
            $table->string('accent_color')->default('#ec4899'); // Pink
            $table->string('font_heading')->default('Inter');
            $table->string('font_body')->default('Inter');
            $table->string('logo_url')->nullable();
            $table->json('custom_components')->nullable(); // Selected component variants per section
            $table->json('custom_images')->nullable();
            $table->timestamps();

            $table->unique('project_id');
            $table->index('template_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_template_customizations');
    }
};
