<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetodePembayaranRequest;
use App\Models\MetodePembayaran;
use App\Repositories\MetodePembayaranRepository;
use App\Services\FileService;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Helpers\Helper;
use App\Models\SessionModel;

class MetodePembayaranController extends Controller
{
    /**
     * metodePembayaranRepository
     *
     * @var MetodePembayaranRepository
     */
    private MetodePembayaranRepository $metodePembayaranRepository;

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
        $this->metodePembayaranRepository = new MetodePembayaranRepository;
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
        return view('metodepembayaran.index', [
            'data' => $this->metodePembayaranRepository->getLatest(),
        ]);
    }

    /**
     * show add new data page
     *
     * @return Response
     */
    public function create()
    {
        return view('metodepembayaran.form', [

        ]);
    }

    /**
     * save new data to db
     *
     * @param MetodePembayaranRequest $request
     * @return Response
     */
    public function store(MetodePembayaranRequest $request)
    {
        $this->metodePembayaranRepository->create(
            array_merge(
                [

                ],
                $request->only([
                    'nama_metode', 'no_rekening', 'atas_nama', 
                ])
            )
        );
        $teks = 'insert data metode pembayaran values nama_metode ='. $request->nama_metode .', no rekening ='. $request->no_rekening.', atas_nama='. $request->atas_nama;
        $ses = new SessionModel(); 
        $ses->insertSession('Tambah Metode Pembayaran', $teks);
        return redirect()->back()->with('successMessage', __('Berhasil menambah data'));
    }

    /**
     * showing edit page
     *
     * @param MetodePembayaran $metodePembayaran
     * @return Response
     */
    public function edit(MetodePembayaran $metodePembayaran)
    {
        return view('metodepembayaran.form', [
            'd' => $metodePembayaran,
        ]);
    }

    /**
     * update data to db
     *
     * @param MetodePembayaranRequest $request
     * @param MetodePembayaran $metodePembayaran
     * @return Response
     */
    public function update(MetodePembayaranRequest $request, MetodePembayaran $metodePembayaran)
    {
        $this->metodePembayaranRepository->update(
            array_merge(
                [

                ],
                $request->only([
                    'nama_metode', 'no_rekening', 'atas_nama', 
                ])
            ),
            $metodePembayaran->id
        );
        return redirect()->back()->with('successMessage', __('Berhasil memperbarui data'));
    }

    /**
     * delete from db
     *
     * @param MetodePembayaran $metodePembayaran
     * @return Response
     */
    public function destroy(MetodePembayaran $metodePembayaran)
    {
        $this->metodePembayaranRepository->delete($metodePembayaran->id);
        return redirect()->back()->with('successMessage', __('Berhasil menghapus data'));
    }

    /**
     * download import example
     *
     * @return BinaryFileResponse
     */
    public function importExcelExample(): BinaryFileResponse
    {
        return Excel::download(new \App\Exports\MetodePembayaranExport(
            $this->metodePembayaranRepository->getLatest()
        ), 'metodepembayaran_excel_import_example.xlsx');
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
        Excel::import(new \App\Imports\MetodePembayaranImport, $request->file('import_file'));
        return Helper::redirectSuccess(route('metodepembayarans.index'), __('Impor berhasil dilakukan'));
    }
}
