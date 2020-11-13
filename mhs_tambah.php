<?php
require_once('functions.php');

if (isset($_POST['tambahMhs'])) {
    if (tambahMhs($_POST) > 0) {
        echo "<script>
            alert('data berhasil ditambahkan!');
            document.location.href='mhs.php';
        </script>";
    } else {
        echo "<script>
            alert('data gagal ditambahkan!');
            document.location.href='mhs.php';
        </script>";
    }
}

?>

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
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php
    include_once('template.php');
    ?>

    <div class="container">

        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-md-8">

                <button type="button" onclick="tampilCardTambah()" class="btn btn-primary mb-2" data-toggle="tooltip" data-placement="right" title="Klik untuk toggle form tambah record"><i class="fa fa-plus"></i> Tambah Data</button>

                <div class="card" id="card-tambah">
                    <div class="card-header badge-primary">
                        Tambah Data
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Record</h5>
                        <!-- form untuk input jumlah record data yang ingin ditambahkan -->
                        <form action="" method="post" class="form">
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <input type="text" class="form-control text-center mb-2" name="jumlahData" id="jumlahData" maxlength="1" pattern="[1-4]" placeholder="maksimal 4 record data" required>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" name="tambah" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>

        <div class="row mt-2 d-flex justify-content-center">
            <div class="col-md-8">

                <!-- jika tombol tambah di klik -> mengirimkan dala lewat method post -->
                <?php if (isset($_POST['tambah'])) : ?>
                    <?php
                    // maka tangkap
                    $jmlData = $_POST['jumlahData'];
                    $kriteria = query("SELECT * FROM kriteria ORDER BY id ASC");
                    $subkriteria = query("SELECT * FROM sub_kriteria ORDER BY id ASC");
                    ?>

                    <form action="" method="post">

                        <!-- jumlah hidden -->
                        <input type="hidden" id="inputJumlah" name="jmlRow" value="<?= $jmlData; ?>">

                        <!-- looping input -->
                        <?php for ($i = 1; $i <= $jmlData; $i++) : ?>
                            <div class="card mb-2">
                                <div class="card-header">
                                    <div class="display-6">Form Tambah Data Mahasiswa ke - <?= $i; ?></div>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="nama<?= $i; ?>"> Nama</label>
                                        <input type="text" name="nama<?= $i; ?>" id="nama<?= $i; ?>" class=" form-control" placeholder="Masukkan nama mahasiswa" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kriteria<?= $i; ?>"><?= $kriteria[0]['nama']; ?></label>
                                        <select name="subkriteria_id<?= $i; ?>" id="sub_a<?= $i; ?>" class="form-control" required>
                                            <option></option>
                                            <option value="1">
                                                < 2.5</option> <option value="2">>= 2.5 - < 3</option> <option value="3">>= 3 - < 3.5 </option> <option value="4">>= 3.5
                                            </option>
                                        </select>
                                        <input type="hidden" name="profil_a<?= $i; ?>" class="form-control" id="profil_a<?= $i; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kriteria<?= $i; ?>"><?= $kriteria[1]['nama']; ?></label>
                                        <select name="subkriteria_id<?= $i; ?>" id="sub_b<?= $i; ?>" class="form-control" required>
                                            <option></option>
                                            <option value="1">>= Rp. 5.000.000</option>
                                            <option value="2">>= Rp. 3.000.000 - < Rp. 5.000.000</option> <option value="3">>= Rp. 1.500.000 - < Rp. 3.000.000 </option> <option value="4">
                                                        < Rp. 1.500.0000</option> </select> <input type="hidden" name="profil_b<?= $i; ?>" class="form-control" id="profil_b<?= $i; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kriteria<?= $i; ?>"><?= $kriteria[2]['nama']; ?></label>
                                        <select name="subkriteria_id<?= $i; ?>" id="sub_c<?= $i; ?>" class="form-control" required>
                                            <option></option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">Lebih dari 3</option>
                                        </select>
                                        <input type="hidden" name="profil_c<?= $i; ?>" class="form-control" id="profil_c<?= $i; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kriteria<?= $i; ?>"><?= $kriteria[3]['nama']; ?></label>
                                        <select name="subkriteria_id<?= $i; ?>" id="sub_d<?= $i; ?>" class="form-control" required>
                                            <option></option>
                                            <option value="1">Semester 1 - 2</option>
                                            <option value="2">Semester 3 - 4</option>
                                            <option value="3">Semester 5 - 6</option>
                                            <option value="4">Semester 7 - 8</option>
                                        </select>
                                        <input type="hidden" name="profil_d<?= $i; ?>" class="form-control" id="profil_d<?= $i; ?>">
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                        <div class="form-group">
                            <button type="submit" name="tambahMhs" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Tambah Data</button>
                        </div>
                    </form>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js" integrity="sha512-7yA/d79yIhHPvcrSiB8S/7TyX0OxlccU8F/kuB8mHYjLlF1MInPbEohpoqfz0AILoq5hoD7lELZAYYHbyeEjag==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>

    <script>
        // dropdown berantai > subkriteria turunan dari kriteria
        // ,,,,


        // looping value dari select subkriteria
        let jml = $('#inputJumlah').val();

        for (let i = 1; i <= jml; i++) {
            // ambil text subkriteria++
            let sk_a = '#sub_a' + i.toString();
            let sk_b = '#sub_b' + i.toString();
            let sk_c = '#sub_c' + i.toString();
            let sk_d = '#sub_d' + i.toString();

            // option selected dari subkriteria++
            let val_a = sk_a + ' option:selected';
            let val_b = sk_b + ' option:selected';
            let val_c = sk_c + ' option:selected';
            let val_d = sk_d + ' option:selected';

            // ambil input profile++
            let profil_a = '#profil_a' + i.toString();
            let profil_b = '#profil_b' + i.toString();
            let profil_c = '#profil_c' + i.toString();
            let profil_d = '#profil_d' + i.toString();

            // jika subkriteria++ (change) set value profile dengan value dari option yang terpilih
            $(sk_a).on('change', function() {
                $(profil_a).val($(val_a).val());
            });
            $(sk_b).on('change', function() {
                $(profil_b).val($(val_b).val());
            });
            $(sk_c).on('change', function() {
                $(profil_c).val($(val_c).val());
            });
            $(sk_d).on('change', function() {
                $(profil_d).val($(val_d).val());
            });

        }
    </script>

</body>

</html>