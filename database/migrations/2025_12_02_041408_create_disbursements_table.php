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
    Schema::create('disbursements', function (Blueprint $table) {
        $table->id();
        $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
        $table->decimal('amount', 15, 2);
        $table->string('bank_name', 100);
        $table->string('account_number', 50);
        $table->string('account_holder', 100);
        $table->enum('status', ['requested', 'processing', 'disbursed', 'rejected'])->default('requested');
        $table->timestamp('processed_at')->nullable();
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disbursements');
    }
};
