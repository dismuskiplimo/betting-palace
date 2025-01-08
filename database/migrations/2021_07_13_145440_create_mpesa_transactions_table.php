<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMpesaTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_transactions', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('Amount')->nullable();
            $table->string('MpesaReceiptNumber')->nullable();
            $table->string('Balance')->nullable();
            $table->string('TransactionDate')->nullable();
            $table->string('PhoneNumber')->nullable();
            $table->string('user_id')->nullable();
            $table->string('description')->nullable();
            $table->string('mpesa_request_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mpesa_transactions');
    }
}
