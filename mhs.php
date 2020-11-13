<?php
require_once('functions.php');

$mahasiswa = query("SELECT * FROM mhs");
$std = query("SELECT * FROM profil_standar");

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

        <div class="row mt-5 mb-5">
            <div class="col-md-4">

                <!-- button modal box - tambah kriteria -->
                <a href="mhs_tambah.php" class="btn btn-primary btn-block mb-2">
                    <i class="fa fa-plus"></i> Tambah Mahasiswa
                </a>

                <div class="card">
                    <div class="card-header badge-info">
                        <div class="display-6">Tabel Mahasiswa</div>
                    </div>
                    <div class="card-body pb-0 mb-0">
                        <table class="table table-hover table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Opsi</th>
                                    <th>No.</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($mahasiswa as $mhs) : ?>
                                    <tr>
                                        <td>
                                            <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" href="mhs_hapus.php?id=<?= $mhs['id']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i> Hapus</a>
                                        </td>
                                        <td><?= $i; ?></td>
                                        <td><?= $mhs['nama']; ?></td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- /. col-md-4 -->

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header badge-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="display-6">Tabel Nilai Profil</div>
                            </div>
                            <div class="col-md-6 ">
                                <button type="button" data-toggle="modal" data-target="#modalKet" class="btn btn-sm btn-info float-right">Keterangan</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-2 mb-0">
                        <form action="" method="post">
                            <table class="table table-hover table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>IPK</th>
                                        <th>Penghasilan Ortu</th>
                                        <th>Jumlah Tanggungan</th>
                                        <th>Semester</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($mahasiswa as $data) : ?>
                                        <tr>
                                            <th>#</th>
                                            <td><?= $data['profil_ipk']; ?></td>
                                            <td><?= $data['profil_penghasilanortu']; ?></td>
                                            <td><?= $data['profil_tanggungan']; ?></td>
                                            <td><?= $data['profil_semester']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="badge-info">
                                        <td><b>Profil Standar</b></td>
                                        <?php foreach ($std as $row) : ?>
                                            <td><?= $row['nilaiprofil_std']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                </tfoot>
                            </table>

                    </div>
                </div>
            </div>
            <!-- /. col-md-8 -->

            <div class="col-md-12">

                <button type="submit" name="hasil" class="btn btn-primary btn-block mt-2">Hitung</button>
                </form>
                <!-- /. form -->

                <hr>

                <?php if (isset($_POST['hasil'])) : ?>

                    <!-- table pemetaan gap -->
                    <div class="card">
                        <div class="card-header badge-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="display-6">Tabel Pemetaan GAP</div>
                                </div>
                                <div class="col-md-6 ">
                                    <button type="button" data-toggle="modal" data-target="#modalBobot" class="btn btn-sm btn-info float-right">Keterangan Bobot Penilaian</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pb-2 mb-0">
                            <form action="peringkat.php" method="post">
                                <table class="table table-hover table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Bobot IPK</th>
                                            <th>Bobot Penghasilan Ortu</th>
                                            <th>Bobot Jumlah Tanggungan</th>
                                            <th>Bobot Semester</th>
                                            <th>NCF</th>
                                            <th>NSF</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($mahasiswa as $data) : ?>
                                            <?php
                                            // nilai profil mhs dikurangi nilai profil standar yang telah ditetapkan
                                            $bobot_ipk = $data['profil_ipk'] - $std[0]['nilaiprofil_std'];
                                            $bobot_pOrtu = $data['profil_penghasilanortu'] - $std[1]['nilaiprofil_std'];
                                            $bobot_tanggungan =  $data['profil_tanggungan'] - $std[2]['nilaiprofil_std'];
                                            $bobot_semester = $data['profil_semester'] - $std[3]['nilaiprofil_std'];

                                            // pembobotan (note: buat tabel baru di database)
                                            // bobot = [0, 1, -1, 2, -2, 3, -3, 4, -4];
                                            // cek selisih > Set nilai bobot
                                            switch ($bobot_ipk) {
                                                case 0:
                                                    $ipk_bobot = 5;
                                                    break;
                                                case 1:
                                                    $ipk_bobot = 4.5;
                                                    break;
                                                case -1:
                                                    $ipk_bobot = 4;
                                                    break;
                                                case 2:
                                                    $ipk_bobot = 3.5;
                                                    break;
                                                case -2:
                                                    $ipk_bobot = 3;
                                                    break;
                                                case 3:
                                                    $ipk_bobot = 2.5;
                                                    break;
                                                case -3:
                                                    $ipk_bobot = 2;
                                                    break;
                                                case 4:
                                                    $ipk_bobot = 1.5;
                                                    break;
                                                case -4:
                                                    $ipk_bobot = 1;
                                                    break;
                                            }
                                            switch ($bobot_pOrtu) {
                                                case 0:
                                                    $pOrtu_bobot = 5;
                                                    break;
                                                case 1:
                                                    $pOrtu_bobot = 4.5;
                                                    break;
                                                case -1:
                                                    $pOrtu_bobot = 4;
                                                    break;
                                                case 2:
                                                    $pOrtu_bobot = 3.5;
                                                    break;
                                                case -2:
                                                    $pOrtu_bobot = 3;
                                                    break;
                                                case 3:
                                                    $pOrtu_bobot = 2.5;
                                                    break;
                                                case -3:
                                                    $pOrtu_bobot = 2;
                                                    break;
                                                case 4:
                                                    $pOrtu_bobot = 1.5;
                                                    break;
                                                case -4:
                                                    $pOrtu_bobot = 1;
                                                    break;
                                            }
                                            switch ($bobot_tanggungan) {
                                                case 0:
                                                    $tanggungan_bobot = 5;
                                                    break;
                                                case 1:
                                                    $tanggungan_bobot = 4.5;
                                                    break;
                                                case -1:
                                                    $tanggungan_bobot = 4;
                                                    break;
                                                case 2:
                                                    $tanggungan_bobot = 3.5;
                                                    break;
                                                case -2:
                                                    $tanggungan_bobot = 3;
                                                    break;
                                                case 3:
                                                    $tanggungan_bobot = 2.5;
                                                    break;
                                                case -3:
                                                    $tanggungan_bobot = 2;
                                                    break;
                                                case 4:
                                                    $tanggungan_bobot = 1.5;
                                                    break;
                                                case -4:
                                                    $tanggungan_bobot = 1;
                                                    break;
                                            }
                                            switch ($bobot_semester) {
                                                case 0:
                                                    $semester_bobot = 5;
                                                    break;
                                                case 1:
                                                    $semester_bobot = 4.5;
                                                    break;
                                                case -1:
                                                    $semester_bobot = 4;
                                                    break;
                                                case 2:
                                                    $semester_bobot = 3.5;
                                                    break;
                                                case -2:
                                                    $semester_bobot = 3;
                                                    break;
                                                case 3:
                                                    $semester_bobot = 2.5;
                                                    break;
                                                case -3:
                                                    $semester_bobot = 2;
                                                    break;
                                                case 4:
                                                    $semester_bobot = 1.5;
                                                    break;
                                                case -4:
                                                    $semester_bobot = 1;
                                                    break;
                                            }

                                            // nilai rata-rata untuk core dan secondary factor
                                            $ncf = ($pOrtu_bobot + $ipk_bobot) / 2;
                                            $nsf = ($tanggungan_bobot + $semester_bobot) / 2;
                                            $total = 0.6 * $ncf + 0.4 * $nsf;
                                            ?>
                                            <tr>
                                                <td><?= $data['nama']; ?></td>
                                                <td><?= $bobot_ipk; ?></td>
                                                <td><?= $bobot_pOrtu; ?></td>
                                                <td><?= $bobot_tanggungan; ?></td>
                                                <td><?= $bobot_semester; ?></td>
                                                <td><?= $ncf; ?></td>
                                                <td><?= $nsf; ?></td>
                                                <td><?= $total; ?></td>
                                            </tr>
                                            <input type="hidden" name="mhs<?= $i; ?>" value="<?= $data['id']; ?>">
                                            <input type="hidden" name="total<?= $i; ?>" value="<?= $total; ?>">
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                        <input type="hidden" name="jmlData" value="<?= count($mahasiswa) ?>">
                                    </tbody>
                                </table>

                                <!-- rangking page -->
                                <button type="submit" name="ranking" class="btn btn-primary btn-block mt-2">Cek Peringkat</button>
                            </form>
                        </div>
                    </div>


                <?php endif; ?>

            </div>
            <!-- /. col-md-12 -->

        </div>
        <!-- /. row -->

    </div>
    <!-- /.container -->

    <!-- Modal Keterangan -->
    <div class="modal fade" id="modalKet" tabindex="-1" role="dialog" aria-labelledby="modalKetTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header badge-info">
                    <h5 class="modal-title" id="modalKetTitle">Keterangan Nilai Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $kriteria = query("SELECT k.nama FROM kriteria k LEFT JOIN sub_kriteria sk ON k.id = sk.kriteria_id");
                    $sub = query("SELECT * FROM sub_kriteria ORDER BY kriteria_id ASC");
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <th>Kriteria</th>
                            <th>Sub-Kriteria</th>
                            <th>Nilai Profil</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <table>
                                        <?php foreach ($kriteria as $k) : ?>
                                            <tr>
                                                <td><?= $k['nama']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </td>
                                <hr>
                                <td>
                                    <table class="table-striped">
                                        <?php foreach ($sub as $sk) : ?>
                                            <tr>
                                                <td><?= $sk['nama']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </td>
                                <hr>
                                <td>
                                    <table class="table-striped">
                                        <?php foreach ($sub as $sk) : ?>
                                            <tr>
                                                <td><?= $sk['nilai']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Keterangan Bobot Nilai -->
    <div class="modal fade" id="modalBobot" tabindex="-1" role="dialog" aria-labelledby="modalBobotTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header badge-info">
                    <h5 class="modal-title" id="modalBobotTitle">Keterangan Bobot Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    $pembobotan = query("SELECT * FROM pembobotan");
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Selisih</th>
                            <th>Bobot Nilai</th>
                            <th>Keterangan</th>
                        </thead>
                        <tbody>
                            <?php foreach ($pembobotan as $p) : ?>
                                <tr>
                                    <td>#</td>
                                    <td><?= $p['selisih']; ?></td>
                                    <td><?= $p['bobot']; ?></td>
                                    <td><?= $p['ket']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js" integrity="sha512-7yA/d79yIhHPvcrSiB8S/7TyX0OxlccU8F/kuB8mHYjLlF1MInPbEohpoqfz0AILoq5hoD7lELZAYYHbyeEjag==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>