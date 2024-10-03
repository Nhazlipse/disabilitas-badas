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

<style>
   .row {
            display: flex;
            justify-content: space-around; /* Adjusts spacing between cards */
            align-items: flex-start; /* Align cards at the top */
        }
        .card {
            width: 15%;
            position: relative;
            left: 0%; /* Pindahkan kotak ke kiri */
            border-left: 5px solid #4e73df; /* Primary border color */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow effect */
            border-radius: 10px; /* Rounded corners */
            padding: 20px;
            background-color: white;
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Hover effect */
        }
        .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .text-primary {
            color: #4e73df; /* Text color */
        }
        .text-center {
            text-align: center;
        }
        .font-weight-bold {
            font-weight: bold;
        }
        .text-gray-900 {
            color: #3a3b45; /* Gray text color */
        }
        .icon {
            font-size: 2rem;
            color: #b0b3c5; /* Icon color */
        }
        .copyright {
            text-align: center; /* Menyelaraskan teks ke tengah */
            padding: 20px; /* Memberi jarak atas dan bawah */
            background-color: #f8f9fa; /* Warna latar belakang */
            flex-shrink: 0; /* Mencegah elemen copyright menyusut */
            margin-top: auto; /* Menjaga copyright di bagian bawah */
        }
        .overview-container {
            display: flex; /* Menggunakan flexbox untuk penataan */
            justify-content: center; /* Menempatkan konten di tengah secara horizontal */
            align-items: center; /* Menempatkan konten di tengah secara vertikal */
            height: 10vh; /* Mengatur tinggi kontainer agar setinggi viewport */
            text-align: center; /* Menyelaraskan teks di tengah */
        }

        .overview-title {
            font-size: 24px; /* Mengatur ukuran font */
            font-weight: bold; /* Menegaskan font */
        }
    </style>

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
<!-- Site wrapper -->
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

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
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
      $posisi = "admin";
      $posisi_sub = "admin";
      include '../kontrol/menu_admin.php';
      ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $nama_web_admin; ?>
        <small><?= $nama_web_kecil_admin; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="#"><?= $nama_web_admin; ?></a></li>
        <li class="active">Beranda</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Dashboard</h3>

          
        </div>
        <div class="box-body">
        <div class="box-body" style="text-align: center; padding: 20px;">
            <h2>Sistem Pendukung Keputusan Bantuan Disabilitas</h2>
            <p style="font-size: 18px;">Menggunakan Metode <strong>Naïve Bayes</strong></p>
        </div>

        <!-- /.box-body -->
        <div class="box-footer">
        <div class="overview-container">
        <div class="overview-title">OVERVIEW</div>
    </div>
        <?php
                         // Query untuk menghitung total data uji
                          $query = "SELECT COUNT(*) as total_data FROM uji_data";
                          $result = $konek->query($query);

                          // Cek apakah query berhasil
                          if ($result) {
                              $row = $result->fetch_assoc();
                              $total_data = $row['total_data'];
                          } else {
                              echo "Error: " . $konek->error;
                          }
                        ?>

<div class="row">
        <!-- Total Data Uji Card -->
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="text-section">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center" style="font-size:16px;">
                        Total Data Uji
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-900 text-center">
                        <?php echo $total_data; ?>
                    </div>
                </div>
                <div class="icon-section">
                    <i class="fa fa-id-card icon"></i>
                </div>
        </div>
    </div>

    <?php
                        $query = "SELECT COUNT(*) as total_data2 FROM uji_data_test";
                        $result = $konek->query($query);

                        // Cek apakah query berhasil
                        if ($result) {
                          $row = $result->fetch_assoc();
                          $total_data2 = $row['total_data2'];
                      } else {
                          echo "Error: " . $konek->error;
                      }
                    ?>

<!-- Data Test Card -->
<div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="text-section">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1 text-center" style="font-size:16px;">
                        Data Test
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-900 text-center">
                        <?php echo $total_data2; ?>
                    </div>
                </div>
                <div class="icon-section">
                    <i class="fa fa-folder icon"></i>
                </div>
                                    </div>
                                </div>
                            </div>
                        </div>

 <!-- Copyright Section -->
 <div class="copyright">
        Ringkasan Data Penerima Bantuan Sosial
    </div>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include '../kontrol/footer-dalam.php';
  ?>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../tampilan/dalam/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../tampilan/dalam/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../tampilan/dalam/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../tampilan/dalam/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../tampilan/dalam/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../tampilan/dalam/dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
