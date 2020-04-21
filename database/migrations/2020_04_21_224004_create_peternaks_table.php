<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeternaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peternaks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('peternakan_id')->unsigned()->nullable();
            $table->foreign('peternakan_id')->references('id')->on('peternakans')->onDelete('cascade');
            $table->string('nama_peternak', 50);
            $table->string('username')->unique();
            $table->string('password');
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
        Schema::table('peternaks', function(Blueprint $table)
        {
            $table->dropForeign('peternaks_peternakan_id_foreign');
        });
        Schema::dropIfExists('peternaks');
    }
}
