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
        Schema::table('contacts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });

        Schema::table('projects_events', function (Blueprint $table) {
            $table->foreignId('project_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('event_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('participants', function (Blueprint $table) {
            $table->foreignId('contact_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('event_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::table('presentations', function (Blueprint $table) {
            $table->foreignId('contact_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('project_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('projects_events', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['event_id']);
        });

        Schema::table('participants', function (Blueprint $table) {
            $table->dropForeign(['contact_id']);
            $table->dropForeign(['event_id']);
        });

        Schema::table('presentations', function (Blueprint $table) {
            $table->dropForeign(['contact_id']);
            $table->dropForeign(['project_id']);
        });
    }
};
