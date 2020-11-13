<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <!-- bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.0/css/all.min.css">
    <!-- my css -->
    <link rel=" stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- navbar -->
    <?php
    include_once('template.php');

    require_once('functions.php');

    $profil = query("SELECT k.nama as k, sk.nama as sk, ps.nilaiprofil_std as np FROM kriteria k INNER JOIN sub_kriteria sk ON k.id = sk.kriteria_id INNER JOIN profil_standar ps ON sk.id = ps.subkriteria_id");
    $pembobotan = query("SELECT * FROM pembobotan");
    ?>

    <div class="container">

        <div class="row mt-5">
            <div class="col-md-12 justify-content-center">


                <div class="display-4 text-center">
                    Selamat Datang, di
                </div>
                <div class="display-4 text-center">
                    Aplikasi SPK - Penerima Beasiswa
                </div>
                <hr>
                <div class="row mt-2">
                    <div class="col-md-8 mx-auto">
                        <p>Dibawah ini adalah tabel nilai standar yang telah ditetapkan</p>
                        <div class="card">
                            <div class="card-body pb-0">
                                <table class="table table-sm table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Kriteria</th>
                                            <th>Nilai Profil Standar</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($profil as $p) : ?>
                                            <tr>
                                                <td class="text-left"><?= $p['k']; ?></td>
                                                <td><?= $p['np']; ?></td>
                                                <td><?= $p['sk']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <p>Dibawah ini adalah tabel pembobotan</p>
                        <div class="card">
                            <div class="card-body pb-0">
                                <table class="table table-sm table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Selisih</th>
                                            <th>Bobot Nilai</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pembobotan as $p) : ?>
                                            <tr>
                                                <td><?= $p['selisih']; ?></td>
                                                <td><?= $p['bobot']; ?></td>
                                                <td><?= $p['ket']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- jumbotron -->
                        <div class="jumbotron mt-2 py-2">
                            <p class="lead">Seleksi Mahasiswa penerima beasiswa</p>
                            <hr class="my-2">
                            <p>Selengkapnya</p>
                            <p class="lead">
                                <a class="btn btn-primary" href="mhs.php" role="button">Klik disini &raquo;</a>
                            </p>
                        </div>

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

</body>

</html>