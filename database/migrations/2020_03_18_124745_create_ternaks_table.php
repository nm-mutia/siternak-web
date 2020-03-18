<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTernaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ternaks', function (Blueprint $table) {
            $table->char('necktag', 6)->primary();
            $table->integer('id_pemilik')->unsigned()->nullable();
            $table->foreign('id_pemilik')->references('id')->on('pemiliks')->onDelete('cascade');
            $table->integer('id_ras')->unsigned();
            $table->foreign('id_ras')->references('id')->on('ras')->onDelete('cascade');
            $table->integer('id_kematian')->unsigned()->nullable();
            $table->foreign('id_kematian')->references('id')->on('kematians')->onDelete('cascade');
            $table->char('jenis_kelamin', 1);
            $table->date('tgl_lahir')->nullable();
            $table->float('bobot_lahir')->nullable();
            $table->time('pukul_lahir')->nullable();
            $table->integer('lama_dikandungan')->nullable();
            $table->integer('lama_laktasi')->nullable();
            $table->date('tgl_lepas_sapih')->nullable();
            $table->char('blood', 1);
            $table->char('necktag_ayah', 6)->nullable();
            $table->char('necktag_ibu', 6)->nullable();
            $table->float('bobot_tubuh')->nullable();
            $table->float('panjang_tubuh')->nullable();
            $table->float('tinggi_tubuh')->nullable();
            $table->string('cacat_fisik')->nullable();
            $table->string('ciri_lain')->nullable();
            $table->boolean('status_ada')->default(true);
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
        Schema::table('ternaks', function(Blueprint $table)
        {
            $table->dropForeign('ternaks_id_pemilik_foreign');
            $table->dropForeign('ternaks_id_ras_foreign');
            $table->dropForeign('ternaks_id_kematian_foreign');
        });
        Schema::dropIfExists('ternaks');
    }
}
