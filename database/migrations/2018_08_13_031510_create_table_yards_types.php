<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableYardsTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yards_types', function( $table ){
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('saved_yards_types', function( $table ){
            $table->integer('yard_id')->unsigned();
            $table->foreign('yard_id')->references('id')->on('yards');
            $table->integer('yards_types_id')->unsigned();
            $table->foreign('yards_types_id')->references('id')->on('yards_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saved_yards_types');
        Schema::dropIfExists('yards_types');
    }
}
