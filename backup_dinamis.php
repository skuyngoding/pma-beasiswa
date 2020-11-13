<!-- gagal dinamis untuk tambah mhs : kriteria, sub kriteria -->
<!-- dinamis -->
<!--
    <?php foreach ($subkriteria as $sk) : ?>
        <option nilai="<?= $sk['nilai']; ?>" value="<?= $sk['id']; ?>"><?= $sk['nama']; ?></option>
    <?php endforeach; ?>
-->

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
                                    <input type="number" class="form-control text-center mb-2" name="jumlahData" id="jumlahData" required>
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
                    // SELECT sk.kriteria_id, sk.nama FROM sub_kriteria sk LEFT JOIN kriteria k ON sk.kriteria_id = k.id ORDER BY kriteria_id ASC
                    // menghasilkan kriteria_id dan nama sub kriteria
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
                                        <label for="kriteria<?= $i; ?>">Kriteria</label>
                                        <select name="kriteria_id<?= $i; ?>" id="kriteria<?= $i; ?>" class="form-control" required>
                                            <option></option>
                                            <?php foreach ($kriteria as $k) : ?>
                                                <option value="<?= $k['id']; ?>"><?= $k['nama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="subkriteria<?= $i; ?>">Sub Kriteria</label>
                                        <select name="subkriteria_id<?= $i; ?>" id="subkriteria<?= $i; ?>" class="form-control" required>
                                            <option></option>
                                            <?php foreach ($subkriteria as $sk) : ?>
                                                <option nilai="<?= $sk['nilai']; ?>" value="<?= $sk['id']; ?>"><?= $sk['nama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <!-- untuk nilai -->
                                    <input type="hidden" name="nilai<?= $i; ?>" class="form-control" id="nilai<?= $i; ?>">
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
    <script src="assets/jquery/jquery-3.4.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script>
        // dropdown berantai > subkriteria turunan dari kriteria
        // pilih kriteria
        // sub-kriteria values auto sesuai dengan kriteria_id

        // looping value dari select subkriteri
        let jml = $('#inputJumlah').val();

        for (let i = 1; i <= jml; i++) {

            let sk = '#subkriteria' + i.toString();
            let nilaival = sk + ' option:selected';
            let nilai = '#nilai' + i.toString();

            $(sk).on('change', function() {
                $(nilai).val($(nilaival).attr('nilai'));
            });
        }
    </script>

</body>

</html>