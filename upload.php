<?php
require ('kontrol/config-db.php');

for($kk=1;$kk<501;$kk++){
    $angkaakhir = random_int(10, 11);
    $angka = random_int(1000, 9999);

    $ambilnama = mysqli_query($konek,"SELECT * FROM nama ORDER BY RAND() LIMIT 1");
    $dt_nama = mysqli_fetch_assoc($ambilnama);

    $ambilhasil= mysqli_query($konek,"SELECT * FROM bantuan ORDER BY RAND() LIMIT 1");
    $dt_hasil = mysqli_fetch_assoc($ambilhasil);
    $hasilnya = $dt_hasil["nama_bantuan"];
    $masuk_hasilnya = $dt_hasil["id_bantuan"];


    $buatnik = "3501010".$angka."000".$angkaakhir;
    $nama_mas = $dt_nama["nama"];
    $id_nama_mas = $dt_nama["id"];
    $nik_mas = $buatnik;

    $buat_id = mysqli_query($konek,"SELECT MAX(id_data) AS mk_id FROM uji_data");
    $keluar_id = mysqli_fetch_assoc($buat_id);
    $id_baru = $keluar_id["mk_id"]+1;

    echo "nama : $nama_mas<br>
    NIK : $nik_mas<br>
    HASIL : $hasilnya<br>
    ";
    $masuk_data = mysqli_query($konek,"INSERT INTO uji_data VALUES('$id_baru','$nik_mas','$nama_mas','$masuk_hasilnya')");
    $data_kriteria = mysqli_query($konek,"SELECT * FROM kriteria ORDER BY id_kriteria ASC");
    while($krit = mysqli_fetch_assoc($data_kriteria)){
        $buat_id1 = mysqli_query($konek,"SELECT MAX(id_uji) AS mk_id FROM uji_nilai");
        $keluar_id1 = mysqli_fetch_assoc($buat_id1);
        $id_baru1 = $keluar_id1["mk_id"]+1;

        $nama_tabel = $krit["tb_kriteria"];
        $id_tabel = $krit["id_kriteria"];

        $cek_tabel = mysqli_query($konek,"SELECT * FROM $nama_tabel ORDER BY RAND() LIMIT 1");
        $isi_tabel = mysqli_fetch_assoc($cek_tabel);

        $buat_idtabel = "id_".$nama_tabel;
        $buat_namatabel = "nama_".$nama_tabel;
        $idisi_tabel = $isi_tabel[$buat_idtabel];
        $val_tabel = $isi_tabel[$buat_namatabel];
        echo "
        ID KRITERIA :  $id_tabel<br>
        NAMA KRITERIA :  $krit[nama_kriteria] = $val_tabel(ID HASIL $idisi_tabel)<br>
        ";
        $masuk_nilai = mysqli_query($konek,"INSERT INTO uji_nilai VALUES('$id_baru1','$nik_mas','$id_tabel','$idisi_tabel','$masuk_hasilnya')");
    }
    if($masuk_data){
        $del = mysqli_query($konek,"DELETE FROM nama WHERE id='$id_nama_mas'");
    }
    echo "<hr>";
}


?>