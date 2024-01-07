<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_admin = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password === $confirm_password) {
            $query = "SELECT * FROM user WHERE username = '$username'";
            $result = $mysqli->query($query);

            if ($result === false) {
                die("Query error: " . $mysqli->error);
            }

            if ($result->num_rows == 0) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $insert_query = "INSERT INTO user (nama, username, password) VALUES ('$nama_admin', '$username', '$hashed_password')";
                if (mysqli_query($mysqli, $insert_query)) {
                    echo "<script>
                    alert('Pendaftaran Berhasil Silahkan Login'); 
                    document.location='index.php?page=loginAdmin';
                    </script>";
                } else {
                    $error = "Pendaftaran gagal coba lagi";
                }
            } else {
                $error = "Username sudah pernah digunakan";
            }
        } else {
            $error = "Password tidak cocok";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center" style="font-weight: bold; font-size: 32px;">Register Admin</div>
                    <div class="card-body">
                        <form method="POST" action="index.php?page=registerAdmin">
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
                                <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama anda">
                            </div>
                            <div class="form-group mt-1">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" required placeholder="Masukkan username anda">
                            </div>
                            <div class="form-group mt-1">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
                            </div>
                            <div class="form-group mt-1">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" required placeholder="Masukkan password konfirmasi">
                            </div>
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                            </div>
                        </form>
                        <div class="text-center">
                            <p class="mt-3">Sudah Punya Akun? <a href="index.php?page=loginAdmin">Login</a></p>
                        </div>
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
