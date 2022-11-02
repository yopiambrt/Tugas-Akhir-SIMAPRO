<?php

namespace App\Http\Controllers;

use App\Models\MhsKategoriPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MhsKategoriPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $users = User::all();
        $role = Role::all();
        return view('kategori_pekerjaan.index', compact('user', 'role', 'users'));
    }
    public function user()
    {
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
            'kategori' => $request->kategori,
        ];
        MhsKategoriPekerjaan::create($data);
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MhsKategoriPekerjaan  $mhsKategoriPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function show(MhsKategoriPekerjaan $mhsKategoriPekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MhsKategoriPekerjaan  $mhsKategoriPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function edit(MhsKategoriPekerjaan $mhsKategoriPekerjaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MhsKategoriPekerjaan  $mhsKategoriPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MhsKategoriPekerjaan $mhsKategoriPekerjaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MhsKategoriPekerjaan  $mhsKategoriPekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MhsKategoriPekerjaan $mhsKategoriPekerjaan)
    {
        //
    }
}
