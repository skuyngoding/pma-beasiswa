<?php
session_start();
require_once('functions.php');

$subkriteria = query("SELECT * FROM sub_kriteria");

if (isset($_POST['tambahSubKriteria'])) {
    if (tambahSubKriteria($_POST) > 0) {
        echo "<script>
            alert('data berhasil ditambahkan!');
            document.location.href='sub_kriteria.php';
        </script>";
    } else {
        echo "<script>
            alert('data gagal ditambahkan!');
            document.location.href='sub_kriteria.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sub Kriteria - Tambah Data</title>
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

                <div class="card mb-2">
                    <div class="card-header badge-primary">
                        Form Tambah Data - Sub Kriteria
                    </div>
                    <div class="card-body">
                        <!-- form untuk input jumlah record data yang ingin ditambahkan -->
                        <form action="" method="post" class="form">
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM kriteria");
                            ?>
                            <div class="form-group">
                                <button onclick='window.location.href="subkriteria_tambah.php"' class="btn btn-sm btn-warning text-white float-right">Reload Halaman</button>
                                <label for="kriteria">Kriteria</label>
                                <select name="kriteria_id" id="kriteria" class="form-control" required>
                                    <option></option>
                                    <?php foreach ($query as $q) : ?>
                                        <option value="<?= $q['id']; ?>"><?= $q['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- button untuk menampilkan input jumlah sub kriteria -->
                            <button onclick="tambahSub()" type="button" class="btn btn-sm btn-primary btn-block mb-2" id="btn-tambahSub">Tambah Sub Kriteria <small> (mulai dari 1) </small></button>

                            <?php
                            if (isset($_POST['btn-tambahSub'])) {
                                $jml = $_POST['number'];
                                echo "<input type='hidden' name='jmlRow' value='$jml'>";
                                for ($i = 1; $i <= $jml; $i++) {
                                    echo "
                                    <div class='form-group row'>
                                        <div class='col-md-9'>
                                            <input type='text' name='nama$i' id='nama$i' class='form-control' placeholder='Masukkan Sub Kriteria $i' required>
                                        </div>
                                        <div class='col-md-3'>
                                            <input type='text' name='nilai$i' id='nilai$i' class='form-control' placeholder='Bobot nilai' required>
                                        </div>
                                    </div>
                                ";
                                }
                            }
                            ?>
                            <div class="form-group mt-2">
                                <button type="submit" name="tambahSubKriteria" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                            </div>

                        </form>
                        <form action="" method="post">
                            <div class="form-group row mb-0" id="inputTambahSub">
                                <div class="col-md-10">
                                    <input type="text" name="number" class="form-control" placeholder="Masukkan jumlah sub kriteria" maxlength="2" pattern="[0-9]+">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" name="btn-tambahSub" class="btn btn-primary float-right">Proses</button>
                                </div>
                            </div>
                        </form>
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
    <script>
        // tambah subkriteria
        $('#inputTambahSub').hide();

        function tambahSub() {
            let btnTambahSub = $('#btn-tambahSub');
            let inputTambahSub = $('#inputTambahSub');
            $(document).on('click', btnTambahSub, function() {
                if (inputTambahSub.is(':hidden')) {
                    inputTambahSub.show("fast");
                    btnTambahSub.hide();
                }
            });
        }
    </script>

</body>

</html>