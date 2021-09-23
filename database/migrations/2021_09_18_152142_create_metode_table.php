<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metodes', function (Blueprint $table) {
            $table->id();
			$table->string('nama_metode', 50);
			$table->string('no_rekening', 191);
			$table->string('atas_nama', 191);
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
        Schema::dropIfExists('metodes');
    }
}
