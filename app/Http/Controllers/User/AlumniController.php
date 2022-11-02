<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\Alumni\AlumniWirausaha;
use App\Models\Alumni\AlumniBekerja;
use App\Models\Alumni\AlumniStudiLanjut;
use App\Models\Master\StatusPekerjaan;
use App\Models\Master\JenisPerusahaan;
use App\Models\MhsBiodata;
use App\Helpers\UploadHelper;
use App\Helpers\AlumniHelper;
use Error;
use Auth;
use DB;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->view = "user.pendataan_alumni.";
        $this->route = "mhs.pendataan_alumni.";
        $this->alumni = new Alumni();
        $this->status_pekerjaan = new StatusPekerjaan();
        $this->alumni_wirausaha = new AlumniWirausaha();
        $this->jenis_perusahaan = new JenisPerusahaan();
        $this->alumni_bekerja = new AlumniBekerja();
        $this->mhs_biodata = new MhsBiodata();
        $this->alumni_studi_lanjut = new AlumniStudiLanjut();
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $biodata = $this->mhs_biodata;
        $biodata = $biodata->where("user_id",Auth::user()->id);
        $biodata = $biodata->first();

        if(!$biodata){
            return redirect()->route("mhs.biodata")->with("error","Data tidak ditemukan");
        }

        $pendataan_alumni = false;

        if(!empty($biodata->tahun_masuk)){
            $year_now = date("Y");
            
            if(($biodata->tahun_masuk + 3) <= $year_now){
                $pendataan_alumni = true;
            }
        }
        
        $result = $this->alumni;
        $result = $result->where("user_id",Auth::user()->id);
        $result = $result->first();

        $data = [
            'result' => $result,
            'pendataan_alumni' => $pendataan_alumni
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
            // Mahasiswa
            $status_kelulusan = (empty($request->input("status_kelulusan"))) ? 0 : trim(htmlentities($request->input("status_kelulusan")));
            $tanggal_lulus = (empty($request->input("tanggal_lulus"))) ? null : trim(htmlentities($request->input("tanggal_lulus")));
            $tanggal_terbit_ijasah = (empty($request->input("tanggal_terbit_ijasah"))) ? null : trim(htmlentities($request->input("tanggal_terbit_ijasah")));
            $upload_foto_ijasah = $request->file("upload_foto_ijasah");

            if($status_kelulusan === ""){
               throw new Error("Status kelulusan mahasiswa tidak boleh kosong");
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
            }

            if(!empty($upload_foto_ijasah)){
                $valid_ext = [];

                $upload = UploadHelper::upload_file($upload_foto_ijasah,'ijasah',$valid_ext);

                if($upload["IsError"] == TRUE){
                    throw new Error($upload["Message"]);
                }

                $upload_foto_ijasah = $upload["Path"];
            }

            $result = $this->alumni;
            $result = $result->where("user_id",Auth::user()->id);
            $result = $result->first();

            if($result){
                if(!$upload_foto_ijasah){
                    $upload_foto_ijasah = $result->upload_foto_ijasah;
                }
            }

            if($status_kelulusan == Alumni::STATUS_KELULUSAN_NO){
                $tanggal_lulus = null;
                $tanggal_terbit_ijasah = null;
                $upload_foto_ijasah = null;
            }

            $this->alumni->updateOrCreate([
                'user_id' => Auth::user()->id,
            ],[
                'user_id' => Auth::user()->id,
                'status_kelulusan' => $status_kelulusan,
                'tanggal_lulus' => $tanggal_lulus,
                'tanggal_terbit_ijasah' => $tanggal_terbit_ijasah,
                'upload_foto_ijasah' => $upload_foto_ijasah,
                'status_verifikasi' => Alumni::STATUS_VERIFIKASI_NO,
            ]);

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Pendataan alumni berhasil diajukan";
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setelah_lulus()
    {
        $result = $this->alumni;
        $result = $result->where("user_id",Auth::user()->id);
        $result = $result->first();

        if(!$result || $result->status_verifikasi != Alumni::STATUS_VERIFIKASI_YES){
            return redirect()->route("mhs.dashboard")->with("error","Data tidak ditemukan");
        }
    
        $data = [
            'result' => $result,
        ];

        return view($this->view."status_pekerjaan",$data);
    }

    public function store_setelah_lulus(Request $request)
    {
        DB::beginTransaction();
        $data_json = [];
        try {
            $status_pekerjaan_id = (empty($request->input("status_pekerjaan_id"))) ? null : trim(htmlentities($request->input("status_pekerjaan_id")));

            if(!$status_pekerjaan_id){
               throw new Error("Status setelah kelulusan mahasiswa tidak boleh kosong");
            }

            $update = $this->alumni;
            $update = $update->where("user_id",Auth::user()->id);
            $update = $update->update([
                'status_pekerjaan_id' => $status_pekerjaan_id
            ]);

            DB::commit();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Status setelah kelulusan berhasil diubah";
            goto ResultData;

        } catch (\Throwable $th) {
            DB::rollback();
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function setelah_lulus_pilihan()
    {
        $result = $this->alumni;
        $result = $result->where("user_id",Auth::user()->id);
        $result = $result->first();

        if(!$result){
            return redirect()->route("mhs.dashboard")->with("error","Data tidak ditemukan");
        }

        if($result->status_pekerjaan_id == StatusPekerjaan::MEMBUKA_USAHA){
            return redirect()->route("mhs.pendataan_alumni.membuka_usaha.create");
        }
        else if($result->status_pekerjaan_id == StatusPekerjaan::BEKERJA){
            return redirect()->route("mhs.pendataan_alumni.bekerja.jenis_perusahaan");
        }
        else if($result->status_pekerjaan_id == StatusPekerjaan::STUDI_LANJUT){
            return redirect()->route("mhs.pendataan_alumni.studi_lanjut.create");
        }
        else{
            return redirect()->route("mhs.dashboard")->with("error","Data tidak ditemukan");
        }
    }

    public function membuka_usaha()
    {
        $result = $this->alumni;
        $result = $result->where("user_id",Auth::user()->id);
        $result = $result->first();

        if(!$result || $result->status_pekerjaan_id != StatusPekerjaan::MEMBUKA_USAHA){
            return redirect()->route("mhs.dashboard")->with("error","Data tidak ditemukan");
        }

        $data = [
            'result' => $result,
        ];

        return view($this->view."membuka_usaha",$data);
    }

    public function jenis_perusahaan()
    {
        $result = $this->alumni;
        $result = $result->where("user_id",Auth::user()->id);
        $result = $result->first();

        if(!$result || $result->status_pekerjaan_id != StatusPekerjaan::BEKERJA){
            return redirect()->route("mhs.dashboard")->with("error","Data tidak ditemukan");
        }

        $jenis_perusahaan = $this->jenis_perusahaan;
        $jenis_perusahaan = $jenis_perusahaan->get();

        $data = [
            'result' => $result,
            'jenis_perusahaan' => $jenis_perusahaan,
        ];

        return view($this->view."memilih_jenis_perusahaan",$data);
    }

    public function bekerja(Request $request)
    {
        $perusahaan_id = (empty($request->input("perusahaan_id"))) ? null : trim(htmlentities($request->input("perusahaan_id")));

        if(!$perusahaan_id){
            return redirect()->route("mhs.dashboard")->with("error","Data tidak ditemukan");
        }

        $result = $this->alumni;
        $result = $result->where("user_id",Auth::user()->id);
        $result = $result->first();

        if(!$result || $result->status_pekerjaan_id != StatusPekerjaan::BEKERJA){
            return redirect()->route("mhs.dashboard")->with("error","Data tidak ditemukan");
        }

        if(!empty($result->alumni_bekerja) && !empty($result->alumni_bekerja->jenis_perusahaan_id) && $result->alumni_bekerja->jenis_perusahaan_id != $perusahaan_id){
            $result->alumni_bekerja = null;
        }

        $check_perusahaan_exist = $this->jenis_perusahaan;
        $check_perusahaan_exist = $check_perusahaan_exist->where("id",$perusahaan_id);
        $check_perusahaan_exist = $check_perusahaan_exist->first();

        if(!$check_perusahaan_exist){
            return redirect()->route("mhs.dashboard")->with("error","Data tidak ditemukan");
        }

        $data = [
            'result' => $result,
            'perusahaan' => $check_perusahaan_exist,
        ];

        if($perusahaan_id == JenisPerusahaan::SWASTA){
            return view($this->view."bekerja.swasta",$data);
        }
        else if($perusahaan_id == JenisPerusahaan::NIRLABA){
            return view($this->view."bekerja.nirlaba",$data);
        }
        else if($perusahaan_id == JenisPerusahaan::MULTILATERAL){
            return view($this->view."bekerja.multilateral",$data);
        }
        else if($perusahaan_id == JenisPerusahaan::LEMBAGA_PEMERINTAH){
            return view($this->view."bekerja.lembaga_pemerintah",$data);
        }
        else if($perusahaan_id == JenisPerusahaan::BUMN){
            return view($this->view."bekerja.bumn",$data);
        }
        else if($perusahaan_id == JenisPerusahaan::BUMD){
            return view($this->view."bekerja.bumd",$data);
        }
        else{
            return redirect()->route("mhs.dashboard")->with("error","Data tidak ditemukan");
        }
    }

    public function studi_lanjut()
    {
        $result = $this->alumni;
        $result = $result->where("user_id",Auth::user()->id);
        $result = $result->first();

        if(!$result || $result->status_pekerjaan_id != StatusPekerjaan::STUDI_LANJUT){
            return redirect()->route("mhs.dashboard")->with("error","Data tidak ditemukan");
        }

        $data = [
            'result' => $result,
        ];

        return view($this->view."studi_lanjut",$data);
    }

    public function store_membuka_usaha(Request $request)
    {
        DB::beginTransaction();
        $data_json = [];
        try {
            $nama_pemilik = (empty($request->input("nama_pemilik"))) ? null : trim(htmlentities($request->input("nama_pemilik")));
            $tanggal_mulai = (empty($request->input("tanggal_mulai"))) ? null : trim(htmlentities($request->input("tanggal_mulai")));
            $nama_usaha = (empty($request->input("nama_usaha"))) ? null : trim(htmlentities($request->input("nama_usaha")));
            $city_id = (empty($request->input("city_id"))) ? null : trim(htmlentities($request->input("city_id")));
            $penghasilan = (empty($request->input("penghasilan"))) ? 0 : trim(htmlentities($request->input("penghasilan")));
            $umr = (empty($request->input("umr"))) ? 0 : trim(htmlentities($request->input("umr")));
            $jenis_usaha_id = (empty($request->input("jenis_usaha_id"))) ? null : trim(htmlentities($request->input("jenis_usaha_id")));
            $level_usaha_id = (empty($request->input("level_usaha_id"))) ? null : trim(htmlentities($request->input("level_usaha_id")));
            $kriteria_usaha_id = (empty($request->input("kriteria_usaha_id"))) ? null : trim(htmlentities($request->input("kriteria_usaha_id")));
            $kriteria_pekerja_lepas_id = (empty($request->input("kriteria_pekerja_lepas_id"))) ? null : trim(htmlentities($request->input("kriteria_pekerja_lepas_id")));
            $tipe = (empty($request->input("tipe"))) ? null : trim(htmlentities($request->input("tipe")));
            $dijalankan_oleh = (empty($request->input("dijalankan_oleh"))) ? null : trim(htmlentities($request->input("dijalankan_oleh")));

            if(!$nama_pemilik){
               throw new Error("Nama pemilik usaha tidak boleh kosong");
            }

            if(!$tanggal_mulai){
                throw new Error("Tanggal mulai usaha tidak boleh kosong");
            }

            if(!$nama_usaha){
                throw new Error("Nama usaha tidak boleh kosong");
            }

            if(!$city_id){
                throw new Error("Kota/kabupaten tempat  usaha tidak boleh kosong");
            }

            if($penghasilan === ""){
                throw new Error("Penghasilan tidak boleh kosong");
            }

            if($umr === ""){
                throw new Error("Umr tidak boleh kosong");
            }

            if(!$jenis_usaha_id){
                throw new Error("Jenis usaha tidak boleh kosong");
            }

            if(!$level_usaha_id){
                throw new Error("Level usaha tidak boleh kosong");
            }

            if(!$tipe){
                throw new Error("Tipe usaha tidak boleh kosong");
            }

            if(!$dijalankan_oleh){
                throw new Error("Usaha dijalankan oleh tidak boleh kosong");
            }

            if($tipe == AlumniWirausaha::TIPE_MEMBUKA_USAHA){
                if(!$kriteria_usaha_id){
                    throw new Error("Kriteria usaha tidak boleh kosong");
                }
            }

            if($tipe == AlumniWirausaha::TIPE_PEKERJA_LEPAS){
                if(!$kriteria_pekerja_lepas_id){
                    throw new Error("Kriteria pekerja lepas tidak boleh kosong");
                }
            }

            if($tipe == AlumniWirausaha::TIPE_MEMBUKA_USAHA){
                $kriteria_pekerja_lepas_id = null;
            }

            if($tipe == AlumniWirausaha::TIPE_PEKERJA_LEPAS){
                $kriteria_usaha_id = null;
            }

            $this->alumni_wirausaha->updateOrCreate([
                'user_id' => Auth::user()->id,
            ],[
                'user_id' => Auth::user()->id,
                'nama_pemilik' => $nama_pemilik,
                'tanggal_mulai' => $tanggal_mulai,
                'nama_usaha' => $nama_usaha,
                'city_id' => $city_id,
                'penghasilan' => $penghasilan,
                'umr' => $umr,
                'jenis_usaha_id' => $jenis_usaha_id,
                'level_usaha_id' => $level_usaha_id,
                'kriteria_usaha_id' => $kriteria_usaha_id,
                'kriteria_pekerja_lepas_id' => $kriteria_pekerja_lepas_id,
                'tipe' => $tipe,
                'dijalankan_oleh' => $dijalankan_oleh,
            ]);

            if(!empty(Auth::user()->alumni_wirausaha)){
                AlumniHelper::alumni_wirausaha_histori(Auth::user()->alumni_wirausaha->id);
            }

            DB::commit();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data wirausaha berhasil diubah";
            goto ResultData;

        } catch (\Throwable $th) {
            DB::rollback();
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function store_nirlaba(Request $request)
    {
        DB::beginTransaction();
        $data_json = [];
        try {
            $jenis_perusahaan_id = (empty($request->input("jenis_perusahaan_id"))) ? null : trim(htmlentities($request->input("jenis_perusahaan_id")));
            $nama = (empty($request->input("nama"))) ? null : trim(htmlentities($request->input("nama")));
            $tanggal_mulai = (empty($request->input("tanggal_mulai"))) ? null : trim(htmlentities($request->input("tanggal_mulai")));
            $nama_instansi = (empty($request->input("nama_instansi"))) ? null : trim(htmlentities($request->input("nama_instansi")));
            $city_id = (empty($request->input("city_id"))) ? null : trim(htmlentities($request->input("city_id")));
            $gaji_pertama = (empty($request->input("gaji_pertama"))) ? 0 : trim(htmlentities($request->input("gaji_pertama")));
            $umr = (empty($request->input("umr"))) ? 0 : trim(htmlentities($request->input("umr")));
            $contact = (empty($request->input("contact"))) ? null : trim(htmlentities($request->input("contact")));
            $jenis_pekerjaan = (empty($request->input("jenis_pekerjaan"))) ? null : trim(htmlentities($request->input("jenis_pekerjaan")));
            $jabatan = (empty($request->input("jabatan"))) ? null : trim(htmlentities($request->input("jabatan")));
            $kategori_pekerjaan_id = (empty($request->input("kategori_pekerjaan_id"))) ? null : trim(htmlentities($request->input("kategori_pekerjaan_id")));
            $level_instansi_id = (empty($request->input("level_instansi_id"))) ? null : trim(htmlentities($request->input("level_instansi_id")));
            $pkwt = (empty($request->input("pkwt"))) ? 0 : trim(htmlentities($request->input("pkwt")));
            $pkwtt = (empty($request->input("pkwtt"))) ? 0 : trim(htmlentities($request->input("pkwtt")));
            $yayasan = (empty($request->input("yayasan"))) ? 0 : trim(htmlentities($request->input("yayasan")));
            $pbh = (empty($request->input("pbh"))) ? 0 : trim(htmlentities($request->input("pbh")));
            $lsm = (empty($request->input("lsm"))) ? 0 : trim(htmlentities($request->input("lsm")));

            if(!$jenis_perusahaan_id){
                throw new Error("Jenis perusahaan tidak boleh kosong");
             }

            if(!$nama){
               throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if(!$tanggal_mulai){
                throw new Error("Tanggal mulai tidak boleh kosong");
            }

            if(!$nama_instansi){
                throw new Error("Nama instansi tidak boleh kosong");
            }

            if(!$city_id){
                throw new Error("Kota/kabupaten instansi tidak boleh kosong");
            }

            if($gaji_pertama === ""){
                throw new Error("Gaji pertama tidak boleh kosong");
            }

            if($umr === ""){
                throw new Error("Umr tidak boleh kosong");
            }

            if(!$contact){
                throw new Error("Kontak tidak boleh kosong");
            }

            if(!$jenis_pekerjaan){
                throw new Error("Jenis pekerjaan tidak boleh kosong");
            }

            if(!$jabatan){
                throw new Error("Jabatan tidak boleh kosong");
            }

            if(!$kategori_pekerjaan_id){
                throw new Error("Kategori pekerjaan oleh tidak boleh kosong");
            }

            if(!$level_instansi_id){
                throw new Error("Level instansi oleh tidak boleh kosong");
            }

            if($pkwt === ""){
                throw new Error("Qustion pkwt wajib dijawab");
            }

            if($pkwtt === ""){
                throw new Error("Qustion pkwt wajib dijawab");
            }

            if($yayasan === ""){
                throw new Error("Qustion yayasan wajib dijawab");
            }

            if($pbh === ""){
                throw new Error("Qustion pbh wajib dijawab");
            }

            if($lsm === ""){
                throw new Error("Qustion lsm wajib dijawab");
            }

            $this->alumni_bekerja->updateOrCreate([
                'user_id' => Auth::user()->id,
            ],[
                'user_id' => Auth::user()->id,
                'jenis_perusahaan_id' => $jenis_perusahaan_id, 
                'nama' => $nama,
                'tanggal_mulai' => $tanggal_mulai,
                'nama_instansi' => $nama_instansi,
                'city_id' => $city_id,
                'gaji_pertama' => $gaji_pertama,
                'umr' => $umr,
                'jenis_pekerjaan' => $jenis_pekerjaan,
                'jabatan' => $jabatan,
                'kategori_pekerjaan_id' => $kategori_pekerjaan_id,
                'level_instansi_id' => $level_instansi_id,
                'contact' => $contact,
                'pkwt' => $pkwt,
                'pkwtt' => $pkwtt,
                'yayasan' => $yayasan,
                'pbh' => $pbh,
                'lsm' => $lsm,
            ]);

            if(!empty(Auth::user()->alumni_bekerja)){
                AlumniHelper::alumni_bekerja_histori(Auth::user()->alumni_bekerja->id);
            }

            DB::commit();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data pekerjaan alumni berhasil diubah";
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function store_swasta(Request $request)
    {
        DB::beginTransaction();
        $data_json = [];
        try {
            $jenis_perusahaan_id = (empty($request->input("jenis_perusahaan_id"))) ? null : trim(htmlentities($request->input("jenis_perusahaan_id")));
            $nama = (empty($request->input("nama"))) ? null : trim(htmlentities($request->input("nama")));
            $tanggal_mulai = (empty($request->input("tanggal_mulai"))) ? null : trim(htmlentities($request->input("tanggal_mulai")));
            $nama_instansi = (empty($request->input("nama_instansi"))) ? null : trim(htmlentities($request->input("nama_instansi")));
            $city_id = (empty($request->input("city_id"))) ? null : trim(htmlentities($request->input("city_id")));
            $gaji_pertama = (empty($request->input("gaji_pertama"))) ? 0 : trim(htmlentities($request->input("gaji_pertama")));
            $umr = (empty($request->input("umr"))) ? 0 : trim(htmlentities($request->input("umr")));
            $contact = (empty($request->input("contact"))) ? null : trim(htmlentities($request->input("contact")));
            $jenis_pekerjaan = (empty($request->input("jenis_pekerjaan"))) ? null : trim(htmlentities($request->input("jenis_pekerjaan")));
            $jabatan = (empty($request->input("jabatan"))) ? null : trim(htmlentities($request->input("jabatan")));
            $kategori_pekerjaan_id = (empty($request->input("kategori_pekerjaan_id"))) ? null : trim(htmlentities($request->input("kategori_pekerjaan_id")));
            $level_instansi_id = (empty($request->input("level_instansi_id"))) ? null : trim(htmlentities($request->input("level_instansi_id")));
            $pkwt = (empty($request->input("pkwt"))) ? 0 : trim(htmlentities($request->input("pkwt")));
            $pkwtt = (empty($request->input("pkwtt"))) ? 0 : trim(htmlentities($request->input("pkwtt")));
            $siup = (empty($request->input("siup"))) ? 0 : trim(htmlentities($request->input("siup")));

            if(!$jenis_perusahaan_id){
                throw new Error("Jenis perusahaan tidak boleh kosong");
             }

            if(!$nama){
               throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if(!$tanggal_mulai){
                throw new Error("Tanggal mulai tidak boleh kosong");
            }

            if(!$nama_instansi){
                throw new Error("Nama instansi tidak boleh kosong");
            }

            if(!$city_id){
                throw new Error("Kota/kabupaten instansi tidak boleh kosong");
            }

            if($gaji_pertama === ""){
                throw new Error("Gaji pertama tidak boleh kosong");
            }

            if($umr === ""){
                throw new Error("Umr tidak boleh kosong");
            }

            if(!$contact){
                throw new Error("Kontak tidak boleh kosong");
            }

            if(!$jenis_pekerjaan){
                throw new Error("Jenis pekerjaan tidak boleh kosong");
            }

            if(!$jabatan){
                throw new Error("Jabatan tidak boleh kosong");
            }

            if(!$kategori_pekerjaan_id){
                throw new Error("Kategori pekerjaan oleh tidak boleh kosong");
            }

            if(!$level_instansi_id){
                throw new Error("Level instansi oleh tidak boleh kosong");
            }

            if($pkwt === ""){
                throw new Error("Qustion pkwt wajib dijawab");
            }

            if($pkwtt === ""){
                throw new Error("Qustion pkwt wajib dijawab");
            }

            if($siup === ""){
                throw new Error("Qustion siup wajib dijawab");
            }

            $this->alumni_bekerja->updateOrCreate([
                'user_id' => Auth::user()->id,
            ],[
                'user_id' => Auth::user()->id,
                'jenis_perusahaan_id' => $jenis_perusahaan_id, 
                'nama' => $nama,
                'tanggal_mulai' => $tanggal_mulai,
                'nama_instansi' => $nama_instansi,
                'city_id' => $city_id,
                'gaji_pertama' => $gaji_pertama,
                'umr' => $umr,
                'jenis_pekerjaan' => $jenis_pekerjaan,
                'jabatan' => $jabatan,
                'kategori_pekerjaan_id' => $kategori_pekerjaan_id,
                'level_instansi_id' => $level_instansi_id,
                'contact' => $contact,
                'pkwt' => $pkwt,
                'pkwtt' => $pkwtt,
                'siup' => $siup,
            ]);

            if(!empty(Auth::user()->alumni_bekerja)){
                AlumniHelper::alumni_bekerja_histori(Auth::user()->alumni_bekerja->id);
            }

            DB::commit();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data pekerjaan alumni berhasil diubah";
            goto ResultData;

        } catch (\Throwable $th) {
            DB::rollback();
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function store_multilateral(Request $request)
    {
        DB::beginTransaction();
        $data_json = [];
        try {
            $jenis_perusahaan_id = (empty($request->input("jenis_perusahaan_id"))) ? null : trim(htmlentities($request->input("jenis_perusahaan_id")));
            $nama = (empty($request->input("nama"))) ? null : trim(htmlentities($request->input("nama")));
            $tanggal_mulai = (empty($request->input("tanggal_mulai"))) ? null : trim(htmlentities($request->input("tanggal_mulai")));
            $nama_instansi = (empty($request->input("nama_instansi"))) ? null : trim(htmlentities($request->input("nama_instansi")));
            $city_id = (empty($request->input("city_id"))) ? null : trim(htmlentities($request->input("city_id")));
            $gaji_pertama = (empty($request->input("gaji_pertama"))) ? 0 : trim(htmlentities($request->input("gaji_pertama")));
            $umr = (empty($request->input("umr"))) ? 0 : trim(htmlentities($request->input("umr")));
            $contact = (empty($request->input("contact"))) ? null : trim(htmlentities($request->input("contact")));
            $jenis_pekerjaan = (empty($request->input("jenis_pekerjaan"))) ? null : trim(htmlentities($request->input("jenis_pekerjaan")));
            $jabatan = (empty($request->input("jabatan"))) ? null : trim(htmlentities($request->input("jabatan")));
            $kategori_pekerjaan_id = (empty($request->input("kategori_pekerjaan_id"))) ? null : trim(htmlentities($request->input("kategori_pekerjaan_id")));
            $level_instansi_id = (empty($request->input("level_instansi_id"))) ? null : trim(htmlentities($request->input("level_instansi_id")));
            $pkwt = (empty($request->input("pkwt"))) ? 0 : trim(htmlentities($request->input("pkwt")));
            $pkwtt = (empty($request->input("pkwtt"))) ? 0 : trim(htmlentities($request->input("pkwtt")));

            if(!$jenis_perusahaan_id){
                throw new Error("Jenis perusahaan tidak boleh kosong");
             }

            if(!$nama){
               throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if(!$tanggal_mulai){
                throw new Error("Tanggal mulai tidak boleh kosong");
            }

            if(!$nama_instansi){
                throw new Error("Nama instansi tidak boleh kosong");
            }

            if(!$city_id){
                throw new Error("Kota/kabupaten instansi tidak boleh kosong");
            }

            if($gaji_pertama === ""){
                throw new Error("Gaji pertama tidak boleh kosong");
            }

            if($umr === ""){
                throw new Error("Umr tidak boleh kosong");
            }

            if(!$contact){
                throw new Error("Kontak tidak boleh kosong");
            }

            if(!$jenis_pekerjaan){
                throw new Error("Jenis pekerjaan tidak boleh kosong");
            }

            if(!$jabatan){
                throw new Error("Jabatan tidak boleh kosong");
            }

            if(!$kategori_pekerjaan_id){
                throw new Error("Kategori pekerjaan oleh tidak boleh kosong");
            }

            if(!$level_instansi_id){
                throw new Error("Level instansi oleh tidak boleh kosong");
            }

            if($pkwt === ""){
                throw new Error("Qustion pkwt wajib dijawab");
            }

            if($pkwtt === ""){
                throw new Error("Qustion pkwt wajib dijawab");
            }

            if(!empty(Auth::user()->alumni_bekerja)){
                AlumniHelper::alumni_bekerja_histori(Auth::user()->alumni_bekerja->id);
            }

            $this->alumni_bekerja->updateOrCreate([
                'user_id' => Auth::user()->id,
            ],[
                'user_id' => Auth::user()->id,
                'jenis_perusahaan_id' => $jenis_perusahaan_id, 
                'nama' => $nama,
                'tanggal_mulai' => $tanggal_mulai,
                'nama_instansi' => $nama_instansi,
                'city_id' => $city_id,
                'gaji_pertama' => $gaji_pertama,
                'umr' => $umr,
                'jenis_pekerjaan' => $jenis_pekerjaan,
                'jabatan' => $jabatan,
                'kategori_pekerjaan_id' => $kategori_pekerjaan_id,
                'level_instansi_id' => $level_instansi_id,
                'contact' => $contact,
                'pkwt' => $pkwt,
                'pkwtt' => $pkwtt,
            ]);

            if(!empty(Auth::user()->alumni_bekerja)){
                AlumniHelper::alumni_bekerja_histori(Auth::user()->alumni_bekerja->id);
            }

            DB::commit();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data pekerjaan alumni berhasil diubah";
            goto ResultData;

        } catch (\Throwable $th) {
            DB::rollback();
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function store_lembaga_pemerintah(Request $request)
    {
        DB::beginTransaction();
        $data_json = [];
        try {
            $jenis_perusahaan_id = (empty($request->input("jenis_perusahaan_id"))) ? null : trim(htmlentities($request->input("jenis_perusahaan_id")));
            $nama = (empty($request->input("nama"))) ? null : trim(htmlentities($request->input("nama")));
            $tanggal_mulai = (empty($request->input("tanggal_mulai"))) ? null : trim(htmlentities($request->input("tanggal_mulai")));
            $nama_instansi = (empty($request->input("nama_instansi"))) ? null : trim(htmlentities($request->input("nama_instansi")));
            $city_id = (empty($request->input("city_id"))) ? null : trim(htmlentities($request->input("city_id")));
            $gaji_pertama = (empty($request->input("gaji_pertama"))) ? 0 : trim(htmlentities($request->input("gaji_pertama")));
            $umr = (empty($request->input("umr"))) ? 0 : trim(htmlentities($request->input("umr")));
            $contact = (empty($request->input("contact"))) ? null : trim(htmlentities($request->input("contact")));
            $jenis_pekerjaan = (empty($request->input("jenis_pekerjaan"))) ? null : trim(htmlentities($request->input("jenis_pekerjaan")));
            $jabatan = (empty($request->input("jabatan"))) ? null : trim(htmlentities($request->input("jabatan")));
            $kategori_pekerjaan_id = (empty($request->input("kategori_pekerjaan_id"))) ? null : trim(htmlentities($request->input("kategori_pekerjaan_id")));
            $level_instansi_id = (empty($request->input("level_instansi_id"))) ? null : trim(htmlentities($request->input("level_instansi_id")));
            $pns = (empty($request->input("pns"))) ? 0 : trim(htmlentities($request->input("pns")));
            $pppk = (empty($request->input("pppk"))) ? 0 : trim(htmlentities($request->input("pppk")));

            if(!$jenis_perusahaan_id){
                throw new Error("Jenis perusahaan tidak boleh kosong");
             }

            if(!$nama){
               throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if(!$tanggal_mulai){
                throw new Error("Tanggal mulai tidak boleh kosong");
            }

            if(!$nama_instansi){
                throw new Error("Nama instansi tidak boleh kosong");
            }

            if(!$city_id){
                throw new Error("Kota/kabupaten instansi tidak boleh kosong");
            }

            if($gaji_pertama === ""){
                throw new Error("Gaji pertama tidak boleh kosong");
            }

            if($umr === ""){
                throw new Error("Umr tidak boleh kosong");
            }

            if(!$contact){
                throw new Error("Kontak tidak boleh kosong");
            }

            if(!$jenis_pekerjaan){
                throw new Error("Jenis pekerjaan tidak boleh kosong");
            }

            if(!$jabatan){
                throw new Error("Jabatan tidak boleh kosong");
            }

            if(!$kategori_pekerjaan_id){
                throw new Error("Kategori pekerjaan oleh tidak boleh kosong");
            }

            if(!$level_instansi_id){
                throw new Error("Level instansi oleh tidak boleh kosong");
            }

            if($pns === ""){
                throw new Error("Qustion pkwt wajib dijawab");
            }

            if($pppk === ""){
                throw new Error("Qustion pkwt wajib dijawab");
            }

            $this->alumni_bekerja->updateOrCreate([
                'user_id' => Auth::user()->id,
            ],[
                'user_id' => Auth::user()->id,
                'jenis_perusahaan_id' => $jenis_perusahaan_id, 
                'nama' => $nama,
                'tanggal_mulai' => $tanggal_mulai,
                'nama_instansi' => $nama_instansi,
                'city_id' => $city_id,
                'gaji_pertama' => $gaji_pertama,
                'umr' => $umr,
                'jenis_pekerjaan' => $jenis_pekerjaan,
                'jabatan' => $jabatan,
                'kategori_pekerjaan_id' => $kategori_pekerjaan_id,
                'level_instansi_id' => $level_instansi_id,
                'contact' => $contact,
                'pns' => $pns,
                'pppk' => $pppk,
            ]);

            if(!empty(Auth::user()->alumni_bekerja)){
                AlumniHelper::alumni_bekerja_histori(Auth::user()->alumni_bekerja->id);
            }

            DB::commit();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data pekerjaan alumni berhasil diubah";
            goto ResultData;

        } catch (\Throwable $th) {
            DB::rollback();
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function store_bumn(Request $request)
    {
        DB::beginTransaction();
        $data_json = [];
        try {
            $jenis_perusahaan_id = (empty($request->input("jenis_perusahaan_id"))) ? null : trim(htmlentities($request->input("jenis_perusahaan_id")));
            $nama = (empty($request->input("nama"))) ? null : trim(htmlentities($request->input("nama")));
            $tanggal_mulai = (empty($request->input("tanggal_mulai"))) ? null : trim(htmlentities($request->input("tanggal_mulai")));
            $nama_instansi = (empty($request->input("nama_instansi"))) ? null : trim(htmlentities($request->input("nama_instansi")));
            $city_id = (empty($request->input("city_id"))) ? null : trim(htmlentities($request->input("city_id")));
            $gaji_pertama = (empty($request->input("gaji_pertama"))) ? 0 : trim(htmlentities($request->input("gaji_pertama")));
            $umr = (empty($request->input("umr"))) ? 0 : trim(htmlentities($request->input("umr")));
            $contact = (empty($request->input("contact"))) ? null : trim(htmlentities($request->input("contact")));
            $jenis_pekerjaan = (empty($request->input("jenis_pekerjaan"))) ? null : trim(htmlentities($request->input("jenis_pekerjaan")));
            $jabatan = (empty($request->input("jabatan"))) ? null : trim(htmlentities($request->input("jabatan")));
            $kategori_pekerjaan_id = (empty($request->input("kategori_pekerjaan_id"))) ? null : trim(htmlentities($request->input("kategori_pekerjaan_id")));
            $level_instansi_id = (empty($request->input("level_instansi_id"))) ? null : trim(htmlentities($request->input("level_instansi_id")));
            $pkwt = (empty($request->input("pkwt"))) ? 0 : trim(htmlentities($request->input("pkwt")));
            $pkwtt = (empty($request->input("pkwtt"))) ? 0 : trim(htmlentities($request->input("pkwtt")));

            if(!$jenis_perusahaan_id){
                throw new Error("Jenis perusahaan tidak boleh kosong");
             }

            if(!$nama){
               throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if(!$tanggal_mulai){
                throw new Error("Tanggal mulai tidak boleh kosong");
            }

            if(!$nama_instansi){
                throw new Error("Nama instansi tidak boleh kosong");
            }

            if(!$city_id){
                throw new Error("Kota/kabupaten instansi tidak boleh kosong");
            }

            if($gaji_pertama === ""){
                throw new Error("Gaji pertama tidak boleh kosong");
            }

            if($umr === ""){
                throw new Error("Umr tidak boleh kosong");
            }

            if(!$contact){
                throw new Error("Kontak tidak boleh kosong");
            }

            if(!$jenis_pekerjaan){
                throw new Error("Jenis pekerjaan tidak boleh kosong");
            }

            if(!$jabatan){
                throw new Error("Jabatan tidak boleh kosong");
            }

            if(!$kategori_pekerjaan_id){
                throw new Error("Kategori pekerjaan oleh tidak boleh kosong");
            }

            if(!$level_instansi_id){
                throw new Error("Level instansi oleh tidak boleh kosong");
            }

            if($pkwt === ""){
                throw new Error("Qustion pkwt wajib dijawab");
            }

            if($pkwtt === ""){
                throw new Error("Qustion pkwt wajib dijawab");
            }

            $this->alumni_bekerja->updateOrCreate([
                'user_id' => Auth::user()->id,
            ],[
                'user_id' => Auth::user()->id,
                'jenis_perusahaan_id' => $jenis_perusahaan_id, 
                'nama' => $nama,
                'tanggal_mulai' => $tanggal_mulai,
                'nama_instansi' => $nama_instansi,
                'city_id' => $city_id,
                'gaji_pertama' => $gaji_pertama,
                'umr' => $umr,
                'jenis_pekerjaan' => $jenis_pekerjaan,
                'jabatan' => $jabatan,
                'kategori_pekerjaan_id' => $kategori_pekerjaan_id,
                'level_instansi_id' => $level_instansi_id,
                'contact' => $contact,
                'pkwt' => $pkwt,
                'pkwtt' => $pkwtt,
            ]);

            if(!empty(Auth::user()->alumni_bekerja)){
                AlumniHelper::alumni_bekerja_histori(Auth::user()->alumni_bekerja->id);
            }

            DB::commit();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data pekerjaan alumni berhasil diubah";
            goto ResultData;

        } catch (\Throwable $th) {
            DB::rollback();
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function store_bumd(Request $request)
    {
        DB::beginTransaction();
        $data_json = [];
        try {
            $jenis_perusahaan_id = (empty($request->input("jenis_perusahaan_id"))) ? null : trim(htmlentities($request->input("jenis_perusahaan_id")));
            $nama = (empty($request->input("nama"))) ? null : trim(htmlentities($request->input("nama")));
            $tanggal_mulai = (empty($request->input("tanggal_mulai"))) ? null : trim(htmlentities($request->input("tanggal_mulai")));
            $nama_instansi = (empty($request->input("nama_instansi"))) ? null : trim(htmlentities($request->input("nama_instansi")));
            $city_id = (empty($request->input("city_id"))) ? null : trim(htmlentities($request->input("city_id")));
            $gaji_pertama = (empty($request->input("gaji_pertama"))) ? 0 : trim(htmlentities($request->input("gaji_pertama")));
            $umr = (empty($request->input("umr"))) ? 0 : trim(htmlentities($request->input("umr")));
            $contact = (empty($request->input("contact"))) ? null : trim(htmlentities($request->input("contact")));
            $jenis_pekerjaan = (empty($request->input("jenis_pekerjaan"))) ? null : trim(htmlentities($request->input("jenis_pekerjaan")));
            $jabatan = (empty($request->input("jabatan"))) ? null : trim(htmlentities($request->input("jabatan")));
            $kategori_pekerjaan_id = (empty($request->input("kategori_pekerjaan_id"))) ? null : trim(htmlentities($request->input("kategori_pekerjaan_id")));
            $level_instansi_id = (empty($request->input("level_instansi_id"))) ? null : trim(htmlentities($request->input("level_instansi_id")));
            $pkwt = (empty($request->input("pkwt"))) ? 0 : trim(htmlentities($request->input("pkwt")));
            $pkwtt = (empty($request->input("pkwtt"))) ? 0 : trim(htmlentities($request->input("pkwtt")));

            if(!$jenis_perusahaan_id){
                throw new Error("Jenis perusahaan tidak boleh kosong");
             }

            if(!$nama){
               throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if(!$tanggal_mulai){
                throw new Error("Tanggal mulai tidak boleh kosong");
            }

            if(!$nama_instansi){
                throw new Error("Nama instansi tidak boleh kosong");
            }

            if(!$city_id){
                throw new Error("Kota/kabupaten instansi tidak boleh kosong");
            }

            if($gaji_pertama === ""){
                throw new Error("Gaji pertama tidak boleh kosong");
            }

            if($umr === ""){
                throw new Error("Umr tidak boleh kosong");
            }

            if(!$contact){
                throw new Error("Kontak tidak boleh kosong");
            }

            if(!$jenis_pekerjaan){
                throw new Error("Jenis pekerjaan tidak boleh kosong");
            }

            if(!$jabatan){
                throw new Error("Jabatan tidak boleh kosong");
            }

            if(!$kategori_pekerjaan_id){
                throw new Error("Kategori pekerjaan oleh tidak boleh kosong");
            }

            if(!$level_instansi_id){
                throw new Error("Level instansi oleh tidak boleh kosong");
            }

            if($pkwt === ""){
                throw new Error("Qustion pkwt wajib dijawab");
            }

            if($pkwtt === ""){
                throw new Error("Qustion pkwt wajib dijawab");
            }

            $this->alumni_bekerja->updateOrCreate([
                'user_id' => Auth::user()->id,
            ],[
                'user_id' => Auth::user()->id,
                'jenis_perusahaan_id' => $jenis_perusahaan_id, 
                'nama' => $nama,
                'tanggal_mulai' => $tanggal_mulai,
                'nama_instansi' => $nama_instansi,
                'city_id' => $city_id,
                'gaji_pertama' => $gaji_pertama,
                'umr' => $umr,
                'jenis_pekerjaan' => $jenis_pekerjaan,
                'jabatan' => $jabatan,
                'kategori_pekerjaan_id' => $kategori_pekerjaan_id,
                'level_instansi_id' => $level_instansi_id,
                'contact' => $contact,
                'pkwt' => $pkwt,
                'pkwtt' => $pkwtt,
            ]);

            if(!empty(Auth::user()->alumni_bekerja)){
                AlumniHelper::alumni_bekerja_histori(Auth::user()->alumni_bekerja->id);
            }

            DB::commit();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data pekerjaan alumni berhasil diubah";
            goto ResultData;

        } catch (\Throwable $th) {
            DB::rollback();
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function store_studi_lanjut(Request $request)
    {
        DB::beginTransaction();
        $data_json = [];
        try {
            $nama = (empty($request->input("nama"))) ? null : trim(htmlentities($request->input("nama")));
            $tanggal_mulai = (empty($request->input("tanggal_mulai"))) ? null : trim(htmlentities($request->input("tanggal_mulai")));
            $nama_universitas = (empty($request->input("nama_universitas"))) ? null : trim(htmlentities($request->input("nama_universitas")));
            $univ_jenjang_id = (empty($request->input("univ_jenjang_id"))) ? null : trim(htmlentities($request->input("univ_jenjang_id")));
            $univ_kategori_id = (empty($request->input("univ_kategori_id"))) ? 0 : trim(htmlentities($request->input("univ_kategori_id")));
            $univ_level_id = (empty($request->input("univ_level_id"))) ? 0 : trim(htmlentities($request->input("univ_level_id")));
            $program_studi = (empty($request->input("program_studi"))) ? null : trim(htmlentities($request->input("program_studi")));
            $fakultas = (empty($request->input("fakultas"))) ? null : trim(htmlentities($request->input("fakultas")));

            if(!$nama){
               throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if(!$tanggal_mulai){
                throw new Error("Tanggal mulai tidak boleh kosong");
            }

            if(!$nama_universitas){
                throw new Error("Nama universitas tidak boleh kosong");
            }

            if(!$univ_jenjang_id){
                throw new Error("Jenjang tidak boleh kosong");
            }

            if(!$univ_kategori_id){
                throw new Error("Kategori universitas tidak boleh kosong");
            }

            if(!$univ_level_id){
                throw new Error("Level Universitas tidak boleh kosong");
            }

            if(!$program_studi){
                throw new Error("Program studi tidak boleh kosong");
            }

            if(!$fakultas){
                throw new Error("Fakultas tidak boleh kosong");
            }

            $this->alumni_studi_lanjut->updateOrCreate([
                'user_id' => Auth::user()->id,
            ],[
                'user_id' => Auth::user()->id,
                'nama' => $nama,
                'tanggal_mulai' => $tanggal_mulai,
                'nama_universitas' => $nama_universitas,
                'univ_jenjang_id' => $univ_jenjang_id,
                'univ_kategori_id' => $univ_kategori_id,
                'univ_level_id' => $univ_level_id,
                'program_studi' => $program_studi,
                'fakultas' => $fakultas,
            ]);

            if(!empty(Auth::user()->alumni_studi_lanjut)){
                AlumniHelper::alumni_studi_lanjut_histori(Auth::user()->alumni_studi_lanjut->id);
            }

            DB::commit();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data studi lanjut alumni berhasil diubah";
            goto ResultData;

        } catch (\Throwable $th) {
            DB::rollback();
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }
}
