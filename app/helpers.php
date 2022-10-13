<?php

if (!function_exists('tanggal_indonesia')) {
    function tanggal_indonesia($tanggal)
    {
        $hari = array(
            "Mon" => "Senin",
            "Tue" => "Selasa",
            "Wed" => "Rabu",
            "Thu" => "Kamis",
            "Fri" => "Jumat",
            "Sat" => "Sabtu",
            "Sun" => "Minggu",
        );



        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $hari[date('D', strtotime($tanggal))] . ', ' . $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

if (!function_exists('tanggal_indo')) {
    function tanggal_indo($tanggal)
    {



        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

if (!function_exists('is_today')) {
    function is_today($date)
    {
        $timestamp = $date;

        $today = new DateTime("today"); // This object represents current date/time with time set to midnight

        $match_date = DateTime::createFromFormat("Y-m-d", $timestamp);
        $match_date->setTime(0, 0, 0); // set time part to midnight, in order to prevent partial comparison

        $diff = $today->diff($match_date);
        $diffDays = (int)$diff->format("%R%a"); // Extract days count in interval

        switch ($diffDays) {
            case 0:
                return true;
                break;
            case -1:
                // echo "//Yesterday";
                // break;
            case +1:
                // echo "//Tomorrow";
                // break;
            default:
                return false;
                // echo "//Sometime";
        }
    }
}
