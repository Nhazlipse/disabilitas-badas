<?php
session_start();
session_regenerate_id(true);
include '../kontrol/config-db.php';
require '../kontrol/site.php';
include '../kontrol/sesi_admin.php';

$page = addslashes($_GET["kriteria"]);
$dekripsi = bukakunci($page);
$pecah = explode("#",$dekripsi);
$id_konten = $pecah[1];

$buka_kriteria = mysqli_query($konek,"SELECT * FROM kriteria WHERE id_kriteria='$id_konten'");
$data_kriteria = mysqli_fetch_assoc($buka_kriteria);

$nama_tabel = $data_kriteria["tb_kriteria"];
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
      $posisi = "$nama_tabel";
      $posisi_sub = "$nama_tabel";
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
        <li class="active">Isi Tabel</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <?php
            if(isset($_GET["tambah"])){
            ?>
              <div class="box-header">
                <h3 class="box-title">Tambah Bidang Minat
                  <a href="isikkriteria?kriteria=<?= $page; ?>&" class="btn btn-primary">Kembali</a>
                </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <form role="form" action="?kriteria=<?= $page; ?>&add" method="post">
                  <div class="form-group">
                    <label for="nama">Nama Isi?</label>
                    <input type="text" name="judul" class="form-control" id="Judul File" placeholder="Nama ISI">
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            <?php
            } else if(isset($_GET["add"])){
              $judul = $_POST["judul"];
              if($judul==""){
                ?>
                  <script>
                    Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Nama Wajib Diisi '
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>&";
                      } else {
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>&";
                      }
                    })
                  </script>
                <?php
              }
                $id_field = "id_". $nama_tabel;
                $nama_field = "nama_". $nama_tabel;
                $buat_id = mysqli_query($konek,"SELECT MAX($id_field) AS mk_id FROM $nama_tabel");
                $keluar_id = mysqli_fetch_assoc($buat_id);
                $id_baru = $keluar_id["mk_id"]+1;
                $masuk_kedua = $konek->prepare("INSERT INTO $nama_tabel($id_field,$nama_field)VALUES(?,?)");
							  $masuk_kedua->bind_param("is",$id_baru,$judul);
                if($masuk_kedua->execute()){
                  //arahkan ke sesi registrasi untuk email aktivasi
                  ?>
                  <script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'ISI berhasil ditambahkan !!! '
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>&";
                      } else {
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>&";
                      }
                    })
                  </script>
                <?php
                } else {
                  //kesalahan
                  ?>
                  <script>
                    Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Terjadi kesalahan dalam proses memasukan data, silahkan ulangi !!! '
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>&";
                      } else {
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>&";
                      }
                    })
                  </script>
                <?php
                }

            } else if(isset($_GET["edit"])){
              $page = addslashes($_GET["edit"]);
              $dekripsi = bukakunci($page);
              $pecah = explode("#",$dekripsi);
              $id_konten = $pecah[1];
              $id_field = "id_". $nama_tabel;
              $nama_field = "nama_". $nama_tabel;
              $data_konten = $konek->prepare("SELECT * FROM $nama_tabel WHERE $id_field=?");
              $data_konten->bind_param("i",$id_konten);
              $data_konten->execute();
              $tampung_konten = $data_konten->get_result();
              $tampil_data = $tampung_konten->fetch_assoc();
              ?>
                <div class="box-header">
                  <h3 class="box-title">Edit DATA
                    <a href="bidang" class="btn btn-primary">Kembali</a>
                  </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form role="form" action="isikriteria?kriteria=<?= $page; ?>&update=<?= $page; ?>" method="post">
                    <div class="form-group">
                      <label for="nama">Nama Bidang Minat ?</label>
                      <input type="text" value="<?= $tampil_data[$nama_field]; ?>" name="judul" class="form-control" id="Judul File" placeholder="Masukan NAma Bidang Minat">
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
              $id_field = "id_". $nama_tabel;
              $nama_field = "nama_". $nama_tabel;
              if($judul==""){
                ?>
                  <script>
                    Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Nama Wajib Diisi '
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "isikriteriia?kriteria=<?= $page; ?>&";
                      } else {
                        window.location.href = "isikriteriia?kriteria=<?= $page; ?>&";
                      }
                    })
                  </script>
                <?php
                exit;
              }
              $update = $konek->prepare("UPDATE $nama_tabel SET $nama_field=? WHERE $id_field=?");
              $update->bind_param("si",$judul,$id_konten);
              if($update->execute()){
                ?>
                  <script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'ISI Berhasil Diperbaharui !!! '
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>&";
                      } else {
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>&";
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
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>&";
                      } else {
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>&";
                      }
                    })
                  </script>
                <?php
              }
            } else if(isset($_GET["delete"])){
              $halaman = addslashes($_GET["delete"]);
              $dekripsi = bukakunci($halaman);
              $pecah = explode("#",$dekripsi);
              $id_konten = $pecah[1];

              $id_field = "id_". $nama_tabel;
              $nama_field = "nama_". $nama_tabel;

              $update1 = $konek->prepare("DELETE FROM $nama_tabel WHERE $id_field=?");
              $update1->bind_param("i",$id_konten);
              if($update1->execute()){
                ?>
                  <script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data Berhasil DiHapus !!! '
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>";
                      } else {
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>";
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
                    text: 'Terjadi kesalahan dalam proses Penghapusan data, silahkan ulangi !!! '
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>";
                      } else {
                        window.location.href = "isikriteria?kriteria=<?= $page; ?>";
                      }
                    })
                  </script>
                <?php
              }
            } else {
            ?>
              <div class="box-header">
                <h3 class="box-title">Daftar Isi Kriteria
                  <a href="?kriteria=<?= $page; ?>&tambah" class="btn btn-primary">Tambah Data</a>
                </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div id="grub">
                <table id="datafile" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10%">No</th>
                    <th width="60%">ISI</th>
                    <th width="30%">Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $data_konten = $konek->prepare("SELECT * FROM $nama_tabel");
                  $data_konten->execute();
                  $tampung_konten = $data_konten->get_result();
                  $nourut = 1;
                  while($tampil_data = $tampung_konten->fetch_assoc()){
                    $id_field = "id_". $nama_tabel;
                    $nama_field = "nama_". $nama_tabel;

                    $buatedit = "data#$tampil_data[$id_field]#Azzam#0813";
                    $enedit = tutupkunci($buatedit);
                  ?>
                  <tr>
                    <td><?= $nourut; ?></td>
                    <td><?= $tampil_data[$nama_field]; ?></td>
                    <td>
                      <a href="?kriteria=<?= $page; ?>&edit=<?= $enedit; ?>" class="btn btn-warning" onclick="return confirm('Yakin Untuk Edit ?');"><span class="fa fa-edit" title="Edit"></span></a>
                      <a href="?kriteria=<?= $page; ?>&delete=<?= $enedit; ?>" class="btn btn-danger" onclick="return confirm('Yakin Untuk Menghapus ?, data terkait Bidang Minat ini akan ikut terhapus');"><span class="fa fa-trash" title="Hapus"></span></a>
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
