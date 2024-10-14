<?php
include 'koneksi.php';

if ($_GET['proses'] == 'insert_kategori') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_kategori = $_POST['id_kategori'];
        $nama_kategori = $_POST['nama_kategori'];
        $dir_upload = "assets/images/logos/";
        $foto = $_FILES['photo']['name'];
        $uploadfile = $dir_upload . $foto;
        $tempfile = $_FILES['photo']['tmp_name'];

        if (move_uploaded_file($tempfile, $uploadfile)) {
            // Gambar berhasil diupload
            $query = "INSERT INTO categories(id_kategori,nama_kategori,photo,nomor_kategori) VALUES ('$id_kategori','$nama_kategori','$foto','$id_kategori')";
        } else {
            // Kesalahan dalam proses upload
            echo "Gagal mengupload gambar.";
        }

        if ($db->query($query) === TRUE) {
            header("Location: index.php?page=booklist"); //redirect
            exit;
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
        }
    }

}

if ($_GET['proses'] == 'update_kategori') {
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];
    if ($_FILES['photo']['error'] == 0) {
        $target_dir = "assets/images/logos/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);

        // Pindahkan file foto yang diupload ke direktori tujuan
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

        // Update query termasuk nama file foto baru
        $query = "UPDATE categories SET nama_kategori='$nama_kategori', photo='" . basename($_FILES["photo"]["name"]) . "' WHERE id_kategori='$id_kategori'";
    } else {
        // Update query tanpa mengubah foto jika tidak ada file yang diupload
        $query = "UPDATE categories SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'";
    }

    if ($db->query($query) === TRUE) {
        header("Location: index.php?page=input&aksi=kategori"); //redirect
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
    }
}

if ($_GET['proses'] == 'delete_kategori') {
    $id_kategori = $_GET['id_kategori'];

    $sql = "DELETE FROM categories WHERE id_kategori='$id_kategori'";

    if ($db->query($sql) == TRUE) {
        header("Location: index.php?page=input&aksi=kategori");
    } else {
        echo "Gagal update data " . $db->error;
    }
}

if ($_GET['proses'] == 'insert_prodi') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $prodi_id = $_POST['prodi_id'];
        $nama_prodi = $_POST['nama_prodi'];

        $query = "INSERT INTO prodi(prodi_id,nama_prodi) VALUES ('$prodi_id','$nama_prodi')";

        if ($db->query($query) === TRUE) {
            header("Location: index.php?page=input&aksi=prodi"); //redirect
            exit;
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
        }
    }
}

if ($_GET['proses'] == 'update_prodi') {
    $prodi_id = $_POST['prodi_id'];
    $nama_prodi = $_POST['nama_prodi'];


    $query = "UPDATE prodi SET nama_prodi='$nama_prodi' WHERE prodi_id='$prodi_id'";


    if ($db->query($query) === TRUE) {
        header("Location: index.php?page=input&aksi=prodi"); //redirect
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
    }
}

if ($_GET['proses'] == 'delete_prodi') {
    $prodi_id = $_GET['prodi_id'];

    $sql = "DELETE FROM prodi WHERE prodi_id='$prodi_id'";

    if ($db->query($sql) == TRUE) {
        header("Location: index.php?page=input&aksi=prodi");
    } else {
        echo "Gagal update data " . $db->error;
    }
}

if ($_GET['proses'] == 'insert_pengarang') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_pengarang = $_POST['id_pengarang'];
        $nama_pengarang = $_POST['nama_pengarang'];

        $query = "INSERT INTO pengarang(id_pengarang,nama_pengarang) VALUES ('$id_pengarang','$nama_pengarang')";

        if ($db->query($query) === TRUE) {
            header("Location: index.php?page=input&aksi=pengarang"); //redirect
            exit;
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
        }
    }
}

if ($_GET['proses'] == 'update_pengarang') {
    $id = $_POST['id'];
    $nama_pengarang = $_POST['nama_pengarang'];


    $query = "UPDATE pengarang SET nama_pengarang='$nama_pengarang' WHERE id='$id'";


    if ($db->query($query) === TRUE) {
        header("Location: index.php?page=input&aksi=pengarang"); //redirect
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
    }
}

if ($_GET['proses'] == 'delete_pengarang') {
    $id = $_GET['id'];

    $sql = "DELETE FROM pengarang WHERE id='$id'";

    if ($db->query($sql) == TRUE) {
        header("Location: index.php?page=input&aksi=pengarang");
    } else {
        echo "Gagal update data " . $db->error;
    }
}

if ($_GET['proses'] == 'insert_penerbit') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_penerbit = $_POST['id_penerbit'];
        $nama_penerbit = $_POST['nama_penerbit'];
        $kota = $_POST['kota'];

        $query = "INSERT INTO penerbit(id_penerbit,nama_penerbit,kota) VALUES ('$id_penerbit','$nama_penerbit','$kota')";

        if ($db->query($query) === TRUE) {
            header("Location: index.php?page=input&aksi=penerbit"); //redirect
            exit;
        } else {
            echo "Error: " . $query . "<br>" . $db->error;
        }
    }
}

if ($_GET['proses'] == 'update_penerbit') {
    $id_penerbit = $_POST['id_penerbit'];
    $nama_penerbit = $_POST['nama_penerbit'];
    $kota = $_POST['kota'];


    $query = "UPDATE penerbit SET nama_penerbit='$nama_penerbit', kota='$kota' WHERE id_penerbit='$id_penerbit'";


    if ($db->query($query) === TRUE) {
        header("Location: index.php?page=input&aksi=penerbit"); //redirect
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
    }
}

if ($_GET['proses'] == 'delete_penerbit') {
    $id_penerbit = $_GET['id_penerbit'];

    $sql = "DELETE FROM penerbit WHERE id_penerbit='$id_penerbit'";

    if ($db->query($sql) == TRUE) {
        header("Location: index.php?page=input&aksi=penerbit");
    } else {
        echo "Gagal update data " . $db->error;
    }
}
