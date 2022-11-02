<?php

namespace App\Http\Controllers;

use App\Models\kompetisi;
use App\Models\KompetisiMahasiswaHasil;
use App\Models\prestasi;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $users = prestasi::all();
        $mhs = user::all();
        $kompetisi = kompetisi::all();
        $hasil = KompetisiMahasiswaHasil::all();
        return view('admin.prestasi.index', compact('users', 'mhs', 'kompetisi', 'hasil'));
    }
    public function store(Request $request)
    {
        $prestasi = new prestasi;
        $prestasi->user_id = $request->user_id;
        $prestasi->nama_kompetisi = $request->nama_kompetisi;
        $prestasi->team = $request->team;
        $prestasi->hasil_kompetisi = "Juara ".$request->id_kompetisi_hasil;
        $prestasi->status = true;
        $prestasi->tanggal_upload = Carbon::now();
        $prestasi->save();
        
        return redirect()->route('admin.prestasi.index');
    }
    public function update(Request $request, $id)
    {
        prestasi::whereId($id)->update([
            'user_id' => $request->user_id,
            'id_kompetisi' => $request->id_kompetisi,
            'team' => $request->team,
            'id_kompetisi_hasil' => $request->id_kompetisi_hasil,
            'status' => true,
            'tanggal_upload' => Carbon::now()
        ]);
        return redirect()->route('admin.prestasi.index');
    }

    public function delete($id)
    {
        $del = prestasi::find($id);
        $del->delete();
        return redirect()->route('admin.prestasi.index');
    }
    public function vieweditprestasi($id){
        $prestasi = prestasi::find($id);
       
        return view('admin.prestasi.editprestasi', ['prestasi'=>$prestasi]);
    }
    public function storeeditprestasi(Request $request,$id){
        $prestasi = prestasi::find($id);
        $prestasi->team = $request->nama_team;
        $prestasi->hasil_kompetisi = $request->hasil_kompetisi;
        $prestasi->save();
        return view('admin.prestasi.editprestasi', ['prestasi'=>$prestasi]);
    }
}
