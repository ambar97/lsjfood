<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;

class ArmadaExport implements FromView
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
                $columns = ['nama_armada', 'nama_driver', 'plat_nomor', ];
                array_push($data, (object) array_combine($columns, $columns));
            }
            $this->data = collect($data);
        }
        return view('armada.export-excel-example', [
            'data'     => $this->data,
            'isExport' => true
        ]);
    }
}
