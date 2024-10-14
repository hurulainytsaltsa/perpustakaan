<?php
include 'koneksi.php';

if ($_GET['proses'] == 'insert') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $kode_buku = $_POST['kode_buku'];
        $issn = $_POST['issn'];
        $judul = $_POST['judul'];
        $category_id = $_POST['category_id'];
        $pengarang = $_POST['pengarang'];
        $total_books = $_POST['total_books'];
        $available_books = $total_books;
        $penerbit = $_POST['penerbit'];
        $dir_upload = "assets/book/";
        $foto = $_FILES['photo']['name'];
        $uploadfile = $dir_upload . $foto;
        $tempfile = $_FILES['photo']['tmp_name'];

        if (move_uploaded_file($tempfile, $uploadfile)) {
            // Gambar berhasil diupload
            $query = "INSERT INTO books(kode_buku,issn,judul,category_id,pengarang,penerbit,total_books,available_books,photo) VALUES ('$kode_buku','$issn','$judul','$category_id','$pengarang','$penerbit','$total_books','$available_books','$foto')";
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

if ($_GET['proses'] == 'update') {
    $kode_buku = $_POST['kode_buku'];
    $judul = $_POST['judul'];
    $category_id = $_POST['category_id'];
    $pengarang = $_POST['pengarang'];
    $total_books = $_POST['total_books'];
    $penerbit = $_POST['penerbit'];

    // Get the current available_books and total_books values from the database
    $result = $db->query("SELECT available_books, total_books FROM books WHERE kode_buku='$kode_buku'");
    $row = $result->fetch_assoc();
    $current_available_books = $row['available_books'];
    $current_total_books = $row['total_books'];

    // Calculate the difference between the new total_books and the old total_books
    $difference = $total_books - $current_total_books;

    // Update the available_books value with the new calculation
    $available_books = $current_available_books + $difference;

    // Periksa apakah file foto diupload
    if ($_FILES['photo']['error'] == 0) {
        $target_dir = "assets/book/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);

        // Pindahkan file foto yang diupload ke direktori tujuan
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

        // Update query termasuk nama file foto baru
        $query = "UPDATE books SET judul='$judul', category_id='$category_id', pengarang='$pengarang', penerbit='$penerbit', available_books='$available_books', total_books='$total_books', photo='" . basename($_FILES["photo"]["name"]) . "' WHERE kode_buku='$kode_buku'";
    } else {
        // Update query tanpa mengubah foto jika tidak ada file yang diupload
        $query = "UPDATE books SET judul='$judul', category_id='$category_id', pengarang='$pengarang', penerbit='$penerbit', available_books='$available_books', total_books='$total_books' WHERE kode_buku='$kode_buku'";
    }

    // cek apakah update sukses atau gagal
    if ($db->query($query) == TRUE) {
        $result_kategori = $db->query("SELECT nama_kategori FROM categories WHERE id_kategori='$category_id'");
        $row_kategori = $result_kategori->fetch_assoc();
        $nama_kategori = $row_kategori['nama_kategori'];

        header("Location: index.php?page=booklist&aksi=viewall&kategori=" . urlencode($nama_kategori));
    } else {
        echo "Data gagal diupdate! " . $db->error;
    }
}



if ($_GET['proses'] == 'delete') {
    $kode_buku = $_GET['kode_buku'];
    $sql = "DELETE FROM books WHERE kode_buku='$kode_buku'";

    if ($db->query($sql) == TRUE) {
        $result_kategori = $db->query("SELECT nama_kategori FROM categories WHERE id_kategori='$category_id'");
        $row_kategori = $result_kategori->fetch_assoc();
        $nama_kategori = $row_kategori['nama_kategori'];

        header("Location: index.php?page=booklist&aksi=viewall&kategori=" . urlencode($nama_kategori));
    } else {
        echo "Data gagal diupdate! " . $db->error;
    }
}    
