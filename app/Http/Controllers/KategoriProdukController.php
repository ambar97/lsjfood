<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriProdukRequest;
use App\Models\KategoriProduk;
use App\Repositories\KategoriProdukRepository;
use App\Services\FileService;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Helpers\Helper;
use App\Models\SessionModel;

class KategoriProdukController extends Controller
{
    /**
     * kategoriProdukRepository
     *
     * @var KategoriProdukRepository
     */
    private KategoriProdukRepository $kategoriProdukRepository;

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
        $this->kategoriProdukRepository = new KategoriProdukRepository;
        $this->fileService = new FileService;
        // $this->middleware('can:Kategori');
        // $this->middleware('can:Kategori Tambah')->only(['create', 'store']);
        // $this->middleware('can:Kategori Ubah')->only(['edit', 'update']);
        // $this->middleware('can:Kategori Hapus')->only(['destroy']);
        // $this->middleware('can:Mahasiswa Impor Excel')->only(['importExcelExample', 'importExcel']);
    }

    /**
     * showing data page
     *
     * @return Response
     */
    public function index()
    {
        return view('kategoriproduk.index', [
            'data' => $this->kategoriProdukRepository->getLatest(),
        ]);
    }

    /**
     * show add new data page
     *
     * @return Response
     */
    public function create()
    {
        return view('kategoriproduk.form', [

        ]);
    }

    /**
     * save new data to db
     *
     * @param KategoriProdukRequest $request
     * @return Response
     */
    public function store(KategoriProdukRequest $request)
    {
        $this->kategoriProdukRepository->create(
            array_merge(
                [

                ],
                $request->only([
                    'nama_kategori', 'keterangan', 
                ])
            )
        );
            $teks = 'insert data kategori produk values nama kaegori ='. $request->nama_kategori;
            $ses = new SessionModel(); 
            $ses->insertSession('Tambah Kategori Produk', $teks);
        return redirect()->back()->with('successMessage', __('Berhasil menambah data'));
    }

    /**
     * showing edit page
     *
     * @param KategoriProduk $kategoriProduk
     * @return Response
     */
    public function edit(KategoriProduk $kategoriProduk)
    {
        return view('kategoriproduk.form', [
            'd' => $kategoriProduk,
        ]);
    }

    /**
     * update data to db
     *
     * @param KategoriProdukRequest $request
     * @param KategoriProduk $kategoriProduk
     * @return Response
     */
    public function update(KategoriProdukRequest $request, KategoriProduk $kategoriProduk)
    {
        $this->kategoriProdukRepository->update(
            array_merge(
                [

                ],
                $request->only([
                    'nama_kategori', 'keterangan', 
                ])
            ),
            $kategoriProduk->id
        );
        return redirect()->back()->with('successMessage', __('Berhasil memperbarui data'));
    }

    /**
     * delete from db
     *
     * @param KategoriProduk $kategoriProduk
     * @return Response
     */
    public function destroy(KategoriProduk $kategoriProduk)
    {
        $this->kategoriProdukRepository->delete($kategoriProduk->id);
        return redirect()->back()->with('successMessage', __('Berhasil menghapus data'));
    }

    /**
     * download import example
     *
     * @return BinaryFileResponse
     */
    public function importExcelExample(): BinaryFileResponse
    {
        return Excel::download(new \App\Exports\KategoriProdukExport(
            $this->kategoriProdukRepository->getLatest()
        ), 'kategoriproduk_excel_import_example.xlsx');
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
        Excel::import(new \App\Imports\KategoriProdukImport, $request->file('import_file'));
        return Helper::redirectSuccess(route('kategoriproduks.index'), __('Impor berhasil dilakukan'));
    }
}
