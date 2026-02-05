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
        Schema::create('project_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');

            // Design & Branding
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->string('accent_color')->nullable();
            $table->string('domain_name')->nullable();
            $table->string('design_style')->nullable(); // e.g., 'minimalist', 'modern', 'brutalism'

            // Assets (URLs)
            $table->string('logo_path')->nullable();
            $table->string('banner_path')->nullable();

            // Content
            $table->text('copywriting_brief')->nullable();

            // Contact Information
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('contact_address')->nullable();
            $table->text('opening_hours')->nullable();

            // Functional options
            $table->json('form_types')->nullable(); // Array of requested forms
            $table->json('additional_options')->nullable(); // For "many other options"

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_configurations');
    }
};
