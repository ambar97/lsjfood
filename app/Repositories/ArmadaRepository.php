<?php

namespace App\Repositories;

use App\Models\Armada;

class ArmadaRepository extends Repository
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Armada();
    }
}
