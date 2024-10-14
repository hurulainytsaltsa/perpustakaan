<?php
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_id = $_POST['member_id'];
    $prodi_id = $_POST['prodi_id'];
    $tanggal_kunjungan = date('Y-m-d');
    $jam_kunjungan = date('H:i:s'); // Menambah informasi jam kunjungan

    $query = "INSERT INTO kunjungan(member_id, prodi_id, tanggal_kunjungan, jam_kunjungan) 
              VALUES ('$member_id', '$prodi_id', '$tanggal_kunjungan', '$jam_kunjungan')";

    if ($db->query($query) === TRUE) {
        header("Location: index.php"); //redirect
        exit;
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
    }
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/logopnp.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-14 col-md-9">
        <br>
        <br>
        <br>
        <div class="card o-hidden border-0 shadow-lg my-5">

          <div class="card-body p-0">

            <!-- Nested Row within Card Body -->
            <div class="row">

              <div class="col-lg-6 d-none d-lg-block bg-login-image">
                <img src="assets/images/backgrounds/visitor.jpg" width="450" alt="">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome to Perpustakaan Politeknik Negeri Padang</h1>
                  </div>
                  <form action="" method="post">
                    <div class="mb-3">
                      <label for="exampleInputtext1" class="form-label">Member ID</label>
                      <input type="text" name="member_id" class="form-control" id="exampleInputtext1"
                        aria-describedby="textHelp">
                    </div>
                   
                    <div class="mb-3">
                      <label for="inputKode" class="form-label">Institution</label>
                      <div>
                        <select name="prodi_id" class="form-select" aria-label="Default select example">
                          <option>Pilih Prodi</option>
                          <?php
                          $prodi = mysqli_query($db, "SELECT * FROM prodi");
                          while ($data_prodi = mysqli_fetch_array($prodi)) {
                            echo "<option value=" . $data_prodi['prodi_id'] . ">" . $data_prodi['nama_prodi'] . "</option>";
                          }
                          ?>
                        </select>
                      </div>

                    </div>
                    <p class>Enough fill your member ID if you are member of Perpustakaan Politeknik Negeri Padang</p>
                    <button name=submit class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Check In</button>
                    <div class="d-flex align-items-center justify-content-center">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  

  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>