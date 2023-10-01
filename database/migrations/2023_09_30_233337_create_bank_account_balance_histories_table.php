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
        Schema::create('bank_account_balance_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_account_balance_id')->constrained('bank_account_balances', 'id')->onDelete('cascade');
            $table->integer('balance');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_account_balance_histories');
    }
};
