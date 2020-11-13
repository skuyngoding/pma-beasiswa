<?php
session_start();
require_once('functions.php');

$kriteria = query("SELECT * FROM kriteria");

if (isset($_POST['tambahKriteria'])) {
    if (tambahKriteria($_POST) > 0) {
        echo "<script>
            alert('data berhasil ditambahkan!');
            document.location.href='kriteria.php';
        </script>";
    } else {
        echo "<script>
            alert('data gagal ditambahkan!');
            document.location.href='kriteria.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspek Penilaian - Kriteria</title>
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

                <!-- button modal box - tambah kriteria -->
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalKriteria">
                    <i class="fa fa-plus"></i> Tambah Kriteria
                </button>

                <div class="card mb-2">
                    <div class="card-header badge-success">
                        <div class="display-6">Tabel Kriteria</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kriteria as $k) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $k['nama']; ?></td>
                                        <td><?= $k['jenis']; ?></td>
                                        <td><?= $k['ket']; ?></td>
                                        <td>
                                            <!-- <a href="aspek_edit?id=<?= $k['id']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i> Hapus</a> -->
                                            <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" href="kriteria_hapus.php?id=<?= $k['id']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Box Kriteria -->
                <div class="modal fade" id="modalKriteria">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> Form Tambah Kriteria </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- form tambah -->
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="nama"></label>
                                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama kriteria" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis"></label>
                                        <select name="jenis" id="jenis" class="form-control" required>
                                            <option></option>
                                            <option value="cf">Core Factor</option>
                                            <option value="sf">Secondary Factor</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ket"></label>
                                        <input type="text" name="ket" id="ket" class="form-control" placeholder="Masukkan keterangan">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="tambahKriteria" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Javascript -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js" integrity="sha512-7yA/d79yIhHPvcrSiB8S/7TyX0OxlccU8F/kuB8mHYjLlF1MInPbEohpoqfz0AILoq5hoD7lELZAYYHbyeEjag==" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
                <script src="assets/js/script.js"></script>

</body>

</html>