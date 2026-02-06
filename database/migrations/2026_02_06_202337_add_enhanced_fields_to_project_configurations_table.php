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
        Schema::table('project_configurations', function (Blueprint $table) {
            $table->string('specifications_file_path')->nullable()->after('form_types');
            $table->text('specifications_content')->nullable()->after('specifications_file_path');
            $table->json('reference_sites')->nullable()->after('specifications_content');
            $table->json('resource_files')->nullable()->after('reference_sites');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_configurations', function (Blueprint $table) {
            $table->dropColumn(['specifications_file_path', 'specifications_content', 'reference_sites', 'resource_files']);
        });
    }
};
