<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\MhsBiodata;
use App\Models\DataKeluarga;
use App\Models\User;
use App\Helpers\UploadHelper;
use Error;
use DB;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->view = "admin.biodata.";
        $this->route = "admin.biodata.";
        $this->alumni = new Alumni();
        $this->user = new User();
        $this->biodata = new MhsBiodata();
        $this->data_keluarga = new DataKeluarga();
    }

    public function index()
    {
        $table = $this->biodata;
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
        $mahasiswa = $mahasiswa->where("is_admin",User::ROLE_MAHASISWA);
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
        DB::beginTransaction();
        try {
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
            $nama = (empty($request->input("nama"))) ? null : trim(htmlentities($request->input("nama")));
            $email = (empty($request->input("email"))) ? null : trim(htmlentities($request->input("email")));
            $nim = (empty($request->input("nim"))) ? null : trim(htmlentities($request->input("nim")));
            $jk = (empty($request->input("jk"))) ? null : trim(htmlentities($request->input("jk")));
            $agama_id = (empty($request->input("agama_id"))) ? null : trim(htmlentities($request->input("agama_id")));
            $tempat_lahir = (empty($request->input("tempat_lahir"))) ? null : trim(htmlentities($request->input("tempat_lahir")));
            $tanggal_lahir = (empty($request->input("tanggal_lahir"))) ? null : trim(htmlentities($request->input("tanggal_lahir")));
            $city_id = (empty($request->input("city_id"))) ? null : trim(htmlentities($request->input("city_id")));
            $alamat = (empty($request->input("alamat"))) ? null : trim(htmlentities($request->input("alamat")));
            $pendidikan_terakhir = (empty($request->input("pendidikan_terakhir"))) ? null : trim(htmlentities($request->input("pendidikan_terakhir")));
            $kelas = (empty($request->input("kelas"))) ? null : trim(htmlentities($request->input("kelas")));
            $tahun_masuk = (empty($request->input("tahun_masuk"))) ? null : trim(htmlentities($request->input("tahun_masuk")));

            // Ortu
            $ayah_nama = (empty($request->input("ayah_nama"))) ? null : trim(htmlentities($request->input("ayah_nama")));
            $ayah_alamat = (empty($request->input("ayah_alamat"))) ? null : trim(htmlentities($request->input("ayah_alamat")));
            $ayah_telepon = (empty($request->input("ayah_telepon"))) ? null : trim(htmlentities($request->input("ayah_telepon")));
            $ayah_pendidikan_id = (empty($request->input("ayah_pendidikan_id"))) ? null : trim(htmlentities($request->input("ayah_pendidikan_id")));
            $ayah_pekerjaan = (empty($request->input("ayah_pekerjaan"))) ? null : trim(htmlentities($request->input("ayah_pekerjaan")));
            $ayah_gaji = (empty($request->input("ayah_gaji"))) ? 0 : trim(htmlentities($request->input("ayah_gaji")));
            $ibu_nama = (empty($request->input("ibu_nama"))) ? null : trim(htmlentities($request->input("ibu_nama")));
            $ibu_alamat = (empty($request->input("ibu_alamat"))) ? null : trim(htmlentities($request->input("ibu_alamat")));
            $ibu_telepon = (empty($request->input("ibu_telepon"))) ? null : trim(htmlentities($request->input("ibu_telepon")));
            $ibu_pendidikan_id = (empty($request->input("ibu_pendidikan_id"))) ? null : trim(htmlentities($request->input("ibu_pendidikan_id")));
            $ibu_pekerjaan = (empty($request->input("ibu_pekerjaan"))) ? null : trim(htmlentities($request->input("ibu_pekerjaan")));
            $ibu_gaji = (empty($request->input("ibu_gaji"))) ? 0 : trim(htmlentities($request->input("ibu_gaji")));
            $kakak_jumlah = (empty($request->input("kakak_jumlah"))) ? 0 : trim(htmlentities($request->input("kakak_jumlah")));
            $adik_jumlah = (empty($request->input("adik_jumlah"))) ? 0 : trim(htmlentities($request->input("adik_jumlah")));

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
             }

            if(!$nama){
               throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if(!$email){
               throw new Error("Email mahasiswa tidak boleh kosong");
            }

            if(!$nim){
               throw new Error("NIM mahasiswa tidak boleh kosong");
            }

            if(!$jk){
               throw new Error("Jenis kelamin mahasiswa tidak boleh kosong");
            }

            if(!$agama_id){
                throw new Error("Agama mahasiswa tidak boleh kosong");
            }

            if(!$tempat_lahir){
                throw new Error("Tempat lahir mahasiswa tidak boleh kosong");
            }

            if(!$tanggal_lahir){
                throw new Error("Tanggal lahir mahasiswa tidak boleh kosong");
            }

            if(!$city_id){
                throw new Error("Kota/Kabupaten tempat tinggal mahasiswa tidak boleh kosong");
            }

            if(!$alamat){
                throw new Error("Alamat mahasiswa tidak boleh kosong");
            }

            if(!$pendidikan_terakhir){
                throw new Error("Pendidikan Terakhir mahasiswa tidak boleh kosong");
            }

            if(!$kelas){
                throw new Error("Kelas mahasiswa tidak boleh kosong");
            }

            if(!$tahun_masuk){
                throw new Error("Tahun masuk mahasiswa tidak boleh kosong");
            }

            if(!$ayah_nama){
                throw new Error("Nama ayah tidak boleh kosong");
            }

            if(!$ayah_telepon){
                throw new Error("Telepon ayah tidak boleh kosong");
            }

            if(!$ayah_alamat){
                throw new Error("Alamat ayah tidak boleh kosong");
            }

            if(!$ayah_pendidikan_id){
                throw new Error("Pendidikan terakhir ayah tidak boleh kosong");
            }

            if(!$ayah_pekerjaan){
                throw new Error("Pekerjaan ayah tidak boleh kosong");
            }

            if($ayah_gaji === ""){
                throw new Error("Gaji ayah tidak boleh kosong");
            }

            if(!$ibu_nama){
                throw new Error("Nama ibu tidak boleh kosong");
            }

            if(!$ibu_telepon){
                throw new Error("Telepon ibu tidak boleh kosong");
            }

            if(!$ibu_alamat){
                throw new Error("Alamat ibu tidak boleh kosong");
            }

            if(!$ibu_pendidikan_id){
                throw new Error("Pendidikan terakhir ibu tidak boleh kosong");
            }

            if(!$ibu_pekerjaan){
                throw new Error("Pekerjaan ibu tidak boleh kosong");
            }
            
            if($ibu_gaji === ""){
                throw new Error("Gaji ibu tidak boleh kosong");
            }

            if($kakak_jumlah === ""){
                throw new Error("Jumlah kakak tidak boleh kosong");
            }

            if($adik_jumlah === ""){
                throw new Error("Jumlah adik tidak boleh kosong");
            }

            $check_exist_biodata = $this->biodata;
            $check_exist_biodata = $check_exist_biodata->where("user_id",$user_id);
            $check_exist_biodata = $check_exist_biodata->first();

            if($check_exist_biodata){
                throw new Error("Duplikat biodata mahasiswa . Mahasiswa ini sudah memiliki biodata");
            }

            $this->biodata->create([
                'user_id' => $user_id,
                'nama' => $nama,
                'email' => $email,
                'nim' => $nim,
                'jk' => $jk,
                'agama_id' => $agama_id,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'city_id' => $city_id,
                'alamat' => $alamat,
                'pendidikan_terakhir' => $pendidikan_terakhir,
                'kelas' => $kelas,
                'tahun_masuk' => $tahun_masuk,
            ]);

            $this->data_keluarga->updateOrCreate([
                'user_id' => $user_id,
            ],[
                'user_id' => $user_id,
                'nim' => $nim,
                'ayah_nama' => $ayah_nama,
                'ayah_alamat' => $ayah_alamat,
                'ayah_telepon' => $ayah_telepon,
                'ayah_pendidikan_id' => $ayah_pendidikan_id,
                'ayah_pekerjaan' => $ayah_pekerjaan,
                'ayah_gaji' => $ayah_gaji,
                'ibu_nama' => $ibu_nama,
                'ibu_alamat' => $ibu_alamat,
                'ibu_telepon' => $ibu_telepon,
                'ibu_pendidikan_id' => $ibu_pendidikan_id,
                'ibu_pekerjaan' => $ibu_pekerjaan,
                'ibu_gaji' => $ibu_gaji,
            ]);

            DB::commit();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil ditambahkan";
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->biodata;
        $result = $result->where('id',$id);
        $result = $result->first();

        if(!$result){
            return redirect()->route($this->route.'index')->with('error','Data tidak ditemukan');
        }

        $mahasiswa = $this->user;
        $mahasiswa = $mahasiswa->where("is_active",User::IS_ACTIVE_YES);
        $mahasiswa = $mahasiswa->where("is_admin",User::ROLE_MAHASISWA);
        $mahasiswa = $mahasiswa->get();

        $data = [
            'mahasiswa' => $mahasiswa,
            'result' => $result,
        ];

        return view($this->view."show",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = $this->biodata;
        $result = $result->where('id',$id);
        $result = $result->first();

        if(!$result){
            return redirect()->route($this->route.'index')->with('error','Data tidak ditemukan');
        }

        $mahasiswa = $this->user;
        $mahasiswa = $mahasiswa->where("is_active",User::IS_ACTIVE_YES);
        $mahasiswa = $mahasiswa->where("is_admin",User::ROLE_MAHASISWA);
        $mahasiswa = $mahasiswa->get();

        $data = [
            'mahasiswa' => $mahasiswa,
            'result' => $result,
        ];

        return view($this->view."edit",$data);
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
        DB::beginTransaction();
        try {
            $id = (empty($request->input("id"))) ? null : trim(htmlentities($request->input("id")));
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
            $nama = (empty($request->input("nama"))) ? null : trim(htmlentities($request->input("nama")));
            $email = (empty($request->input("email"))) ? null : trim(htmlentities($request->input("email")));
            $nim = (empty($request->input("nim"))) ? null : trim(htmlentities($request->input("nim")));
            $jk = (empty($request->input("jk"))) ? null : trim(htmlentities($request->input("jk")));
            $agama_id = (empty($request->input("agama_id"))) ? null : trim(htmlentities($request->input("agama_id")));
            $tempat_lahir = (empty($request->input("tempat_lahir"))) ? null : trim(htmlentities($request->input("tempat_lahir")));
            $tanggal_lahir = (empty($request->input("tanggal_lahir"))) ? null : trim(htmlentities($request->input("tanggal_lahir")));
            $city_id = (empty($request->input("city_id"))) ? null : trim(htmlentities($request->input("city_id")));
            $alamat = (empty($request->input("alamat"))) ? null : trim(htmlentities($request->input("alamat")));
            $pendidikan_terakhir = (empty($request->input("pendidikan_terakhir"))) ? null : trim(htmlentities($request->input("pendidikan_terakhir")));
            $kelas = (empty($request->input("kelas"))) ? null : trim(htmlentities($request->input("kelas")));
            $tahun_masuk = (empty($request->input("tahun_masuk"))) ? null : trim(htmlentities($request->input("tahun_masuk")));

            // Ortu
            $ayah_nama = (empty($request->input("ayah_nama"))) ? null : trim(htmlentities($request->input("ayah_nama")));
            $ayah_alamat = (empty($request->input("ayah_alamat"))) ? null : trim(htmlentities($request->input("ayah_alamat")));
            $ayah_telepon = (empty($request->input("ayah_telepon"))) ? null : trim(htmlentities($request->input("ayah_telepon")));
            $ayah_pendidikan_id = (empty($request->input("ayah_pendidikan_id"))) ? null : trim(htmlentities($request->input("ayah_pendidikan_id")));
            $ayah_pekerjaan = (empty($request->input("ayah_pekerjaan"))) ? null : trim(htmlentities($request->input("ayah_pekerjaan")));
            $ayah_gaji = (empty($request->input("ayah_gaji"))) ? 0 : trim(htmlentities($request->input("ayah_gaji")));
            $ibu_nama = (empty($request->input("ibu_nama"))) ? null : trim(htmlentities($request->input("ibu_nama")));
            $ibu_alamat = (empty($request->input("ibu_alamat"))) ? null : trim(htmlentities($request->input("ibu_alamat")));
            $ibu_telepon = (empty($request->input("ibu_telepon"))) ? null : trim(htmlentities($request->input("ibu_telepon")));
            $ibu_pendidikan_id = (empty($request->input("ibu_pendidikan_id"))) ? null : trim(htmlentities($request->input("ibu_pendidikan_id")));
            $ibu_pekerjaan = (empty($request->input("ibu_pekerjaan"))) ? null : trim(htmlentities($request->input("ibu_pekerjaan")));
            $ibu_gaji = (empty($request->input("ibu_gaji"))) ? 0 : trim(htmlentities($request->input("ibu_gaji")));
            $kakak_jumlah = (empty($request->input("kakak_jumlah"))) ? 0 : trim(htmlentities($request->input("kakak_jumlah")));
            $adik_jumlah = (empty($request->input("adik_jumlah"))) ? 0 : trim(htmlentities($request->input("adik_jumlah")));

            if(!$id){
                throw new Error("ID tidak boleh kosong");
            }

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
            }

            if(!$nama){
               throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if(!$email){
               throw new Error("Email mahasiswa tidak boleh kosong");
            }

            if(!$nim){
               throw new Error("NIM mahasiswa tidak boleh kosong");
            }

            if(!$jk){
               throw new Error("Jenis kelamin mahasiswa tidak boleh kosong");
            }

            if(!$agama_id){
                throw new Error("Agama mahasiswa tidak boleh kosong");
            }

            if(!$tempat_lahir){
                throw new Error("Tempat lahir mahasiswa tidak boleh kosong");
            }

            if(!$tanggal_lahir){
                throw new Error("Tanggal lahir mahasiswa tidak boleh kosong");
            }

            if(!$city_id){
                throw new Error("Kota/Kabupaten tempat tinggal mahasiswa tidak boleh kosong");
            }

            if(!$alamat){
                throw new Error("Alamat mahasiswa tidak boleh kosong");
            }

            if(!$pendidikan_terakhir){
                throw new Error("Pendidikan Terakhir mahasiswa tidak boleh kosong");
            }

            if(!$kelas){
                throw new Error("Kelas mahasiswa tidak boleh kosong");
            }

            if(!$tahun_masuk){
                throw new Error("Tahun masuk mahasiswa tidak boleh kosong");
            }

            if(!$ayah_nama){
                throw new Error("Nama ayah tidak boleh kosong");
            }

            if(!$ayah_telepon){
                throw new Error("Telepon ayah tidak boleh kosong");
            }

            if(!$ayah_alamat){
                throw new Error("Alamat ayah tidak boleh kosong");
            }

            if(!$ayah_pendidikan_id){
                throw new Error("Pendidikan terakhir ayah tidak boleh kosong");
            }

            if(!$ayah_pekerjaan){
                throw new Error("Pekerjaan ayah tidak boleh kosong");
            }

            if($ayah_gaji === ""){
                throw new Error("Gaji ayah tidak boleh kosong");
            }

            if(!$ibu_nama){
                throw new Error("Nama ibu tidak boleh kosong");
            }

            if(!$ibu_telepon){
                throw new Error("Telepon ibu tidak boleh kosong");
            }

            if(!$ibu_alamat){
                throw new Error("Alamat ibu tidak boleh kosong");
            }

            if(!$ibu_pendidikan_id){
                throw new Error("Pendidikan terakhir ibu tidak boleh kosong");
            }

            if(!$ibu_pekerjaan){
                throw new Error("Pekerjaan ibu tidak boleh kosong");
            }
            
            if($ibu_gaji === ""){
                throw new Error("Gaji ibu tidak boleh kosong");
            }

            if($kakak_jumlah === ""){
                throw new Error("Jumlah kakak tidak boleh kosong");
            }

            if($adik_jumlah === ""){
                throw new Error("Jumlah adik tidak boleh kosong");
            }

            $result = $this->biodata;
            $result = $result->where('id',$id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }

            $check_exist_biodata = $this->biodata;
            $check_exist_biodata = $check_exist_biodata->where("user_id",$user_id);
            $check_exist_biodata = $check_exist_biodata->where("id","!=",$id);
            $check_exist_biodata = $check_exist_biodata->first();

            if($check_exist_biodata){
                throw new Error("Duplikat biodata mahasiswa . Mahasiswa ini sudah memiliki biodata");
            }

            $result->update([
                'user_id' => $user_id,
                'nama' => $nama,
                'email' => $email,
                'nim' => $nim,
                'jk' => $jk,
                'agama_id' => $agama_id,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'city_id' => $city_id,
                'alamat' => $alamat,
                'pendidikan_terakhir' => $pendidikan_terakhir,
                'kelas' => $kelas,
                'tahun_masuk' => $tahun_masuk,
            ]);

            $result->keluarga->update([
                'user_id' => $user_id,
                'nim' => $nim,
                'ayah_nama' => $ayah_nama,
                'ayah_alamat' => $ayah_alamat,
                'ayah_telepon' => $ayah_telepon,
                'ayah_pendidikan_id' => $ayah_pendidikan_id,
                'ayah_pekerjaan' => $ayah_pekerjaan,
                'ayah_gaji' => $ayah_gaji,
                'ibu_nama' => $ibu_nama,
                'ibu_alamat' => $ibu_alamat,
                'ibu_telepon' => $ibu_telepon,
                'ibu_pendidikan_id' => $ibu_pendidikan_id,
                'ibu_pekerjaan' => $ibu_pekerjaan,
                'ibu_gaji' => $ibu_gaji,
                'kakak_jumlah' => $kakak_jumlah,
                'adik_jumlah' => $adik_jumlah,
            ]);

            DB::commit();

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil diubah";
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

            $result = $this->biodata;
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
}
