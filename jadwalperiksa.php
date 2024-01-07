<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['role'])) {
    // Jika pengguna sudah login, tampilkan tombol "Logout"
    header("Location: index.php?page=loginDokter");
    exit;
}

// Gantilah nilai-nilai ini sesuai dengan koneksi database Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "poli";

// Koneksi ke database
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['simpan'])) {
    // Determine status based on the value of 'aksi'
    $status = ($_POST['aksi'] == 'Y') ? 'Aktif' : 'Tidak Aktif';

    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE jadwal_periksa SET 
            hari = '" . $_POST['hari'] . "',
            jam_mulai = '" . $_POST['jam_mulai'] . "',
            jam_selesai = '" . $_POST['jam_selesai'] . "',
            aksi = '" . $_POST['aksi'] . "',
            status = '" . $status . "'
            WHERE
            id = '" . $_POST['id'] . "'");
    } else {
        // ... (previous code)

        // Insert status value into the 'status' column
        $tambah = mysqli_query($mysqli, "INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai, aksi, status) 
            VALUES (
                '" . $_SESSION['id_dokter'] . "',
                '" . $_POST['hari'] . "',
                '" . $_POST['jam_mulai'] . "',
                '" . $_POST['jam_selesai'] . "',
                '" . $_POST['aksi'] . "',
                '" . $status . "'
            )");
    }

    echo "<script> 
            document.location='index.php?page=jadwalperiksa';
            </script>";
}
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM jadwal_periksa WHERE id = '" . $_GET['id'] . "'");
    }
    echo "<script> 
            document.location='index.php?page=jadwalperiksa';
            </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jadwal Periksa</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>

    <body>
        <br>
        <h2>Jadwal Periksa</h2>
        <br>
        <div class="container">
            <!-- Form Input Data -->
            <form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
                <?php
                $hari = '';
                $jam_mulai = '';
                $jam_selesai = '';
                $aksi = '';
                if (isset($_GET['id'])) {
                    $ambil = mysqli_query($mysqli, "SELECT * FROM jadwal_periksa 
                        WHERE id='" . $_GET['id'] . "'");
                    while ($row = mysqli_fetch_array($ambil)) {
                        $hari = $row['hari'];
                        $jam_mulai = $row['jam_mulai'];
                        $jam_selesai = $row['jam_selesai'];
                        $aksi = $row['aksi'];
                ?>
                        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                <?php
                    }
                }
                ?>
                <div class="row">
                    <label for="inputHari" class="form-label fw-bold">
                        Hari
                    </label>
                    <div>
                        <select class="form-control" name="hari" id="inputHari" required>
                            <option value="Senin" <?php echo ($hari == 'Senin') ? 'selected' : ''; ?>>Senin</option>
                            <option value="Selasa" <?php echo ($hari == 'Selasa') ? 'selected' : ''; ?>>Selasa</option>
                            <option value="Rabu" <?php echo ($hari == 'Rabu') ? 'selected' : ''; ?>>Rabu</option>
                            <option value="Kamis" <?php echo ($hari == 'Kamis') ? 'selected' : ''; ?>>Kamis</option>
                            <option value="Jumat" <?php echo ($hari == 'Jumat') ? 'selected' : ''; ?>>Jumat</option>
                            <option value="Sabtu" <?php echo ($hari == 'Sabtu') ? 'selected' : ''; ?>>Sabtu</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-1">
                    <label for="inputJamMulai" class="form-label fw-bold">
                        Jam Mulai
                    </label>
                    <div>
                        <input type="time" class="form-control" name="jam_mulai" id="inputJamMulai" required value="<?php echo $jam_mulai ?>">
                    </div>
                </div>
                <div class="row mt-1">
                    <label for="inputJamSelesai" class="form-label fw-bold">
                        Jam Selesai
                    </label>
                    <div>
                        <input type="time" class="form-control" name="jam_selesai" id="inputJamSelesai" required value="<?php echo $jam_selesai ?>">
                    </div>
                </div>
                <div class="row mt-1">
                    <label for="inputAksi" class="form-label fw-bold">
                        Aksi
                    </label>
                    <div>
                        <input type="text" class="form-control" name="aksi" id="inputAksi" required placeholder="Aksi" value="<?php echo $aksi ?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <button type="submit" class="btn btn-primary rounded-pill px-3 mt-auto" name="simpan">Simpan</button>
                    </div>
                </div>
            </form>

            <br>
            <br>
            <!-- Table -->
            <table class="table table-hover">
                <!-- thead atau baris judul -->
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Jam Mulai</th>
                        <th scope="col">Jam Selesai</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <!-- tbody berisi isi tabel sesuai dengan judul atau head -->
                <tbody>
                    <!-- Kode PHP untuk menampilkan semua isi dari tabel urut -->
                    <?php
                    $result = mysqli_query($mysqli, "SELECT * FROM jadwal_periksa WHERE id_dokter = '" . $_SESSION['id_dokter'] . "'");
                    $no = 1;
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $no++ ?></th>
                            <td><?php echo $data['hari'] ?></td>
                            <td><?php echo $data['jam_mulai'] ?></td>
                            <td><?php echo $data['jam_selesai'] ?></td>
                            <td><?php echo $data['status'] ?></td> <!-- Add this line -->
                            <td>
                                <a class="btn btn-success rounded-pill px-3" href="index.php?page=jadwalperiksa&id=<?php echo $data['id'] ?>">Ubah</a>
                                <a class="btn btn-danger rounded-pill px-3" href="index.php?page=jadwalperiksa&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>
