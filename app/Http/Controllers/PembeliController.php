<?php

namespace App\Http\Controllers;

use App\Http\Requests\PembeliRequest;
use App\Models\Pembeli;
use App\Repositories\PembeliRepository;
use App\Services\FileService;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Helpers\Helper;
use PDF;

class PembeliController extends Controller
{
    /**
     * pembeliRepository
     *
     * @var PembeliRepository
     */
    private PembeliRepository $pembeliRepository;

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
        $this->pembeliRepository = new PembeliRepository;
        $this->fileService = new FileService;
        // $this->middleware('can:Pembeli');
        // $this->middleware('can:Pembeli Tambah')->only(['create', 'store']);
        // $this->middleware('can:Pembeli Ubah')->only(['edit', 'update']);
        // $this->middleware('can:Pembeli Hapus')->only(['destroy']);
        // $this->middleware('can:Mahasiswa Impor Excel')->only(['importExcelExample', 'importExcel']);
    }

    /**
     * showing data page
     *
     * @return Response
     */
    public function index()
    {
        return view('pembeli.index', [
            'data' => $this->pembeliRepository->getLatest(),
        ]);
    }

    /**
     * show add new data page
     *
     * @return Response
     */
    public function create()
    {
        return view('pembeli.form', [

        ]);
    }

    /**
     * save new data to db
     *
     * @param PembeliRequest $request
     * @return Response
     */
    public function store(PembeliRequest $request)
    {
        $this->pembeliRepository->create(
            array_merge(
                $request->only([
                    'nama_pembeli', 'alamat', 'email', 'no_telp', 'alamat', 'lat', 'long', 
                ]),
                ['foto' => $this->fileService->uploadPembelis($request->file('foto'))],
            )
        );
        return redirect('/pembelis')->with('successMessage', __('Berhasil menambah data'));
    }

    /**
     * showing edit page
     *
     * @param Pembeli $pembeli
     * @return Response
     */
    public function edit(Pembeli $pembeli)
    {
        return view('pembeli.form', [
            'd' => $pembeli,
        ]);
    }

    /**
     * update data to db
     *
     * @param PembeliRequest $request
     * @param Pembeli $pembeli
     * @return Response
     */
    public function update(PembeliRequest $request, Pembeli $pembeli)
    {
        if ($request->hasFile('foto')) {
            $this->pembeliRepository->update(
                array_merge(
                    $request->only([
                        'nama_pembeli', 'alamat', 'email', 'no_telp', 'alamat', 'lat', 'long', 
                    ]),
                    ['foto' => $this->fileService->uploadPembelis($request->file('foto'))],
                ),
                $pembeli->id
            );
        }else {
            $this->pembeliRepository->update(
                array_merge(
                    $request->only([
                        'nama_pembeli', 'alamat', 'email', 'no_telp', 'alamat', 'lat', 'long', 
                    ]),
                ),
                $pembeli->id
            );
        }
        return redirect('/pembelis')->with('successMessage', __('Berhasil memperbarui data'));
    }

    /**
     * delete from db
     *
     * @param Pembeli $pembeli
     * @return Response
     */
    public function destroy(Pembeli $pembeli)
    {
        $this->pembeliRepository->delete($pembeli->id);
        return redirect()->back()->with('successMessage', __('Berhasil menghapus data'));
    }
    /**
     * delete from db
     *
     * @param Pembeli $pembeli
     * @return Response
     */
    
    public function maps(Pembeli $pembeli, $id)
    {
        $customers = Pembeli::where('id', $id)->first();
        return view('pembeli.maps', [
            'lat'=>$customers->lat,
            'long'=>$customers->long,
        ]);
    }
    public function address()
    {
        // $address = "Kathmandu, Nepal";
        // $url = "http://maps.google.com/maps/api/geocode/json?address=".urlencode($address);

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
        // $responseJson = curl_exec($ch);
        // curl_close($ch);

        // $response = json_decode($responseJson);

        // if ($response->status == 'OK') {
        //     $latitude = $response->results[0]->geometry->location->lat;
        //     $longitude = $response->results[0]->geometry->location->lng;

        //     echo 'Latitude: ' . $latitude;
        //     echo '<br />';
        //     echo 'Longitude: ' . $longitude;
        // } else {
        //     echo $response->status;
        //     var_dump($response);
        // }  
        // return true;  
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('pdf/mypdf', $data);
        return $pdf->stream();
        // return $pdf->download('itsolutionstuff.pdf');
    }
 
    /**
     * download import example
     *
     * @return BinaryFileResponse
     */
    public function importExcelExample(): BinaryFileResponse
    {
        return Excel::download(new \App\Exports\PembeliExport(
            $this->pembeliRepository->getLatest()
        ), 'pembeli_excel_import_example.xlsx');
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
        Excel::import(new \App\Imports\PembeliImport, $request->file('import_file'));
        return Helper::redirectSuccess(route('pembelis.index'), __('Impor berhasil dilakukan'));
    }
}
