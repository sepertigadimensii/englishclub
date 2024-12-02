<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Keikutsertaan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #e3f2fd;
            color: #212121;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #7600bc;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .btn-add {
            display: inline-block;
            padding: 12px 24px;
            background-color: #7600bc;
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 15px;
            transition: transform 0.2s, background-color 0.3s;
        }

        .btn-add:hover {
            background-color: #5f00a0;
            transform: scale(1.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fafafa;
        }

        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 2px solid #e0e0e0;
        }

        th {
            background-color: #7600bc;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        tr:hover {
            background-color: #ffffff;
        }

        .action-links a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
            margin-right: 8px;
            transition: background-color 0.3s;
        }

        .edit-btn {
            background-color: #DDA0DD;
            color: white;
        }

        .delete-btn {
            background-color: #FF69B4;
            color: white;
        }

        .edit-btn:hover {
            background-color: #DDA0DD;
        }

        .delete-btn:hover {
            background-color: #FF69B4;
        }

        /* Gaya untuk form dropdown */
        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            color: #333;
            background-color: #fafafa;
            border: 2px solid #bbb;
            border-radius: 6px;
            margin-bottom: 15px;
            box-sizing: border-box;
            transition: border-color 0.3s, background-color 0.3s;
        }

        select:focus {
            border-color: #7600bc;
            background-color: #ffffff;
        }

        button[type="submit"] {
            padding: 12px 24px;
            background-color: #7600bc;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button[type="submit"]:hover {
            background-color: #5f00a0;
            transform: scale(1.05);
        }
    </style>
<?php
include_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi input
    $IDAnggota = isset($_POST['id_anggota']) ? $_POST['id_anggota'] : null;
    $IDkegiatan = isset($_POST['id_kegiatan']) ? $_POST['id_kegiatan'] : null;

    if ($IDAnggota && $IDkegiatan) {
        // Menggunakan prepared statement untuk menghindari SQL injection
        $stmt = $conn->prepare("INSERT INTO keikutsertaan (id_anggota, id_kegiatan) VALUES (?, ?)");
        $stmt->bind_param("ii", $IDAnggota, $IDkegiatan);

        if ($stmt->execute()) {
            echo "<p>Keikutsertaan berhasil ditambahkan!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Data tidak valid. Harap isi semua field.</p>";
    }
}

// Proses penghapusan data
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM keikutsertaan WHERE id_keikutsertaan = ?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<p>Keikutsertaan berhasil dihapus!</p>";
    } else {
        echo "<p>Gagal menghapus data: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<h2>Tambah Keikutsertaan</h2>
<form method="POST">
    <label>Pilih Anggota:</label><br>
    <select name="id_anggota" required>
        <option value="">-Pilih Anggota-</option>
        <?php
        if ($conn) {
            $result_anggota = $conn->query("SELECT id_anggota, nama FROM anggota");
            if ($result_anggota) {
                while ($row_anggota = $result_anggota->fetch_assoc()) {
                    echo "<option value='{$row_anggota['id_anggota']}'>{$row_anggota['nama']}</option>";
                }
            } else {
                echo "<option value=''>Data tidak tersedia</option>";
            }
        } else {
            echo "<option value=''>Koneksi ke database gagal</option>";
        }
        ?>
    </select><br><br>

    <label>Pilih Kegiatan:</label><br>
    <select name="id_kegiatan" required>
        <option value="">-Pilih Kegiatan-</option>
        <?php
        if ($conn) {
            $result_kegiatan = $conn->query("SELECT id_kegiatan, nama_kegiatan FROM kegiatan");
            if ($result_kegiatan) {
                while ($row_kegiatan = $result_kegiatan->fetch_assoc()) {
                    echo "<option value='{$row_kegiatan['id_kegiatan']}'>{$row_kegiatan['nama_kegiatan']}</option>";
                }
            } else {
                echo "<option value=''>Data tidak tersedia</option>";
            }
        } else {
            echo "<option value=''>Koneksi ke database gagal</option>";
        }
        ?>
    </select><br><br>

    <button type="submit">Simpan Keikutsertaan</button>
    <a href="index.html" class="btn-add">Home</a>
</form>

<h2>Daftar Keikutsertaan</h2>
<table border="1">
    <tr>
        <th>ID Keikutsertaan</th>
        <th>Nama Anggota</th>
        <th>Nama Kegiatan</th>
        <th>Aksi</th>
    </tr>
    <?php
    // Query untuk menampilkan data keikutsertaan
    $sql = "
        SELECT k.id_keikutsertaan, a.nama AS nama_anggota, kg.nama_kegiatan
        FROM keikutsertaan k
        JOIN anggota a ON k.id_anggota = a.id_anggota
        JOIN kegiatan kg ON k.id_kegiatan = kg.id_kegiatan
    ";

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['id_keikutsertaan']}</td>
                    <td>{$row['nama_anggota']}</td>
                    <td>{$row['nama_kegiatan']}</td>
                    <td>
                        <a href='editserta.php?id={$row['id_keikutsertaan']}'>Edit</a> |
                        <a href='?delete_id={$row['id_keikutsertaan']}' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Delete</a>
                    </td>
                </tr>
            ";
        }
    } else {
        echo "<tr><td colspan='4'>Tidak ada data keikutsertaan.</td></tr>";
    }
    ?>
</table>
</html>