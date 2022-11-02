<?php

namespace App\Http\Controllers;

use App\Models\MhsTambahPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MhsTambahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $data = [
            'user_id' => Auth::user()->id,
            'jenis' => $request->jenis,
            'kategori' => $request->kategori,
            'jabatan' => $request->jabatan,
            'instansi' => $request->instansi,
            'kontak' => $request->kontak,
            'ppkwt' => $request->radio1,
            'ppkkpw' => $request->radio2,
            'pkkbpw' => $request->radio3,
            'pns' => $request->radio4,
            'pppk' => $request->radio5,
        ];
        MhsTambahPekerjaan::create($data);
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MhsTambahPekerjaan  $mhsPekerjaanModel
     * @return \Illuminate\Http\Response
     */
    public function show(MhsTambahPekerjaan $mhsTambahPekerjaanModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MhsTambahPekerjaan  $mhsPekerjaanModel
     * @return \Illuminate\Http\Response
     */
    public function edit(MhsTambahPekerjaan $mhsTambahPekerjaanModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MhsTambahPekerjaan  $mhsPekerjaanModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MhsTambahPekerjaan $mhsTambahPekerjaanModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MhsTambahPekerjaan  $mhsPekerjaanModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(MhsTambahPekerjaan $mhsTambahPekerjaanModel)
    {
        //
    }
}
