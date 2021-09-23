<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use App\Repositories\KategoriRepository;
use App\Services\FileService;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Helpers\Helper;

class KategoriController extends Controller
{
    /**
     * kategoriRepository
     *
     * @var KategoriRepository
     */
    private KategoriRepository $kategoriRepository;

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
        $this->kategoriRepository = new KategoriRepository;
        $this->fileService = new FileService;
        // $this->middleware('can:Kategori Produk');
        // $this->middleware('can:Kategori Produk Tambah')->only(['create', 'store']);
        // $this->middleware('can:Kategori Produk Ubah')->only(['edit', 'update']);
        // $this->middleware('can:Kategori Produk Hapus')->only(['destroy']);
        // $this->middleware('can:Mahasiswa Impor Excel')->only(['importExcelExample', 'importExcel']);
    }

    /**
     * showing data page
     *
     * @return Response
     */
    public function index()
    {
        return view('kategori.index', [
            'data' => $this->kategoriRepository->getLatest(),
        ]);
    }

    /**
     * show add new data page
     *
     * @return Response
     */
    public function create()
    {
        return view('kategori.form', [

        ]);
    }

    /**
     * save new data to db
     *
     * @param KategoriRequest $request
     * @return Response
     */
    public function store(KategoriRequest $request)
    {
        $this->kategoriRepository->create(
            array_merge(
                [

                ],
                $request->only([
                    'nama_kategori', 'keterangan', 
                ])
            )
        );
        return redirect('/kategoris')->with('successMessage', __('Berhasil menambah data'));
    }

    /**
     * showing edit page
     *
     * @param Kategori $kategori
     * @return Response
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.form', [
            'd' => $kategori,
        ]);
    }

    /**
     * update data to db
     *
     * @param KategoriRequest $request
     * @param Kategori $kategori
     * @return Response
     */
    public function update(KategoriRequest $request, Kategori $kategori)
    {
        $this->kategoriRepository->update(
            array_merge(
                [

                ],
                $request->only([
                    'nama_kategori', 'keterangan', 
                ])
            ),
            $kategori->id
        );
        return redirect('/kategoris')->with('successMessage', __('Berhasil memperbarui data'));
    }

    /**
     * delete from db
     *
     * @param Kategori $kategori
     * @return Response
     */
    public function destroy(Kategori $kategori)
    {
        $this->kategoriRepository->delete($kategori->id);
        return redirect()->back()->with('successMessage', __('Berhasil menghapus data'));
    }

    /**
     * download import example
     *
     * @return BinaryFileResponse
     */
    public function importExcelExample(): BinaryFileResponse
    {
        return Excel::download(new \App\Exports\KategoriExport(
            $this->kategoriRepository->getLatest()
        ), 'kategori_excel_import_example.xlsx');
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
        Excel::import(new \App\Imports\KategoriImport, $request->file('import_file'));
        return Helper::redirectSuccess(route('kategoris.index'), __('Impor berhasil dilakukan'));
    }
}
