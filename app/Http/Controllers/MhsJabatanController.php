<?php

namespace App\Http\Controllers;

use App\Models\MhsJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MhsJabatanController extends Controller
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
            'jabatan' => $request->jabatan,
            'golongan' => $request->golongan,
        ];
        MhsJabatan::create($data);
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MhsJabatan  $mhsjabatan
     * @return \Illuminate\Http\Response
     */
    public function show(MhsJabatan $mhsjabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MhsJabatan  $mhsjabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(MhsJabatan $mhsjabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mhsjabatan  $mhsjabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mhsjabatan $mhsjabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mhsjabatan  $mhsjabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mhsjabatan $mhsjabatan)
    {
        //
    }
}
