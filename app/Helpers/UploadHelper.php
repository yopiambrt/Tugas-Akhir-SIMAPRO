<?php
    namespace App\Helpers;
    use Illuminate\Support\Str;
    use Storage;

    class UploadHelper {
        public static function upload_file($file,$last_folder,$valid_ext=[],$max_size=5097152){
            $return = [];
            try{
                $path = 'public/'.$last_folder.'/';
                
                $ext = $file->getClientOriginalExtension();
                $size = $file->getSize();

                if($size > $max_size){
                $return["IsError"] = TRUE;
                $return["Message"] = "Maksimal ukuran file adalah 5 MB";
                goto ResultData;
                }

                if(count($valid_ext) > 0){
                    if(!in_array(strtolower($ext), $valid_ext)){
                        $data_json["IsError"] = TRUE;
                        $data_json["Message"] = "Format file diperbolehkan yaitu jpeg,jpg,png,gif";
                        goto ResultData;
                    }
                }

                $name = Str::random(40). "." . $ext;
                $put = Storage::putFileAs($path, $file, $name);

                $return["IsError"] = FALSE;
                $return["Message"] = "Berhasil mengupload file";
                $return["Data"] = asset('storage/'.$last_folder.'/'.$name);
                $return["Path"] = "storage/".$last_folder."/".$name; 
                $return["Ext"] = ".".$ext;
                goto ResultData;

            }catch(\Throwable $e){
                $return["IsError"] = TRUE;
                $return["Message"] = $e->getMessage();
                goto ResultData;
            }
            
            ResultData:
            return $return;
        }
        public static function delete_file($file)
        {
            $return = [];
            try{
                $path = 'public/'.$file;

                if(Storage::exists($path)){
                    $delete = Storage::delete($path);
                }

                $return["IsError"] = FALSE;
                $return["Message"] = "File berhasil dihapus";
                goto ResultData;

            }catch(\Throwable $e){
                $return["IsError"] = TRUE;
                $return["Message"] = $e->getMessage();
                goto ResultData;
            }
            
            ResultData:
            return $return;
        }
    }
?>