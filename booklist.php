<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
  case 'list':
    ?>
    <div class="container-fluid">
      <div class="container-fluid">
        <div class="col-lg-12 d-flex align-items-stretch">
          <div class="card w-100">
            <div class="card-body p-4">
              <div class="d-flex justify-content-between">
                <h5 class="card-title fw-semibold mb-4">Select the topic you are interested in</h5>

                <?php
                if (isset($_SESSION['login'])) {
                  echo '<a href="?page=booklist&aksi=input"><button type="button" class="btn btn-primary ti ti-square-plus"> Add new Book</button></a>';
                }
                ?>
              </div>

              <hr>
              <div class="row">
                <?php
                $result = $db->query("SELECT * FROM categories ORDER BY nomor_kategori");
                if ($result) {
                  while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-sm-6 col-xl-2">
                      <div class="card overflow-hidden rounded-2">
                        <div class="position-relative p-4">
                          <a href="javascript:void(0)"><img src="assets/images/logos/<?php echo $row['photo']; ?>"
                              class="card-img-top rounded-0" alt="..."></a>
                          <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Add To Cart"></a>
                        </div>
                        <div class="card-body pt-3 p-4">
                          <h6 class="fw-semibold fs-2">
                            <?php echo $row['nama_kategori']; ?>
                          </h6>
                          <div class="d-flex align-items-center justify-content-between">
                            <a class="btn btn-primary"
                              href="?page=booklist&aksi=viewall&kategori=<?php echo urlencode($row['nama_kategori']); ?>"
                              role="button">view all</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                } else {
                  echo "Error in the query: " . $db->error;
                }
                ?>
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
  case 'input':
    ?>
    <div class="container-fluid">
      <div class="container-fluid">
        <!-- <div class="col-lg-12 d-flex align-items-stretch"> -->
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Form Input Book</h5>
            <div class="card">
              <div class="card-body">
                <form action="proses_books.php?proses=insert" method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="inputKode" class="form-label">ISSN</label>
                    <div>
                      <input class="form-control" name="issn" id="inputKode">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="inputKode" class="form-label">Kode Buku</label>
                    <div>
                      <input class="form-control" name="kode_buku" id="inputKode">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="inputJudul" class="form-label">Judul Buku</label>
                    <div>
                      <input class="form-control" name="judul" id="inputJudul">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="inputKode" class="form-label">Kategori Buku</label>
                    <div>
                      <select name="category_id" class="form-select" aria-label="Default select example">
                        <option>Pilih Kategori</option>
                        <?php
                        $category = mysqli_query($db, "SELECT * FROM categories");
                        while ($data_kategori = mysqli_fetch_array($category)) {
                          echo "<option value=" . $data_kategori['id_kategori'] . ">" . $data_kategori['nama_kategori'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="inputKode" class="form-label">Pengarang</label>
                    <div>
                      <select name="pengarang" class="form-select" aria-label="Default select example">
                        <option>Pilih Pengarang</option>
                        <?php
                        $pengarang_query = mysqli_query($db, "SELECT * FROM pengarang");
                        while ($data_pengarang = mysqli_fetch_array($pengarang_query)) {
                          echo "<option value='" . $data_pengarang['id'] . "'>" . $data_pengarang['nama_pengarang'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="inputKode" class="form-label">Penerbit</label>
                    <div>
                      <select name="penerbit" class="form-select" aria-label="Default select example">
                        <option>Pilih Penerbit</option>
                        <?php
                        $penerbit_query = mysqli_query($db, "SELECT * FROM penerbit");
                        while ($data_penerbit = mysqli_fetch_array($penerbit_query)) {
                          echo "<option value='" . $data_penerbit['id'] . "'>" . $data_penerbit['nama_penerbit'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="inputKode" class="form-label">Total Buku</label>
                    <div>
                      <input class="form-control" name="total_books" id="inputKode">
                    </div>
                  </div>

                  <div class="mb-1">
                    <label for="inputKode" class="form-label">Pilih Gambar</label>
                    <div>
                      <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    </div>
                  </div>

                  <div>
                    <!-- <?php echo "<image src='" . $uploadfile . "'width='' />"; ?> -->
                  </div>
                  <br>

                  <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                  <button name="submit" type="submit" class="btn btn-danger">Kembali</button>


                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
      break;
  case 'edit':
    $kode_buku = isset($_GET['kode_buku']) ? $_GET['kode_buku'] : '';
    if ($kode_buku !== '') {
      // Gunakan prepared statement untuk mencegah SQL injection
      $query = $db->prepare("SELECT * FROM books WHERE kode_buku=?");
      $query->bind_param("s", $kode_buku);
      $query->execute();
      $result = $query->get_result();
      $row = $result->fetch_assoc();
    } else {
      // Handle ketika kode_buku tidak ditemukan atau kosong
      echo "Kode buku tidak valid";
    }
    ?>


      <?php
      break;
  case 'viewall':
    $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
    // Gunakan prepared statement untuk mencegah SQL injection
    $query = $db->prepare("SELECT * FROM books WHERE category_id IN (SELECT id_kategori FROM categories WHERE nama_kategori = ?)");
    $query = $db->prepare("SELECT books.*, categories.nama_kategori, pengarang.nama_pengarang, penerbit.nama_penerbit, penerbit.kota
    FROM books 
    JOIN categories ON books.category_id = categories.id_kategori
    JOIN pengarang ON books.pengarang = pengarang.id
    JOIN penerbit ON books.penerbit = penerbit.id
    WHERE categories.nama_kategori = ?");
    $query->bind_param("s", $kategori);
    $query->execute();

    $query->bind_param("s", $kategori);
    $query->execute();
    $result = $query->get_result();
    if (!$result) {
      echo "Error in the query: " . $db->error;
    } else {
      ?>
        <div class="container-fluid">
          <div class="container-fluid">
            <div class="col-lg-12 d-flex align-items-stretch">
              <div class="card w-100">
                <div class="card-body p-4">
                  <h5 class="card-title fw-semibold mb-4">Book List</h5>

                  <hr>
                  <div class="table-responsive">
                    <table id=example class="table text-nowrap mb-0 align-middle" style="width:100%">
                      <thead class="text-dark fs-4">
                        <tr>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">No</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0 ">Sampul Buku</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Nama dan Kode Buku</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Pengarang</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Tersedia</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Total</h6>
                          </th>
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Detail</h6>
                          </th>
                          <?php
                          if (isset($_SESSION['login'])) {
                            echo '<th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">New Update</h6>
                                  </th>';
                          }
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $nomor = 1;
                        foreach ($result as $row): ?>
                          <tr>
                            <td class="border-bottom-0">
                              <h6 class="fw-semibold mb-0">
                                <?= $nomor++ ?>
                              </h6>
                            </td>
                            <td class="border-bottom-0">
                              <div style="float: left;" class="long-text">
                                <!-- Isi elemen di samping kiri -->
                                <img src="assets/book/<?= $row['photo'] ?>" alt="Gambar" width="90">
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <h6 class="fw-semibold mb-1">
                                <?= $row['judul'] ?>
                              </h6>
                              <span class="fw-normal">
                                <?= $row['kode_buku'] ?>
                              </span>
                            </td>
                            <td class="border-bottom-0">
                              <p class="mb-0 fw-normal">
                                <?= $row['nama_pengarang'] ?>
                              </p>
                            </td>
                            <td class="border-bottom-0">
                              <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary rounded-3 fw-semibold">
                                  <?= $row['available_books'] ?>
                                </span>
                              </div>
                            </td>
                            <td class="border-bottom-0">
                              <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary rounded-3 fw-semibold">
                                  <?= $row['total_books'] ?>
                                </span>
                              </div>
                            </td>

                            <td class="border-bottom-0">
                              <div class="d-flex align-items-center gap-2">
                              <button type="button" class="btn btn-outline-primary ti ti-hand-move" data-bs-toggle="modal"
                                  data-bs-target="#DetailModal<?= $row['id'] ?>"><span class="bx bx-pen"></span></button>

                                <div class="modal fade" id="DetailModal<?= $row['id'] ?>" tabindex="-1">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Detail Buku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <!--Isi content Modal-->
                                        <section class="section profile">
                                          <div class="row">
                                            <div class="col-sm-5">
                                              <div class="card">
                                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                                  <img src="assets/book/<?= $row['photo'] ?>" alt="Gambar" width="200">
                                                </div>
                                              </div>
                                            </div>

                                            <div class="col-sm-7">
                                              <div class="card">
                                                <div class="card-body pt-3">
                                                  <!-- Bordered Tabs -->
                                                  <ul class="nav nav-tabs nav-tabs-bordered">
                                                    <li class="nav-item">
                                                      <button class="nav-link active" data-bs-toggle="tab"
                                                        data-bs-target="#profile-overview">Details</button>
                                                    </li>
                                                  </ul>
                                                  <div class="tab-content pt-2">
                                                    <div class="tab-pane fade show active profile-overview"
                                                      id="profile-overview">


                                                      <div class="row text-start">
                                                        <div class="col-lg-4 col-md-4 label mb-1">Judul :
                                                          <?= $row['judul'] ?>
                                                        </div>
                                                      
                                                      <div class="row text-start">
                                                        <div class="col-lg-4 col-md-4 label mb-1">Kode Buku :
                                                          <?= $row['kode_buku'] ?>
                                                        </div>

                                                      </div>
                                                      <div class="row text-start">
                                                        <div class="col-lg-4 col-md-4 label mb-1">ISSN :
                                                          <?= $row['issn'] ?>
                                                        </div>

                                                      </div>
                                                      <div class="row text-start">
                                                        <div class="col-lg-4 col-md-4 label mb-1">Kategori Buku :
                                                          <?= $row['nama_kategori'] ?>
                                                        </div>

                                                        <div class="row text-start">
                                                          <div class="col-lg-4 col-md-4 label mb-1">Pengarang :
                                                            <?= $row['nama_pengarang'] ?>
                                                          </div>

                                                        </div>

                                                        <div class="row text-start">
                                                          <div class="col-lg-4 col-md-4 label mb-1">Penerbit :
                                                            <?= $row['nama_penerbit'] ?>
                                                          </div>

                                                        </div>

                                                        <div class="row text-start">
                                                          <div class="col-lg-4 col-md-4 label mb-1">Kota Terbit :
                                                            <?= $row['kota'] ?>
                                                          </div>

                                                          <div class="row text-start">
                                                            <div class="col-lg-4 col-md-4 label mb-1">Buku Tersedia :
                                                              <?= $row['available_books'] ?>
                                                            </div>
                                                            <div class="row text-start">
                                                              <div class="col-lg-4 col-md-4 label mb-1">Jumlah Buku :
                                                                <?= $row['total_books'] ?>
                                                              </div>

                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                        </section>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                      </div>
                                    </div>
                                  </div>
                                </div>


                              </div>
                            </td>
                            <?php
                            if (isset($_SESSION['login'])) { ?>
                            <td class="border-bottom-0">
                              <div class="d-flex align-items-center gap-2">


                                
                                <?php
                               
                                  echo '<a class="btn btn-primary ti ti-pencil" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row['kode_buku'] . '"></a>';
                                
                                ?>

                                <div class="modal fade" id="exampleModal<?= $row['kode_buku'] ?>" tabindex="-1"
                                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Buku</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="proses_books.php?proses=update" method="post"
                                          enctype="multipart/form-data">
                                          <div class="mb-3">
                                            <label for="inputKode" class="form-label">ISSN</label>
                                            <div>
                                              <input class="form-control" name="kode_buku" value="<?= $row['issn'] ?>" readonly>
                                            </div>
                                          </div>

                                          <div class="mb-3">
                                            <label for="inputKode" class="form-label">Kode Buku</label>
                                            <div>
                                              <input class="form-control" name="kode_buku" value="<?= $row['kode_buku'] ?>"
                                                readonly>
                                            </div>
                                          </div>

                                          <div class="mb-3">
                                            <label for="inputJudul" class="form-label">Judul Buku</label>
                                            <div>
                                              <input class="form-control" name="judul" value="<?= $row['judul'] ?>"
                                                id="inputJudul">
                                            </div>
                                          </div>

                                          <div class="mb-3">
                                            <label for="inputKode" class="form-label">Kategori Buku</label>
                                            <div>
                                              <select name="category_id" class="form-select"
                                                aria-label="Default select example">
                                                <?php
                                                $category = mysqli_query($db, "SELECT * FROM categories");
                                                while ($data_kategori = mysqli_fetch_array($category)) {
                                                  $selected = ($row['category_id'] == $data_kategori['id_kategori']) ? 'selected' : '';
                                                  echo "<option value=" . $data_kategori['id_kategori'] . " $selected>" . $data_kategori['nama_kategori'] . "</option>";
                                                }
                                                ?>
                                              </select>

                                            </div>
                                          </div>

                                          <div class="mb-3">
                                            <label for="inputKode" class="form-label">Pengarang</label>
                                            <div>
                                              <select name="pengarang" class="form-select" aria-label="Default select example">
                                                <option>Pilih Pengarang</option>
                                                <?php
                                                $pengarang_query = mysqli_query($db, "SELECT * FROM pengarang");
                                                while ($data_pengarang = mysqli_fetch_array($pengarang_query)) {
                                                  $selected = ($row['pengarang'] == $data_pengarang['id']) ? 'selected="selected"' : '';
                                                  echo "<option value=" . $data_pengarang['id'] . " $selected>" . $data_pengarang['nama_pengarang'] . "</option>";
                                                }
                                                ?>
                                              </select>

                                            </div>
                                          </div>

                                          <div class="mb-3">
                                            <label for="inputKode" class="form-label">Penerbit</label>
                                            <div>
                                              <select name="penerbit" class="form-select" aria-label="Default select example">
                                                <option>Pilih Penerbit</option>
                                                <?php
                                                $penerbit_query = mysqli_query($db, "SELECT * FROM penerbit");
                                                while ($data_penerbit = mysqli_fetch_array($penerbit_query)) {
                                                  $selected = ($row['penerbit'] == $data_penerbit['id']) ? 'selected="selected"' : '';
                                                  echo "<option value='" . $data_penerbit['id'] . "' $selected>" . $data_penerbit['nama_penerbit'] . "</option>";
                                                }
                                                ?>
                                              </select>
                                            </div>
                                          </div>




                                          <div class="mb-3">
                                            <label for="inputKode" class="form-label">Total Buku</label>
                                            <div>
                                              <input class="form-control" name="total_books" value="<?= $row['total_books'] ?>"
                                                id="inputKode">
                                            </div>
                                          </div>

                                          <div class="mb-1">
                                            <label for="inputKode" class="form-label">Pilih Gambar</label>
                                            <div>
                                              <input type="file" class="form-control" accept="image/*" id="photo" name="photo">
                                              <img src="<?php echo "assets/book/" . $row['photo']; ?>" alt="Buku Image"
                                                style="width: 150px;">
                                              <?php echo $row['photo']; ?>
                                            </div>
                                          </div>

                                          <div class="modal-footer">
                                            <button name="submit" type="submit" class="btn btn-primary">Edit</button>
                                            <button name="submit" type="submit" class="btn btn-danger">Kembali</button>
                                          </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?php
                               
                                  echo '<a class="btn btn-danger ti ti-trash" onclick="return confirm(\'Apakah yakin menghapusnya?\')" href="proses_books.php?proses=delete&kode_buku=' . $row['kode_buku'] . '" role="button"></a>';
                                
                                ?>

                              </div>
                            </td>
                            <?php } ?>
                          </tr>

                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
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
          <?php
    

    }

    break;
}
?>

