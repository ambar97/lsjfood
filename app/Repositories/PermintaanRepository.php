<?php

namespace App\Repositories;

use App\Models\Permintaan;

class PermintaanRepository extends Repository
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Permintaan();
    }
}
