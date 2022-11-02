<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MhsJabatan;
use App\Models\Alumni;
use App\Models\Master\StatusPekerjaan;
use App\Models\Master\JenisPerusahaan;
use App\Models\Alumni\AlumniWirausaha;
use App\Models\Alumni\AlumniBekerja;
use App\Models\Alumni\AlumniStudiLanjut;
use App\Helpers\UploadHelper;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->alumni = new Alumni();
        $this->user = new User();
        $this->status_pekerjaan = new StatusPekerjaan();
        $this->alumni_wirausaha = new AlumniWirausaha();
        $this->alumni_bekerja = new AlumniBekerja();
        $this->alumni_studi_lanjut = new AlumniStudiLanjut();
        $this->jenis_perusahaan = new JenisPerusahaan();
    }

    public function index()
    {
        $alumni_wirausaha = $this->alumni_wirausaha;
        $alumni_wirausaha = $alumni_wirausaha->orderBy("created_at","DESC");
        $alumni_wirausaha = $alumni_wirausaha->whereHas("user",function($query2){
            $query2->whereHas("alumni",function($query3){
                $query3->where("status_pekerjaan_id",StatusPekerjaan::MEMBUKA_USAHA);
            });
        });
        $alumni_wirausaha = $alumni_wirausaha->count();

        $alumni_bekerja = $this->alumni_bekerja;
        $alumni_bekerja = $alumni_bekerja->orderBy("created_at","DESC");
        $alumni_bekerja = $alumni_bekerja->whereHas("user",function($query2){
            $query2->whereHas("alumni",function($query3){
                $query3->where("status_pekerjaan_id",StatusPekerjaan::BEKERJA);
            });
        });
        $alumni_bekerja = $alumni_bekerja->count();

        $alumni_studi_lanjut = $this->alumni_studi_lanjut;
        $alumni_studi_lanjut = $alumni_studi_lanjut->orderBy("created_at","DESC");
        $alumni_studi_lanjut = $alumni_studi_lanjut->whereHas("user",function($query2){
            $query2->whereHas("alumni",function($query3){
                $query3->where("status_pekerjaan_id",StatusPekerjaan::STUDI_LANJUT);
            });
        });
        $alumni_studi_lanjut = $alumni_studi_lanjut->count();

        $total_user = $this->user;
        $total_user = $total_user->count();

        $total_mahasiswa = $this->user;
        $total_mahasiswa = $total_mahasiswa->where("is_admin",User::ROLE_MAHASISWA);
        $total_mahasiswa = $total_mahasiswa->count();

        $total_alumni = $this->user;
        $total_alumni = $total_alumni->where("is_admin",User::ROLE_MAHASISWA);
        $total_alumni = $total_alumni->whereHas("alumni",function($query2){
            $query2->where("status_verifikasi",Alumni::STATUS_VERIFIKASI_YES);
        });
        $total_alumni = $total_alumni->count();

        $data = [
            'alumni_wirausaha' => $alumni_wirausaha,
            'alumni_bekerja' => $alumni_bekerja,
            'alumni_studi_lanjut' => $alumni_studi_lanjut,
            'total_user' => $total_user,
            'total_mahasiswa' => $total_mahasiswa,
            'total_alumni' => $total_alumni,
        ];

        return view('dashboard',$data);
    }

    public function bekerja()
    {
        $jenis_perusahaan = $this->jenis_perusahaan;
        $jenis_perusahaan = $jenis_perusahaan->get();

        $collection = new Collection();

        foreach($jenis_perusahaan as $index => $row){
            $total_alumni = $this->user;
            $total_alumni = $total_alumni->where("is_admin",User::ROLE_MAHASISWA);
            $total_alumni = $total_alumni->whereHas("alumni",function($query2) use($row){
                $query2->where("status_verifikasi",Alumni::STATUS_VERIFIKASI_YES);
            });
            $total_alumni = $total_alumni->whereHas("alumni_bekerja",function($query2) use($row){
                $query2->where("jenis_perusahaan_id",$row->id);
            });
            $total_alumni = $total_alumni->count();

            $collection->push([
                'perusahaan' => $row->nama,
                'total_alumni' => $total_alumni
            ]);
            
        }

        $data = [
            'data' => $collection
        ];

        return view('dashboard_bekerja',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        //
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
}
