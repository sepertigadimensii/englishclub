<?php
// Include file konfigurasi database
include_once("koneksi.php");

// Proses update data jika form disubmit
if (isset($_POST['update'])) {   
    // Ambil data dari form
    $IDkeikutsertaan = $_POST['id_keikutsertaan'];
    $IDAnggota = $_POST['id_anggota'];
    $IDKegiatan = $_POST['id_kegiatan'];
    
    // Query update data keikutsertaan
    $stmt = $conn->prepare("UPDATE keikutsertaan SET id_anggota=?, id_kegiatan=? WHERE id_keikutsertaan=?");
    $stmt->bind_param("iii", $IDAnggota, $IDKegiatan, $IDkeikutsertaan);

    if ($stmt->execute()) {
        echo "<p>Keikutsertaan berhasil diperbarui!</p>";
        // Redirect ke halaman utama setelah update
        header("Location: keikutsertaan.php");
        exit;
    } else {
        echo "<p>Gagal memperbarui data: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

// Memeriksa apakah id_keikutsertaan ada di URL
if (isset($_GET['id_keikutsertaan'])) {
    $IDkeikutsertaan = $_GET['id_keikutsertaan'];

    // Query untuk mendapatkan data keikutsertaan berdasarkan id
    $stmt = $conn->prepare("SELECT * FROM keikutsertaan WHERE id_keikutsertaan=?");
    $stmt->bind_param("i", $IDkeikutsertaan);
    $stmt->execute();
    $result = $stmt->get_result();

    // Mengecek apakah data ditemukan
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $IDAnggota = $user_data['id_anggota'];
        $IDKegiatan = $user_data['id_kegiatan'];
    } else {
        echo "Keikutsertaan tidak ditemukan.";
        exit;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>  
    <title>Edit Data Keikutsertaan</title>
    <style>
        /* Styling yang sama seperti sebelumnya */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #e3f2fd;
            color: #212121;
        }

        .container {
            max-width: 600px;
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

        .btn-home {
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

        .btn-home:hover {
            background-color: #5e0095;
            transform: scale(1.05);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .btn-submit {
            background-color: #7600bc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-submit:hover {
            background-color: #5e0095;
            transform: scale(1.05);
        }

        .form-group .btn-submit {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Data Keikutsertaan</h2>
        <a href="keikutsertaan.php" class="btn-home">Kembali</a>
        
        <form name="update_user" method="post" action="edit_keikutsertaan.php">
            <div class="form-group">
                <label>Pilih Anggota</label>
                <select name="id_anggota" class="form-control" required>
                    <?php
                    // Query untuk mengambil data anggota
                    $result_anggota = $conn->query("SELECT id_anggota, nama FROM anggota");
                    while ($row_anggota = $result_anggota->fetch_assoc()) {
                        $selected = ($row_anggota['id_anggota'] == $IDAnggota) ? "selected" : "";
                        echo "<option value='{$row_anggota['id_anggota']}' $selected>{$row_anggota['nama']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Pilih Kegiatan</label>
                <select name="id_kegiatan" class="form-control" required>
                    <?php
                    // Query untuk mengambil data kegiatan
                    $result_kegiatan = $conn->query("SELECT id_kegiatan, nama_kegiatan FROM kegiatan");
                    while ($row_kegiatan = $result_kegiatan->fetch_assoc()) {
                        $selected = ($row_kegiatan['id_kegiatan'] == $IDKegiatan) ? "selected" : "";
                        echo "<option value='{$row_kegiatan['id_kegiatan']}' $selected>{$row_kegiatan['nama_kegiatan']}</option>";
                    }
                    ?>
                </select>
            </div>

            <input type="hidden" name="id_keikutsertaan" value="<?php echo $IDkeikutsertaan; ?>">
            
            <div class="form-group">
                <input type="submit" name="update" value="Update Keikutsertaan" class="btn-submit">
            </div>
        </form>
    </div>
</body>
</html>
