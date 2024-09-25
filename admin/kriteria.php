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
  <!-- DataTables -->
  <link rel="stylesheet" href="../tampilan/dalam/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
      $posisi = "kriteria";
      $posisi_sub = "kriteria";
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Setting</a></li>
        <li><a href="#"><?= $nama_web_admin; ?></a></li>
        <li class="active">Kriteriia</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <?php
            if(isset($_GET["edit"])){
              $page = addslashes($_GET["edit"]);
              $dekripsi = bukakunci($page);
              $pecah = explode("#",$dekripsi);
              $id_konten = $pecah[1];
              $data_konten = $konek->prepare("SELECT * FROM kriteria WHERE id_kriteria=?");
              $data_konten->bind_param("i",$id_konten);
              $data_konten->execute();
              $tampung_konten = $data_konten->get_result();
              $tampil_data = $tampung_konten->fetch_assoc();
              ?>
                <div class="box-header">
                  <h3 class="box-title">Edit Kriteria
                    <a href="kriteria" class="btn btn-primary">Kembali</a>
                  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form role="form" action="?update=<?= $page; ?>" method="post">
                    <div class="form-group">
                      <label for="nama">Nama Kriteria ?</label>
                      <input type="text" value="<?= $tampil_data["nama_kriteria"]; ?>" name="judul" class="form-control" id="Judul File" placeholder="Masukan NAma Kriteria">
                    </div>
                    <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Perbaharui</button>
                </div>
                  </form>
                </div>
              <?php
            } else if(isset($_GET["update"])){
              $page = addslashes($_GET["update"]);
              $dekripsi = bukakunci($page);
              $pecah = explode("#",$dekripsi);
              $id_konten = $pecah[1];
              $judul = addslashes($_POST["judul"]);
              if($judul==""){
                ?>
                  <script>
                    Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Nama Wajib Diisi '
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "kriteria";
                      } else {
                        window.location.href = "kriteria";
                      }
                    })
                  </script>
                <?php
                exit;
              }
              $update = $konek->prepare("UPDATE kriteria SET nama_kriteria=? WHERE id_kriteria=?");
              $update->bind_param("si",$judul,$id_konten);
              if($update->execute()){
                ?>
                  <script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Nama Kriteria Berhasil Diperbaharui !!! '
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "kriteria";
                      } else {
                        window.location.href = "kriteria";
                      }
                    })
                  </script>
                <?php
              } else {
                ?>
                  <script>
                    Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Terjadi kesalahan dalam proses Update data, silahkan ulangi !!! '
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "kriteria";
                      } else {
                        window.location.href = "kriteria";
                      }
                    })
                  </script>
                <?php
              }
            } else {
            ?>
              <div class="box-header">
                <h3 class="box-title">Daftar Kriteria
                </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div id="grub">
                <table id="datafile" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10%">No</th>
                    <th width="60%">Nama Kriteria</th>
                    <th width="30%">Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $data_konten = $konek->prepare("SELECT * FROM kriteria ORDER BY nama_kriteria DESC");
                  $data_konten->execute();
                  $tampung_konten = $data_konten->get_result();
                  $nourut = 1;
                  while($tampil_data = $tampung_konten->fetch_assoc()){
                    $buatedit = "data#$tampil_data[id_kriteria]#Azzam#0813";
                    $enedit = tutupkunci($buatedit);
                  ?>
                  <tr>
                    <td><?= $nourut; ?></td>
                    <td><?= $tampil_data["nama_kriteria"]; ?></td>
                    <td>
                      <a href="?edit=<?= $enedit; ?>" class="btn btn-warning" onclick="return confirm('Yakin Untuk Edit ?');"><span class="fa fa-edit" title="Edit"></span></a>
                    </td>
                  </tr>
                  <?php
                  $nourut++;
                  }
                  ?>
                </table>
                </div>
              </div>
            <?php
            }
            ?>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
<!-- DataTables -->
<script src="../tampilan/dalam/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../tampilan/dalam/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../tampilan/dalam/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../tampilan/dalam/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../tampilan/dalam/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../tampilan/dalam/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#datafile').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
