<?php

namespace App\Http\Controllers;

use App\Models\AlumniTambah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniTambahController extends Controller
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
            'nama' => $request->nama,
            'nim' => $request->nim,
            'angkatan' => $request->angkatan,
            'pekerjaan' => $request->pekerjaan,
            'instansi' => $request->instansi,
            'tglmasuk' => $request->masuk,
            'jabatan' => $request->jabatan,
            'gaji' => $request->gaji,
            'umr' => $request->umr,
            'kategori' => $request->kategori,
        ];
        AlumniTambah::create($data);
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlumniTambah  $alumniTambah
     * @return \Illuminate\Http\Response
     */
    public function show(AlumniTambah $alumniTambah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlumniTambah  $alumniTambah
     * @return \Illuminate\Http\Response
     */
    public function edit(AlumniTambah $alumniTambah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlumniTambah  $alumniTambah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlumniTambah $alumniTambah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlumniTambah  $alumniTambah
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlumniTambah $alumniTambah)
    {
        //
    }
}
