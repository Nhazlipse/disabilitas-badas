<li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../media/profil/<?= $data_login["foto_data"]; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $data_login["nama_data"]; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../media/profil/<?= $data_login["foto_data"]; ?>" class="img-circle" alt="User Image">

                <p>
                  <?= $data_login["nama_data"]; ?>
                  <small><?= $data_login["email_data"]; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?= $base_url; ?>/logout" onclick="return confirm('Anda Yakin Akan Keluar ?');" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>