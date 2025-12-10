<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('disbursements', function (Blueprint $table) {
            $table->renameColumn('notes', 'creator_notes');
            $table->text('admin_note')->nullable()->after('creator_notes');
            $table->dropColumn('status');
            $table->dropColumn('processed_at');
        });

        Schema::table('disbursements', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('account_holder');
            $table->timestamp('approved_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('disbursements', function (Blueprint $table) {
            $table->dropColumn(['admin_note', 'approved_at']);
            $table->renameColumn('creator_notes', 'notes');
            $table->dropColumn('status');
        });

        Schema::table('disbursements', function (Blueprint $table) {
            $table->enum('status', ['requested', 'processing', 'disbursed', 'rejected'])->default('requested');
            $table->timestamp('processed_at')->nullable();
        });
    }
};
