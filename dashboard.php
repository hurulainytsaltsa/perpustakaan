<?php
include 'koneksi.php';
?>

<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-4 ">

            <!-- Monthly Earnings -->
            <?php
            date_default_timezone_set('Asia/Jakarta');
            $tanggal_hari_ini = date('Y-m-d');

            $query = $db->prepare("SELECT COUNT(*) as jumlah_pengunjung FROM kunjungan WHERE tanggal_kunjungan = ?");
            $query->bind_param("s", $tanggal_hari_ini);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $jumlah_pengunjung = $row['jumlah_pengunjung'];
            } else {
                echo "No results for today.";
            }
            ?>
            <div class="card">
                <div class="card-body">
                    <div class="row alig n-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold">Daily Visitor</h5>
                            <h4 class="fw-semibold mb-3">
                                <?php echo $jumlah_pengunjung; ?>
                            </h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div
                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-eye fs-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- Monthly Earnings -->
            <?php
            // Query untuk menghitung jumlah buku
            $query_book = $db->query("SELECT COUNT(*) as jumlah_buku FROM books");
            $row_book = $query_book->fetch_assoc();
            $jumlah_buku = $row_book['jumlah_buku'];
            ?>

            <div class="card">
                <div class="card-body">
                    <div class="row alig n-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold">Total Books</h5>
                            <h4 class="fw-semibold mb-3">
                                <?php echo $jumlah_buku; ?>
                            </h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div
                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-book fs-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div id="earning"></div> -->
            </div>
        </div>
        <div class="col-lg-4">
            <!-- Monthly Earnings -->
            <?php
            // Query untuk menghitung jumlah buku
            $query_member = $db->query("SELECT COUNT(*) as jumlah_member FROM member");
            $row_member = $query_member->fetch_assoc();
            $jumlah_member = $row_member['jumlah_member'];
            ?>
            <div class="card">
                <div class="card-body">
                    <div class="row alig n-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold">Total Member</h5>
                            <h4 class="fw-semibold mb-3">
                                <?php echo $jumlah_member; ?>
                            </h4>

                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div
                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-user fs-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div id="earning"></div> -->
            </div>
        </div>
        <div class="col-lg-4">

        </div>
    </div>

    <?php
    $query = "
