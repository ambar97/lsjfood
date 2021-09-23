<?php

namespace App\Repositories;

use App\Models\MetodePembayaran;

class MetodePembayaranRepository extends Repository
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new MetodePembayaran();
    }
}
