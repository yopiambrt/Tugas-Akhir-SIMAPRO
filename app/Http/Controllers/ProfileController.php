<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Helpers\UploadHelper;
use Auth;
use Error;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->view = "profile";
        $this->route = "profile";
        $this->user = new User();

    }
    public function index()
    {
        return view($this->view);
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
        //
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
            $name = (empty($request->input("name"))) ? null : trim(htmlentities($request->input("name")));
            $password = (empty($request->input("password"))) ? null : trim(htmlentities($request->input("password")));
            $avatar = $request->file("avatar");

            if(!$name){
                throw new Error("Nama tidak boleh kosong");
            }

            $result = $this->user;
            $result = $result->where("id",Auth::user()->id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }

            if($password){
                $password = Hash::make($password);
            }else{
                $password = $result->password;
            }

            if(!empty($avatar)){
                $valid_ext = [];

                $upload = UploadHelper::upload_file($avatar,'avatar',$valid_ext);

                if($upload["IsError"] == TRUE){
                    throw new Error($upload["Message"]);
                }

                $avatar = $upload["Path"];
            }
            else{
                $avatar = $result->avatar;
            }

            $result->update([
                'name' => $name,
                'password' => $password,
                'avatar' => $avatar,
            ]);

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data profile berhasil diubah";
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
    public function destroy($id)
    {
        //
    }
}
