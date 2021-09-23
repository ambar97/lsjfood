<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArmadaRequest;
use App\Models\Armada;
use App\Repositories\ArmadaRepository;
use App\Services\FileService;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Helpers\Helper;
use App\Models\SessionModel;

class ArmadaController extends Controller
{
    /**
     * armadaRepository
     *
     * @var ArmadaRepository
     */
    private ArmadaRepository $armadaRepository;

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
        $this->armadaRepository = new ArmadaRepository;
        $this->fileService = new FileService;
        // $this->middleware('can:Armada');
        // $this->middleware('can:Armada Tambah')->only(['create', 'store']);
        // $this->middleware('can:Armada Ubah')->only(['edit', 'update']);
        // $this->middleware('can:Armada Hapus')->only(['destroy']);
        // $this->middleware('can:Mahasiswa Impor Excel')->only(['importExcelExample', 'importExcel']);
    }

    /**
     * showing data page
     *
     * @return Response
     */
    public function index()
    {
        return view('armada.index', [
            'data' => $this->armadaRepository->getLatest(),
        ]);
    }

    /**
     * show add new data page
     *
     * @return Response
     */
    public function create()
    {
        return view('armada.form', [

        ]);
    }

    /**
     * save new data to db
     *
     * @param ArmadaRequest $request
     * @return Response
     */
    public function store(ArmadaRequest $request)
    {
        $this->armadaRepository->create(
            array_merge(
                [

                ],
                $request->only([
                    'nama_armada', 'nama_driver', 'plat_nomor', 
                ])
            )
        );
            $teks = 'insert data armada values nama armada ='. $request->nama_armada.', nama driver='. $request->nama_driver .', plat_nomor='. $request->plat_nomor;
            $ses = new SessionModel(); 
            $ses->insertSession('Tambah Armada', $teks);
        return redirect('/armadas')->with('successMessage', __('Berhasil menambah data'));
    }

    /**
     * showing edit page
     *
     * @param Armada $armada
     * @return Response
     */
    public function edit(Armada $armada)
    {
        return view('armada.form', [
            'd' => $armada,
        ]);
    }

    /**
     * update data to db
     *
     * @param ArmadaRequest $request
     * @param Armada $armada
     * @return Response
     */
    public function update(ArmadaRequest $request, Armada $armada)
    {
        $this->armadaRepository->update(
            array_merge(
                [

                ],
                $request->only([
                    'nama_armada', 'nama_driver', 'plat_nomor', 
                ])
            ),
            $armada->id
        );
        return redirect()->back()->with('successMessage', __('Berhasil memperbarui data'));
    }

    /**
     * delete from db
     *
     * @param Armada $armada
     * @return Response
     */
    public function destroy(Armada $armada)
    {
        $this->armadaRepository->delete($armada->id);
        return redirect()->back()->with('successMessage', __('Berhasil menghapus data'));
    }

    /**
     * download import example
     *
     * @return BinaryFileResponse
     */
    public function importExcelExample(): BinaryFileResponse
    {
        return Excel::download(new \App\Exports\ArmadaExport(
            $this->armadaRepository->getLatest()
        ), 'armada_excel_import_example.xlsx');
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
        Excel::import(new \App\Imports\ArmadaImport, $request->file('import_file'));
        return Helper::redirectSuccess(route('armadas.index'), __('Impor berhasil dilakukan'));
    }
}
