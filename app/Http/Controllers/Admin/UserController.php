<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AlamatMhs;
use App\Models\DataKeluarga;
use App\Models\Individu;
use App\Models\MhsSekolah;
use Illuminate\Support\Facades\Hash;
use App\Mail\AktivasiAkunMail;
use App\Helpers\UploadHelper;
use Mail;
use Error;

class UserController extends Controller
{
    public function __construct(){
        $this->user = new User();
        $this->role = new Role();
    }

    public function index()
    {
        $user = User::orderBy("created_at","DESC")->get();
        $users = User::orderBy("created_at","DESC")->get();
        $role = Role::orderBy("created_at","DESC")->get();
        return view('admin.user.user', compact('user', 'role', 'users'));
    }

    public function store(Request $request)
    {
        $data_json = [];
        try {
            $name = (empty($request->input("name"))) ? null : trim(htmlentities($request->input("name")));
            $email = (empty($request->input("email"))) ? null : trim(htmlentities($request->input("email")));
            $password = (empty($request->input("password"))) ? null : trim(htmlentities($request->input("password")));
            $is_admin = (empty($request->input("is_admin"))) ? null : trim(htmlentities($request->input("is_admin")));
            $avatar = $request->file("avatar");

            if(!$name){
                throw new Error("Nama tidak boleh kosong");
            }

            if(!$email){
                throw new Error("Email tidak boleh kosong");
            }

            if(!$password){
                throw new Error("Password tidak boleh kosong");
            }

            if(!$is_admin){
                throw new Error("Role tidak boleh kosong");
            }

            $is_exist_email = $this->user;
            $is_exist_email = $is_exist_email->where("email",$email);
            $is_exist_email = $is_exist_email->first();

            if($is_exist_email){
                throw new Error("Duplikat email . Email sudah digunakan");
            }

            if(!empty($avatar)){
                $valid_ext = [];

                $upload = UploadHelper::upload_file($avatar,'avatar',$valid_ext);

                if($upload["IsError"] == TRUE){
                    throw new Error($upload["Message"]);
                }

                $avatar = $upload["Path"];
            }

            $password = Hash::make($password);

            $this->user->create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'is_admin' => $is_admin,
                'avatar' => $avatar,
            ]);

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil didapatkan";
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }
    public function update(Request $request)
    {
        $data_json = [];
        try {
            $id = (empty($request->input("id"))) ? null : trim(htmlentities($request->input("id")));
            $name = (empty($request->input("name"))) ? null : trim(htmlentities($request->input("name")));
            $email = (empty($request->input("email"))) ? null : trim(htmlentities($request->input("email")));
            $password = (empty($request->input("password"))) ? null : trim(htmlentities($request->input("password")));
            $is_admin = (empty($request->input("is_admin"))) ? null : trim(htmlentities($request->input("is_admin")));
            $avatar = $request->file("avatar");

            if(!$id){
                throw new Error("Nama tidak boleh kosong");
            }

            if(!$name){
                throw new Error("Nama tidak boleh kosong");
            }

            if(!$email){
                throw new Error("Email tidak boleh kosong");
            }

            if(!$is_admin){
                throw new Error("Role tidak boleh kosong");
            }

            $result = $this->user;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }

            $is_exist_email = $this->user;
            $is_exist_email = $is_exist_email->where("email",$email);
            $is_exist_email = $is_exist_email->where("id","!=",$id);
            $is_exist_email = $is_exist_email->first();

            if($is_exist_email){
                throw new Error("Duplikat email . Email sudah digunakan");
            }

            if($password){
                $password = Hash::make($password);
            }
            else{
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
                'email' => $email,
                'password' => $password,
                'is_admin' => $is_admin,
                'avatar' => $avatar,
            ]);

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil diubah";
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete($user);

        return redirect()->route('admin.user.index')->with("success","Data berhasil dihapus");
    }

    public function mhs()
    {
        $mhs = $this->user;
        $mhs = $mhs->where("is_admin",User::ROLE_MAHASISWA);
        $mhs = $mhs->orderBy("created_at","DESC")->get();

        $role = $this->role;
        $role = $role->orderBy("created_at","DESC")->get();

        $data = [
            'mhs' => $mhs,
            'role' => $role,
        ];

        return view('admin.mahasiswa.mhs', $data);
    }
    public function mhsRead($id)
    {
        $mhs = User::find($id);
        return view('admin.mahasiswa.read', compact('mhs'));
    }
    public function mhsStore(Request $request, $id)
    {


        if (AlamatMhs::whereUserId(!$id)->get()) {
            AlamatMhs::whereUserId($id)->update([
                'nim' => $request->nim,
                'alamat_status' => $request->alamat_status,
                'alamat_tinggal' => $request->alamat_tinggal,
            ]);
            MhsSekolah::whereUserId($id)->update([
                'nim' => $request->nim,
                'jenis_sekolah_atas' => $request->jenis_sekolah_atas,
                'nama_sekolah_atas' => $request->nama_sekolah_atas,
                'nama_smp' => $request->nama_smp,
                'nama_sd' => $request->nama_sd,
            ]);
            DataKeluarga::whereUserId($id)->update([
                'nim' => $request->nim,
                'ibu_nama' => $request->ibu_nama,
                'ibu_alamat' => $request->ibu_alamat,
                'ibu_gaji' => $request->ibu_gaji,
                'ibu_telepon' => $request->ibu_telepon,
                'ibu_pendidikan_terakhir' => $request->ibu_pendidikan_terakhir,
                'ibu_pekerjaan' => $request->ibu_pekerjaan,
                'ibu_gaji' => $request->ibu_gaji,
                'ayah_nama' => $request->ayah_nama,
                'ayah_alamat' => $request->ayah_alamat,
                'ayah_telepon' => $request->ayah_telepon,
                'ayah_pendidikan_terakhir' => $request->ayah_pendidikan_terakhir,
                'ayah_pekerjaan' => $request->ayah_pekerjaan,
                'ayah_gaji' => $request->ayah_gaji,
                'kakak_jumlah' => $request->kakak_jumlah,
                'adik_jumlah' => $request->adik_jumlah
            ]);
        }

        if (AlamatMhs::whereUserId($id)->get()) {
            AlamatMhs::UpdateOrCreate([
                'user_id' => $id,
                'nim' => $request->nim,
                'alamat_status' => $request->alamat_status,
                'alamat_tinggal' => $request->alamat_tinggal,
            ]);
            MhsSekolah::UpdateOrCreate([
                'user_id' => $id,
                'nim' => $request->nim,
                'jenis_sekolah_atas' => $request->jenis_sekolah_atas,
                'nama_sekolah_atas' => $request->nama_sekolah_atas,
                'nama_smp' => $request->nama_smp,
                'nama_sd' => $request->nama_sd,
            ]);
            DataKeluarga::UpdateOrCreate([
                'user_id' => $id,
                'nim' => $request->nim,
                'ibu_nama' => $request->ibu_nama,
                'ibu_alamat' => $request->ibu_alamat,
                'ibu_gaji' => $request->ibu_gaji,
                'ibu_telepon' => $request->ibu_telepon,
                'ibu_pendidikan_terakhir' => $request->ibu_pendidikan_terakhir,
                'ibu_pekerjaan' => $request->ibu_pekerjaan,
                'ibu_gaji' => $request->ibu_gaji,
                'ayah_nama' => $request->ayah_nama,
                'ayah_alamat' => $request->ayah_alamat,
                'ayah_telepon' => $request->ayah_telepon,
                'ayah_pendidikan_terakhir' => $request->ayah_pendidikan_terakhir,
                'ayah_pekerjaan' => $request->ayah_pekerjaan,
                'ayah_gaji' => $request->ayah_gaji,
                'kakak_jumlah' => $request->kakak_jumlah,
                'adik_jumlah' => $request->adik_jumlah
            ]);
        }
        return redirect()->route('admin.mhs.read', $id);
    }

    public function mhsActive(Request $request)
    {
        try{
            $id = empty($request->input("id")) ? null : trim(htmlentities($request->input("id")));

            if(!$id){
                return redirect()->route("admin.mhs.index")->with("error","ID tidak boleh kosong");
            }

            $result = $this->user;
            $result = $result->findOrFail($id);

            if(!$result){
                return redirect()->route('admin.mhs.index')->with('error','Data tidak ditemukan');
            }

            $result->update([
                'is_active' => User::IS_ACTIVE_YES
            ]);

            Mail::to($result->email)->send(new AktivasiAkunMail($result));

            return redirect()->route('admin.mhs.index')->with('success','Akun berhasil diaktifkan');
        }catch(\Throwable $th){
            return redirect()->route("admin.mhs.index")->with("error",$th->getMessage());
        }
    }

    public function mhsBanned(Request $request)
    {
        try{
            $id = empty($request->input("id")) ? null : trim(htmlentities($request->input("id")));

            if(!$id){
                return redirect()->route("admin.mhs.index")->with("error","ID tidak boleh kosong");
            }

            $result = $this->user;
            $result = $result->findOrFail($id);

            if(!$result){
                return redirect()->route('admin.mhs.index')->with('error','Data tidak ditemukan');
            }

            $result->update([
                'is_active' => User::IS_ACTIVE_NO
            ]);

            return redirect()->route('admin.mhs.index')->with('success','Akun berhasil dinonaktifkan');
        }catch(\Throwable $th){
            return redirect()->route("admin.mhs.index")->with("error",$th->getMessage());
        }
    }

    public function mhsUpdate(Request $request)
    {
        $data_json = [];
        try {
            $id = (empty($request->input("id"))) ? null : trim(htmlentities($request->input("id")));
            $name = (empty($request->input("name"))) ? null : trim(htmlentities($request->input("name")));
            $email = (empty($request->input("email"))) ? null : trim(htmlentities($request->input("email")));
            $password = (empty($request->input("password"))) ? null : trim(htmlentities($request->input("password")));
            $avatar = $request->file("avatar");

            if(!$id){
                throw new Error("ID tidak boleh kosong");
            }

            if(!$name){
               throw new Error("Nama mahasiswa tidak boleh kosong");
            }

            if(!$email){
               throw new Error("Email mahasiswa tidak boleh kosong");
            }

            $result = $this->user;
            $result = $result->where('id',$id);
            $result = $result->first();

            if(!$result){
                throw new Error("Data tidak ditemukan");
            }

            if(!empty($password)){
                $password = Hash::make($password);
            }
            else{
                $password = $result->password;
            }

            $check_exist_email = $this->user;
            $check_exist_email = $check_exist_email->where("email",$email);
            $check_exist_email = $check_exist_email->where("id","!=",$id);
            $check_exist_email = $check_exist_email->first();

            if($check_exist_email){
                throw new Error("Duplikat email . Email sudah digunakan");
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
                'email' => $email,
                'password' => $password,
                'avatar' => $avatar,
            ]);

            $data_json["IsError"] = FALSE;
            $data_json["Message"] = "Data berhasil diubah";
            goto ResultData;

        } catch (\Throwable $th) {
            $data_json["IsError"] = TRUE;
            $data_json["Message"] = $th->getMessage();
            goto ResultData;
        }

        ResultData:
        return response()->json($data_json,200);
    }

    public function user_active(Request $request)
    {
        try{
            $id = empty($request->input("id")) ? null : trim(htmlentities($request->input("id")));

            if(!$id){
                return redirect()->route("admin.user.index")->with("error","ID tidak boleh kosong");
            }

            $result = $this->user;
            $result = $result->findOrFail($id);

            if(!$result){
                return redirect()->route('admin.user.index')->with('error','Data tidak ditemukan');
            }

            $result->update([
                'is_active' => User::IS_ACTIVE_YES
            ]);

            if($result->is_admin == User::ROLE_MAHASISWA){
                Mail::to($result->email)->send(new AktivasiAkunMail($result));
            }

            return redirect()->route('admin.user.index')->with('success','Akun berhasil diaktifkan');
        }catch(\Throwable $th){
            return redirect()->route("admin.user.index")->with("error",$th->getMessage());
        }
    }

    public function user_banned(Request $request)
    {
        try{
            $id = empty($request->input("id")) ? null : trim(htmlentities($request->input("id")));

            if(!$id){
                return redirect()->route("admin.user.index")->with("error","ID tidak boleh kosong");
            }

            $result = $this->user;
            $result = $result->findOrFail($id);

            if(!$result){
                return redirect()->route('admin.user.index')->with('error','Data tidak ditemukan');
            }

            $result->update([
                'is_active' => User::IS_ACTIVE_NO
            ]);

            return redirect()->route('admin.user.index')->with('success','Akun berhasil dinonaktifkan');
        }catch(\Throwable $th){
            return redirect()->route("admin.mhs.index")->with("error",$th->getMessage());
        }
    }
}
