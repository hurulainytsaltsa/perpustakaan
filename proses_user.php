<?php
include 'koneksi.php';

if ($_GET['proses'] == 'insert') {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $dir_upload = "assets/images/profile/";
    $foto = $_FILES['photo']['name'];
    $uploadfile = $dir_upload . $foto;
    $tempfile = $_FILES['photo']['tmp_name'];

    if (move_uploaded_file($tempfile, $uploadfile)) {
      // Gambar berhasil diupload
      $query = "INSERT INTO user(id_user, nama, email, password, level, photo) VALUES ('$id_user','$nama','$email','$password','$level','$foto')";
    } else {
      // Kesalahan dalam proses upload
      echo "Gagal mengupload gambar.";
    }

    if ($db->query($query) === TRUE) {
      header("Location: index.php?page=user&aksi=input"); //redirect
      exit;
    } else {
      echo "Error: " . $query . "<br>" . $db->error;
    }
  }
}

if ($_GET['proses'] == 'update') {
  $id_user = $_POST['id_user'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $level = $_POST['level'];

  if ($_FILES['photo']['error'] == 0) {
    $target_dir = "assets/images/profile/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);

    // Pindahkan file foto yang diupload ke direktori tujuan
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

    // Update query termasuk nama file foto baru
    $query = "UPDATE user SET nama='$nama', password='$password', level='$level', photo='" . basename($_FILES["photo"]["name"]) . "' WHERE id_user='$id_user'";
  } else {
    // Update query tanpa mengubah foto jika tidak ada file yang diupload
    $query = "UPDATE user SET nama='$nama', password='$password', level='$level' WHERE id_user='$id_user'";
  }

  if ($db->query($query) === TRUE) {
    header("Location: index.php?page=user&aksi=profile"); //redirect
    exit;
  } else {
    echo "Error: " . $query . "<br>" . $db->error;
  }

}
?>