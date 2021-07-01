<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrailItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trail_items', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('trail_id')->nullable();
            $table->foreign('trail_id')->references('id')->on('trail')->onUpdate('cascade')->onDelete('cascade');
			$table->date('date')->nullable();
            $table->double('cost', 15, 8);			
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
        Schema::dropIfExists('trail_items');
    }
}
