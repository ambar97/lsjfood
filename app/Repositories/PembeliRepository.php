<?php

namespace App\Repositories;

use App\Models\Pembeli;

class PembeliRepository extends Repository
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Pembeli();
    }
}
