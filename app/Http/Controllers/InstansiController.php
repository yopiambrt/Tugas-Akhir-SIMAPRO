<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MhsInstansi;
use Illuminate\Support\Facades\Auth;

class InstansiController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
    }
    public function store(Request $request)
    {    
        $data = [
            'user_id' => Auth::user()->id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'bidang' => $request->bidang,
            'jenis' => $request->jenis,
            'siup' => $request->siup,
            'iumk' => $request->iumk,
            'yayasan' => $request->yayasan,
            'pbh' => $request->pbh,
            'ism' => $request->ism,
        ];
        MhsInstansi::create($data);
        return redirect()->back()->withInput();
    }

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
    public function datainstansi()
    {
        $datainstansi = Mhsinstansi::all();
        return view('instansi', ['datainstansi'=>$datainstansi]);
    }
    public function hapusinstansi($id)
    {
        $datainstansi = MhsInstansi::find($id);
        $datainstansi->delete();
        return redirect('/data/instansi');
    }
    public function vieweditjabatan($id)
    {
        $datajabatan = MhsJabatan::all();
        $datajabatanrinci = MhsJabatan::find($id);
        return view('editjabatan',['datajabatanrinci'=>$datajabatanrinci, 'datajabatan'=>$datajabatan]);
    }
    public function storeeditinstansi(Request $request,$id)
    {
        $datajabatanrinci = MhsInstansi::find($id);
        $datajabatanrinci->jabatan = $request->jabatan;
        $datajabatanrinci->golongan = $request->golongan;
        $datajabatanrinci->save();
        return redirect('/data/instansi');
   
    }   

}
