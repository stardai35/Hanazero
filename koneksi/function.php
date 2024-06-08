<?php
    
    function totalBayar($total_sewa, $denda, $uang_muka) {
        return $total_sewa + $denda - $uang_muka; 
    }

    function denda($tgl_kembali, $harga) {
        $day1 = strtotime($tgl_kembali);
        $day2 = strtotime(date("Y-m-d H:i:s"));
        $diffHours = round(($day2 - $day1) / 3600);
        if ($diffHours <= 0) {
            return 0;
        }
        $denda = ceil(($harga * 4.16666 / 100) * $diffHours);
        return $denda;
    }

?>