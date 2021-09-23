<?php

namespace App\Repositories;

use App\Models\KategoriProduk;

class KategoriProdukRepository extends Repository
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new KategoriProduk();
    }
}
