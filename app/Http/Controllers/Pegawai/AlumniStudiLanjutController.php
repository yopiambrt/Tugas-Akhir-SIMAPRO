<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Alumni;
use App\Models\Alumni\AlumniStudiLanjut;
use App\Models\User;
use App\Models\Master\StatusPekerjaan;
use App\Helpers\UploadHelper;
use App\Exports\Alumni\AlumniStudiLanjutExport;
use Error;
use Excel;
use PDF;

class AlumniStudiLanjutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->view = "pegawai.alumni.studi_lanjut.";
        $this->route = "pegawai.alumni.studi_lanjut.";
        $this->alumni = new Alumni();
        $this->user = new User();
        $this->status_pekerjaan = new StatusPekerjaan();
        $this->alumni_studi_lanjut = new AlumniStudiLanjut();
    }

    public function index()
    {
        $table = $this->alumni_studi_lanjut;
        $table = $table->orderBy("created_at","DESC");
        $table = $table->whereHas("user",function($query2){
            $query2->whereHas("alumni",function($query3){
                $query3->where("status_pekerjaan_id",StatusPekerjaan::STUDI_LANJUT);
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
            $query2->where("status_pekerjaan_id",StatusPekerjaan::STUDI_LANJUT);
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
            $nama = (empty($request->input("nama"))) ? null : trim(htmlentities($request->input("nama")));
            $tanggal_mulai = (empty($request->input("tanggal_mulai"))) ? null : trim(htmlentities($request->input("tanggal_mulai")));
            $nama_universitas = (empty($request->input("nama_universitas"))) ? null : trim(htmlentities($request->input("nama_universitas")));
            $univ_jenjang_id = (empty($request->input("univ_jenjang_id"))) ? null : trim(htmlentities($request->input("univ_jenjang_id")));
            $univ_kategori_id = (empty($request->input("univ_kategori_id"))) ? 0 : trim(htmlentities($request->input("univ_kategori_id")));
            $univ_level_id = (empty($request->input("univ_level_id"))) ? 0 : trim(htmlentities($request->input("univ_level_id")));
            $program_studi = (empty($request->input("program_studi"))) ? null : trim(htmlentities($request->input("program_studi")));
            $fakultas = (empty($request->input("fakultas"))) ? null : trim(htmlentities($request->input("fakultas")));

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
             }

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

            $check_exist_alumni_studi_lanjut = $this->alumni_studi_lanjut;
            $check_exist_alumni_studi_lanjut = $check_exist_alumni_studi_lanjut->where("user_id",$user_id);
            $check_exist_alumni_studi_lanjut = $check_exist_alumni_studi_lanjut->first();

            if($check_exist_alumni_studi_lanjut){
                throw new Error("Duplikat studi lanjut mahasiswa . Data studi lanjut mahasiswa ini sudah terdaftar");
            }

            $this->alumni_studi_lanjut->create([
                'user_id' => $user_id,
                'nama' => $nama,
                'tanggal_mulai' => $tanggal_mulai,
                'nama_universitas' => $nama_universitas,
                'univ_jenjang_id' => $univ_jenjang_id,
                'univ_kategori_id' => $univ_kategori_id,
                'univ_level_id' => $univ_level_id,
                'program_studi' => $program_studi,
                'fakultas' => $fakultas,
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
        $result = $this->alumni_studi_lanjut;
        $result = $result->where('id',$id);
        $result = $result->first();

        if(!$result){
            return redirect()->route($this->route.'index')->with('error','Data tidak ditemukan');
        }

        $mahasiswa = $this->user;
        $mahasiswa = $mahasiswa->whereHas("alumni",function($query2){
            $query2->where("status_pekerjaan_id",StatusPekerjaan::STUDI_LANJUT);
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
        $result = $this->alumni_studi_lanjut;
        $result = $result->where('id',$id);
        $result = $result->first();

        if(!$result){
            return redirect()->route($this->route.'index')->with('error','Data tidak ditemukan');
        }

        $mahasiswa = $this->user;
        $mahasiswa = $mahasiswa->whereHas("alumni",function($query2){
            $query2->where("status_pekerjaan_id",StatusPekerjaan::STUDI_LANJUT);
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
            $nama = (empty($request->input("nama"))) ? null : trim(htmlentities($request->input("nama")));
            $tanggal_mulai = (empty($request->input("tanggal_mulai"))) ? null : trim(htmlentities($request->input("tanggal_mulai")));
            $nama_universitas = (empty($request->input("nama_universitas"))) ? null : trim(htmlentities($request->input("nama_universitas")));
            $univ_jenjang_id = (empty($request->input("univ_jenjang_id"))) ? null : trim(htmlentities($request->input("univ_jenjang_id")));
            $univ_kategori_id = (empty($request->input("univ_kategori_id"))) ? 0 : trim(htmlentities($request->input("univ_kategori_id")));
            $univ_level_id = (empty($request->input("univ_level_id"))) ? 0 : trim(htmlentities($request->input("univ_level_id")));
            $program_studi = (empty($request->input("program_studi"))) ? null : trim(htmlentities($request->input("program_studi")));
            $fakultas = (empty($request->input("fakultas"))) ? null : trim(htmlentities($request->input("fakultas")));

            if(!$id){
                throw new Error("ID tidak boleh kosong");
             }

            if(!$user_id){
                throw new Error("User mahasiswa tidak boleh kosong");
             }

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

            $result = $this->alumni_studi_lanjut;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }

            $check_exist_alumni_studi_lanjut = $this->alumni_studi_lanjut;
            $check_exist_alumni_studi_lanjut = $check_exist_alumni_studi_lanjut->where("user_id",$user_id);
            $check_exist_alumni_studi_lanjut = $check_exist_alumni_studi_lanjut->where("id","!=",$id);
            $check_exist_alumni_studi_lanjut = $check_exist_alumni_studi_lanjut->first();

            if($check_exist_alumni_studi_lanjut){
                throw new Error("Duplikat studi lanjut mahasiswa . Data studi lanjut mahasiswa ini sudah terdaftar");
            }

            $result->update([
                'user_id' => $user_id,
                'nama' => $nama,
                'tanggal_mulai' => $tanggal_mulai,
                'nama_universitas' => $nama_universitas,
                'univ_jenjang_id' => $univ_jenjang_id,
                'univ_kategori_id' => $univ_kategori_id,
                'univ_level_id' => $univ_level_id,
                'program_studi' => $program_studi,
                'fakultas' => $fakultas,
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

            $result = $this->alumni_studi_lanjut;
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
        $table = $this->alumni_studi_lanjut;
        $table = $table->orderBy("created_at","DESC");
        $table = $table->whereHas("user",function($query2){
            $query2->whereHas("alumni",function($query3){
                $query3->where("status_pekerjaan_id",StatusPekerjaan::STUDI_LANJUT);
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
                'nama_universitas' => $row->nama_universitas,
                'program_studi' => $row->program_studi,
                'fakultas' => $row->fakultas,
            ]);
        }

        return Excel::download(new AlumniStudiLanjutExport($collection), 'alumnistudilanjut-'.date('ymdhis').'.xlsx');
    }

    public function export_pdf(Request $request){
        try {

            $table = $this->alumni_studi_lanjut;
            $table = $table->orderBy("created_at","DESC");
            $table = $table->whereHas("user",function($query2){
                $query2->whereHas("alumni",function($query3){
                    $query3->where("status_pekerjaan_id",StatusPekerjaan::STUDI_LANJUT);
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
