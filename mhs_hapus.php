<?php

require_once('functions.php');

$id = $_GET['id'];

if (hapusMhs(intval($id)) > 0) {
    echo "<script>
        alert('data berhasil dihapus!');
        document.location.href='mhs.php';
    </script>";
} else {
    echo "<script>
        alert('data gagal dihapus!');
        document.location.href='mhs.php';
    </script>";
}
