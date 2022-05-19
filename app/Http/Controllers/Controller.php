<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getProvinsi(Request $request){
        $idProvinsi = $request->get('id');

        $provinsi = Provinsi::where('id', $idProvinsi)->get();

        return response()->json($provinsi);
        //return view('welcome');
    }

    public function getKabupaten(Request $request){
        $idKabupaten = $request->get('id_kabupaten');

        $kabupaten = Kabupaten::where('id_kabupaten', $idKabupaten)->get();

        return response()->json($kabupaten);
        //return view('welcome');
    }
    public function getListKabupaten(Request $request){
        $idProvinsi = $request->get('id_provinsi');

        $kabupaten = Kabupaten::where('id_provinsi', $idProvinsi)->get();

        return response()->json($kabupaten);
        //return view('welcome');
    }

    public function createProvinsi(Request $request){
        $namaProvinsi = $request->get('nama_provinsi');

        if($namaProvinsi == ''){
            return response()->json(["Nama provinsi harus diisi!"]);
        }else{
            $provinsi = new Provinsi;
            $provinsi->nama = $namaProvinsi;
            $provinsi->save();

            return response()->json($provinsi);
        }
    }

    public function createKabupaten(Request $request){
        $idProvinsi = $request->get('id_provinsi');
        $namaKabupaten = $request->get('nama_kabupaten');

        if($idProvinsi == ''){
            return response()->json(["Id provinsi harus diisi!"]);
        }else{
            $kabupaten = new Kabupaten;
            $kabupaten->id_provinsi = $idProvinsi;
            $kabupaten->nama = $namaKabupaten;
            $kabupaten->save();

            return response()->json($kabupaten);
        }
    }

    public function dashboard(Request $request){
        $token = $request->get('t');

        if($token){
            $request->session()->put('token', $token);
            return view('dashboard', ["token"=>$token]);
        }else{
            return redirect("/");
        }

    }

}

