<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Alumni;
use App\Models\Alumni\AlumniBekerja;
use App\Models\User;
use App\Models\Master\StatusPekerjaan;
use App\Models\Master\JenisPerusahaan;
use App\Helpers\UploadHelper;
use App\Exports\Alumni\AlumniBekerjaExport;
use Error;
use Excel;
use PDF;

class AlumniBekerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->view = "pegawai.alumni.bekerja.";
        $this->route = "pegawai.alumni.bekerja.";
        $this->alumni = new Alumni();
        $this->user = new User();
        $this->status_pekerjaan = new StatusPekerjaan();
        $this->alumni_bekerja = new AlumniBekerja();
        $this->jenis_perusahaan = new JenisPerusahaan();
    }

    public function index(Request $request)
    {
        $jenis_perusahaan_id = (empty($request->input("jenis_perusahaan_id"))) ? null : trim(htmlentities($request->input("jenis_perusahaan_id")));
        $table = $this->alumni_bekerja;
        $table = $table->orderBy("created_at","DESC");
        $table = $table->whereHas("user",function($query2){
            $query2->whereHas("alumni",function($query3){
                $query3->where("status_pekerjaan_id",StatusPekerjaan::BEKERJA);
            });
        });
        if(!empty($jenis_perusahaan_id)){
            $table = $table->where("jenis_perusahaan_id",$jenis_perusahaan_id);
        }
        $table = $table->get();

        $jenis_perusahaan = $this->jenis_perusahaan;
        $jenis_perusahaan = $jenis_perusahaan->get();

        $data = [
            'table' => $table,
            'jenis_perusahaan' => $jenis_perusahaan
        ];

        return view($this->view."index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $perusahaan_id = $nama_pemilik = (empty($request->input("perusahaan_id"))) ? null : trim(htmlentities($request->input("perusahaan_id")));

        if(!$perusahaan_id){
            return redirect()->route($this->route."index")->with("error","Data tidak ditemukan");
        }

        $check_perusahaan_exist = $this->jenis_perusahaan;
        $check_perusahaan_exist = $check_perusahaan_exist->where("id",$perusahaan_id);
        $check_perusahaan_exist = $check_perusahaan_exist->first();

        if(!$check_perusahaan_exist){
            return redirect()->route($this->route."index")->with("error","Data tidak ditemukan");
        }

        $mahasiswa = $this->user;
        $mahasiswa = $mahasiswa->whereHas("alumni",function($query2){
            $query2->where("status_pekerjaan_id",StatusPekerjaan::BEKERJA);
        });
        $mahasiswa = $mahasiswa->where("is_active",User::IS_ACTIVE_YES);
        $mahasiswa = $mahasiswa->where("is_admin",User::ROLE_MAHASISWA);
        $mahasiswa = $mahasiswa->get();

        $data = [
            'perusahaan' => $check_perusahaan_exist,
            'mahasiswa' => $mahasiswa,
        ];

        if($perusahaan_id == JenisPerusahaan::SWASTA){
            return view($this->view."create.swasta",$data);
        }
        else if($perusahaan_id == JenisPerusahaan::NIRLABA){
            return view($this->view."create.nirlaba",$data);
        }
        else if($perusahaan_id == JenisPerusahaan::MULTILATERAL){
            return view($this->view."create.multilateral",$data);
        }
        else if($perusahaan_id == JenisPerusahaan::LEMBAGA_PEMERINTAH){
            return view($this->view."create.lembaga_pemerintah",$data);
        }
        else if($perusahaan_id == JenisPerusahaan::BUMN){
            return view($this->view."create.bumn",$data);
        }
        else if($perusahaan_id == JenisPerusahaan::BUMD){
            return view($this->view."create.bumd",$data);
        }
        else{
            return redirect()->route($this->route."index")->with("error","Data tidak ditemukan");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->alumni_bekerja;
        $result = $result->where("id",$id);
        $result = $result->first();

        if(!$result){
            return redirect()->route($this->route."index")->with("error","Data tidak ditemukan");
        }

        $mahasiswa = $this->user;
        $mahasiswa = $mahasiswa->whereHas("alumni",function($query2){
            $query2->where("status_pekerjaan_id",StatusPekerjaan::BEKERJA);
        });
        $mahasiswa = $mahasiswa->where("is_active",User::IS_ACTIVE_YES);
        $mahasiswa = $mahasiswa->where("is_admin",User::ROLE_MAHASISWA);
        $mahasiswa = $mahasiswa->get();

        $data = [
            'result' => $result,
            'mahasiswa' => $mahasiswa,
        ];

        if($result->jenis_perusahaan_id == JenisPerusahaan::SWASTA){
            return view($this->view."show.swasta",$data);
        }
        else if($result->jenis_perusahaan_id == JenisPerusahaan::NIRLABA){
            return view($this->view."show.nirlaba",$data);
        }
        else if($result->jenis_perusahaan_id == JenisPerusahaan::MULTILATERAL){
            return view($this->view."show.multilateral",$data);
        }
        else if($result->jenis_perusahaan_id == JenisPerusahaan::LEMBAGA_PEMERINTAH){
            return view($this->view."show.lembaga_pemerintah",$data);
        }
        else if($result->jenis_perusahaan_id == JenisPerusahaan::BUMN){
            return view($this->view."show.bumn",$data);
        }
        else if($result->jenis_perusahaan_id == JenisPerusahaan::BUMD){
            return view($this->view."show.bumd",$data);
        }
        else{
            return redirect()->route($this->route."index")->with("error","Data tidak ditemukan");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = $this->alumni_bekerja;
        $result = $result->where("id",$id);
        $result = $result->first();

        if(!$result){
            return redirect()->route($this->route."index")->with("error","Data tidak ditemukan");
        }

        $mahasiswa = $this->user;
        $mahasiswa = $mahasiswa->whereHas("alumni",function($query2){
            $query2->where("status_pekerjaan_id",StatusPekerjaan::BEKERJA);
        });
        $mahasiswa = $mahasiswa->where("is_active",User::IS_ACTIVE_YES);
        $mahasiswa = $mahasiswa->where("is_admin",User::ROLE_MAHASISWA);
        $mahasiswa = $mahasiswa->get();

        $data = [
            'result' => $result,
            'mahasiswa' => $mahasiswa,
        ];

        if($result->jenis_perusahaan_id == JenisPerusahaan::SWASTA){
            return view($this->view."edit.swasta",$data);
        }
        else if($result->jenis_perusahaan_id == JenisPerusahaan::NIRLABA){
            return view($this->view."edit.nirlaba",$data);
        }
        else if($result->jenis_perusahaan_id == JenisPerusahaan::MULTILATERAL){
            return view($this->view."edit.multilateral",$data);
        }
        else if($result->jenis_perusahaan_id == JenisPerusahaan::LEMBAGA_PEMERINTAH){
            return view($this->view."edit.lembaga_pemerintah",$data);
        }
        else if($result->jenis_perusahaan_id == JenisPerusahaan::BUMN){
            return view($this->view."edit.bumn",$data);
        }
        else if($result->jenis_perusahaan_id == JenisPerusahaan::BUMD){
            return view($this->view."edit.bumd",$data);
        }
        else{
            return redirect()->route($this->route."index")->with("error","Data tidak ditemukan");
        }
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
    public function destroy(Request $request)
    {
        try{
            $id = empty($request->input("id")) ? null : trim(htmlentities($request->input("id")));

            if(!$id){
                return redirect()->route($this->route."index")->with("error","ID tidak boleh kosong");
            }

            $result = $this->alumni_bekerja;
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

    public function store_nirlaba(Request $request)
    {
        $data_json = [];
        try {
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
            }

            if(!$jenis_perusahaan_id){
                throw new Error("Jenis perusahaan tidak boleh kosong");
             }

            if(!$nama){
               throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if(!$tanggal_mulai){
                throw new Error("Tanggal mulai usaha tidak boleh kosong");
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

            if(!$level_instansi){
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

            $check_exist_alumni_bekerja = $this->alumni_bekerja;
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("user_id",$user_id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->first();

            if($check_exist_alumni_bekerja){
                throw new Error("Duplikat data pekerjaan alumni . Data pekerjaan alumni ini sudah terdaftar");
            }

            $this->alumni_bekerja->create([
                'user_id' => $user_id,
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

    public function store_swasta(Request $request)
    {
        $data_json = [];
        try {
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
            }

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

            $check_exist_alumni_bekerja = $this->alumni_bekerja;
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("user_id",$user_id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->first();

            if($check_exist_alumni_bekerja){
                throw new Error("Duplikat data pekerjaan alumni . Data pekerjaan alumni ini sudah terdaftar");
            }

            $this->alumni_bekerja->create([
                'user_id' => $user_id,
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

    public function store_multilateral(Request $request)
    {
        $data_json = [];
        try {
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
            }

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

            $check_exist_alumni_bekerja = $this->alumni_bekerja;
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("user_id",$user_id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->first();

            if($check_exist_alumni_bekerja){
                throw new Error("Duplikat data pekerjaan alumni . Data pekerjaan alumni ini sudah terdaftar");
            }

            $this->alumni_bekerja->create([
                'user_id' => $user_id,
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

    public function store_lembaga_pemerintah(Request $request)
    {
        $data_json = [];
        try {
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
            }

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

            $check_exist_alumni_bekerja = $this->alumni_bekerja;
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("user_id",$user_id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->first();

            if($check_exist_alumni_bekerja){
                throw new Error("Duplikat data pekerjaan alumni . Data pekerjaan alumni ini sudah terdaftar");
            }

            $this->alumni_bekerja->create([
                'user_id' => $user_id,
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

    public function store_bumn(Request $request)
    {
        $data_json = [];
        try {
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
            }

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

            $check_exist_alumni_bekerja = $this->alumni_bekerja;
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("user_id",$user_id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->first();

            if($check_exist_alumni_bekerja){
                throw new Error("Duplikat data pekerjaan alumni . Data pekerjaan alumni ini sudah terdaftar");
            }

            $this->alumni_bekerja->create([
                'user_id' => $user_id,
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

    public function store_bumd(Request $request)
    {
        $data_json = [];
        try {
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
            }

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

            $check_exist_alumni_bekerja = $this->alumni_bekerja;
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("user_id",$user_id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->first();

            if($check_exist_alumni_bekerja){
                throw new Error("Duplikat data pekerjaan alumni . Data pekerjaan alumni ini sudah terdaftar");
            }

            $this->alumni_bekerja->create([
                'user_id' => $user_id,
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

    public function update_nirlaba(Request $request)
    {
        $data_json = [];
        try {
            $id = (empty($request->input("id"))) ? null : trim(htmlentities($request->input("id")));
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
            }

            if(!$nama){
               throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if(!$tanggal_mulai){
                throw new Error("Tanggal mulai usaha tidak boleh kosong");
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

            if(!$level_instansi){
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

            $result = $this->alumni_bekerja;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }
            
            $check_exist_alumni_bekerja = $this->alumni_bekerja;
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("user_id",$user_id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("id","!=",$id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->first();

            if($check_exist_alumni_bekerja){
                throw new Error("Duplikat data pekerjaan alumni . Data pekerjaan alumni ini sudah terdaftar");
            }

            $result->update([
                'user_id' => $user_id,
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

    public function update_swasta(Request $request)
    {
        $data_json = [];
        try {
            $id = (empty($request->input("id"))) ? null : trim(htmlentities($request->input("id")));
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
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

            $result = $this->alumni_bekerja;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }
            
            $check_exist_alumni_bekerja = $this->alumni_bekerja;
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("user_id",$user_id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("id","!=",$id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->first();

            if($check_exist_alumni_bekerja){
                throw new Error("Duplikat data pekerjaan alumni . Data pekerjaan alumni ini sudah terdaftar");
            }

            $result->update([
                'user_id' => $user_id,
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

    public function update_multilateral(Request $request)
    {
        $data_json = [];
        try {
            $id = (empty($request->input("id"))) ? null : trim(htmlentities($request->input("id")));
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
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

            $result = $this->alumni_bekerja;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }
            
            $check_exist_alumni_bekerja = $this->alumni_bekerja;
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("user_id",$user_id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("id","!=",$id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->first();

            if($check_exist_alumni_bekerja){
                throw new Error("Duplikat data pekerjaan alumni . Data pekerjaan alumni ini sudah terdaftar");
            }

            $result->update([
                'user_id' => $user_id,
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

    public function update_lembaga_pemerintah(Request $request)
    {
        $data_json = [];
        try {
            $id = (empty($request->input("id"))) ? null : trim(htmlentities($request->input("id")));
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
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

            $result = $this->alumni_bekerja;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }
            
            $check_exist_alumni_bekerja = $this->alumni_bekerja;
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("user_id",$user_id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("id","!=",$id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->first();

            if($check_exist_alumni_bekerja){
                throw new Error("Duplikat data pekerjaan alumni . Data pekerjaan alumni ini sudah terdaftar");
            }

            $result->update([
                'user_id' => $user_id,
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

    public function update_bumn(Request $request)
    {
        $data_json = [];
        try {
            $id = (empty($request->input("id"))) ? null : trim(htmlentities($request->input("id")));
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
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

            $result = $this->alumni_bekerja;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }
            
            $check_exist_alumni_bekerja = $this->alumni_bekerja;
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("user_id",$user_id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("id","!=",$id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->first();

            if($check_exist_alumni_bekerja){
                throw new Error("Duplikat data pekerjaan alumni . Data pekerjaan alumni ini sudah terdaftar");
            }

            $result->update([
                'user_id' => $user_id,
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

    public function update_bumd(Request $request)
    {
        $data_json = [];
        try {
            $id = (empty($request->input("id"))) ? null : trim(htmlentities($request->input("id")));
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
            }

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

            $result = $this->alumni_bekerja;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }
            
            $check_exist_alumni_bekerja = $this->alumni_bekerja;
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("user_id",$user_id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->where("id","!=",$id);
            $check_exist_alumni_bekerja = $check_exist_alumni_bekerja->first();

            if($check_exist_alumni_bekerja){
                throw new Error("Duplikat data pekerjaan alumni . Data pekerjaan alumni ini sudah terdaftar");
            }

            $result->update([
                'user_id' => $user_id,
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

    public function export_excel(Request $request)
    {
        $jenis_perusahaan_id = (empty($request->input("jenis_perusahaan_id"))) ? null : trim(htmlentities($request->input("jenis_perusahaan_id")));

        $table = $this->alumni_bekerja;
        $table = $table->orderBy("created_at","DESC");
        $table = $table->whereHas("user",function($query2){
            $query2->whereHas("alumni",function($query3){
                $query3->where("status_pekerjaan_id",StatusPekerjaan::BEKERJA);
            });
        });
        if(!empty($jenis_perusahaan_id)){
            $table = $table->where("jenis_perusahaan_id",$jenis_perusahaan_id);
        }
        $table = $table->get();

        if(count($table) <= 0){
            return redirect()->route($this->route."index")->with("error","Data yang akan diexport tidak ditemukan");
        }

        $collection = new Collection();

        $i = 0;
        foreach ($table as $index => $row) {
            $tanggal_mulai = "";

            if(!empty($row->tanggal_mulai)){
                $tanggal_mulai = date("d-m-Y",strtotime($row->tanggal_mulai));
            }
            $collection->push([
                'no' => ++$i,
                'nama' => $row->user->biodata->nama ?? null,
                'nim' => $row->user->biodata->nim ?? null,
                'tanggal_mulai' => $tanggal_mulai,
                'nama_instansi' => $row->nama_instansi,
                'jenis_pekerjaan' => $row->jenis_pekerjaan,
                'jenis_perusahaan' => $row->jenis_perusahaan->nama ?? null,
            ]);
        }

        return Excel::download(new AlumniBekerjaExport($collection), 'alumnibekerja-'.date('ymdhis').'.xlsx');
    }

    public function export_pdf(Request $request){
        try {
            $jenis_perusahaan_id = (empty($request->input("jenis_perusahaan_id"))) ? null : trim(htmlentities($request->input("jenis_perusahaan_id")));

            $table = $this->alumni_bekerja;
            $table = $table->orderBy("created_at","DESC");
            $table = $table->whereHas("user",function($query2){
                $query2->whereHas("alumni",function($query3){
                    $query3->where("status_pekerjaan_id",StatusPekerjaan::BEKERJA);
                });
            });
            if(!empty($jenis_perusahaan_id)){
                $table = $table->where("jenis_perusahaan_id",$jenis_perusahaan_id);
            }
            $table = $table->get();

            $data = [
                'table' => $table
            ];

            $pdf = PDF::loadview($this->view."export_pdf",$data)->setPaper('a4','potrait');
            return $pdf->stream();
        } catch (Throwable $e) {
            return redirect()->back()->withError($th->getMessage());
        }
    }
}
