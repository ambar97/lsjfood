<?php

namespace App\Repositories;

use App\Models\Kategori;

class KategoriRepository extends Repository
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Kategori();
    }
}
