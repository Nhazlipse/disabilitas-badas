<?php
$ambil_kesalahan = mysqli_query($konek,"SELECT * FROM masuk_salah WHERE browser='$idenbrowser' AND ipadd='$ip_user' AND os_usr='$osbrowser' ORDER BY tgl DESC LIMIT 0,1");
$data_kesalahan = mysqli_fetch_assoc($ambil_kesalahan);
?>
<!DOCTYPE html>
<html>
    <head>
         <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="ERROR">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="media/web/error.png">

        <title>ERROR ACCESS</title>

        <!-- Base Css Files -->
        <link href="tampilan/kesalahan/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="tampilan/kesalahan/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="tampilan/kesalahan/assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="tampilan/kesalahan/css/material-design-iconic-font.min.css" rel="stylesheet">

        <!-- animate css -->
        <link href="tampilan/kesalahan/css/animate.css" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="tampilan/kesalahan/css/waves-effect.css" rel="stylesheet">

        <!-- Custom Files -->
        <link href="tampilan/kesalahan/css/helper.css" rel="stylesheet" type="text/css" />
        <link href="tampilan/kesalahan/css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="tampilan/kesalahan/js/modernizr.min.js"></script>
        
    </head>
    <body>


        <div class="wrapper-page">
            <div class="ex-page-content text-center">
                <h2><label class=" label label-warning"><span class="fa fa-warning"></span></label>&nbsp;&nbsp;&nbsp;<label class="label label-purple"><span class="md md-vpn-key"></span></label>&nbsp;&nbsp;<label class=" label label-warning"><span class="fa fa-warning"></span></label></h2>
                <h2 class="font-light">Kesalahan Akses</h2><br>
                <p>Anda sudah sering salah memasukan username dan password, silahkan kembali dalam :</p>
                
                <h2><p id="countdown"></p></h2>
                
                <button class="btn btn-purple waves-effect waves-light" onClick="window.location.reload();"><i class="fa fa-angle-left"></i> Reload</button>
            </div>


        </div>
        <?php
                $tgl = $data_kesalahan["tgl"];
                $akhiran = manipulasiTanggal($tgl,'1','hours');
                
                function manipulasiTanggal($tgl,$jumlah=1,$format='days'){
                    $currentDate = $tgl;
                    return date('Y-m-d H:i:s', strtotime($jumlah.' '.$format, strtotime($currentDate)));
                } 
        ?>
        <script>
            // Mengatur waktu akhir perhitungan mundur
            var countDownDate = new Date("<?= $akhiran; ?>").getTime();

            // Memperbarui hitungan mundur setiap 1 detik
            var x = setInterval(function() {

            // Untuk mendapatkan tanggal dan waktu hari ini
            var now = new Date().getTime();
                
            // Temukan jarak antara sekarang dan tanggal hitung mundur
            var distance = countDownDate - now;
                
            // Perhitungan waktu untuk hari, jam, menit dan detik
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
            // Keluarkan hasil dalam elemen dengan id = "demo"
            document.getElementById("countdown").innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";
                
            // Jika hitungan mundur selesai, tulis beberapa teks 
            if (distance < 0) {
                clearInterval(x);
               document.location.href='?login_true=accept_login';
            }
            }, 1000);
            </script>
        
    	<script>
            var resizefunc = [];
        </script>
        <script src="tampilan/kesalahan/js/jquery.min.js"></script>
        <script src="tampilan/kesalahan/js/bootstrap.min.js"></script>
        <script src="tampilan/kesalahan/js/waves.js"></script>
        <script src="tampilan/kesalahan/js/wow.min.js"></script>
        <script src="tampilan/kesalahan/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="tampilan/kesalahan/js/jquery.scrollTo.min.js"></script>
        <script src="tampilan/kesalahan/assets/jquery-detectmobile/detect.js"></script>
        <script src="tampilan/kesalahan/assets/fastclick/fastclick.js"></script>
        <script src="tampilan/kesalahan/assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="tampilan/kesalahan/assets/jquery-blockui/jquery.blockUI.js"></script>


        <!-- CUSTOM JS -->
        <script src="tampilan/kesalahan/js/jquery.app.js"></script>
	
	</body>
</html>