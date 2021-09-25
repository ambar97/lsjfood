<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukRequest;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\SessionModel;
use App\Models\Satuan;
use App\Repositories\ProdukRepository;
use App\Services\FileService;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Auth;

class ProdukController extends Controller
{
    /**
     * produkRepository
     *
     * @var ProdukRepository
     */
    private ProdukRepository $produkRepository;

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
        $this->produkRepository = new ProdukRepository;
        $this->fileService = new FileService;
        // $this->middleware('can:Produk');
        // $this->middleware('can:Produk Tambah')->only(['create', 'store']);
        // $this->middleware('can:Produk Ubah')->only(['edit', 'update']);
        // $this->middleware('can:Produk Hapus')->only(['destroy']);
        // $this->middleware('can:Mahasiswa Impor Excel')->only(['importExcelExample', 'importExcel']);
    }

    /**
     * showing data page
     *
     * @return Response
     */
    public function index()
    {
        // dd(storage_path());
        return view('produk.index', [
            'data' => $this->produkRepository->getLatest(),
        ]);
    }

    /**
     * show add new data page
     *
     * @return Response
     */
    public function create()
    {
        // dd(KategoriProduk::all());
        return view('produk.form', [
            'kategori'=> Kategori::all(),
            'satuan'=>Satuan::all(),
        ]);
    }

    /**
     * save new data to db
     *
     * @param ProdukRequest $request
     * @return Response
     */
    public function store(ProdukRequest $request)
    {
        $this->produkRepository->create(
            array_merge(
                $request->only([
                    'nama_produk', 'isi', 'harga', 'satuan', 'keterangan', 'kategori', 
                ]),
                ['image' => $this->fileService->uploadProduks($request->file('image'))],
            )
        );
        $teks = 'insert data nama_produk ='. $request->nama_produk .', isi ='. $request->isi.', harga='. $request->harga.' satuan='. Satuan::where('id',$request->satuan)->first()->nama_satuan.', kategori='. Kategori::where('id',$request->kategori)->first()->nama_kategori .', keterangan='. $request->keterangan;
        $ses = new SessionModel(); 
        $ses->insertSession('Tambah Produk', $teks,'null');
        return redirect('/produks')->with('successMessage', __('Berhasil menambah data'));
    }

    /**
     * showing edit page
     *
     * @param Produk $produk
     * @return Response
     */
    public function edit(Produk $produk)
    {
        
        return view('produk.form', [
            'd' => $produk,
            'kategori'=> Kategori::all(),
            'satuan'=> Satuan::all(),
        ]);
    }

    /**
     * update data to db
     *
     * @param ProdukRequest $request
     * @param Produk $produk
     * @return Response
     */
    public function update(ProdukRequest $request, Produk $produk)
    {
        if ($request->hasFile('image')) {
            $this->produkRepository->update(
                array_merge(
                    $request->only([
                        'nama_produk', 'isi', 'harga', 'satuan', 'keterangan', 'kategori', 
                    ]),
                     ['image' => $this->fileService->uploadProduks($request->file('image'))],
                ),
                $produk->id
            );
        }else {
            $this->produkRepository->update(
                array_merge(
                    $request->only([
                        'nama_produk', 'isi', 'harga', 'satuan', 'keterangan', 'kategori', 
                    ]),
                ),
                $produk->id
            );
        }
        return redirect('/produks')->with('successMessage', __('Berhasil memperbarui data'));
    }

    /**
     * delete from db
     *
     * @param Produk $produk
     * @return Response
     */
    public function destroy(Produk $produk)
    {
        $this->produkRepository->delete($produk->id);
        return redirect()->back()->with('successMessage', __('Berhasil menghapus data'));
    }

    /**
     * download import example
     *
     * @return BinaryFileResponse
     */
    public function importExcelExample(): BinaryFileResponse
    {
        return Excel::download(new \App\Exports\ProdukExport(
            $this->produkRepository->getLatest()
        ), 'produk_excel_import_example.xlsx');
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
        Excel::import(new \App\Imports\ProdukImport, $request->file('import_file'));
        return Helper::redirectSuccess(route('produks.index'), __('Impor berhasil dilakukan'));
    }
}
