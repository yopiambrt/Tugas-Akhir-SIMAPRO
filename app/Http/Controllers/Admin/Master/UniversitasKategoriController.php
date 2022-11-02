<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\UniversitasKategori;

class UniversitasKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->view = "admin.master.universitas_kategori";
        $this->route = "admin.master.universitas_kategori.";
        $this->universitas_kategori = new UniversitasKategori();
    }
    public function index()
    {
        $table = $this->universitas_kategori;
        $table = $table->orderBy("created_at","DESC");
        $table = $table->get();

        $data = [
            'table' => $table
        ];

        return view($this->view,$data);
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
        $data_json = [];
        try {
            $nama = (empty($request->input("nama"))) ? 0 : trim(htmlentities($request->input("nama")));

            if(!$nama){
                throw new Error("Nama tidak boleh kosong");
            }

            $this->universitas_kategori->create([
                'nama' => $nama,
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
    public function update(Request $request)
    {
        $data_json = [];
        try {
            $id = (empty($request->input("id"))) ? null : trim(htmlentities($request->input("id")));
            $nama = (empty($request->input("nama"))) ? null : trim(htmlentities($request->input("nama")));

            if(!$id){
                throw new Error("ID tidak boleh kosong");
            }

            if(!$nama){
                throw new Error("Nama tidak boleh kosong");
            }

            $result = $this->universitas_kategori;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }

            $result->update([
                'nama' => $nama,
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

            $result = $this->universitas_kategori;
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
