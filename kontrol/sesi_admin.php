<?php
if(!isset($_SESSION["ses_id"]) || !isset($_SESSION["ses_user"]) || !isset($_SESSION["ses_password"]) || !isset($_SESSION["ses_level"])){
    echo "
    <script>
        document.location.href='$base_url';
    </script>
    ";
} else {
    $id_masuk_login = $_SESSION["ses_id"];
    $usr_masuk_login = $_SESSION["ses_user"];
    $pwd_masuk_login = $_SESSION["ses_password"];
    $lev_masuk_login = $_SESSION["ses_level"];
    $open_login = $konek->prepare("SELECT * FROM masuk AS a,masuk_data AS b WHERE a.lev_masuk='1' AND a.id_masuk=? AND a.usr_masuk=? AND a.pass_masuk=? AND a.lev_masuk=? AND a.id_masuk=b.id_data");
    $open_login->bind_param("issi",$id_masuk_login,$usr_masuk_login,$pwd_masuk_login,$lev_masuk_login);
    $open_login->execute();
    $tampung_open = $open_login->get_result();
    if($tampung_open->num_rows>0){
        $data_login = $tampung_open->fetch_assoc();
    } else {
        echo "
        <script>
            document.location.href='$base_url/logout';
        </script>
        ";
    }
	
}
?>