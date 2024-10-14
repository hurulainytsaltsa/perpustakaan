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
                                <!-- Button trigger modal -->

                                <h5 class="card-title fw-semibold mb-2">Membership</h5>
                                
                                <button type="button" class="btn btn-primary ti ti-user-plus" data-bs-toggle="modal" data-bs-target="#exampleModal"> Add new Member</button>

                                <!-- Modal Input-->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Member</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="proses_membership.php?proses=insert" method="post">
                                                <div class="mb-3">
                                                    <label for="inputKode" class="form-label">ID Member</label>
                                                    <div>
                                                    <input class="form-control" name="id_member" id="inputKode">
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
                                                    <div >
                                                    <input class="form-control" type="email" name="email" id="inputKode">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                <label for="inputKode" class="form-label">Jenis Kelamin</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jekel" id="laki" value="Laki-laki" required>
                                                    <label class="form-label" for="laki">Laki-laki</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jekel" id="perempuan" value="Perempuan" required>
                                                    <label class="form-label" for="perempuan">Perempuan</label>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <div>
                                                <input class="form-control" type="date" name="tanggal_lahir" id="inputKode">
                                            </div>
                                        </div>

                                                <div class="mb-3">
                                                    <label for="inputKode" class="form-label">Type</label>
                                                    <div>
                                                        <select name="type" class="form-select" aria-label="Default select example">
                                                            <option value="staff">Pilih</option>
                                                            <option value="mahasiswa">Mahasiswa</option>
                                                            <option value="dosen">Dosen</option>
                                                            <option value="staff">Staff</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="inputKode" class="form-label">Program Studi</label>
                                                    <div>
                                                    <select name="prodi_id" class="form-select" aria-label="Default select example">
                                                        <option>Pilih Prodi</option>
                                                        <?php
                                                            $prodi=mysqli_query($db,"SELECT * FROM prodi");
                                                            while($data_prodi=mysqli_fetch_array($prodi)){
                                                                echo "<option value=".$data_prodi['prodi_id'].">".$data_prodi['nama_prodi']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="inputKode" class="form-label">Alamat</label>
                                                    <div>
                                                    <textarea class="form-control" name="alamat" id="inputKode"></textarea>
                                                    </div>
                                                </div>
 
                                                <div class="mb-3">
                                                    <label for="inputKode" class="form-label">Tanggal Registrasi</label>
                                                    <div>
                                                    <input class="form-control" type="date" name="tanggal_registrasi" id="inputKode" value="<?php echo date('Y-m-d'); ?>">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="inputKode" class="form-label">Tanggal Berakhir</label>
                                                    <div>
                                                    <input class="form-control" type="date" name="tanggal_berakhir" id="inputKode">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                
                                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                                <button name="submit" type="submit" class="btn btn-danger">Kembali</button>
                                                </div>            
                                                </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <!-- <a href="?page=membership&aksi=input"><button type="button" class="btn btn-outline-primary">Add New Member</button></a> -->
                            </div>
                            <div class="table-responsive">
                                <hr>
                                <table class="table text-nowrap mb-0 align-middle" id="example">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">No</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">ID</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Nama</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Type</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Email</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Aksi</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $query = "SELECT * FROM member";
                                        $result = $db->query($query);
                                        $nomor = 1; 
                                        foreach ($result as $row) : ?>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0"><?= $nomor++ ?></h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-1"><?= $row['id_member']?></h6>
                                                <!-- <span class="fw-normal"><?= $row['type']?></span> -->
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row['nama']?></p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <?php
                                                    $type = $row['type'];
                                                    $badgeClass = '';

                                                    // Array yang memetakan nilai type ke kelas warna
                                                    $colorMapping = [
                                                        'Staff' => 'bg-danger',
                                                        'Mahasiswa' => 'bg-success',
                                                        'Dosen' => 'bg-info',
                                                    ];
                                                    // Cek apakah type ada dalam mapping, jika tidak, gunakan warna default
                                                    $badgeClass = isset($colorMapping[$type]) ? $colorMapping[$type] : 'bg-secondary';
                                                    ?>
                                                    <span class="badge <?= $badgeClass ?> rounded-3 fw-semibold"><?= $type ?></span>
                                                </div>
                                            </td>


                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal"><?= $row['email']?></p>
                                            </td>
                                            
                                            <td class="border-bottom-0">
                                                <a class="btn btn-primary ti ti-edit-circle"  role="button" data-bs-toggle="modal" data-bs-target="#exModal<?= $row['id_member'] ?>"></a>

                                            <!-- Modal Edit-->
                                            <div class="modal fade" id="exModal<?= $row['id_member'] ?>" tabindex="-1" aria-labelledby="exModalLabel" aria-hidden="true">                               
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exModalLabel">Edit Member</h1></br>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <form action="proses_membership.php?proses=update" method="post">
                                                            <div class="mb-3">
                                                                <label for="inputKode" class="form-label">ID Member</label>
                                                                <div>
                                                                <input class="form-control" name="id_member" value="<?=$row['id_member']?>" id="inputKode" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="inputKode" class="form-label">Nama</label>
                                                                <div>
                                                                <input class="form-control" name="nama" value="<?=$row['nama']?>" id="inputKode">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="inputKode" class="form-label">Email</label>
                                                                <div>
                                                                <input class="form-control" type="email" name="email" value="<?=$row['email']?>" id="inputKode">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                            <label for="inputKode" class="form-label">Jenis Kelamin</label><br>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="jekel" id="laki" value="Laki-laki" <?=$row['jekel'] == 'Laki-laki'? 'checked' : ''?> required>
                                                                <label class="form-label" for="laki">Laki-laki</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="jekel" id="perempuan" value="Perempuan" <?=$row['jekel'] == 'Perempuan'? 'checked' : ''?> required>
                                                                <label class="form-label" for="perempuan">Perempuan</label>
                                                            </div>
                                                        </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Tanggal Lahir</label>
                                                                <div>
                                                                    <input class="form-control" type="date" value="<?=$row['tanggal_lahir']?>" name="tanggal_lahir" id="inputKode">
                                                                    <!-- <div class="d-flex">
                                                                    <select name="tgl" class="form-select me-1" aria-label="Default select example" require style="width: 300px;">
                                                                        <?php
                                                                            echo "<option value>Tanggal</option>";
                                                                            for ($i=1; $i <=31 ; $i++) {
                                                                                $selected = ($i == $tanggal) ? 'selected' : ''; 
                                                                                echo "<option value='$i' $selected>$i</option>";
                                                                            }
                                                                        ?>
                                                                    </select>

                                                                        <select name="bln" class="form-select me-1" aria-label="Default select example" require style="width: 300px;">
                                                                            <?php
                                                                                echo "<option value>Bulan</option>";
                                                                                $namaBulan = array(
                                                                                    1 => "Januari",
                                                                                    2 => "Februari",
                                                                                    3 => "Maret",
                                                                                    4 => "April",
                                                                                    5 => "Mei",
                                                                                    6 => "Juni",
                                                                                    7 => "Juli",
                                                                                    8 => "Agustus",
                                                                                    9 => "September",
                                                                                    10 => "Oktober",
                                                                                    11 => "November",
                                                                                    12 => "Desember"
                                                                                );

                                                                                foreach ($namaBulan as $key => $value) {
                                                                                    $selected = ($key == $bulan) ? 'selected' : '';
                                                                                    echo "<option value='$key' $selected>$value</option>";
                                                                                   
                                                                                }
                                                                            ?>
                                                                        </select>

                                                                        <select name="thn" class="form-select me-1" aria-label="Default select example" require style="width: 300px;">
                                                                            <?php
                                                                                echo "<option value>Tahun</option>";
                                                                                $tahunSekarang = date("2030");
                                                                                for ($thn = $tahunSekarang; $thn >= 1980; $thn--) { 
                                                                                    $selected = ($thn == $tahun) ? 'selected' : '';
                                                                                    echo "<option value='$thn' $selected>$thn</option>";
                                                                                }
                                                                                
                                                                            ?>
                                                                        </select>
                                                                    </div> -->
                                                                </div>
                                                            </div>


                                                            <div class="mb-3">
                                                                <label for="inputKode" class="form-label">Type</label>
                                                                <div>
                                                                    <select name="type" class="form-select" aria-label="Default select example">
                                                                        <option <?php echo ($type == 'Pilih') ? 'selected' : ''; ?>>Pilih</option>
                                                                        <option <?php echo ($type == 'Mahasiswa') ? 'selected' : ''; ?> value="Mahasiswa">Mahasiswa</option>
                                                                        <option <?php echo ($type == 'Dosen') ? 'selected' : ''; ?> value="Dosen">Dosen</option>
                                                                        <option <?php echo ($type == 'Staff') ? 'selected' : ''; ?> value="Staff">Staff</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="inputKode" class="form-label">Program Studi</label>
                                                                <div>
                                                                    <select name="prodi_id" class="form-select" aria-label="Default select example">
                                                                        <option value="">Pilih</option>
                                                                        <?php
                                                                        $prodi=mysqli_query($db,"SELECT * FROM prodi");
                                                                        while($data_prodi=mysqli_fetch_array($prodi)){
                                                                            $selected = ($row['id_prodi'] == $data_prodi['prodi_id']) ? 'selected' : '';
                                                                            echo "<option value=" . $data_prodi['prodi_id'] . " $selected>" . $data_prodi['nama_prodi'] . "</option>";
                                                                        }?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            

                                                            <div class="mb-3">
                                                                <label for="inputKode" class="form-label">Alamat</label>
                                                                <div>
                                                                <textarea class="form-control" name="alamat" id="inputKode"><?php echo $row['alamat']; ?></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="inputKode" class="form-label">Tanggal Registrasi</label>
                                                                <div>
                                                                <input class="form-control" type="date" value="<?=$row['tanggal_registrasi']?>" name="tanggal_registrasi" id="inputKode">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="inputKode" class="form-label">Tanggal Berakhir</label>
                                                                <div>
                                                                <input class="form-control" type="date" value="<?=$row['tanggal_berakhir']?>" name="tanggal_berakhir" id="inputKode">
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
                                                <a class="btn btn-danger ti ti-trash" onclick="return confirm('Apakah yakin menghapusnya?')" href="proses_membership.php?proses=delete&id_member=<?=$row['id_member']?>">
                                                    
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
    case 'input'          
?>
    
<?php
    break;
    case 'edit' :
        $id_member = $_GET['id_member'];
        $query = "SELECT * FROM member WHERE id_member=$id_member";
        $result = $db->query($query);
        $row = $result->fetch_assoc(); 
        $type = $row['type'];
        $tanggal_lahir = $row['tanggal_lahir'];
        list($tahun, $bulan, $tanggal) = explode('-', $row['tanggal_lahir']);
        
?>

<?php        
    break;
}
?>