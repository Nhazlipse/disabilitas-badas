<?php
session_start();
session_regenerate_id(true);
include '../kontrol/config-db.php';
require '../kontrol/site.php';
include '../kontrol/sesi_admin.php';

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title><?= $def_title; ?></title>
	<link rel="shortcut icon" href="<?= $icon_web; ?>">
	<meta name="description" content="<?= $def_deskripsi; ?>" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../tampilan/dalam/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../tampilan/dalam/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../tampilan/dalam/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../tampilan/dalam/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../tampilan/dalam/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
        <style type="text/css">
            #grub{
            overflow: auto;
            }
            .swal2-popup{
                font-size: 1.6rem !important;
            }
        </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= $base_admin; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>WB</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>Web</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <?php
            include '../kontrol/admin_kanan.php';
          ?>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <?php
      include '../kontrol/admin_kiri.php';
      ?>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php
      $posisi = "profile";
      $posisi_sub = "profile";
      include '../kontrol/menu_admin.php';
      ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $nama_web_admin; ?>
        <small><?= $nama_web_kecil_admin; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
        <li><a href="#"><?= $nama_web_admin; ?></a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Biodata</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
            if(isset($_GET["page"])){
              $halaman = addslashes($_GET["page"]);
              $dekrip=bukakunci($halaman);
              $pecah = explode("#",$dekrip);
              if($pecah[0]="Paskan" && $pecah[1]=="edit"){
                $username = addslashes($_POST["username"]);
                $password = addslashes($_POST["password"]);
                $nama = addslashes($_POST["nama"]);
                $telp = addslashes($_POST["telp"]);
                $alamat = addslashes($_POST["alamat"]);
                $email = addslashes($_POST["email"]);
                $foto = $_FILES['foto']['name'];
                if($username==""){
                  $usernya = $data_login["usr_masuk"];
                } else {
                  $usernya = $username;
                }
                if($password==""){
                  $passnya = $data_login["pass_masuk"];
                } else {
                  $perulangan = [ 'cost' => 12];
                  $passnya = password_hash("$password", PASSWORD_DEFAULT, $perulangan);
                }
                
                if($foto==""){
                  $fotonya = $data_login["foto_data"];
                } else {
                  $ukuranFile = $_FILES['foto']['size'];
                  $error = $_FILES['foto']['error'];
                  $tmpName = $_FILES['foto']['tmp_name'];

                  $ekstensiGambarvalid= ['jpg'];
                  $ekstensiGambar = explode('.', $foto);
                  $ekstensiGambar = strtolower(end($ekstensiGambar));
                  
                  if( !in_array($ekstensiGambar, $ekstensiGambarvalid)){
                      echo "
                      <script>
                          alert('Format yang diizinkan Jpg');
                          document.location.href='profile';
                      </script>
                      ";
                      exit;
                  } 
                  if($data_login["foto_data"]=="master.png"){
                    $resize_image = "../media/profil/" . uniqid(rand()) . ".".$ekstensiGambar;
                    list( $width, $height ) = getimagesize($tmpName);
                    if( $width === 160 AND $height === 160) {
                      $namaFileBaru = uniqid();
                      $namaFileBaru .= '.';
                      $namaFileBaru .= $ekstensiGambar;
                      $namauploadnya = $namaFileBaru;

                      move_uploaded_file($tmpName, '../media/profil/'.$namaFileBaru);
                      $fotonya = $namauploadnya;
                    } else {
                      // menentukan width yang baru
                      $newwidth = 160;

                      // menentukan height yang baru
                      $newheight = 160;

                      // fungsi untuk membuat image yang baru
                      $thumb = imagecreatetruecolor($newwidth, $newheight);
                      
                        $source = imagecreatefromjpeg($tmpName);
                      // men-resize image yang baru
                      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                      // menyimpan image yang baru
                      imagejpeg($thumb, $resize_image);

                      imagedestroy($thumb);
                      imagedestroy($source);
                      $pecah_gambar=explode("/",$resize_image);
                      $buat_fileup="$pecah_gambar[3]";
                      $fotonya = $buat_fileup;
                    }
                  } else {
                    $lokasiawal = "../media/profil/$data_login[foto_data]";
                    unlink($lokasiawal);
                    $resize_image = "../media/profil/" . uniqid(rand()) . ".".$ekstensiGambar;
                    list( $width, $height ) = getimagesize($tmpName);
                    if( $width === 160 AND $height === 160) {
                      $namaFileBaru = uniqid();
                      $namaFileBaru .= '.';
                      $namaFileBaru .= $ekstensiGambar;
                      $namauploadnya = $namaFileBaru;

                      move_uploaded_file($tmpName, '../media/profil/'.$namaFileBaru);
                      $fotonya = $namauploadnya;
                    } else {
                      // menentukan width yang baru
                      $newwidth = 160;

                      // menentukan height yang baru
                      $newheight = 160;

                      // fungsi untuk membuat image yang baru
                      $thumb = imagecreatetruecolor($newwidth, $newheight);
                      
                        $source = imagecreatefromjpeg($tmpName);
                      // men-resize image yang baru
                      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                      // menyimpan image yang baru
                      imagejpeg($thumb, $resize_image);

                      imagedestroy($thumb);
                      imagedestroy($source);
                      $pecah_gambar=explode("/",$resize_image);
                      $buat_fileup="$pecah_gambar[3]";
                      $fotonya = $buat_fileup;
                    }
                  }
                }
                $id_nya = $data_login["id_masuk"];
                  $data_update1 = $konek->prepare("UPDATE masuk SET usr_masuk=?,pass_masuk=? WHERE id_masuk=?");
                  $data_update1->bind_param("ssi",$usernya,$passnya,$id_nya);
                  $data_update1->execute();
                  $data_update = $konek->prepare("UPDATE masuk_data SET nama_data=?,telp_data=?,alamat_data=?,email_data=?,foto_data=? WHERE id_akses=?");
                  $data_update->bind_param("sssssi",$nama,$telp,$alamat,$email,$fotonya,$id_nya);
                  if($data_update->execute()){
                    ?>
                      <script>
                        Swal.fire({
                        icon: 'success',
                        title: 'Data Di Perbaharui',
                        text: 'Data Profil Berhasil Di Perbaharui, Silahkan LOGIN untuk memulai kembali '
                        }).then((result) => {
                          if (result.value) {
                            window.location.href = "<?= $base_url; ?>logout";
                          } else {
                            window.location.href = "<?= $base_url; ?>logout";
                          }
                        })
                      </script>
                    <?php
                  } else {
                    ?>
                      <script>
                        Swal.fire({
                        icon: 'error',
                        title: 'Pembaharuan gagal',
                        text: 'Profil anda mengalami masalah saat memperbaharui Data, silahkan Ulangi '
                        }).then((result) => {
                          if (result.value) {
                            window.location.href = "<?= $base_admin; ?>profile";
                          } else {
                            window.location.href = "<?= $base_admin; ?>profile";
                          }
                        })
                      </script>
                    <?php
                  }
              } else {
              ?>
                <script>
                  Swal.fire({
                  icon: 'error',
                  title: 'Akses Tidak Diketahui',
                  text: 'Akses anda tidak diketahui '
                  }).then((result) => {
                    if (result.value) {
                      window.location.href = "<?= $base_admin; ?>profile";
                    } else {
                      window.location.href = "<?= $base_admin; ?>profile";
                    }
                  })
                </script>
              <?php
              }
            }
            $buat_edit = "Paskan#edit#0813";
            $enedit = tutupkunci($buat_edit);
            ?>
            <form role="form" action="?page=<?= $enedit; ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
                  <p class="help-block">Kosongi Jika Tetap</p>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  <p class="help-block">Kosongi Jika Tetap</p>
                </div>
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input value="<?= $data_login["nama_data"]; ?>" type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama">
                </div>
                <div class="form-group">
                  <label for="telp">No Telp</label>
                  <input value="<?= $data_login["telp_data"]; ?>" type="text" name="telp" class="form-control" id="telp" placeholder="Masukan No Telp">
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"><?= $data_login["alamat_data"]; ?></textarea>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input value="<?= $data_login["email_data"]; ?>" type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
              </div>
              <!-- /.box-body -->

              
            
          </div>
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Foto Profil</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                
                  <img src="../media/profil/<?= $data_login["foto_data"]; ?>" width="10%" alt=""><br>
                  <div class="form-group">
                    <label for="exampleInputFile">Foto</label>
                    <input type="file" name="foto" id="exampleInputFile">
                    <p class="help-block">Ukuran wajib 160x160 dengan format png</p>
                    <p class="help-block">Jika melebihi akan di resize otomatis</p>
                  </div>
              </div>
              <!-- /.box-body -->
              <!-- /.box-footer -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Perbaharui</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
    include '../kontrol/footer-dalam.php';
  ?>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../tampilan/dalam/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../tampilan/dalam/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../tampilan/dalam/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../tampilan/dalam/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../tampilan/dalam/dist/js/demo.js"></script>
</body>
</html>
