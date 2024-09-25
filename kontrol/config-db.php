<?php
//error_reporting(0);

// $host_db = "localhost";
// $user_db = "usr_jurusan";
// $password_db = "z0tZ07y!2";
// $db_db = "jurusan";
$host_db = "localhost";
$user_db = "root";
$password_db = "";
$db_db = "disabilitas";
$konek = new mysqli($host_db,$user_db,$password_db,$db_db);
if($konek -> connect_errno){
    require 'kesalahan.php';
    exit;
} else {
    //$base_url = "http://172.16.31.8/disabilitas";
    $base_url = "http://localhost/disabilitas";
    // $base_url = "https://disabilitas.kedirikab.go.id";
    $base_galeri = "$base_url/media";
    $base_view = "$base_url/tampilan";

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    $ip_user = get_client_ip();
    //enkrip isi url
    function MyEncode_base64($Ndata)
    {
        $sBase64 = base64_encode($Ndata);
        return strtr($sBase64, '+/', '-_');
    }
            
    function tutupkunci($Ndata, $sKey='Ismiwulandari@Azzam') {
        $sResult = '';
            for($i = 0; $i < strlen($Ndata); $i ++) {
                $sChar    = substr($Ndata, $i, 1);
                $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
                $sChar    = chr(ord($sChar) + ord($sKeyChar));
                $sResult .= $sChar;
            }
        return MyEncode_base64($sResult);
    }
            
    function MyDecode_base64($EData) {
        $sBase64 = strtr($EData, '-_', '+/');
        return base64_decode($sBase64);
    }
            
    function bukakunci($Edata, $sKey='Ismiwulandari@Azzam') {
        $sResult = '';
        $Edata   = MyDecode_base64($Edata);
            for($i = 0; $i < strlen($Edata); $i ++) {
                $sChar    = substr($Edata, $i, 1);
                $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
                $sChar    = chr(ord($sChar) - ord($sKeyChar));
                $sResult .= $sChar;
            }
        return $sResult;
    }
    
    $datamac = exec('getmac');
    $datamac = strtok($datamac, ' ');

    date_default_timezone_set('Asia/Jakarta');
    $tanggalsekarang=date("Y-m-d H:i:s");
    $tanggalsekarang1=date("Y-m-d");

    require_once ('BrowserDetection.php');
        $Browser = new paskanazzam\BrowserDetection();

        $useragent = $_SERVER['HTTP_USER_AGENT'];

        // Get all possible environment data (array):
        $result = $Browser->getAll($useragent);

        // Get OS data (array):
        $result = $Browser->getOS($useragent);

        // Get Browser data (array):
        $result = $Browser->getBrowser($useragent);

        // Get Device type data (array):
        $result = $Browser->getDevice($useragent);

        $browsernyaadalah = $Browser->getAll($useragent);
        $idenbrowser = $browsernyaadalah["browser_name"];
        $osbrowser =  $browsernyaadalah["os_title"];

    function Rupiah($angkaawal){
        $rupiahindonesiasatu="Rp. ".number_format($angkaawal,0,',','.');
        return $rupiahindonesiasatu;
    }
    function Rupiah1($angka){
        $rupiahindonesia=number_format($angka,0,',','.');
        return $rupiahindonesia;
    }
    
    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai))." rupiah";
		} else {
			$hasil = trim(penyebut($nilai))." rupiah";
		}     		
		return $hasil;
	}
    $hari_indonesia = array('Mon'  => 'Senin',
    'Tue'  => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu',
    'Sun' => 'Minggu');
    $hari_bulan_indonesia = array('1'  => 'Januari',
    '2'  => 'Februari',
    '3' => 'Maret',
    '4' => 'April',
    '5' => 'Mei',
    '6' => 'Juni',
    '7' => 'Juli',
    '8' => 'Agustus',
    '9' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember');
    function tgl_indo($tanggal){
        $bulan = array (
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
    
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
    function tanggal_indo($tanggal, $cetak_hari = false)
    {
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   'Januari',
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
        $split 	  = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }
    function tanggal_indo_bulantahun($tanggal, $cetak_hari = false)
    {
        $hari = array ( 1 =>    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   'Januari',
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
        $split 	  = explode('-', $tanggal);
        $tgl_indo = $bulan[ (int)$split[1] ] . ' ' . $split[0];
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }
}
?>