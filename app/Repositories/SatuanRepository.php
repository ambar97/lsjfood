<?php

namespace App\Repositories;

use App\Models\Satuan;

class SatuanRepository extends Repository
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Satuan();
    }
}
