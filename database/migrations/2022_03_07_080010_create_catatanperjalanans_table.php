<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatatanperjalanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catatanperjalanans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->date('tgl')->nullable();
            $table->time('jam')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('suhu')->nullable();
            $table->string('foto')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('catatanperjalanans');
    }
}
