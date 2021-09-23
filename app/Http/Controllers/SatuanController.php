<?php

namespace App\Http\Controllers;

use App\Http\Requests\SatuanRequest;
use App\Models\Satuan;
use App\Repositories\SatuanRepository;
use App\Services\FileService;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Helpers\Helper;

class SatuanController extends Controller
{
    /**
     * satuanRepository
     *
     * @var SatuanRepository
     */
    private SatuanRepository $satuanRepository;

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
        $this->satuanRepository = new SatuanRepository;
        $this->fileService = new FileService;
        // $this->middleware('can:Satuan Produk');
        // $this->middleware('can:Satuan Produk Tambah')->only(['create', 'store']);
        // $this->middleware('can:Satuan Produk Ubah')->only(['edit', 'update']);
        // $this->middleware('can:Satuan Produk Hapus')->only(['destroy']);
        // $this->middleware('can:Mahasiswa Impor Excel')->only(['importExcelExample', 'importExcel']);
    }

    /**
     * showing data page
     *
     * @return Response
     */
    public function index()
    {
        return view('satuan.index', [
            'data' => $this->satuanRepository->getLatest(),
        ]);
    }

    /**
     * show add new data page
     *
     * @return Response
     */
    public function create()
    {
        return view('satuan.form', [

        ]);
    }

    /**
     * save new data to db
     *
     * @param SatuanRequest $request
     * @return Response
     */
    public function store(SatuanRequest $request)
    {
        $this->satuanRepository->create(
            array_merge(
                [

                ],
                $request->only([
                    'nama_satuan_produk', 'keterangan_satuan_produk', 
                ])
            )
        );
        return redirect('/satuans')->with('successMessage', __('Berhasil menambah data'));
    }

    /**
     * showing edit page
     *
     * @param Satuan $satuan
     * @return Response
     */
    public function edit(Satuan $satuan)
    {
        return view('satuan.form', [
            'd' => $satuan,
        ]);
    }

    /**
     * update data to db
     *
     * @param SatuanRequest $request
     * @param Satuan $satuan
     * @return Response
     */
    public function update(SatuanRequest $request, Satuan $satuan)
    {
        $this->satuanRepository->update(
            array_merge(
                [

                ],
                $request->only([
                    'nama_satuan_produk', 'keterangan_satuan_produk', 
                ])
            ),
            $satuan->id
        );
        return redirect('/satuans')->with('successMessage', __('Berhasil memperbarui data'));
    }

    /**
     * delete from db
     *
     * @param Satuan $satuan
     * @return Response
     */
    public function destroy(Satuan $satuan)
    {
        $this->satuanRepository->delete($satuan->id);
        return redirect()->back()->with('successMessage', __('Berhasil menghapus data'));
    }

    /**
     * download import example
     *
     * @return BinaryFileResponse
     */
    public function importExcelExample(): BinaryFileResponse
    {
        return Excel::download(new \App\Exports\SatuanExport(
            $this->satuanRepository->getLatest()
        ), 'satuan_excel_import_example.xlsx');
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
        Excel::import(new \App\Imports\SatuanImport, $request->file('import_file'));
        return Helper::redirectSuccess(route('satuans.index'), __('Impor berhasil dilakukan'));
    }
}
