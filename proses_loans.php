<?php
include 'koneksi.php';

if (isset($_POST['search'])) {
    $keywords = $_POST['keywords'];
    $query = "SELECT * FROM member WHERE id_member LIKE '%$keywords%'";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Member Details
            echo <<<HTML
            <form action="" method="post">
            <div class="card w-100">
                <div class="card-body p-4">
                <div class="row mb-2">
                        <label for="inputKode" class="col-sm-3 col-form-label">ID Member</label>
                        <div class="col-sm-9">
                            <input class="form-control" value="{$row['id_member']}" name="id_member" id="inputKode" readonly>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="inputKode" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input class="form-control" value="{$row['nama']}" name="nama" id="inputKode" readonly>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="inputKode" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="email" value="{$row['email']}"  name="email" id="inputKode" readonly>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="inputKode" class="col-sm-3 col-form-label">Type</label>
                        <div class="col-sm-9">
                            <input class="form-control" value="{$row['type']}" name="type" id="inputKode" readonly>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="inputKode" class="col-sm-3 col-form-label">Tanggal Registrasi</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="date" value="{$row['tanggal_registrasi']}" name="tanggal_registrasi" id="inputKode" readonly>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <label for="inputKode" class="col-sm-3 col-form-label">Tanggal Berakhir</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="date" value="{$row['tanggal_berakhir']}" name="tanggal_berakhir" id="inputKode" readonly>
                        </div>
                    </div>
                    

                <!-- Tabel Peminjaman -->
                </div> <div class="card-body p-4">
                   
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title fw-semibold">Daftar Peminjaman</h5>
                        <form action="pdf.php" method="post">
                            <input type="hidden" name="id_member" value="{$row['id_member']}">
                            <a href="pdf.php?id_member={$row['id_member']}" target="_blank" class="btn btn-success" onclick="openPDF({$row['id_member']})">Cetak</a>

                        </form>                      
                    </div>
                    <hr>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-5">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">No</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">ID Member</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Judul Buku</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Kode Buku</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tanggal Peminjaman</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tanggal Pengembalian</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Status Pengembalian</h6>
                                        </th>
                                    </tr>
                                </thead>
                    <tbody>
HTML;

            $id_member = $row['id_member'];
            $queryLoans = "SELECT * FROM loans 
                               INNER JOIN books ON loans.kode_buku = books.kode_buku 
                               WHERE loans.id_member = '$id_member' AND status='Sedang Dipinjam'";
            //$id_transaksi = $_GET['id_transaksi'];
            $resultLoans = $db->query($queryLoans);

            if ($resultLoans->num_rows > 0) {
                $nomor = 1;
                while ($rowLoan = $resultLoans->fetch_assoc()) {
                    echo <<<HTML
                    <tr>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">$nomor</h6>
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">{$rowLoan['id_member']}</h6>
                        </td>
                        <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{$rowLoan['judul']}</p>
                        </td>
                        <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{$rowLoan['kode_buku']}</p>
                        </td>
                        <td class="border-bottom-0">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success rounded-3 fw-semibold">{$rowLoan['tanggal_peminjaman']}</span>
                            </div>
                        </td>
                        <td class="border-bottom-0">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-danger rounded-3 fw-semibold">{$rowLoan['tanggal_pengembalian']}</span>
                            </div>
                        </td>
                        
                        <td class="border-bottom-0">
                            <a class="btn btn-primary ti ti-check" href="proses_loans.php?proses=pengembalian&id_transaksi={$rowLoan['id_transaksi']}"></a>
                            <a class="btn btn-danger ti ti-x" onclick="return confirm('Apakah yakin menghapusnya?')" href="proses_loans.php?proses=delete&id_transaksi={$rowLoan['id_transaksi']}"></a>
                        </form>
</td>

</form>
        </tr>
HTML;
                    $nomor++;
                }


                echo <<<HTML
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
HTML;
            } else {
                echo '<p>Tidak ada buku yang dipinjam untuk member ini.</p>';
            }

            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>Tidak ditemukan hasil</p>';
    }
}


