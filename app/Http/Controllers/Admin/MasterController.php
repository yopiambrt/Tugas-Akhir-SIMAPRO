<?php

namespace App\Http\Controllers\Admin;

use App\Models\Prodi;
use App\Models\Jenjang;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterController extends Controller
{
    public function indexFakultas()
    {
        $fakultas = Fakultas::all();
        return view('admin.master.fakultas', compact('fakultas'));
    }
    public function storeFakultas(Request $request)
    {
        Fakultas::create(['nama_fakultas' => $request->nama_fakultas]);
        return redirect()->route('admin.fakultas.index');
    }
    public function updateFakultas(Request $request, $id)
    {
        Fakultas::whereId($id)->update(['nama_fakultas' => $request->nama_fakultas]);
        return redirect()->route('admin.fakultas.index');
    }
    public function destroyFakultas(Request $request, $id)
    {
        $fakultas = Fakultas::find($id);
        $fakultas->delete($fakultas);
        return redirect()->route('admin.fakultas.index');
    }

    //Program Studi
    public function indexProdi()
    {
        $fakultas = Fakultas::all();
        $jenjang = Jenjang::all();
        $prodi = Prodi::all();
        return view('admin.master.prodi', compact('prodi', 'fakultas', 'jenjang'));
    }
    public function storeProdi(Request $request)
    {
        Prodi::create([
            'id_fakultas' => $request->id_fakultas,
            'id_jenjang' => $request->id_jenjang,
            'nama_prodi' => $request->nama_prodi,
        ]);
        return redirect()->route('admin.prodi.index');
    }
    public function updateProdi(Request $request, $id)
    {
        Prodi::whereId($id)->update([
            'id_fakultas' => $request->id_fakultas,
            'id_jenjang' => $request->id_jenjang,
            'nama_prodi' => $request->nama_prodi,
        ]);
        return redirect()->route('admin.prodi.index');
    }
    public function destroyProdi(Request $request, $id)
    {
        $prodi = Prodi::find($id);
        $prodi->delete();
        return redirect()->route('admin.prodi.index');
    }

    //Jenjang
    public function indexJenjang()
    {
        $jenjang = Jenjang::all();
        return view('admin.master.jenjang', compact('jenjang'));
    }
    public function storeJenjang(Request $request)
    {
        Jenjang::create([
            'nama_jenjang' => $request->nama_jenjang,
        ]);
        return redirect()->route('admin.jenjang.index');
    }
    public function updateJenjang(Request $request, $id)
    {
        Jenjang::whereId($id)->update([
            'nama_jenjang' => $request->nama_jenjang,
        ]);
        return redirect()->route('admin.jenjang.index');
    }
    public function destroyJenjang(Request $request, $id)
    {
        $jenjang = Jenjang::find($id);
        $jenjang->delete();
        return redirect()->route('admin.jenjang.index');
    }
}
