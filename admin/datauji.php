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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
        <style type="text/css">
            #grub{
            overflow: auto;
            }
            .swal2-popup{
                font-size: 1.6rem !important;
            }
            th {
              width: auto;
              text-align: center;
              vertical-align: middle;
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
      $posisi = "datauji";
      $posisi_sub = "datauji";
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Data Uji</a></li>
        <li><a href="#"><?= $nama_web_admin; ?></a></li>
        <li class="active">Daftar data Uji</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
          <?php
          if(isset($_GET["halaman"])){
            $halaman = $_GET["halaman"];
            if($halaman=="tambah"){
            ?>
              <div class="box-header">
                <h3 class="box-title">Tambah Data Uji
                  <a href="datauji" class="btn btn-primary">Kembali</a>
                </h3>
              </div>
              <div class="box-body">
                <form role="form" action="?halaman=add" method="post">
                  <center><b>DATA WARGA</b></center>
                  <div class="form-group">
                    <label for="nama">Nama WARGA ?</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Mahasiswa" required>
                  </div>
                  <div class="form-group">
                    <label for="nim">NIK WARGA ?</label>
                    <input type="text" name="nim" class="form-control" id="nim" placeholder="NIM Mahasiswa" required>
                  </div>
                  <center><b>DATA NILAI KRITERIA</b></center>
                  <?php
                  $datamatkul = $konek-> prepare("SELECT * FROM kriteria ORDER BY id_kriteria ASC");
                  $datamatkul->execute();
                  $tampung_matkul = $datamatkul -> get_result();
                  while($k_matkul = $tampung_matkul->fetch_assoc()){
                    $nama_tabel = $k_matkul["tb_kriteria"];
                  ?>
                    <div class="form-group">
                      <label for="kriteria"><?= $k_matkul["nama_kriteria"]; ?></label>
                      <input name="matkul[]" value="<?= $k_matkul["id_kriteria"]; ?>" type="hidden" id="" class="form-control col-xs-6">
                      <select name="nilai[]" id="" required class="form-control col-xs-4">
                        <?php
                          $subsub = mysqli_query($konek,"SELECT * FROM $nama_tabel");
                          while($dsub = mysqli_fetch_assoc($subsub)){
                                $id_hasil = "id_".$nama_tabel;
                                $id_hasiltabel = $dsub[$id_hasil];
                                $nama_hasil = "nama_".$nama_tabel;
                                $nama_hasiltabel = $dsub[$nama_hasil];
                                echo "<option value='$id_hasiltabel'>$nama_hasiltabel</option>";
                          }
                        ?>
                      </select>
                    </div>
                  <?php
                  }
                  ?>
                  <center><b>DATA PENERIMA</b></center>
                  <div class="form-group">
                      <label for="bidang">APAKAH MENERIMA ?</label>
                      <select name="bidang" id="" required class="form-control">
                        <?php
                        $databidang = $konek-> prepare("SELECT * FROM bantuan ORDER BY nama_bantuan ASC");
                        $databidang->execute();
                        $tampung_bidang = $databidang -> get_result();
                        while($k_bidang = $tampung_bidang->fetch_assoc()){
                        ?>
                          <option value="<?= $k_bidang["id_bantuan"]; ?>"><?= $k_bidang["nama_bantuan"]; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            <?php
            } else if($halaman=="add"){
              $nama = addslashes($_POST["nama"]);
              $nim = addslashes($_POST["nim"]);
              $matkul = $_POST["matkul"];
              $nilai = $_POST["nilai"];
              $bidang = addslashes($_POST["bidang"]);

              $buat_id = mysqli_query($konek,"SELECT MAX(id_data) AS mk_id FROM uji_data");
              $keluar_id = mysqli_fetch_assoc($buat_id);
              $id_baru = $keluar_id["mk_id"]+1;
              $masuk_pertama = $konek->prepare("INSERT INTO uji_data(id_data,nim_data,nama_data,bidang_data)VALUES(?,?,?,?)");
							$masuk_pertama->bind_param("iisi",$id_baru,$nim,$nama,$bidang);
              
              $jum_data = count($matkul);
              for($xm=0;$xm<$jum_data;$xm++){
                $buat_id1 = mysqli_query($konek,"SELECT MAX(id_uji) AS mk_id FROM uji_nilai");
                $keluar_id1 = mysqli_fetch_assoc($buat_id1);
                $id_baru1 = $keluar_id1["mk_id"]+1;
                $masuk_kedua = $konek->prepare("INSERT INTO uji_nilai(id_uji,nim_uji,kriteria_uji,nilai_uji,bidang_uji)VALUES(?,?,?,?,?)");
							  $masuk_kedua->bind_param("iiisi",$id_baru1,$nim,$matkul[$xm],$nilai[$xm],$bidang);
                $masuk_kedua->execute();
              }

              if($masuk_pertama->execute()){
                ?>
                  <script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data Uji berhasil ditambahkan !!! '
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "datauji";
                      } else {
                        window.location.href = "datauji";
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
                    text: 'Terjadi Kesalahan Saat Menambahkan data, silahkan ulangi !!! '
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "datauji";
                      } else {
                        window.location.href = "datauji";
                      }
                    })
                  </script>
                <?php
              }

            } else if($halaman=="hapus"){
              $page = addslashes($_GET["data"]);
              $dekripsi = bukakunci($page);
              $pecah = explode("#",$dekripsi);
              $nim_konten = $pecah[1];
              $update = $konek->prepare("DELETE FROM uji_data WHERE nim_data=?");
              $update1 = $konek->prepare("DELETE FROM uji_nilai WHERE nim_uji=?");
              $update1->bind_param("i",$nim_konten);
              $update1->execute();
              
              $update->bind_param("i",$nim_konten);
              if($update->execute()){
                ?>
                  <script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data Berhasil DiHapus !!! '
                    }).then((result) => {
                      if (result.value) {
                        window.location.href = "datauji";
                      } else {
                        window.location.href = "datauji";
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
                        window.location.href = "datauji";
                      } else {
                        window.location.href = "datauji";
                      }
                    })
                  </script>
                <?php
              }
            } else {
              //
            }
          } else{
            $cek_jum_matkul = mysqli_query($konek,"SELECT * FROM kriteria");
            $jum_mat = mysqli_num_rows($cek_jum_matkul);
          ?>
          <div class="box-header">
            <h3 class="box-title">Daftar Data Uji
              <a href="?halaman=tambah" class="btn btn-primary">Tambah Data</a>
            </h3>
          </div>
          <div class="box-body">
            <div id="grub">
            <table id="datafile" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th valign="middle" rowspan="2">NIK</th>
                    <th rowspan="2">NAMA</th>
                    <th colspan="<?= $jum_mat; ?>">KRITERIA</th>
                    <th rowspan="2" >HASIL</th>
                    <th rowspan="2">OPSI</th>
                  </tr>
                  <tr>
                      <?php
                      $data_matkul = $konek -> prepare("SELECT * FROM kriteria ORDER BY id_kriteria ASC");
                      $data_matkul -> execute();
                      $tampung_mat = $data_matkul -> get_result();
                      while($kkmat = $tampung_mat -> fetch_assoc()){
                      ?>
                      <th><?= $kkmat["nama_kriteria"]; ?></th>
                      <?php
                      }
                      ?>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $data_mas = mysqli_query($konek,"SELECT * FROM uji_data ORDER BY nama_data ASC");
                    while($dmas = mysqli_fetch_assoc($data_mas)){
                      $buatedit = "data#$dmas[nim_data]#Azzam#0813";
                    $enedit = tutupkunci($buatedit);
                    echo "
                    <tr>
                        <td>$dmas[nim_data]</td>
                        <td>$dmas[nama_data]</td>
                    ";
                      $data_kriteria = mysqli_query($konek,"SELECT * FROM kriteria ORDER BY id_kriteria ASC");
                      while($dkrit = mysqli_fetch_assoc($data_kriteria)){
                        $id_namatabel = $dkrit["tb_kriteria"];
                        //ambil dari uji nilai dulu untuk mendapatkan nilai dari keriteria
                        $data_uji = mysqli_query($konek,"SELECT * FROM uji_nilai WHERE nim_uji='$dmas[nim_data]' AND kriteria_uji='$dkrit[id_kriteria]'");
                        $duji = mysqli_fetch_assoc($data_uji);

                        //setelah dapat inisiasi nama tabelnya dan id nama tabel id_namatabel
                        $nm_tabel = $dkrit["tb_kriteria"];
                        $id_tabel = "id_".$dkrit["tb_kriteria"];
                        //ambil nilai kriteria dari data nama tabel
                        $panggil_tabel = mysqli_query($konek,"SELECT * FROM $nm_tabel WHERE $id_tabel='$duji[nilai_uji]'");
                        $isi_tabel = mysqli_fetch_assoc($panggil_tabel);
                        //inisiasi untuk nama field didalam tabel agar biisa dipanggil
                        $nama_isi = "nama_".$dkrit["tb_kriteria"];
                        echo "
                        <td>$isi_tabel[$nama_isi]</td>
                        ";
                      }

                    echo "
                      <td>$dmas[bidang_data]</td>
                    ";
                    ?>
                      <td>
                      <a href="?halaman=hapus&data=<?= $enedit; ?>" class="btn btn-danger" onclick="return confirm('Yakin Untuk Menghapus ?, data terkait ini akan ikut terhapus');"><span class="fa fa-trash" title="Hapus"></span></a>
                    </td>
                    <?php
                    echo "
                    </tr>
                    ";
                    }
                  ?>
                  </tbody>
                </table>
                </div>
          </div>
          <?php
          }
          $konek->close();
          ?>
        
        <!-- /.box-body -->
        
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
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#datafile').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,
      "language": {
      "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json"
      }
    })
  })
</script>
</body>
</html>
