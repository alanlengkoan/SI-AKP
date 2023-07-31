<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiPangkatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai_pangkat', function (Blueprint $table) {
            $table->increments('id_pegawai_pangkat');
            $table->integer('id_pegawai')->unsigned()->nullable();
            $table->integer('id_pangkat')->unsigned()->nullable();
            $table->date('tmt')->nullable()->comment('tmt = tanggal mulai tugas');

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai');
            $table->foreign('id_pangkat')->references('id_pangkat')->on('pangkat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai_pangkats');
    }
}
