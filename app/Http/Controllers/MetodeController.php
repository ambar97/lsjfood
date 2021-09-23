<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetodeRequest;
use App\Models\Metode;
use App\Repositories\MetodeRepository;
use App\Services\FileService;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Helpers\Helper;

class MetodeController extends Controller
{
    /**
     * metodeRepository
     *
     * @var MetodeRepository
     */
    private MetodeRepository $metodeRepository;

    /**
     * fileService
     *
     * @var FileService
     */
    private FileService $fileService;

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->metodeRepository = new MetodeRepository;
        $this->fileService = new FileService;
        // $this->middleware('can:Metode Pembayaran');
        // $this->middleware('can:Metode Pembayaran Tambah')->only(['create', 'store']);
        // $this->middleware('can:Metode Pembayaran Ubah')->only(['edit', 'update']);
        // $this->middleware('can:Metode Pembayaran Hapus')->only(['destroy']);
        // $this->middleware('can:Mahasiswa Impor Excel')->only(['importExcelExample', 'importExcel']);
    }

    /**
     * showing data page
     *
     * @return Response
     */
    public function index()
    {
        return view('metode.index', [
            'data' => $this->metodeRepository->getLatest(),
        ]);
    }

    /**
     * show add new data page
     *
     * @return Response
     */
    public function create()
    {
        return view('metode.form', [

        ]);
    }

    /**
     * save new data to db
     *
     * @param MetodeRequest $request
     * @return Response
     */
    public function store(MetodeRequest $request)
    {
        $this->metodeRepository->create(
            array_merge(
                [

                ],
                $request->only([
                    'nama_metode', 'no_rekening', 'atas_nama', 
                ])
            )
        );
        return redirect('/metodes')->with('successMessage', __('Berhasil menambah data'));
    }

    /**
     * showing edit page
     *
     * @param Metode $metode
     * @return Response
     */
    public function edit(Metode $metode)
    {
        return view('metode.form', [
            'd' => $metode,
        ]);
    }

    /**
     * update data to db
     *
     * @param MetodeRequest $request
     * @param Metode $metode
     * @return Response
     */
    public function update(MetodeRequest $request, Metode $metode)
    {
        $this->metodeRepository->update(
            array_merge(
                [

                ],
                $request->only([
                    'nama_metode', 'no_rekening', 'atas_nama', 
                ])
            ),
            $metode->id
        );
        return redirect('/metodes')->with('successMessage', __('Berhasil memperbarui data'));
    }

    /**
     * delete from db
     *
     * @param Metode $metode
     * @return Response
     */
    public function destroy(Metode $metode)
    {
        $this->metodeRepository->delete($metode->id);
        return redirect()->back()->with('successMessage', __('Berhasil menghapus data'));
    }

    /**
     * download import example
     *
     * @return BinaryFileResponse
     */
    public function importExcelExample(): BinaryFileResponse
    {
        return Excel::download(new \App\Exports\MetodeExport(
            $this->metodeRepository->getLatest()
        ), 'metode_excel_import_example.xlsx');
    }

    /**
     * import excel file to db
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function importExcel(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ]);
        Excel::import(new \App\Imports\MetodeImport, $request->file('import_file'));
        return Helper::redirectSuccess(route('metodes.index'), __('Impor berhasil dilakukan'));
    }
}
