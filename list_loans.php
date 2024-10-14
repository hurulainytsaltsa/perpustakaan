<div class="container-fluid">
    <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title fw-semibold">Loan List</h5>
                        <a href="index.php?page=detail_loans"><button name="submit" type="submit"
                                class="btn btn-primary ti ti-square-plus">Add new Loans</button></a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle" id="example">
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
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Status</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Denda</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $query = "SELECT loans.*, books.judul FROM loans JOIN books ON loans.kode_buku = books.kode_buku";
                                $result = $db->query($query);
                                $nomor = 1; 
                                foreach ($result as $row) : ?>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0"><?= $nomor++ ?></h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1"><?= $row['id_member']?></h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $row['judul']?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?= $row['kode_buku']?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-success rounded-3 fw-semibold"><?= $row['tanggal_peminjaman']?></span>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-danger rounded-3 fw-semibold"><?= $row['tanggal_pengembalian']?></span>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-primary rounded-3 fw-semibold"><?= $row['status']?></span>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">Rp. <?= $row['denda']?></p>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
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
</div>