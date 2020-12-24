<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventar_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('inventar_id');
            $table->string('name');
            $table->integer('netto');
            $table->integer('bruto');
            $table->integer('count');
            $table->integer('countreal');
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
        Schema::dropIfExists('inventar_lists');
    }
}
