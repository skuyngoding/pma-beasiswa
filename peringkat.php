<?php
require_once('functions.php');

if (isset($_POST['ranking'])) {

    $jmlData = $_POST['jmlData'];

    for ($i = 1; $i <= $jmlData; $i++) {
        $mhs = $_POST['mhs' . $i];
        $total = $_POST['total' . $i];

        // update data jika sama, tambah data jika belum ada
        mysqli_query($conn, "REPLACE INTO peringkat(id, mhs_id, nilai_total) VALUES($mhs, $mhs, $total)");
    }
} else {
    $empty = true;
}

// query untuk tabel peringkat => perangkingan
$peringkat = query("SELECT * FROM peringkat ORDER BY nilai_total DESC");
$query = query("SELECT * FROM mhs m INNER JOIN peringkat p ON m.id = p.mhs_id ORDER BY nilai_total DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peringkat</title>
    <!-- bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.min.css">
    <!-- my css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- navbar -->
    <?php
    include_once('template.php');
    ?>

    <div class="container">

        <div class="row mt-2 d-flex justify-content-center ">
            <div class="col-md-8">

                <div class="display-4 text-center mb-2">
                    Data Mahasiswa
                </div>

                <?php if (isset($empty)) : ?>
                    <div class='alert alert-primary mt-2' role='alert'>
                        <div class='display-6'> Silahkan lakukan <b>perhitungan ulang</b> di halaman mahasiswa untuk data terbaru!</div>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header badge-info">
                        <div class="display-6">Tabel Peringkat</div>
                    </div>
                    <div class="card-body pb-0 mb-0">
                        <table class="table table-hover table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($query as $q) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $q['nama']; ?></td>
                                        <td><?= $q['nilai_total']; ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
                $query = mysqli_query($conn, "SELECT m.nama FROM mhs m LEFT JOIN peringkat p ON m.id = p.mhs_id ORDER BY nilai_total DESC LIMIT 1");
                if (mysqli_num_rows($query) > 0) {
                ?>
                    <?php
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <div class="alert alert-primary mt-2" role="alert">
                            <div class="display-6"> <b><?= $data["nama"]; ?></b> adalah mahasiswa yang berada pada urutan pertama dalam penentuan beasiswa.</div>
                        </div>
                    <?php
                    } ?>
                <?php } ?>

                <a href="mhs.php" class="btn btn-warning btn-block mb-4"><i class="fa fa-backward"></i> Kembali ke halaman Mahasiswa</a>

            </div>
            <!-- /. col-md-8 -->
        </div>
        <!-- /. row -->



    </div>

    <!-- Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js" integrity="sha512-7yA/d79yIhHPvcrSiB8S/7TyX0OxlccU8F/kuB8mHYjLlF1MInPbEohpoqfz0AILoq5hoD7lELZAYYHbyeEjag==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>