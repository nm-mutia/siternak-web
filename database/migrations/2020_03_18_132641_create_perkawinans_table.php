<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerkawinansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perkawinans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('necktag', 6);
            $table->char('necktag_psg', 6);
            $table->foreign('necktag_psg')->references('necktag')->on('ternaks');
            $table->date('tgl')->nullable();
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
        Schema::table('perkawinans', function(Blueprint $table)
        {
            $table->dropForeign('perkawinans_necktag_psg_foreign');
        });
        
        Schema::dropIfExists('perkawinans');
    }
}
