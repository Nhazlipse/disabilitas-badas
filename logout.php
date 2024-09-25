<?php
session_start();
include 'kontrol/config-db.php';
unset($_SESSION["ses_id"]);
unset($_SESSION["ses_user"]);
unset($_SESSION["ses_password"]);
unset($_SESSION["ses_level"]);
unset($_SESSION["last_login_time"]);
session_destroy();
echo "
<script>
    document.location.href='$base_url';
</script>
";
?>