if (isset($_POST['loans']) && isset($_POST['code']) && isset($_POST['id_member'])) {
    $code = $_POST['code'];
    $id_member = $_POST['id_member'];

    $maxLoanCount = 3;
    $currentLoanCount = getLoanCount($id_member, $db);

    if ($currentLoanCount >= $maxLoanCount) {
        echo '<div>Anda sudah mencapai batas maksimal peminjaman. Kembalikan salah satu buku dulu untuk meminjam kembali</div>';
    } else {
        $queryGetIdBuku = "SELECT kode_buku FROM books WHERE kode_buku = '$code'";
        $resultGetIdBuku = $db->query($queryGetIdBuku);

        if ($resultGetIdBuku->num_rows > 0) {
            $rowGetIdBuku = $resultGetIdBuku->fetch_assoc();
            $kode_buku = $rowGetIdBuku['kode_buku'];

            $tanggal_peminjaman = date('Y-m-d');
            $tanggal_pengembalian = date('Y-m-d', strtotime('+7 days'));

            $queryStatusKeanggotaan = "SELECT type FROM member WHERE id_member = '$id_member'";
            $resultStatusKeanggotaan = $db->query($queryStatusKeanggotaan);
            $rowStatusKeanggotaan = $resultStatusKeanggotaan->fetch_assoc();
            // Uncomment dan sesuaikan bagian ini
            $type = $rowStatusKeanggotaan['type']; // Gantilah dengan cara mendapatkan jenis pengguna yang sebenarnya
            if ($type == "Dosen") {
                $tanggal_pengembalian = date('Y-m-d', strtotime($tanggal_peminjaman . '+30 days'));
            } else {
                $tanggal_pengembalian = date('Y-m-d', strtotime($tanggal_peminjaman . '+7 days'));
            }

            $queryPeminjaman = "INSERT INTO loans(kode_buku, id_member, tanggal_peminjaman, tanggal_pengembalian) VALUES ('$kode_buku', '$id_member', '$tanggal_peminjaman', '$tanggal_pengembalian')";

            if ($db->query($queryPeminjaman)) {
                // Ambil informasi buku
                $queryInfoBuku = "SELECT * FROM books WHERE kode_buku = '$kode_buku'";
                $resultInfoBuku = $db->query($queryInfoBuku);

                // Ambil informasi member
                $queryInfoMember = "SELECT * FROM member WHERE id_member = '$id_member'";
                $resultInfoMember = $db->query($queryInfoMember);

                $queryInfoPinjam = "SELECT * FROM loans WHERE id_member = '$id_member'";
                $resultInfoPinjam = $db->query($queryInfoPinjam);

                if ($resultInfoBuku->num_rows > 0 && $resultInfoMember->num_rows > 0) {
                    $rowInfoBuku = $resultInfoBuku->fetch_assoc();
                    $rowInfoMember = $resultInfoMember->fetch_assoc();
                    $rowInfoPinjam = $resultInfoPinjam->fetch_assoc();

                    $queryStatusKeanggotaan = "SELECT type FROM member WHERE id_member = '$id_member'";
                    $resultStatusKeanggotaan = $db->query($queryStatusKeanggotaan);

                    if ($resultStatusKeanggotaan->num_rows > 0) {
                        $rowStatusKeanggotaan = $resultStatusKeanggotaan->fetch_assoc();
                        $status_keanggotaan = $rowStatusKeanggotaan['type'];

                        if ($status_keanggotaan == 'Dosen') {
                            // Jika status keanggotaan adalah Dosen, tambahkan 30 hari ke tanggal peminjaman
                            $tanggal_pengembalian = date('Y-m-d', strtotime($tanggal_peminjaman . '+30 days'));
                        } else {
                            // Jika status keanggotaan adalah Mahasiswa atau Tendik, tambahkan 7 hari ke tanggal peminjaman
                            $tanggal_pengembalian = date('Y-m-d', strtotime($tanggal_peminjaman . '+7 days'));
                        }

                        // Update jumlah buku yang tersedia di tabel buku
                        $queryUpdateBuku = "UPDATE books SET available_books = available_books - 1 WHERE kode_buku = '$kode_buku'";
                        $db->query($queryUpdateBuku);
                    }

                    echo <<<HTML
        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="card w-100">
              <div class="card-body p-4">
                  <h5 class="card-title fw-semibold mb-2">Loan List</h5>
                  <hr>
                  <div class="table-responsive">
                      <table class="table text-nowrap mb-0 align-middle">
                          <thead class="text-dark fs-5">
                              <tr>
                                  <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">No</h6>
                                  </th>
                                  <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">ID Member</h6>
                                  </th>
                                  <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Judul Buku</h6>
                                  </th>
                                  <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Kode Buku</h6>
                                  </th>
                                  <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Loan Date</h6>
                                </th>
                                <th class="border-bottom-0">
                                  <h6 class="fw-semibold mb-0">Return Date</h6>
                              </th>
                              <!-- <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Return Status</h6>
                            </th> -->
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">1</h6>
                                  </td>
                                  <td class="border-bottom-0">
                                      <h6 class="fw-semibold mb-1">{$rowInfoMember['id_member']}</h6>
                                      <!-- <span class="fw-semibold mb-1">2201092014</span> -->
                                  </td>
                                  <td class="border-bottom-0">
                                      <p class="mb-0 fw-normal">{$rowInfoBuku['judul']}</p>
                                  </td>
                                  <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{$rowInfoBuku['kode_buku']}</p>
                                </td>
                                <td class="border-bottom-0">
                                  <div class="d-flex align-items-center gap-2">
                                      <span class="badge bg-success rounded-3 fw-semibold">{$rowInfoPinjam['tanggal_peminjaman']}</span>
                                  </div>
                              </td>
                              <td class="border-bottom-0">
                                  <div class="d-flex align-items-center gap-2">
                                      <span class="badge bg-danger rounded-3 fw-semibold">{$rowInfoPinjam['tanggal_pengembalian']}</span>
                                  </div>
                              </td>       
                              </tr>
                              
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
        </div>
HTML;
                } else {
                    echo '<div>Failed to fetch book or member information.</div>';
                }
            } else {
                echo '<div>Failed to insert data into peminjaman table.</div>';
                echo "Error: " . $db->error;
            }
        } else {
            echo '<div>Book with code ' . $code . ' not found.</div>';
        }
    }
}

