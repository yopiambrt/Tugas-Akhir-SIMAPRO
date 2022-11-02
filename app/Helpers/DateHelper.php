<?php
    namespace App\Helpers;
    use Illuminate\Support\Str;
    use Storage;

    class DateHelper {
        public static function different_date($tanggal_akhir,$tanggal_awal){
            $date1 = $tanggal_awal; 
            $date2 = $tanggal_akhir; 

            $diff = abs(strtotime($date2) - strtotime($date1)); $years = floor($diff / (365*60*60*24)); $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            $data["years"] = $years;
            $data["months"] = $months;
            $data["days"] = $days;

            return $data;
        }
    }
?>