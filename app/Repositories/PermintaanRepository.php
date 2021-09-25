<?php

namespace App\Repositories;

use App\Models\Permintaan;
use App\Models\DetailPermintaan;
use Auth;
class PermintaanRepository extends Repository
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Permintaan();
    }
    public function insert($request)
    {
        $karakter = '0123456789';
        $shuffle  = substr(str_shuffle($karakter), 0, 4);
        $generate = date('dmyh').''. $shuffle;
        $data = array('id_permintaan'=> $generate,'id_user'=>Auth::user()->id,'jumlah_permintaan'=>count($request->nama_barang));
        $datas = Permintaan::create($data);
        $lat_id = $datas->id;
        for ($i=0; $i < count($request->nama_barang)  ; $i++) { 
            $detail = array('id_permintaan'=>$lat_id,'nama_barang'=>$request->nama_barang[$i],'qty'=>$request->kuantitas[$i]);
            DetailPermintaan::create($detail);
        }
    }
    public function getDetail($id)
    {
        return DetailPermintaan::where('id_permintaan',$id)->get();
    }
    public function getPermintaan($id)
    {
        return Permintaan::where('id',$id)->first();
    }
    public function updateDetail($request)
    {
        $data = array('id_user'=>Auth::user()->id,'jumlah_permintaan'=>count($request->nama_barang));
        $datas = Permintaan::updateOrCreate($data);
        $lat_id = $request->id_permintaan;
        $post = DetailPermintaan::where('id_permintaan', $request->id_permintaan)->delete();
        for ($i=0; $i < count($request->nama_barang)  ; $i++) { 
            $detail = array('id_permintaan'=>$lat_id,'nama_barang'=>$request->nama_barang[$i],'qty'=>$request->kuantitas[$i]);
            DetailPermintaan::create($detail);
        }
    }
    public function deleteDetail($id)
    {
        DetailPermintaan::where('id_permintaan', $id)->delete();
    }
}