if (isset($_GET['proses']) && $_GET['proses'] == 'pengembalian') {
    $id_transaksi = $_GET['id_transaksi'];

    // Mendapatkan tanggal pengembalian yang diharapkan dari tabel loans
    $queryGetDueDate = "SELECT tanggal_pengembalian, kode_buku FROM loans WHERE id_transaksi = '$id_transaksi'";
    $result = $db->query($queryGetDueDate);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tanggal_pengembalian = $row['tanggal_pengembalian'];
        $kode_buku = $row['kode_buku'];

        // Mendapatkan tanggal pengembalian aktual
        $actual_return_date = date('Y-m-d');

        // Menghitung perbedaan hari
        $diff_days = floor((strtotime($actual_return_date) - strtotime($tanggal_pengembalian)) / (60 * 60 * 24));

        // Menentukan batas waktu tertentu untuk penerapan denda (misalnya, 1 hari)
        $late_return_penalty = 200; // Denda per hari terlambat
        $late_return_days_limit = 1; // Batas waktu tertentu

        if ($diff_days >= $late_return_days_limit) {
            // Menghitung total denda
            $total_penalty = $diff_days * $late_return_penalty;

            // Update status dan tambahkan denda
            $queryUpdateStatus = "UPDATE loans SET status = 'Sudah Dikembalikan', denda = $total_penalty WHERE id_transaksi = '$id_transaksi'";
            if ($db->query($queryUpdateStatus) === TRUE) {
                // Update jumlah buku yang tersedia
                $queryUpdateAvailableBooks = "UPDATE books SET available_books = available_books + 1 WHERE kode_buku = '$kode_buku'";
                $db->query($queryUpdateAvailableBooks);

                header("Location: index.php?page=loans");
            } else {
                echo "Buku gagal dikembalikan! " . $db->error;
            }
        } else {
            // Update status tanpa denda
            $queryUpdateStatus = "UPDATE loans SET status = 'Sudah Dikembalikan' WHERE id_transaksi = '$id_transaksi'";
            if ($db->query($queryUpdateStatus) === TRUE) {
                // Update jumlah buku yang tersedia
                $queryUpdateAvailableBooks = "UPDATE books SET available_books = available_books + 1 WHERE kode_buku = '$kode_buku'";
                $db->query($queryUpdateAvailableBooks);

                header("Location: index.php?page=loans");
            } else {
                echo "Buku gagal dikembalikan! " . $db->error;
            }
        }
    } else {
        echo "Data transaksi tidak ditemukan!";
    }
}

if (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
    $kode_buku = $_GET['kode_buku'];
    $id_member = $_GET['id_member'];

    // Hapus transaksi berdasarkan kode buku dan id member
    $sql = "DELETE FROM loans WHERE id_transaksi = '$id_transaksi'";

    if ($db->query($sql) === TRUE) {
        // Update jumlah buku yang tersedia
        $queryUpdateAvailableBooks = "UPDATE books SET available_books = available_books + 1 WHERE kode_buku = '$kode_buku'";
        $db->query($queryUpdateAvailableBooks);

        header("Location: index.php?page=loans");
    } else {
        echo "Data gagal dihapus! " . $db->error;
    }
}
function getLoanCount($id_member, $db)
{
    $query = "SELECT COUNT(*) as total FROM loans WHERE id_member = '$id_member' AND status='Sedang Dipinjam'";
    $result = $db->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return 0;
    }
}
?>
<!-- <script>
    document.getElementById('cetakButton').addEventListener('click', function() {
    // Ambil nilai id_member dari input hidden
    var idMemberValue = document.getElementById('idMemberInput').value;

    // Buat URL yang diinginkan dengan menambahkan id_member
    var url = 'pdf.php?id_member=' + idMemberValue;

    // Alihkan ke URL yang baru
    window.location.href = url;
});

</script> -->

<?php

$db->close();
?>
