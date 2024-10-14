<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirimkan melalui form
    $keyword = $_POST['query'];

    // Data yang akan dijadikan acuan untuk pencarian
    $data = [
        'index.php' => 'dashboard',
        'index.php?page=booklist' => 'buku',
        'index.php?page=booklist&aksi=input' => 'tambah buku',
        'index.php?page=membership' => 'members',
        'index.php?page=loans' => 'loans',
        'index.php?page=detail_loans' => 'tambah loans',
        'index.php?page=information' => 'informasi',
        'index.php?page=input&aksi=kategori' => 'kategori',
        'index.php?page=input&aksi=penerbit' => 'penerbit',
    ];

    // Mencari hasil yang cocok dengan keyword
    $results = array_filter($data, function($item) use ($keyword) {
        return strpos(strtolower($item), strtolower($keyword)) !== false;
    });

    // Mengarahkan ke halaman terkait
    if (!empty($results)) {
        $page = array_keys($results)[0]; // Mengambil halaman pertama yang cocok
        header("Location: $page");
        exit();
    } else {
        echo "Tidak ada hasil untuk '" . $keywords . "'";
    }
}
