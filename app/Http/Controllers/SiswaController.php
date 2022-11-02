<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiswaModel;
// use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function datalist(){
        $datasiswa = SiswaModel::whereId($id)->first();
        $data = [
            'nama' => 'nama baru'
        ];
        $datasiswa->update($data);
        return redirect()->back()->withInput();
    }
}
