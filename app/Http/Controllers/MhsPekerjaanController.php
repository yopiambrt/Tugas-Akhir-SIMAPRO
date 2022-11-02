<?php

namespace App\Http\Controllers;

use App\Models\MhsPekerjaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MhsPekerjaanController extends Controller
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
            'status_id' => $request->status,
            'instansi' => $request->ibu_pekerjaan,
        ];
        MhsPekerjaanModel::create($data);
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MhsPekerjaanModel  $mhsPekerjaanModel
     * @return \Illuminate\Http\Response
     */
    public function show(MhsPekerjaanModel $mhsPekerjaanModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MhsPekerjaanModel  $mhsPekerjaanModel
     * @return \Illuminate\Http\Response
     */
    public function edit(MhsPekerjaanModel $mhsPekerjaanModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MhsPekerjaanModel  $mhsPekerjaanModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MhsPekerjaanModel $mhsPekerjaanModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MhsPekerjaanModel  $mhsPekerjaanModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(MhsPekerjaanModel $mhsPekerjaanModel)
    {
        //
    }
}