SELECT books.kode_buku, books.judul, books.photo, COUNT(loans.kode_buku) AS total_peminjaman
FROM loans
INNER JOIN books ON loans.kode_buku = books.kode_buku
GROUP BY loans.kode_buku
ORDER BY total_peminjaman DESC;
";

    // Eksekusi query
    $result = $db->query($query);

    // $query = "SELECT * FROM books ORDER BY id DESC LIMIT 4";
    // $result = $db->query($query);
    ?>

    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title fw-semibold">Popular Among our Collections</h5>
                    <a href="?page=booklist&aksi=list"><button name="submit" type="submit" class="btn btn-primary">book
                            list</button></a>
                </div>
                <br>
                <p>Our library's line of collection that have been favoured by our users were shown here. Look for them.
                    Borrow them. Hope you also like them
                </p>
                <hr>
                <div class="row">
                    <?php foreach ($result as $row): ?>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card overflow-hidden rounded-2">
                                <div class="position-relative">
                                <a href="javascript:void(0)"><img src="assets/book/<?php echo $row['photo']; ?>"
                                            class="card-img-top rounded-0" alt="..."></a>
                                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Add To Cart"></a>
                                </div>
                                <div class="card-body pt-3 p-4">
                                    <h6 class="fw-semibold fs-4">
                                        <?= $row['judul'] ?>
                                    </h6>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span>
                                            <?= $row['kode_buku'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- New Collection -->
    <?php
    $query = "SELECT * FROM books ORDER BY id DESC LIMIT 4";
    $result = $db->query($query);
    ?>
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title fw-semibold">New Collections and Update</h5>
                    <a href="?page=booklist&aksi=list"><button name="submit" type="submit" class="btn btn-primary">book
                            list</button></a>
                </div>
                <br>
                <p>These are new collections list. Hope you like them. Maybe not all of them are new. But in term of
                    time, we make sure that these are fresh from our processing oven</p>
                <hr>
                <div class="row">
                    <?php foreach ($result as $row): ?>
                        <div class="col-sm-6 col-xl-3">
                            <div class="card overflow-hidden rounded-2">
                                <div class="position-relative">
                                    <a href="javascript:void(0)"><img src="assets/book/<?php echo $row['photo']; ?>"
                                            class="card-img-top rounded-0" alt="..."></a>
                                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Add To Cart"></a>
                                </div>
                                <div class="card-body pt-3 p-4">
                                    <h6 class="fw-semibold fs-4">
                                        <?= $row['judul'] ?>
                                    </h6>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span>
                                            <?= $row['kode_buku'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Top Reader of the Year</h5>
                <p>Our best users, readers, so far. Continue to read if you want your name being mentioned here.</p>
                <hr>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Nama</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">ID Member</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Loans</h6>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT l.id_member, COUNT(l.id_member) AS jumlah_pinjaman, 
                           (SELECT nama FROM member WHERE id_member = l.id_member) AS nama_member,
                           (SELECT type FROM member WHERE id_member = l.id_member) AS type
                    FROM loans l
                    GROUP BY l.id_member
                    ORDER BY jumlah_pinjaman DESC;";


                            $result = $db->query($query);



                            // Pastikan $result adalah array sebelum menggunakan foreach
                            if ($result && $result->num_rows > 0) {
                                $nomor = 1;
                                foreach ($result as $row):
                                    

                                    ?>
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">
                                                <?= $nomor++ ?>
                                            </h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">
                                                <?= $row['nama_member'] ?>
                                            </h6>
                                            <span class="fw-normal">
                                                <?= $row['type'] ?>
                                            </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">
                                                <?= $row['id_member'] ?>
                                            </p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-primary rounded-3 fw-semibold">
                                                    <?= $row['jumlah_pinjaman'] ?>
                                                </span>
                                            </div>
                                        </td>

                                    </tr>
                                <?php endforeach;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Daily Visitor -->
    <?php
    date_default_timezone_set('Asia/Jakarta');
    $tanggal_hari_ini = date('Y-m-d');
    $query = "SELECT kunjungan.*, member.nama, member.type
               FROM kunjungan
               JOIN member ON kunjungan.member_id = member.id_member
               WHERE kunjungan.tanggal_kunjungan = '$tanggal_hari_ini'
               ORDER BY kunjungan.jam_kunjungan DESC
               LIMIT 7";
    $result = $db->query($query);
    ?>

    <div class="row">
        <div class="col-lg-4 d-flex align-items-stretch">

            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold text-center">Recent Visits Today</h5>
                        <hr>
                    </div>
                    <ul class="timeline-widget mb-0 position-relative mb-n5">
                        <?php foreach ($result as $row): ?>
                            <li class="timeline-item d-flex position-relative overflow-hidden text-center">
                                <?php
                                $jam_kunjungan = date('h:i A', strtotime($row['jam_kunjungan']));
                                ?>
                                <div class="timeline-time text-dark flex-shrink-0 text-end">
                                    <?= $jam_kunjungan ?>
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">
                                    <?= $row['nama'] ?>
                                    <span class="fw-normal">
                                    </span>
                                    <span class="fw-semibold">
                                    <?= $row['type'] ?>
                                    </span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Maps -->
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">


                    <iframe width="625" height="450" frameborder="0" style="border:0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1186.0293442656366!2d100.46644504975669!3d-0.9134401804921105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b7be96dab6f1%3A0x33bb46d09e2c9cf9!2sGedung%20C%20%3A%20Perpustakaan%20Politeknik%20Negeri%20Padang!5e0!3m2!1sid!2sid!4v1669946883021!5m2!1sid!2sid"
                        allowfullscreen>

                    </iframe>
                </div>

            </div>

        </div>

        <footer>
            <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Copyright
                    <?= date("Y") ?> &copy; | Project PBL Kelompok 3 MI 2C
                </p>
            </div>
        </footer>

        
    </div>