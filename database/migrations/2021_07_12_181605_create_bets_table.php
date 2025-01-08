<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('league')->nullable();
            $table->string('gameId')->nullable();
            $table->string('homeName')->nullable();
            $table->string('awayName')->nullable();
            $table->string('prediction')->nullable();

            $table->integer('predictedHomeScore')->nullable();
            $table->integer('predictedAwayScore')->nullable();

            $table->boolean('free')->default(0);

            $table->integer('status')->default(0);

            $table->integer('homeScore')->nullable();
            $table->integer('awayScore')->nullable();

            $table->integer('user_id');
            $table->timestamp('starts_at')->nullable();
            
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
        Schema::dropIfExists('bets');
    }
}
