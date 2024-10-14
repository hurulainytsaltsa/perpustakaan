<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>-</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        header {
            text-align: center;
        }
        h5 {
        font-weight: bold;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        form {
            margin-top: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        #signature-form {
            margin-top: 80px;
            text-align: center;
        }

        #signature-canvas {
            border: 2px solid #ddd;
        }

        .signature {
            margin-left: 780px;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include 'koneksi.php';
    $id_member = isset($_POST['id_member']) ? $_POST['id_member'] : '';
    $id_member = $_GET['id_member'];

    $result = $db->query(
        "SELECT DISTINCT * FROM loans 
            INNER JOIN books ON loans.kode_buku = books.kode_buku 
            INNER JOIN member ON loans.id_member = member.id_member
            WHERE loans.id_member = '$id_member' AND loans.status='Sedang Dipinjam'"
    );

    ?>
    <header>
        <img src="assets/images/logos/kop.jpg" alt="Header Image">
        <br></br>
        <h5>LAPORAN PEMINJAMAN BUKU </h5>
        <h5>PERPUSTAKAAN POLITEKNIK NEGERI PADANG</h5>
    </header>

    <form>
        <?php
        if ($row = $result->fetch_assoc()) {
            ?>
            <label for="name">ID Member :
                <?= $row['id_member'] ?>
            </label>

            <br>
            <label for="email">Nama :
                <?= $row['nama'] ?>
            </label>

            <br>

            <label for="email">Email :
                <?= $row['email'] ?>
            </label>

            <br>

            <label for="email">Status :
                <?= $row['type'] ?>
            </label>

            <br>

            <label for="email">Registrasi :
                <?= $row['tanggal_registrasi'] ?>
            </label>

            <br>

            <label for="email">Berakhir :
                <?= $row['tanggal_berakhir'] ?>
            </label>
            <?php
        } else {
            // Jika tidak ada data peminjaman
            echo "Tidak ada data peminjaman untuk ID Member: $id_member";
        }
        ?>
    </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Member</th>
                <th>Judul Buku</th>
                <th>Kode Buku</th>
                <th>Tanggal
                    <br>Peminjaman
                </th>
                <th>Tanggal
                    <br> Pengembalian
                </th>
                <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Jika ada data peminjaman
                $nomor = 1;
                foreach ($result as $row):
                    ?>
                    <tr>
                        <td>
                            <?= $nomor++ ?>
                        </td>
                        <td>
                            <?= $row['id_member'] ?>
                        </td>
                        <td>
                            <?= $row['judul'] ?>
                        </td>
                        <td>
                            <?= $row['kode_buku'] ?>
                        </td>
                        <td>
                            <?= $row['tanggal_peminjaman'] ?>
                        </td>
                        <td>
                            <?= $row['tanggal_pengembalian'] ?>
                        </td>
                        <!-- Tambahkan data lainnya sesuai kebutuhan -->
                    </tr>
                    <?php
                endforeach;
            } else {
                // Jika tidak ada data peminjaman
                echo "<tr><td colspan='6'>Tidak ada data peminjaman untuk ID Member: $id_member</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <form id="signature-form">
        <div class="signature">
            <div class="col-12">
                <label for="signature">Padang,
                    <?= date('j F Y'); ?>
                </label>
                <br>
                <?php
                $result_user = $db->query("SELECT * FROM user WHERE email = '$_SESSION[email]'");
                $row_user = $result_user->fetch_assoc();
                echo '<label for="signature">' . $row_user['level'] . '</label>';
                echo '<br>';
                echo '<canvas id="signature-canvas" width="300" height="100"></canvas>';
                echo '<label for="signature">' . $row_user['nama'] . '</label>';
                echo '<br>';
                echo '<label for="signature">(' . $row_user['id_user'] . ')</label>';
                ?>
            </div>
        </div>

        <!-- Tambahkan script JavaScript untuk menangani tanda tangan di sini -->
        <script>
            function printReport() {
                // Cetak laporan secara otomatis
                window.print();
            }
            // Panggil fungsi cetak saat halaman dimuat
            printReport();
        </script>

        <!-- Tambahkan link JS Bootstrap di sini -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </form>

</body>

</html>
