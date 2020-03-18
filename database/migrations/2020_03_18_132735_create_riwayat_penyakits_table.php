<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPenyakitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_penyakits', function (Blueprint $table) {
            $table->integer('id_penyakit')->unsigned();
            $table->foreign('id_penyakit')->references('id')->on('penyakits')->onDelete('cascade');
            $table->char('necktag', 6);
            $table->foreign('necktag')->references('necktag')->on('ternaks')->onDelete('cascade');
            $table->date('tgl_sakit')->nullable();
            $table->string('obat', 50)->nullable();
            $table->integer('lama_sakit')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::table('riwayat_penyakits', function(Blueprint $table)
        {
            $table->dropForeign('riwayat_penyakits_id_penyakit_foreign');
            $table->dropForeign('riwayat_penyakits_necktag_foreign');
        });
        Schema::dropIfExists('riwayat_penyakits');
    }
}
