<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
  case 'kategori':
    ?>
    <div class="container-fluid">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Form Input Kategori</h5>
            <div class="card">
              <div class="card-body">
                <form action="proses_input.php?proses=insert_kategori" method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label class="form-label">ID Kategori</label>
                    <input class="form-control" name="id_kategori">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input class="form-control" name="nama_kategori">
                  </div>
                  <div class="mb-3">
                    <label for="inputKode" class="form-label">Pilih Gambar</label>
                    <div>
                      <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body p-4">
              <h5 class="card-title fw-semibold mb-4">Table List Kategori</h5>

              <hr>
              <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle" id="example">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">ID</h6>
                      </th>

                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nama Kategori</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Logo</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Aksi</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM categories";
                    $result = $db->query($query);
                    foreach ($result as $row): ?>
                      <tr>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">
                            <?= $row['id_kategori'] ?>
                          </h6>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1">
                            <?= $row['nama_kategori'] ?>
                          </h6>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal"><img src="assets/images/logos/<?= $row['photo'] ?>" alt="Gambar"
                              width="90"></p>
                        </td>
                        <td class="border-bottom-0">
                          <a class="btn btn-primary ti ti-pencil" role="button" data-bs-toggle="modal"
                            data-bs-target="#exModal<?= $row['id_kategori'] ?>"></a>

                          <!-- Modal Edit-->
                          <div class="modal fade" id="exModal<?= $row['id_kategori'] ?>" tabindex="-1"
                            aria-labelledby="exModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exModalLabel">Edit Kategori</h1></br>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form action="proses_input.php?proses=update_kategori" method="post"
                                    enctype="multipart/form-data">
                                    <div class="mb-3">
                                      <label class="form-label">ID Kategori</label>
                                      <input class="form-control" value="<?= $row['id_kategori'] ?>" name="id_kategori"
                                        readonly>
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Nama Kategori</label>
                                      <input class="form-control" value="<?= $row['nama_kategori'] ?>" name="nama_kategori">
                                    </div>
                                    <div class="mb-3">
                                      <label for="inputKode" class="form-label">Pilih Gambar</label>
                                      <div>
                                        <input type="file" class="form-control" accept="image/*" id="photo" name="photo">
                                        <img src="<?php echo "assets/images/logos/" . $row['photo']; ?>" alt="Buku Image"
                                          style="width: 150px;">
                                        <?php echo $row['photo']; ?>
                                      </div>
                                    </div>
                                    <div class="modal-footer">

                                      <button name="submit" type="submit" class="btn btn-primary">Edit</button>
                                      <button name="cancel" type="submit" class="btn btn-danger">Kembali</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Member</button> -->
                          <a class="btn btn-danger ti ti-trash" onclick="return confirm('Apakah yakin menghapusnya?')"
                            href="proses_input.php?proses=delete_kategori&id_kategori=<?= $row['id_kategori'] ?>">

                          </a>
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

    <?php
    break;
  case 'prodi':
    ?>
    <div class="container-fluid">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Form Input Prodi</h5>
            <div class="card">
              <div class="card-body">
                <form action="proses_input.php?proses=insert_prodi" method="post">
                  <div class="mb-3">
                    <label class="form-label">ID Prodi</label>
                    <input class="form-control" name="prodi_id">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nama Program Studi</label>
                    <input class="form-control" name="nama_prodi">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body p-4">
              <h5 class="card-title fw-semibold mb-4">Table List Prodi</h5>

              <hr>
              <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle" id="example">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">ID</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nama Prodi</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Aksi</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM prodi";
                    $result = $db->query($query);
                    foreach ($result as $row): ?>
                      <tr>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">
                            <?= $row['prodi_id'] ?>
                          </h6>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1">
                            <?= $row['nama_prodi'] ?>
                          </h6>
                        </td>
                        <td class="border-bottom-0">
                          <a class="btn btn-primary ti ti-pencil" role="button" data-bs-toggle="modal"
                            data-bs-target="#exModal<?= $row['prodi_id'] ?>"></a>

                          <!-- Modal Edit-->
                          <div class="modal fade" id="exModal<?= $row['prodi_id'] ?>" tabindex="-1"
                            aria-labelledby="exModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exModalLabel">Edit Prodi</h1></br>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form action="proses_input.php?proses=update_prodi" method="post">
                                    <div class="mb-3">
                                      <label class="form-label">ID Prodi</label>
                                      <input class="form-control" name="prodi_id" value="<?= $row['prodi_id'] ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Nama Program Studi</label>
                                      <input class="form-control" name="nama_prodi" value="<?= $row['nama_prodi'] ?>">
                                    </div>
                                    <div class="modal-footer">

                                      <button name="submit" type="submit" class="btn btn-primary">Edit</button>
                                      <button name="cancel" type="submit" class="btn btn-danger">Kembali</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Member</button> -->
                          <a class="btn btn-danger ti ti-trash" onclick="return confirm('Apakah yakin menghapusnya?')"
                            href="proses_input.php?proses=delete_prodi&prodi_id=<?= $row['prodi_id'] ?>">

                          </a>
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

    <?php
    break;
  case 'pengarang':
    ?>
    <div class="container-fluid">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Form Input Pengarang</h5>
            <div class="card">
              <div class="card-body">
                <form action="proses_input.php?proses=insert_pengarang" method="post">
                  <div class="mb-3">
                    <label class="form-label">ID Pengarang</label>
                    <input class="form-control" name="id_pengarang">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nama Pengarang</label>
                    <input class="form-control" name="nama_pengarang">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body p-4">
              <h5 class="card-title fw-semibold mb-4">Table List Pengarang</h5>

              <hr>
              <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle" id="example">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">ID</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nama Pengarang</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Aksi</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM pengarang";
                    $result = $db->query($query);
                    foreach ($result as $row): ?>
                      <tr>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">
                            <?= $row['id'] ?>
                          </h6>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1">
                            <?= $row['nama_pengarang'] ?>
                          </h6>
                        </td>
                        <td class="border-bottom-0">
                          <a class="btn btn-primary ti ti-pencil" role="button" data-bs-toggle="modal"
                            data-bs-target="#exModal<?= $row['id'] ?>"></a>

                          <!-- Modal Edit-->
                          <div class="modal fade" id="exModal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exModalLabel">Edit Pengarang</h1></br>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form action="proses_input.php?proses=update_pengarang" method="post">
                                    <div class="mb-3">
                                      <label class="form-label">ID Pengarang</label>
                                      <input class="form-control" name="id_pengarang" value="<?= $row['id_pengarang'] ?>"
                                        readonly>
                                    </div>
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <!-- Tambahkan input tersembunyi untuk id -->
                                    <div class="mb-3">
                                      <label class="form-label">Nama Pengarang</label>
                                      <input class="form-control" name="nama_pengarang" value="<?= $row['nama_pengarang'] ?>">
                                    </div>
                                    <div class="modal-footer">
                                      <button name="submit" type="submit" class="btn btn-primary">Edit</button>
                                      <button name="cancel" type="submit" class="btn btn-danger">Kembali</button>
                                    </div>
                                  </form>

                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Member</button> -->
                          <a class="btn btn-danger ti ti-trash" onclick="return confirm('Apakah yakin menghapusnya?')"
                          href="proses_input.php?proses=delete_pengarang&id=<?= $row['id'] ?>">

                          </a>
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

    <?php
    break;
  case 'penerbit':
    ?>
    <div class="container-fluid">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Form Input Penerbit</h5>
            <div class="card">
              <div class="card-body">
                <form action="proses_input.php?proses=insert_penerbit" method="post">
                  <div class="mb-3">
                    <label class="form-label">ID Penerbit</label>
                    <input class="form-control" name="id_penerbit">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nama Penerbit</label>
                    <input class="form-control" name="nama_penerbit">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Kota Penerbit</label>
                    <input class="form-control" name="kota">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body p-4">
              <h5 class="card-title fw-semibold mb-4">Table List Penerbit</h5>

              <hr>
              <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle" id="example">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">ID</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nama Penerbit</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Kota Penerbit</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Aksi</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $query = "SELECT * FROM penerbit";
                    $result = $db->query($query);
                    foreach ($result as $row): ?>
                    <tr>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-0"><?= $row['id_penerbit'] ?></h6>
                      </td>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1"><?= $row['nama_penerbit'] ?></h6>
                      </td>
                      <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1"><?= $row['kota'] ?></h6>
                      </td>
                      <td class="border-bottom-0">
                        <a class="btn btn-primary ti ti-pencil" role="button" data-bs-toggle="modal"
                          data-bs-target="#exModal<?= $row['id_penerbit'] ?>"></a>

                        <!-- Modal Edit-->
                        <div class="modal fade" id="exModal<?= $row['id_penerbit'] ?>" tabindex="-1" aria-labelledby="exModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exModalLabel">Edit Penerbit</h1></br>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form action="proses_input.php?proses=update_penerbit" method="post">
                                  <div class="mb-3">
                                    <label class="form-label">ID Penerbit</label>
                                    <input class="form-control" name="id_penerbit" value="<?= $row['id_penerbit'] ?>" readonly>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Nama Penerbit</label>
                                    <input class="form-control" name="nama_penerbit" value="<?= $row['nama_penerbit'] ?>">
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Kota Penerbit</label>
                                    <input class="form-control" name="kota" value="<?= $row['kota'] ?>">
                                  </div>
                                  <div class="modal-footer">

                                    <button name="submit" type="submit" class="btn btn-primary">Edit</button>
                                    <button name="cancel" type="submit" class="btn btn-danger">Kembali</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Member</button> -->
                        <a class="btn btn-danger ti ti-trash" onclick="return confirm('Apakah yakin menghapusnya?')"
                        href="proses_input.php?proses=delete_penerbit&id_penerbit=<?= $row['id_penerbit'] ?>">

                        </a>
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

    <?php
    break;
}
?>