<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('general_ledgers', function (Blueprint $table) {
            $table->id('ledger_id');
            $table->string('account_number')->unique();
            $table->string('account_name');
            $table->enum('account_type', ['Assets', 'Liabilities', 'Equity', 'Revenue', 'Expenses']);
            $table->decimal('balance', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_ledgers');
    }
};
