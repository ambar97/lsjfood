<?php

namespace App\Repositories;

use App\Models\Metode;

class MetodeRepository extends Repository
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Metode();
    }
}
