<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGapoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gapok', function (Blueprint $table) {
            $table->increments('id_gapok');
            $table->integer('id_pangkat')->unsigned()->nullable();
            $table->integer('dari')->nullable();
            $table->integer('sampai')->nullable();
            $table->bigInteger('gaji')->nullable();

            $table->integer('by_users')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_pangkat')->references('id_pangkat')->on('pangkat')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gapoks');
    }
}
