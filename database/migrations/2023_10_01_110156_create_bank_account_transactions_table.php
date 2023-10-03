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
        Schema::create('bank_account_transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['credit', 'debit']);
            $table->foreignId('bank_account_id')->constrained('bank_accounts', 'id')->onDelete('cascade');
            $table->foreignId('financial_center_id')->constrained('financial_centers', 'id')->onDelete('cascade');
            $table->string('description')->nullable();
            $table->date('efective_date');
            $table->boolean('completed')->default(false);
            $table->integer('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_account_transactions');
    }
};
