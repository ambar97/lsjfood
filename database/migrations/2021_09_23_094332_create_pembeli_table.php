<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelis', function (Blueprint $table) {
            $table->id();
			$table->string('nama_pembeli', 50);
			$table->string('alamat', 191);
			$table->string('email', 191);
			$table->string('no_telp', 191);
			$table->string('foto', 191);
			$table->string('lat', 191);
			$table->string('long', 191);
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
        Schema::dropIfExists('pembelis');
    }
}
