<?php
include_once("koneksi.php");

$IDAnggota = $_GET['id_anggota'];
$result = mysqli_query($mysqli, "DELETE FROM anggota WHERE id_anggota=$IDAnggota");

header("Location:anggota.php");
?>