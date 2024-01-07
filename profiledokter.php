<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['role'])) {
    // Jika pengguna sudah login, tampilkan tombol "Logout"
    header("Location: index.php?page=loginDokter");
    exit;
}

// Sertakan file mysqli
include 'koneksi.php';

// Ambil data dokter dari database berdasarkan id_dokter yang sudah login
$id_dokter = $_SESSION['id_dokter'];
$query = "SELECT * FROM dokter WHERE id = $id_dokter";
$result = mysqli_query($mysqli, $query);

// Periksa apakah query berhasil dijalankan
if (!$result) {
    die("Query error: " . mysqli_error($mysqli));
}

// Ambil data dokter
$dokter = mysqli_fetch_assoc($result);

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
    header("Location: index.php?page=loginDokter");
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
</head>
<body>
    <h1>Profil Dokter</h1>

    <form method="POST" action="">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo $dokter['nama']; ?>" required><br>

        <label for="nip">NIP:</label>
        <input type="text" name="nip" value="<?php echo $dokter['nip']; ?>" required><br>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" value="<?php echo $dokter['alamat']; ?>" required><br>

        <label for="no_hp">No HP:</label>
        <input type="text" name="no_hp" value="<?php echo $dokter['no_hp']; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password"><br>

        <label for="id_poli">ID Poli:</label>
        <input type="text" name="id_poli" value="<?= $dokter['id_poli'] ?>"><br>

        <input type="submit" value="Simpan">
    </form>
</body>
</html>
