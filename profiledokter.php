<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['role'])) {
    // Jika pengguna sudah login, tampilkan tombol "Logout"
    header("Location: index.php?page=profiledokter");
    exit;
}

// Sertakan file mysqli
include 'koneksi.php';

// Ambil data dokter dari database berdasarkan id_dokter yang sudah login
$id_dokter = $_SESSION['id_dokter'];
$query = "SELECT * FROM dokter WHERE id = $id_dokter";
$result = mysqli_query($mysqli, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($mysqli));
}

// Ambil data dokter sebagai array associative
$dokter = mysqli_fetch_assoc($result);

// Ambil data poli untuk dropdown
$query_poli = "SELECT id, nama_poli FROM poli";
$result_poli = mysqli_query($mysqli, $query_poli);

if (!$result_poli) {
    die("Query Poli Error: " . mysqli_error($mysqli));
}

$poli_options = "";
while ($row = mysqli_fetch_assoc($result_poli)) {
    $selected = ($row['id'] == $dokter['id_poli']) ? 'selected' : '';
    $poli_options .= "<option value='{$row['id']}' $selected>{$row['nama_poli']}</option>";
}

// Proses pembaruan data jika ada form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang diubah dari formulir
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    // Query untuk mengupdate data dokter
    $update_query = "UPDATE dokter SET nama = '$nama', nip = '$nip', alamat = '$alamat', no_hp = '$no_hp' WHERE id = $id_dokter";
    $update_result = mysqli_query($mysqli, $update_query);

    // Periksa apakah query update berhasil dijalankan
    if ($update_result) {
        echo "Data dokter berhasil diupdate.";
    } else {
        die("Update error: " . mysqli_error($mysqli));
    }

    // Proses perubahan password
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $update_password_query = "UPDATE dokter SET password = '$hashed_password' WHERE id = $id_dokter";
    $update_password_result = mysqli_query($mysqli, $update_password_query);

    if (!$update_password_result) {
        die("Update Password Error: " . mysqli_error($mysqli));
    }

    // Proses perubahan poli
    $id_poli = $_POST['id_poli'];
    $update_poli_query = "UPDATE dokter SET id_poli = $id_poli WHERE id = $id_dokter";
    $update_poli_result = mysqli_query($mysqli, $update_poli_query);

    if (!$update_poli_result) {
        die("Update Poli Error: " . mysqli_error($mysqli));
    }

    // Redirect ke halaman profile dokter setelah perubahan
    header("Location: index.php?page=logout");
    exit();
}

// Tutup mysqli database
mysqli_close($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Dokter</title>
    <!-- Tambahkan link stylesheet Bootstrap di sini -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Profil Dokter</h1>

        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $dokter['nama']; ?>" required>
            </div>

            <div class="form-group">
                <label for="nip">NIP:</label>
                <input type="text" class="form-control" name="nip" value="<?php echo $dokter['nip']; ?>" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" name="alamat" value="<?php echo $dokter['alamat']; ?>" required>
            </div>

            <div class="form-group">
                <label for="no_hp">No HP:</label>
                <input type="text" class="form-control" name="no_hp" value="<?php echo $dokter['no_hp']; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="form-group">
                <label for="id_poli">Poli:</label>
                <select class="form-control" name="id_poli">
                    <?= $poli_options ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <!-- Tambahkan script Bootstrap di sini -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
