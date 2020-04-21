<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPeternakanToTernaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ternaks', function (Blueprint $table) {
            $table->integer('peternakan_id')->unsigned()->nullable()->after('pemilik_id');
            $table->foreign('peternakan_id')->references('id')->on('peternakans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ternaks', function (Blueprint $table) {
            //
        });
    }
}
