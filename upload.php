<?php
// File upload.php

// Pemrosesan upload foto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/"; // Folder untuk menyimpan foto (pastikan folder ada dan dapat ditulisi)
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file gambar valid
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check === false) {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Cek ukuran file
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Maaf, file terlalu besar.";
        $uploadOk = 0;
    }

    // Izinkan hanya beberapa format file tertentu
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if(!in_array($imageFileType, $allowedFormats)) {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Cek apakah upload berhasil
    if ($uploadOk == 0) {
        echo "Maaf, file tidak terupload.";
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "Foto " . basename($_FILES["photo"]["name"]) . " berhasil diupload.";

            // Tampilkan foto yang diupload
            echo '<div class="img-wrap">';
            echo '<img src="' . $target_file . '" alt="Preview" style="max-width: 100%;">';
            echo '</div>';
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload foto.";
        }
    }
}
?>
