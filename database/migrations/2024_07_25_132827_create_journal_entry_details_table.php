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
        Schema::create('journal_entry_details', function (Blueprint $table) {
            $table->id('detail_id');
            $table->unsignedBigInteger('journal_id');
            $table->string('account_number');
            $table->decimal('debit', 15, 2)->nullable();
            $table->decimal('credit', 15, 2)->nullable();
            $table->text('description');
            $table->timestamps();

            $table->foreign('journal_id')->references('journal_id')->on('journals')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entry_details');
    }
};
