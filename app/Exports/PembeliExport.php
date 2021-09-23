<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;

class PembeliExport implements FromView
{
    /**
     * data
     *
     * @var Collection
     */
    private Collection $data;

    /**
     * constructor method
     *
     * @param Collection $data
     * @return void
     */
    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    /**
     * export from view
     *
     * @return View
     */
    public function view(): View
    {
        if ($this->data->count() === 0) {
            $data = [];
            foreach (range(1, 10) as $i) {
                $columns = ['nama_pembeli', 'alamat', 'email', 'no_telp', 'alamat', 'foto', 'lat', 'long', ];
                array_push($data, (object) array_combine($columns, $columns));
            }
            $this->data = collect($data);
        }
        return view('pembeli.export-excel-example', [
            'data'     => $this->data,
            'isExport' => true
        ]);
    }
}