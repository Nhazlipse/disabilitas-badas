<div class="user-panel">
        <div class="pull-left image">
          <img src="../media/profil/<?= $data_login["foto_data"]; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <?php
          $buat_nama = explode(" ",$data_login["nama_data"]);
          ?>
          <p><?= $buat_nama[0]; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>