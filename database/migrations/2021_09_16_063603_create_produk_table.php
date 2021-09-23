<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
			$table->string('nama_produk', 50);
			$table->string('isi', 191);
			$table->string('harga', 191);
			$table->string('satuan', 191);
			$table->string('keterangan', 191)->nullable();
			$table->string('image', 191);
			$table->string('kategori', 191);
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
        Schema::dropIfExists('produks');
    }
}
