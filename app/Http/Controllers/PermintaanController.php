<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermintaanRequest;
use App\Models\Permintaan;
use App\Repositories\PermintaanRepository;
use App\Services\FileService;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use PDF;



class PermintaanController extends Controller
{
    /**
     * permintaanRepository
     *
     * @var PermintaanRepository
     */
    private PermintaanRepository $permintaanRepository;

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
        $this->permintaanRepository = new PermintaanRepository;
        $this->fileService = new FileService;
        // $this->middleware('can:Permintaan Produk');
        // $this->middleware('can:Permintaan Produk Tambah')->only(['create', 'store']);
        // $this->middleware('can:Permintaan Produk Ubah')->only(['edit', 'update']);
        // $this->middleware('can:Permintaan Produk Hapus')->only(['destroy']);
        // $this->middleware('can:Mahasiswa Impor Excel')->only(['importExcelExample', 'importExcel']);
    }

    /**
     * showing data page
     *
     * @return Response
     */
    public function index()
    {
        return view('permintaan.index', [
            'data' => $this->permintaanRepository->getLatest(),
        ]);
    }

    /**
     * show add new data page
     *
     * @return Response
     */
    public function create()
    {
        return view('permintaan.form', [
           
        ]);
    }

    
    public function store(Request $request)
    {
        $this->permintaanRepository->insert($request);
        return redirect('/permintaans')->with('successMessage', __('Berhasil menambah data'));
    }

    /**
     * showing edit page
     *
     * @param Permintaan $permintaan
     * @return Response
     */
    public function edit($permintaan)
    {
        return view('permintaan.form', [
            'd'=> $this->permintaanRepository->getPermintaan($permintaan),
            'data' => $this->permintaanRepository->getDetail($permintaan),
        ]);
    }

    /**
     * update data to db
     *
     * @param PermintaanRequest $request
     * @param Permintaan $permintaan
     * @return Response
     */
    public function update(Request $request)
    {
        $this->permintaanRepository->updateDetail($request);
        return redirect()->back()->with('successMessage', __('Berhasil memperbarui data'));
    }

    /**
     * delete from db
     *
     * @param Permintaan $permintaan
     * @return Response
     */
    public function destroy(Permintaan $permintaan)
    {
        $this->permintaanRepository->delete($permintaan->id);
        $this->permintaanRepository->deleteDetail($permintaan->id);
        return redirect()->back()->with('successMessage', __('Berhasil menghapus data'));
    }

    /**
     * download import example
     *
     * @return BinaryFileResponse
     */
    public function importExcelExample(): BinaryFileResponse
    {
        return Excel::download(new \App\Exports\PermintaanExport(
            $this->permintaanRepository->getLatest()
        ), 'permintaan_excel_import_example.xlsx');
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
        Excel::import(new \App\Imports\PermintaanImport, $request->file('import_file'));
        return Helper::redirectSuccess(route('permintaans.index'), __('Impor berhasil dilakukan'));
    }

    public function eksport()
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('pdf/mypdf', $data);
        return $pdf->stream();
    }
}
