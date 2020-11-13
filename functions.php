<?php
// koneksi
$conn = mysqli_connect('localhost', 'root', '', 'db_spk_beasiswa_pma');

// fetch data
function query($query)
{
    global $conn;

    $res = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambahKriteria($data)
{
    global $conn;

    $nama = $data['nama'];
    $jenis = $data['jenis'];
    $ket = $data['ket'];

    $query = "INSERT INTO kriteria VALUES('', '$nama', '$jenis', '$ket')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusKriteria($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM kriteria WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function tambahSubKriteria($data)
{
    global $conn;

    $k_id = $data['kriteria_id'];
    $jml = $data['jmlRow'];

    for ($i = 1; $i <= $jml; $i++) {
        $nama = $data['nama' . $i];
        $nilai = $data['nilai' . $i];
        mysqli_query($conn, "INSERT INTO sub_kriteria VALUES('', '$k_id', '$nama', '$nilai') ");
    }

    return mysqli_affected_rows($conn);
}

function hapusSubKriteria($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM sub_kriteria WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function tambahMhs($data)
{
    global $conn;

    $jml = $data['jmlRow'];

    for ($i = 1; $i <= $jml; $i++) {

        $nama = $data['nama' . $i];
        $profil_a = $data['profil_a' . $i];
        $profil_b = $data['profil_b' . $i];
        $profil_c = $data['profil_c' . $i];
        $profil_d = $data['profil_d' . $i];

        mysqli_query($conn, "INSERT INTO mhs VALUES('', '$nama', '$profil_a', '$profil_b', '$profil_c', '$profil_d') ");
    }
    return mysqli_affected_rows($conn);
}

function hapusMhs($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM mhs WHERE id = $id");
    return mysqli_affected_rows($conn);
}
