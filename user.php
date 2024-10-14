<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'input':
        ?>
        <div class="container-fluid">
            <!-- <div class="col-lg-12 d-flex align-items-stretch"> -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Form Add User</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="proses_user.php?proses=insert" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="inputKode" class="form-label">ID User</label>
                                    <div>
                                        <input class="form-control" name="id_user" id="inputKode">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputKode" class="form-label">Nama</label>
                                    <div>
                                        <input class="form-control" name="nama" id="inputKode">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputKode" class="form-label">Email</label>
                                    <div>
                                        <input class="form-control" type="email" name="email" id="inputKode">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputKode" class="form-label">Password</label>
                                    <div>
                                        <input type="password" class="form-control" name="password" id="inputKode">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputKode" class="form-label">Level</label>
                                    <div>
                                        <select name="level" class="form-select" aria-label="Default select example">
                                            <option value="staff">Pilih</option>
                                            <option value="admin">Admin</option>
                                            <option value="pustakawan">Pustakawan</option>
                                        </select>
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
    case 'profile':
        $query = "SELECT * FROM user";
        $result = $db->query($query);
        $level = $row['level'];
        ?>
        <div class="container-fluid">
            <!-- <div class="col-lg-12 d-flex align-items-stretch"> -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Profile</h5>
                    <div class="card">
                        <div class="card-body">
                            <form action="proses_user.php?proses=update" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="inputKode" class="form-label">ID User</label>
                                    <div>
                                        <input class="form-control" name="id_user" id="inputKode"
                                            value="<?= $row['id_user'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputKode" class="form-label">Nama</label>
                                    <div>
                                        <input class="form-control" name="nama" id="inputKode" value="<?= $row['nama'] ?>">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputKode" class="form-label">Email</label>
                                    <div>
                                        <input class="form-control" type="email" name="email" id="inputKode"
                                            value="<?= $row['email'] ?>">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputKode" class="form-label">Password</label>
                                    <div>
                                        <input type="password" class="form-control" name="password" id="inputKode"
                                            value="<?= $row['password'] ?>">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputKode" class="form-label">Level</label>
                                    <div>
                                        <select name="level" class="form-select" aria-label="Default select example">
                                            <option <?php echo ($level == 'Pilih') ? 'selected' : ''; ?>>Pilih</option>
                                            <option <?php echo ($level == 'Admin') ? 'selected' : ''; ?> value="Admin">Admin
                                            </option>
                                            <option <?php echo ($level == 'Pustakawan') ? 'selected' : ''; ?> value="Pustakawan">
                                                Pustakawan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-1">
                                    <label for="inputKode" class="form-label">Pilih Gambar</label>
                                    <div>
                                        <input type="file" class="form-control" accept="image/*" id="photo" name="photo">
                                        <img src="<?php echo "assets/images/profile/" . $row['photo']; ?>" alt="Profile Image"
                                            style="width: 150px;">
                                        <?php echo $row['photo']; ?>
                                    </div>
                                </div>

                                <button name="submit" type="submit" class="btn btn-primary">Update</button>
                                <button name="submit" type="submit" class="btn btn-danger">Kembali</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        break;
}
?>