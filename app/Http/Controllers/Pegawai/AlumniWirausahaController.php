<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Alumni;
use App\Models\Alumni\AlumniWirausaha;
use App\Models\User;
use App\Models\Master\StatusPekerjaan;
use App\Helpers\UploadHelper;
use App\Exports\Alumni\AlumniWirausahaExport;
use Error;
use Excel;
use PDF;

class AlumniWirausahaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->view = "pegawai.alumni.wirausaha.";
        $this->route = "pegawai.alumni.wirausaha.";
        $this->alumni = new Alumni();
        $this->user = new User();
        $this->status_pekerjaan = new StatusPekerjaan();
        $this->alumni_wirausaha = new AlumniWirausaha();
    }

    public function index()
    {
        $table = $this->alumni_wirausaha;
        $table = $table->orderBy("created_at","DESC");
        $table = $table->whereHas("user",function($query2){
            $query2->whereHas("alumni",function($query3){
                $query3->where("status_pekerjaan_id",StatusPekerjaan::MEMBUKA_USAHA);
            });
        });
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
        $mahasiswa = $mahasiswa->whereHas("alumni",function($query2){
            $query2->where("status_pekerjaan_id",StatusPekerjaan::MEMBUKA_USAHA);
        });
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
        try {
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$user_id){
                throw new Error("User mahasiswa usaha tidak boleh kosong");
             }

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

            $check_exist_alumni_wirausaha = $this->alumni_wirausaha;
            $check_exist_alumni_wirausaha = $check_exist_alumni_wirausaha->where("user_id",$user_id);
            $check_exist_alumni_wirausaha = $check_exist_alumni_wirausaha->first();

            if($check_exist_alumni_wirausaha){
                throw new Error("Duplikat wirausaha mahasiswa . Data wirausaha mahasiswa ini sudah terdaftar");
            }

            $this->alumni_wirausaha->create([
                'user_id' => $user_id,
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
    public function show($id)
    {
        $result = $this->alumni_wirausaha;
        $result = $result->where('id',$id);
        $result = $result->first();

        if(!$result){
            return redirect()->route($this->route.'index')->with('error','Data tidak ditemukan');
        }

        $mahasiswa = $this->user;
        $mahasiswa = $mahasiswa->whereHas("alumni",function($query2){
            $query2->where("status_pekerjaan_id",StatusPekerjaan::MEMBUKA_USAHA);
        });
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
        $result = $this->alumni_wirausaha;
        $result = $result->where('id',$id);
        $result = $result->first();

        if(!$result){
            return redirect()->route($this->route.'index')->with('error','Data tidak ditemukan');
        }

        $mahasiswa = $this->user;
        $mahasiswa = $mahasiswa->whereHas("alumni",function($query2){
            $query2->where("status_pekerjaan_id",StatusPekerjaan::MEMBUKA_USAHA);
        });
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
        try {
            $id = (empty($request->input("id"))) ? null : trim(htmlentities($request->input("id")));
            $user_id = (empty($request->input("user_id"))) ? null : trim(htmlentities($request->input("user_id")));
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

            if(!$id){
                throw new Error("ID tidak boleh kosong");
             }

            if(!$user_id){
                throw new Error("User mahasiswa usaha tidak boleh kosong");
             }

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

            $result = $this->alumni_wirausaha;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }

            $check_exist_alumni_wirausaha = $this->alumni_wirausaha;
            $check_exist_alumni_wirausaha = $check_exist_alumni_wirausaha->where("user_id",$user_id);
            $check_exist_alumni_wirausaha = $check_exist_alumni_wirausaha->where("id","!=",$id);
            $check_exist_alumni_wirausaha = $check_exist_alumni_wirausaha->first();

            if($check_exist_alumni_wirausaha){
                throw new Error("Duplikat wirausaha mahasiswa . Data wirausaha mahasiswa ini sudah terdaftar");
            }

            $result->update([
                'user_id' => $user_id,
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

            $result = $this->alumni_wirausaha;
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

    public function export_excel(Request $request)
    {
        $table = $this->alumni_wirausaha;
        $table = $table->orderBy("created_at","DESC");
        $table = $table->whereHas("user",function($query2){
            $query2->whereHas("alumni",function($query3){
                $query3->where("status_pekerjaan_id",StatusPekerjaan::MEMBUKA_USAHA);
            });
        });
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
                'nama_usaha' => $row->nama_usaha,
                'jenis_usaha' => $row->jenis_usaha->nama ?? null,
                'level_usaha' => $row->level_usaha->nama ?? null,
            ]);
        }

        return Excel::download(new AlumniWirausahaExport($collection), 'alumniwirausaha-'.date('ymdhis').'.xlsx');
    }

    public function export_pdf(Request $request){
        try {

            $table = $this->alumni_wirausaha;
            $table = $table->orderBy("created_at","DESC");
            $table = $table->whereHas("user",function($query2){
                $query2->whereHas("alumni",function($query3){
                    $query3->where("status_pekerjaan_id",StatusPekerjaan::MEMBUKA_USAHA);
                });
            });
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
