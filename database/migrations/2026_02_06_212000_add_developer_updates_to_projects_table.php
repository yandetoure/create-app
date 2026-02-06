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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('deployment_url')->nullable();
            $table->string('staging_url')->nullable();
            $table->json('demo_files')->nullable();
            $table->json('developer_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['deployment_url', 'staging_url', 'demo_files', 'developer_notes']);
        });
    }
};
