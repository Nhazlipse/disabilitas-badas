<ul class="sidebar-menu" data-widget="tree">
        <li class="header"><center><font color="white">Data</font></center></li>
        <li><a href="<?= $base_admin; ?>"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></a></li>
        <li class="<?php if($posisi=="profile"){echo "active";} ?>"><a href="profile"><i class="fa fa-user"></i> <span>Profile</span></a></li>
        <li class="<?php if($posisi=="datauji"){echo "active";} ?>"><a href="datauji"><i class="fa fa-external-link-square"></i> <span>Data Uji</span></a></li>
        <li class="<?php if($posisi=="perhitungan"){echo "active";} ?>"><a href="perhitungan"><i class="fa fa-calculator"></i> <span>Perhitungan</span></a></li>
        <li class=""><a href="<?= $base_url; ?>logout" onclick="return confirm('Anda Yakin Akan Keluar ?');"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>
        <li class="header"><center><font color="white">Setting</font></center></li>
        <li class="<?php if($posisi=="kriteria"){echo "active";} ?>"><a href="kriteria"><i class="fa fa-book"></i> <span>Kriteria</span></a></li>
        <li class="<?php if($posisi=="bantuan"){echo "active";} ?>"><a href="bantuan"><i class="fa fa-book"></i> <span>Bantuan</span></a></li>
        <li class="header"><center><font color="white">Setting Isi Kriteria</font></center></li>
        <?php
        $kkrit = mysqli_query($konek,"SELECT * FROM kriteria ORDER BY id_kriteria ASC");
        while($krite = mysqli_fetch_assoc($kkrit)){
          $buatenmenu = "data#$krite[id_kriteria]#Azzam#0813";
          $enmenu = tutupkunci($buatenmenu);
        ?>
        <li class="<?php if($posisi=="$krite[tb_kriteria]"){echo "active";} ?>"><a href="isikriteria?kriteria=<?= $enmenu; ?>"><i class="fa fa-book"></i> <span><?= $krite["nama_kriteria"]; ?></span></a></li>
        <?php
        }
        ?>
      </ul>