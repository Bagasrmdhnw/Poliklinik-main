<?php
session_start();
$role = "";
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    // Hapus session
    session_unset();
    session_destroy();
}
if ($role == 'admin') {
    header("Location: index.php?page=loginUser");
} elseif ($role == 'dokter') {
    header("Location: index.php?page=loginDokter");
} else {
    header("Location: index.php?page=pendaftaranPasienBaru");
}
exit();
?>