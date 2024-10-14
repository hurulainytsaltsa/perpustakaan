<?php
include 'koneksi.php';
if ($_GET['proses'] == 'insert') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_member = $_POST['id_member'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $type = $_POST['type'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $tanggal_registrasi = $_POST['tanggal_registrasi'];
        $tanggal_berakhir = $_POST['tanggal_berakhir'];
        $jekel = $_POST['jekel'];
        $prodi_id = $_POST['prodi_id'];
        $alamat = $_POST['alamat'];
        
        $query = "INSERT INTO member(id_member, nama, type, email, tanggal_lahir, tanggal_registrasi, tanggal_berakhir,jekel,id_prodi,alamat) VALUES ('$id_member','$nama','$type','$email','$tanggal_lahir','$tanggal_registrasi','$tanggal_berakhir','$jekel','$prodi_id','$alamat')";
        if ($db->query($query) === TRUE) {
            header("Location: index.php?page=membership"); //redirect
            exit;
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
        }
    }
}

if ($_GET['proses'] == 'update') {
    $id_member = $_POST['id_member'];
    $nama = $_POST['nama'];
    $type = $_POST['type'];
    $email = $_POST['email'];
    // $tanggal = $_POST['tgl'];
    // $bulan = $_POST['bln'];
    // $tahun = $_POST['thn'];
    // $tgl_lahir = $tahun . "-" . $bulan . "-" . $tanggal;
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $tanggal_registrasi = $_POST['tanggal_registrasi'];
    $tanggal_berakhir = $_POST['tanggal_berakhir'];
    $jekel = $_POST['jekel'];
    $prodi_id = $_POST['prodi_id'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE member SET id_member='$id_member', nama='$nama', type='$type', email='$email',  tanggal_lahir='$tanggal_lahir', tanggal_registrasi='$tanggal_registrasi', tanggal_berakhir='$tanggal_berakhir', jekel='$jekel', id_prodi='$prodi_id', alamat='$alamat' WHERE id_member='$id_member'";

    // cek apakah update sukse atau gagal
    if ($db->query($query) == TRUE) {
        header("Location: index.php?page=membership");
    } else {
        echo "Data gagal diupdate! " . $db->error;
    }
}

if ($_GET['proses'] == 'delete') {
    $id_member = $_GET['id_member'];
    $sql = "DELETE FROM member WHERE id_member='$id_member'";

    if ($db->query($sql) == TRUE) {
        header("Location: index.php?page=membership");
    } else {
        echo "Gagal update data " . $db->error;
    }
}
?>