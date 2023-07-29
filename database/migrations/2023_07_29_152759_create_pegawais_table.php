<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->increments('id_pegawai');
            $table->integer('id_agama')->unsigned()->nullable();
            $table->integer('id_pangkat')->unsigned()->nullable();
            $table->integer('id_pendidikan')->unsigned()->nullable();
            $table->string('nip', 50)->unique()->nullable();
            $table->date('tgl_sk')->nullable();
            $table->string('nama', 50)->nullable();
            $table->enum('kelamin', ['L', 'P'])->nullable()->comment('L: Laki-laki, P: Perempuan');
            $table->string('tmp_lahir', 50)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('status', ['0', '1'])->nullable()->comment('0: Tidak Aktif, 1: Aktif');

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_agama')->references('id_agama')->on('agama')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pangkat')->references('id_pangkat')->on('pangkat')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pendidikan')->references('id_pendidikan')->on('pendidikan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
