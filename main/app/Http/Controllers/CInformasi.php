<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class CInformasi extends Controller
{
    public function index(){
        $cuaca = DB::table('nelayan_detailcuaca')
                 ->join('nelayan_postlaporan','nelayan_postlaporan.id_laporan','=','nelayan_detailcuaca.id_laporan')
                 ->join('nelayan_user','nelayan_user.id_user','=','nelayan_postlaporan.id_user')
                 ->where('nelayan_postlaporan.jenis_laporan','=',2)
                 ->get();

        /*$keadaan_laut = DB::table('nelayan_detailkeadaanlaut')
            ->get();*/

        $keadaan_laut = DB::table('nelayan_detailkeadaanlaut')
            ->join('nelayan_postlaporan','nelayan_postlaporan.id_laporan','=','nelayan_detailkeadaanlaut.id_laporan')
            ->join('nelayan_user','nelayan_user.id_user','=','nelayan_postlaporan.id_user')
            ->where('nelayan_postlaporan.jenis_laporan','=',3)
            ->get();

        /*$kejahatan = DB::table('nelayan_detailkejahatan')
            ->get();*/

        $kejahatan = DB::table('nelayan_detailkejahatan')
            ->join('nelayan_postlaporan','nelayan_postlaporan.id_laporan','=','nelayan_detailkejahatan.id_laporan')
            ->join('nelayan_user','nelayan_user.id_user','=','nelayan_postlaporan.id_user')
            ->where('nelayan_postlaporan.jenis_laporan','=',1)
            ->get();

        $tangkapan = DB::table('nelayan_detailtangkapan')
            ->join('nelayan_postlaporan','nelayan_postlaporan.id_laporan','=','nelayan_detailtangkapan.id_laporan')
            ->join('nelayan_user','nelayan_user.id_user','=','nelayan_postlaporan.id_user')
            ->where('nelayan_postlaporan.jenis_laporan','=',5)
            ->get();

        $panic = DB::table('nelayan_postlaporan')
            ->where('nelayan_postlaporan.jenis_laporan','=',4)
            ->join('nelayan_user','nelayan_user.id_user','=','nelayan_postlaporan.id_user')
            ->orderBy('nelayan_postlaporan.detail_waktu','desc')
            ->get();

        $laporan = DB::table('nelayan_postlaporan')
                    /*->select('*')
                    ->join('nelayan_detailcuaca','nelayan_detailcuaca.id_laporan','=','nelayan_postlaporan.id_laporan')
                    ->join('nelayan_detailkeadaanlaut','nelayan_detailkeadaanlaut.id_laporan','=','nelayan_postlaporan.id_laporan')
                    ->join('nelayan_detailkejahatan','nelayan_detailkejahatan.id_laporan','=','nelayan_postlaporan.id_laporan')
                    ->join('nelayan_user','nelayan_user.id_user','=','nelayan_postlaporan.id_user')
                    ->orderBy('nelayan_postlaporan.detail_waktu','desc')*/
                    ->join('nelayan_user','nelayan_user.id_user','=','nelayan_postlaporan.id_user')
                    ->orderBy('nelayan_postlaporan.detail_waktu','desc')
                    ->get();



        return view('index')
                ->with('cuaca',$cuaca)
                ->with('keadaan_laut',$keadaan_laut)
                ->with('kejahatan',$kejahatan)
                ->with('laporan',$laporan)
                ->with('panic',$panic)
                ->with('tangkapan',$tangkapan)
                ->with('markerCuaca',json_encode($cuaca))
                ->with('markerKeadaanLaut',json_encode($keadaan_laut))
                ->with('markerKejahatan',json_encode($kejahatan))
                ->with('markerTangkapan',json_encode($tangkapan))
                ->with('markerPanic',json_encode($panic));
                //->with('map_laporan',json_encode($map_laporan));
    }
}
