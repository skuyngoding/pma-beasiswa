<?php
require_once('functions.php');

$subkriteria = query("SELECT * FROM sub_kriteria");

if (isset($_POST['tambahSubKriteria'])) {
    if (tambahKriteria($_POST) > 0) {
        echo "<script>
            alert('data berhasil ditambahkan!');
            document.location.href='aspek.php';
        </script>";
    } else {
        echo "<script>
            alert('data gagal ditambahkan!');
            document.location.href='aspek.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspek Penilaian - Sub Kriteria</title>
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

        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-md-8">

                <a href="subkriteria_tambah.php" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah Data</a>

                <div class="card">
                    <div class="card-header badge-success text-white">
                        <div class="display-6">Tabel Sub Kriteria</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sub Kriteria</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($subkriteria as $sk) : ?>

                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $sk['nama']; ?></td>
                                        <td><?= $sk['nilai']; ?></td>
                                        <td>
                                            <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" href="subkriteria_hapus.php?id=<?= $sk['id']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>

                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- /. container -->

    <!-- Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js" integrity="sha512-7yA/d79yIhHPvcrSiB8S/7TyX0OxlccU8F/kuB8mHYjLlF1MInPbEohpoqfz0AILoq5hoD7lELZAYYHbyeEjag==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>