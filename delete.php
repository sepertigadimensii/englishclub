<?php
include_once("koneksi.php");

$IDkegiatan = $_GET['id_kegiatan'];
$result = mysqli_query($mysqli, "DELETE FROM kegiatan WHERE id_kegiatan=$IDkegiatan");

header("Location:kegiatan.php");
?>