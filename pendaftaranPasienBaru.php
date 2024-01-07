<?php
if (!isset($_SESSION)) {
    session_start();
}

function showAlert($message) {
    echo "<script>alert('$message')</script>";
    echo '<meta http-equiv="refresh" content="0">';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pasien = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_ktp = $_POST['no_ktp'];
    $no_hp = $_POST['no_hp'];

    $query_cek = "SELECT * FROM pasien WHERE no_ktp = '$no_ktp'";
    $result = $mysqli->query($query_cek);

    if ($result === false) {
        die("Query error: " . $mysqli->error);
    }

    if ($result->num_rows == 0) {
        $query_ambil_jumlah_pasien = "SELECT COUNT(id) AS jumlah_pasien FROM pasien";
        $data = mysqli_fetch_assoc(mysqli_query($mysqli, $query_ambil_jumlah_pasien));
        $jumlah_pasien = $data["jumlah_pasien"] + 1;
        $set_jumlah_pasien = ($jumlah_pasien < 10) ? "00{$jumlah_pasien}" : (($jumlah_pasien < 100) ? "0{$jumlah_pasien}" : "{$jumlah_pasien}");
        $no_rm = date("Ym") . "-" . (string) $set_jumlah_pasien;

        $insert_query = "INSERT INTO pasien (nama, alamat, no_ktp, no_hp, no_rm) VALUES ('$nama_pasien', '$alamat', '$no_ktp', '$no_hp', '$no_rm')";
        if (mysqli_query($mysqli, $insert_query)) {
            $_SESSION['id_pasien'] = mysqli_insert_id($mysqli);
            $_SESSION['name'] = $nama_pasien;
            $_SESSION['no_rm'] = $no_rm;
            $_SESSION['role'] = "pasien";
            showAlert('Pendaftaran Berhasil');
            echo "<script>document.location='index.php?page=daftarPoliklinik';</script>";
        } else {
            $error = "Pendaftaran gagal";
        }
    } else {
        $row = $result->fetch_assoc();
        $_SESSION['id_pasien'] = $row['id'];
        $_SESSION['name'] = $row['nama'];
        $_SESSION['no_rm'] = $row['no_rm'];
        $_SESSION['role'] = "pasien";
        header("Location: index.php?page=daftarPoliklinik");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pasien</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center" style="font-weight: bold; font-size: 32px;">Register Pasien</div>
                    <div class="card-body">
                        <form method="POST" action="index.php?page=pendaftaranPasienBaru">
                            <?php
                            if (isset($error)) {
                                echo '<div class="alert alert-danger">' . $error . '
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>';
                            }
                            ?>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" required placeholder="Masukkan Nama Lengkap">
                            </div>
                            <div class="form-group mt-1">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control" required placeholder="Masukkan Alamat">
                            </div>
                            <div class="form-group mt-1">
                                <label for="no_ktp">No.KTP</label>
                                <input type="text" name="no_ktp" class="form-control" required placeholder="Masukkan No.KTP">
                            </div>
                            <div class="form-group mt-1">
                                <label for="no_hp">No.HP</label>
                                <input type="text" name="no_hp" class="form-control" required placeholder="Masukkan No.HP">
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
