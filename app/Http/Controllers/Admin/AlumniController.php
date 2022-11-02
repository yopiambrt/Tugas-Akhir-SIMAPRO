<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\Alumni\AlumniBekerjaHistori;
use App\Models\Alumni\AlumniWirausahaHistori;
use App\Models\Alumni\AlumniStudiLanjutHistori;
use App\Models\Master\StatusPekerjaan;
use App\Models\User;
use App\Helpers\UploadHelper;
use App\Helpers\DateHelper;
use Error;
use Auth;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->view = "admin.alumni.";
        $this->route = "admin.alumni.";
        $this->alumni = new Alumni();
        $this->user = new User();
        $this->alumni_bekerja_histori = new AlumniBekerjaHistori();
        $this->alumni_wirausaha_histori = new AlumniWirausahaHistori();
        $this->alumni_studi_lanjut_histori = new AlumniStudiLanjutHistori();
    }

    public function index()
    {
        $table = $this->alumni;
        $table = $table->orderBy("created_at","DESC");
        $table = $table->get();

        $data = [
            'table' => $table
        ];

        return view($this->view."index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mahasiswa = $this->user;
        $mahasiswa = $mahasiswa->where("is_active",User::IS_ACTIVE_YES);
        $mahasiswa = $mahasiswa->whereHas("biodata");
        $mahasiswa = $mahasiswa->get();

        $data = [
            'mahasiswa' => $mahasiswa
        ];

        return view($this->view."create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_json = [];
        try {
            $user_id = (empty($request->input("user_id"))) ? 0 : trim(htmlentities($request->input("user_id")));
            $status_kelulusan = (empty($request->input("status_kelulusan"))) ? 0 : trim(htmlentities($request->input("status_kelulusan")));
            $tanggal_lulus = (empty($request->input("tanggal_lulus"))) ? null : trim(htmlentities($request->input("tanggal_lulus")));
            $tanggal_terbit_ijasah = (empty($request->input("tanggal_terbit_ijasah"))) ? null : trim(htmlentities($request->input("tanggal_terbit_ijasah")));
            $upload_foto_ijasah = $request->file("upload_foto_ijasah");
            $status_pekerjaan_id = (empty($request->input("status_pekerjaan_id"))) ? null : trim(htmlentities($request->input("status_pekerjaan_id")));
            $status_verifikasi = (empty($request->input("status_verifikasi"))) ? 0 : trim(htmlentities($request->input("status_verifikasi")));

            if(!$user_id){
                throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if($status_kelulusan === ""){
               throw new Error("Status kelulusan mahasiswa tidak boleh kosong");
            }

            if($status_verifikasi === ""){
                throw new Error("Status verifikasi mahasiswa tidak boleh kosong");
            }

            if($status_kelulusan == Alumni::STATUS_KELULUSAN_YES){
                if(!$tanggal_lulus){
                    throw new Error("Tahun lulus mahasiswa tidak boleh kosong");
                }

                if(!$tanggal_terbit_ijasah){
                    throw new Error("Tanggal terbit ijasah mahasiswa tidak boleh kosong");
                }

                if(!$upload_foto_ijasah){
                    throw new Error("Upload foto ijasah mahasiswa tidak boleh kosong");
                }

                if(!$status_pekerjaan_id){
                    throw new Error("Status pekerjaan mahasiswa tidak boleh kosong");
                }
            }

            $check_exist_alumni = $this->alumni;
            $check_exist_alumni = $check_exist_alumni->where("user_id",$user_id);
            $check_exist_alumni = $check_exist_alumni->first();

            if($check_exist_alumni){
                throw new Error("Duplikat nama mahasiswa . Mahasiswa ini sudah terdaftar sebagai alumni");
            }

            if(!empty($upload_foto_ijasah)){
                $valid_ext = [];

                $upload = UploadHelper::upload_file($upload_foto_ijasah,'ijasah',$valid_ext);

                if($upload["IsError"] == TRUE){
                    throw new Error($upload["Message"]);
                }

                $upload_foto_ijasah = $upload["Path"];
            }

            if($status_kelulusan == Alumni::STATUS_KELULUSAN_NO){
                $tanggal_lulus = null;
                $tanggal_terbit_ijasah = null;
                $upload_foto_ijasah = null;
                $status_pekerjaan_id = null;
            }

            $this->alumni->create([
                'user_id' => $user_id,
                'status_kelulusan' => $status_kelulusan,
                'tanggal_lulus' => $tanggal_lulus,
                'tanggal_terbit_ijasah' => $tanggal_terbit_ijasah,
                'upload_foto_ijasah' => $upload_foto_ijasah,
                'status_verifikasi' => $status_verifikasi,
                'status_pekerjaan_id' => $status_pekerjaan_id,
            ]);

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil ditambahkan";
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = $this->alumni;
        $result = $result->where('id',$id);
        $result = $result->first();

        if(!$result){
            return redirect()->route($this->route.'index')->with('error','Data tidak ditemukan');
        }

        $mahasiswa = $this->user;
        $mahasiswa = $mahasiswa->where("is_active",User::IS_ACTIVE_YES);
        $mahasiswa = $mahasiswa->whereHas("biodata");
        $mahasiswa = $mahasiswa->get();

        $data = [
            'mahasiswa' => $mahasiswa,
            'result' => $result,
        ];

        return view($this->view."edit",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->alumni;
        $result = $result->where('id',$id);
        $result = $result->first();

        if(!$result){
            return redirect()->route($this->route.'index')->with('error','Data tidak ditemukan');
        }

        $mahasiswa = $this->user;
        $mahasiswa = $mahasiswa->where("is_active",User::IS_ACTIVE_YES);
        $mahasiswa = $mahasiswa->whereHas("biodata");
        $mahasiswa = $mahasiswa->get();

        $waktu_tunggu = "";
        $waktu_tunggu_detail = "";

        if(!empty($result->user->alumni->status_pekerjaan_id) && !empty($result->user->alumni->tanggal_terbit_ijasah) && $result->user->alumni->status_verifikasi == Alumni::STATUS_VERIFIKASI_YES){
            if($result->user->alumni->status_pekerjaan_id == StatusPekerjaan::BEKERJA){
                if(!empty($result->user->alumni_bekerja->tanggal_mulai)){
                    $tanggal_akhir = $result->user->alumni_bekerja->tanggal_mulai;
                    $tanggal_awal = $result->user->alumni->tanggal_terbit_ijasah;

                    $diff = DateHelper::different_date($tanggal_akhir,$tanggal_awal);

                    $bulan = $diff["months"];

                    if($diff["years"] >= 1){
                        $bulan = (int)$diff["years"]*12;
                    }
                    
                    $waktu_tunggu = "Masa tunggu untuk bekerja sejak diterbitkannya ijasah yaitu".(($bulan <= 6) ? " < " : " > ")."6 bulan";

                    $waktu_tunggu_detail = "Waktu tunggu = ".$diff["years"]." tahun ".$diff["months"]." bulan ".$diff["days"]." hari";
                } 
            }

            else if($result->user->alumni->status_pekerjaan_id == StatusPekerjaan::MEMBUKA_USAHA){
                if(!empty($result->user->alumni_wirausaha->tanggal_mulai)){
                    $tanggal_akhir = $result->user->alumni_wirausaha->tanggal_mulai;
                    $tanggal_awal = $result->user->alumni->tanggal_terbit_ijasah;

                    $diff = DateHelper::different_date($tanggal_akhir,$tanggal_awal);

                    $bulan = $diff["months"];

                    if($diff["years"] >= 1){
                        $bulan = (int)$diff["years"]*12;
                    }
                    
                    $waktu_tunggu = "Masa tunggu untuk membuka usaha sejak diterbitkannya ijasah yaitu".(($bulan <= 6) ? " < " : " > ")."6 bulan";

                    $waktu_tunggu_detail = "Waktu tunggu = ".$diff["years"]." tahun ".$diff["months"]." bulan ".$diff["days"]." hari";
                } 
            }

            else if($result->user->alumni->status_pekerjaan_id == StatusPekerjaan::STUDI_LANJUT){
                if(!empty($result->user->alumni_studi_lanjut->tanggal_mulai)){
                    $tanggal_akhir = $result->user->alumni_studi_lanjut->tanggal_mulai;
                    $tanggal_awal = $result->user->alumni->tanggal_terbit_ijasah;

                    $diff = DateHelper::different_date($tanggal_akhir,$tanggal_awal);

                    $bulan = $diff["months"];

                    if($diff["years"] >= 1){
                        $bulan = (int)$diff["years"]*12;
                    }
                    
                    $waktu_tunggu = "Masa tunggu untuk studi lanjut sejak diterbitkannya ijasah yaitu".(($bulan <= 6) ? " < " : " > ")."6 bulan";

                    $waktu_tunggu_detail = "Waktu tunggu = ".$diff["years"]." tahun ".$diff["months"]." bulan ".$diff["days"]." hari";
                } 
            }
        }

        $bekerja = $this->alumni_bekerja_histori;
        $bekerja = $bekerja->where("user_id",$result->user->id ?? null);
        $bekerja = $bekerja->orderBy("created_at","DESC");
        $bekerja = $bekerja->get();

        $wirausaha = $this->alumni_wirausaha_histori;
        $wirausaha = $wirausaha->where("user_id",$result->user->id ?? null);
        $wirausaha = $wirausaha->orderBy("created_at","DESC");
        $wirausaha = $wirausaha->get();

        $studi_lanjut = $this->alumni_studi_lanjut_histori;
        $studi_lanjut = $studi_lanjut->where("user_id",$result->user->id ?? null);
        $studi_lanjut = $studi_lanjut->orderBy("created_at","DESC");
        $studi_lanjut = $studi_lanjut->get();
        
        if(($result->user->alumni_bekerja_histori->count() >= 1 && $result->user->alumni_wirausaha_histori->count() >= 1 ) || ($result->user->alumni_bekerja_histori->count() >= 1 && $result->user->alumni_studi_lanjut_histori->count() >= 1 ) || ($result->user->alumni_wirausaha_histori->count() >= 1 && $result->user->alumni_studi_lanjut_histori->count() >= 1 ) || ($result->user->alumni_bekerja_histori->count() >= 1 && $result->user->alumni_wirausaha_histori->count() >= 1 && $result->user->alumni_studi_lanjut_histori->count() >= 1) || $result->user->alumni_bekerja_histori->count() >= 2 || $result->user->alumni_wirausaha_histori->count() >= 2 || $result->user->alumni_studi_lanjut_histori->count() >= 2){
            $waktu_tunggu = null;
            $waktu_tunggu_detail = null;
        }

        $data = [
            'mahasiswa' => $mahasiswa,
            'result' => $result,
            'waktu_tunggu' => $waktu_tunggu,
            'waktu_tunggu_detail' => $waktu_tunggu_detail,
            'bekerja' => $bekerja,
            'wirausaha' => $wirausaha,
            'studi_lanjut' => $studi_lanjut,
        ];

        return view($this->view."show",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data_json = [];
        try {
            $id = (empty($request->input("id"))) ? 0 : trim(htmlentities($request->input("id")));
            $user_id = (empty($request->input("user_id"))) ? 0 : trim(htmlentities($request->input("user_id")));
            $status_kelulusan = (empty($request->input("status_kelulusan"))) ? 0 : trim(htmlentities($request->input("status_kelulusan")));
            $tanggal_lulus = (empty($request->input("tanggal_lulus"))) ? null : trim(htmlentities($request->input("tanggal_lulus")));
            $tanggal_terbit_ijasah = (empty($request->input("tanggal_terbit_ijasah"))) ? null : trim(htmlentities($request->input("tanggal_terbit_ijasah")));
            $upload_foto_ijasah = $request->file("upload_foto_ijasah");
            $status_pekerjaan_id = (empty($request->input("status_pekerjaan_id"))) ? null : trim(htmlentities($request->input("status_pekerjaan_id")));
            $status_verifikasi = (empty($request->input("status_verifikasi"))) ? 0 : trim(htmlentities($request->input("status_verifikasi")));

            if(!$id){
                throw new Error("ID tidak boleh kosong");
            }

            if(!$user_id){
                throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if($status_kelulusan === ""){
               throw new Error("Status kelulusan mahasiswa tidak boleh kosong");
            }

            if($status_verifikasi === ""){
                throw new Error("Status verifikasi mahasiswa tidak boleh kosong");
            }

            if($status_kelulusan == Alumni::STATUS_KELULUSAN_YES){
                if(!$tanggal_lulus){
                    throw new Error("Tahun lulus mahasiswa tidak boleh kosong");
                }

                if(!$tanggal_terbit_ijasah){
                    throw new Error("Tanggal terbit ijasah mahasiswa tidak boleh kosong");
                }

                if(!$status_pekerjaan_id){
                    throw new Error("Status pekerjaan mahasiswa tidak boleh kosong");
                }
            }

            $result = $this->alumni;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }

            $check_exist_alumni = $this->alumni;
            $check_exist_alumni = $check_exist_alumni->where("user_id",$user_id);
            $check_exist_alumni = $check_exist_alumni->where("id","!=",$id);
            $check_exist_alumni = $check_exist_alumni->first();

            if($check_exist_alumni){
                throw new Error("Duplikat nama mahasiswa . Mahasiswa ini sudah terdaftar sebagai alumni");
            }

            if(!empty($upload_foto_ijasah)){
                $valid_ext = [];

                $upload = UploadHelper::upload_file($upload_foto_ijasah,'ijasah',$valid_ext);

                if($upload["IsError"] == TRUE){
                    throw new Error($upload["Message"]);
                }

                $upload_foto_ijasah = $upload["Path"];
            }
            else{
                $upload_foto_ijasah = $result->upload_foto_ijasah;
            }

            if($status_kelulusan == Alumni::STATUS_KELULUSAN_NO){
                $tanggal_lulus = null;
                $tanggal_terbit_ijasah = null;
                $upload_foto_ijasah = null;
                $status_pekerjaan_id = null;
            }

            $result->update([
                'user_id' => $user_id,
                'status_kelulusan' => $status_kelulusan,
                'tanggal_lulus' => $tanggal_lulus,
                'tanggal_terbit_ijasah' => $tanggal_terbit_ijasah,
                'upload_foto_ijasah' => $upload_foto_ijasah,
                'status_verifikasi' => $status_verifikasi,
                'status_pekerjaan_id' => $status_pekerjaan_id,
            ]);

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil diubah";
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $id = empty($request->input("id")) ? null : trim(htmlentities($request->input("id")));

            if(!$id){
                return redirect()->route($this->route."index")->with("error","ID tidak boleh kosong");
            }

            $result = $this->alumni;
            $result = $result->findOrFail($id);

            if(!$result){
                return redirect()->route($this->route.'index')->with('error','Data tidak ditemukan');
            }

            $result->delete();

            return redirect()->route($this->route.'index')->with('success','Data berhasil dihapus');
        }catch(\Throwable $th){
            return redirect()->route($this->route."index")->with("error",$th->getMessage());
        }
    }

    public function riwayat_pekerjaan($user_id)
    {
        $result = $this->user;
        $result = $result->where('id',$user_id);
        $result = $result->first();

        if(!$result){
            return redirect()->route($this->route.'index')->with('error','Data tidak ditemukan');
        }

        $bekerja = $this->alumni_bekerja_histori;
        $bekerja = $bekerja->where("user_id",$user_id);
        $bekerja = $bekerja->orderBy("created_at","DESC");
        $bekerja = $bekerja->get();

        $wirausaha = $this->alumni_wirausaha_histori;
        $wirausaha = $wirausaha->where("user_id",$user_id);
        $wirausaha = $wirausaha->orderBy("created_at","DESC");
        $wirausaha = $wirausaha->get();

        $studi_lanjut = $this->alumni_studi_lanjut_histori;
        $studi_lanjut = $studi_lanjut->where("user_id",$user_id);
        $studi_lanjut = $studi_lanjut->orderBy("created_at","DESC");
        $studi_lanjut = $studi_lanjut->get();

        $data = [
            'bekerja' => $bekerja,
            'wirausaha' => $wirausaha,
            'studi_lanjut' => $studi_lanjut,
            'result' => $result
        ];

        return view($this->view."riwayat_pekerjaan",$data);
    }
}
