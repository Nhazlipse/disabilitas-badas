<?php
session_start();
session_regenerate_id(true);
require ('kontrol/config-db.php');

if(isset($_GET["login_true"])){
        $hapus_kesalahan = mysqli_query($konek,"DELETE FROM masuk_salah WHERE browser='$idenbrowser' AND ipadd='$ip_user' AND os_usr='$osbrowser'");
        echo "
        <script>
        document.location.href='$base_url';
        </script>
        ";
    }
$cek_salah = mysqli_query($konek,"SELECT * FROM masuk_salah WHERE browser='$idenbrowser' AND ipadd='$ip_user' AND os_usr='$osbrowser'");
$jumlah_kesalahan = mysqli_num_rows($cek_salah);
if($jumlah_kesalahan >=3){
        require_once 'error_login.php';
        exit;
	}
if(isset($_SESSION["ses_user"]) || isset($_SESSION["ses_password"]) || isset($_SESSION["ses_token"])){
    if($_SESSION["ses_level"]==1){
        echo "
        <script>
            document.location.href='$base_url/admin';
        </script>
        ";
        exit;
    } else if($_SESSION["ses_level"]==2){
        echo "
        <script>
            document.location.href='$base_url/kadis';
        </script>
        ";
        exit;
    } else if($_SESSION["ses_level"]==3){
        echo "
        <script>
            document.location.href='$base_url/bidang';
        </script>
        ";
        exit;
    } else {
        echo "
        <script>
            alert('Akses Masuk tidak diketahui');
            document.location.href='$base_url/logout';
        </script>
    ";
    exit;
    }
}

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>SPK PENERIMA BANTUAN DISABILITAS</title>
	<link rel="shortcut icon" href="<?= $base_galeri; ?>/web/title.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="tampilan/depan/css/style.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style type="text/css">
            #grub{
            overflow: auto;
            }
            
        </style>
	</head>
	<body class="img js-fullheight" style="background-image: url(tampilan/depan/images/bg.jpg);">
<?php
if(isset($_GET['masuk_app'])){
    $user_log = addslashes($_POST["usr"]);
    $pass_log = addslashes($_POST["psw"]);

    //cek user
    $cek_user = mysqli_query($konek,"SELECT * FROM masuk WHERE usr_masuk='$user_log'");
    $jum = mysqli_num_rows($cek_user);
    if($jum!=0){
        $data_login = mysqli_fetch_assoc($cek_user);
        if(password_verify($pass_log, $data_login["pass_masuk"])){
            if($data_login["lev_masuk"]==1){
                $hapus_kesalahan = mysqli_query($konek,"DELETE FROM masuk_salah WHERE browser='$idenbrowser' AND ipadd='$ip_user' AND os_usr='$osbrowser'");
                //akses admin
                $_SESSION["ses_id"] = $data_login["id_masuk"];
                $_SESSION["ses_user"] = $data_login["usr_masuk"];
                $_SESSION["ses_password"] = $data_login["pass_masuk"];
                $_SESSION["ses_level"] = $data_login["lev_masuk"];
                $_SESSION["ses_token"] = "admin";
                $_SESSION["last_login_time"] = time();
                echo "<script>document.location.href='$base_url/admin';</script>";
            } else if($data_login["lev_masuk"]==2){
                $hapus_kesalahan = mysqli_query($konek,"DELETE FROM masuk_salah WHERE browser='$idenbrowser' AND ipadd='$ip_user' AND os_usr_masuk='$osbrowser'");
                //akses operator
                $_SESSION["ses_id"] = $data_login["id_masuk"];
                $_SESSION["ses_user"] = $data_login["usr_masuk"];
                $_SESSION["ses_password"] = $data_login["pass_masuk"];
                $_SESSION["ses_level"] = $data_login["lev_masuk"];
                $_SESSION["ses_token"] = "layanan";
                $_SESSION["last_login_time"] = time();
                echo "<script>document.location.href='$base_url/layanan';</script>";
            } else {
            ?>
            <script>
                Swal.fire({
                icon: 'error',
                title: 'Akses Error',
                text: 'Akses tidak diketahui, ulangi !! '
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "<?= $base_url; ?>";
                    } else {
                        window.location.href = "<?= $base_url; ?>";
                    }
                })
            </script>
            <?php
            exit;
            }
        } else {
            // buat ID
            $buat_id = mysqli_query($konek,"SELECT MAX(id_salah) AS mk_id FROM masuk_salah");
            $keluar_id = mysqli_fetch_assoc($buat_id);
            $id_baru = $keluar_id["mk_id"]+1;
            $masuk_kesalahan = mysqli_query($konek,"INSERT INTO masuk_salah VALUES('$id_baru','$user_log','$pass_log','$idenbrowser','$ip_user','$osbrowser','$tanggalsekarang')")
            
            ?>
            <script>
                Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'User atau password Anda Salah !!!! '
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "<?= $base_url; ?>";
                    } else {
                        window.location.href = "<?= $base_url; ?>";
                    }
                })
            </script>
            <?php
            exit;
        }
    } else {
        // buat ID
        $buat_id = mysqli_query($konek,"SELECT MAX(id_salah) AS mk_id FROM masuk_salah");
        $keluar_id = mysqli_fetch_assoc($buat_id);
        $id_baru = $keluar_id["mk_id"]+1;
        $masuk_kesalahan = mysqli_query($konek,"INSERT INTO masuk_salah VALUES('$id_baru','$user_log','$pass_log','$idenbrowser','$ip_user','$osbrowser','$tanggalsekarang')")
        ?>
            <script>
                Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'User atau password Anda Salah !!! '
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "<?= $base_url; ?>";
                    } else {
                        window.location.href = "<?= $base_url; ?>";
                    }
                })
            </script>
            <?php
            exit;
    }
}
?>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">
							<img src="media/web/title.png" alt="">
					</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Punya Akses ?</h3>
		      	<form action="?masuk_app" method="POST" class="signin-form" id="login_form" name="login_form">
		      		<div class="form-group">
		      			<input type="text" class="form-control" autocomplete="off" name="usr" placeholder="Username" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" name="psw" autocomplete="off" type="password" class="form-control" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" id="btn-login" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	          </form>
	          
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="tampilan/depan/js/jquery.min.js"></script>
  <script src="tampilan/depan/js/popper.js"></script>
  <script src="tampilan/depan/js/bootstrap.min.js"></script>
  <script src="tampilan/depan/js/main.js"></script>
	</body>
</html>

