<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trail', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('customer_id'); 
            $table->string('trail_to')->nullable();
            $table->string('flying_from')->nullable();
            $table->double('total_cost', 15, 8);
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
        Schema::dropIfExists('trail');
    }
}
