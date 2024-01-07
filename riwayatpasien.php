<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['role'])) {
    header("Location: index.php?page=loginDokter");
    exit;
}

include 'koneksi.php';

$result = mysqli_query($mysqli, "SELECT ps.nama, ps.no_rm, pr.tgl_periksa, pr.catatan, o.nama_obat, pr.biaya_periksa FROM pasien AS ps
                                    JOIN daftar_poli AS dp ON ps.id = dp.id_pasien
                                    JOIN periksa AS pr ON dp.id = pr.id_daftar_poli
                                    JOIN detail_periksa AS dep ON pr.id = dep.id_periksa
                                    JOIN obat AS o ON dep.id_obat = o.id
                                    JOIN jadwal_periksa AS jp ON dp.id_jadwal = jp.id
                                    JOIN dokter AS dok ON jp.id_dokter = dok.id
                                    WHERE jp.id_dokter IN (SELECT id FROM dokter WHERE id =  '".$_SESSION['id_dokter']."')
                                ");
$no = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pasien</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <br>
        <h2>Riwayat Pasien</h2>
        <br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Pasien</th>
                    <th scope="col">Tanggal Periksa</th>
                    <th scope="col">No RM</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Obat</th>
                    <th scope="col">Biaya</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($data = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <th scope="row"><?php echo $no++ ?></th>
                        <td><?php echo $data['nama'] ?></td>
                        <td><?php echo $data['tgl_periksa'] ?></td>
                        <td><?php echo $data['no_rm'] ?></td>
                        <td><?php echo $data['catatan'] ?></td>
                        <td><?php echo $data['nama_obat'] ?></td>
                        <td><?php echo $data['biaya_periksa'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
