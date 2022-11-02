<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\Agama;
use App\Models\Master\JenisUsaha;
use App\Models\Master\LevelUsaha;
use App\Models\Master\KriteriaUsaha;
use App\Models\Master\KriteriaPekerjaLepas;
use App\Models\Master\StatusPekerjaan;
use App\Models\Master\KategoriPekerjaan;
use App\Models\Master\LevelInstansi;
use App\Models\Master\UniversitasJenjang;
use App\Models\Master\UniversitasLevel;
use App\Models\Master\UniversitasKategori;
use App\Models\Master\JenisPerusahaan;
use App\Models\Master\Pendidikan;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->province = new Province();
        $this->city = new City();
        $this->agama = new Agama();
        $this->jenis_usaha = new JenisUsaha();
        $this->level_usaha = new LevelUsaha();
        $this->kriteria_usaha = new KriteriaUsaha();
        $this->kriteria_pekerja_lepas = new KriteriaPekerjaLepas();
        $this->status_pekerjaan = new StatusPekerjaan();
        $this->kategori_pekerjaan = new KategoriPekerjaan();
        $this->level_instansi = new LevelInstansi();
        $this->universitas_jenjang = new UniversitasJenjang();
        $this->universitas_level = new UniversitasLevel();
        $this->universitas_kategori = new UniversitasKategori();
        $this->jenis_perusahaan = new JenisPerusahaan();
        $this->pendidikan = new Pendidikan();
    }

    public function province(Request $request){
        $data_json = [];

        try {
            $province_id = (empty($request->input("province_id"))) ? null : trim(htmlentities($request->input("province_id")));

            $province = $this->province;
            if(!empty($province_id)){
                $province = $province->where("prov_id",$province_id);
            }
            $province = $province->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $province;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function city(Request $request){
        $data_json = [];

        try {
            $province_id = (empty($request->input("province_id"))) ? null : trim(htmlentities($request->input("province_id")));
            $city_id = (empty($request->input("city_id"))) ? null : trim(htmlentities($request->input("city_id")));

            $city = $this->city;
            if(!empty($city_id)){
                $city = $city->where("city_id",$city_id);
            }
            if(!empty($province_id)){
                $city = $city->where("prov_id",$province_id);
            }
            $city = $city->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $city;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function agama(Request $request){
        $data_json = [];

        try {
            $agama = $this->agama;
            $agama = $agama->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $agama;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function jenis_usaha(Request $request){
        $data_json = [];

        try {
            $data = $this->jenis_usaha;
            $data = $data->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $data;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function level_usaha(Request $request){
        $data_json = [];

        try {
            $data = $this->level_usaha;
            $data = $data->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $data;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function kriteria_usaha(Request $request){
        $data_json = [];

        try {
            $data = $this->kriteria_usaha;
            $data = $data->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $data;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function kriteria_pekerja_lepas(Request $request){
        $data_json = [];

        try {
            $data = $this->kriteria_pekerja_lepas;
            $data = $data->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $data;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function status_pekerjaan(Request $request){
        $data_json = [];

        try {
            $data = $this->status_pekerjaan;
            $data = $data->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $data;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function kategori_pekerjaan(Request $request){
        $data_json = [];

        try {
            $data = $this->kategori_pekerjaan;
            $data = $data->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $data;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function level_instansi(Request $request){
        $data_json = [];

        try {
            $data = $this->level_instansi;
            $data = $data->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $data;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function universitas_jenjang(Request $request){
        $data_json = [];

        try {
            $data = $this->universitas_jenjang;
            $data = $data->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $data;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function universitas_level(Request $request){
        $data_json = [];

        try {
            $data = $this->universitas_level;
            $data = $data->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $data;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function universitas_kategori(Request $request){
        $data_json = [];

        try {
            $data = $this->universitas_kategori;
            $data = $data->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $data;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function jenis_perusahaan(Request $request){
        $data_json = [];

        try {
            $data = $this->jenis_perusahaan;
            $data = $data->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $data;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function pendidikan(Request $request){
        $data_json = [];

        try {
            $data = $this->pendidikan;
            $data = $data->get();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            $data_json["Data"] = $data;
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }
}