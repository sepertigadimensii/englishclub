<?php
include_once("koneksi.php");

if (isset($_GET['id_keikutsertaan'])) {
    $IDKeikutsertaan = $_GET['id_keikutsertaan'];

    // Query untuk menghapus data keikutsertaan berdasarkan ID
    $result = mysqli_query($mysqli, "DELETE FROM keikutsertaan WHERE id_keikutsertaan=$IDKeikutsertaan");

    if ($result) {
        echo "<p>Keikutsertaan berhasil dihapus!</p>";
    } else {
        echo "<p>Gagal menghapus keikutsertaan: " . mysqli_error($mysqli) . "</p>";
    }

    // Setelah menghapus, alihkan ke halaman yang sesuai (misalnya halaman daftar keikutsertaan)
    header("Location:keikutsertaan.php");
    exit; // Pastikan untuk menghentikan eksekusi lebih lanjut setelah pengalihan
} else {
    echo "<p>ID keikutsertaan tidak ditemukan.</p>";
}
?>
