<?php
// Include database connection file
include_once("koneksi.php");

// Check if form is submitted for data update
if (isset($_POST['update'])) {
    $IDAnggota = $_POST['id_anggota'];
    $nama = $_POST['nama'];
    $TingkatKemampuan = $_POST['tingkat_kemampuan'];
    $MinatKhusus = $_POST['minat_khusus'];
    $FrekuensiKehadiran = $_POST['frekuensi_kehadiran'];

    // Update data
    $result = mysqli_query($mysqli, "UPDATE anggota SET 
        nama='$nama', 
        tingkat_kemampuan='$TingkatKemampuan', 
        minat_khusus='$MinatKhusus', 
        frekuensi_kehadiran='$FrekuensiKehadiran' 
        WHERE id_anggota=$IDAnggota");

    // Redirect to homepage
    header("Location: anggota.php");
}

// Check if id_anggota is set in URL and fetch data
if (isset($_GET['id_anggota']) && is_numeric($_GET['id_anggota'])) {
    $IDAnggota = $_GET['id_anggota'];

    // Fetch anggota data based on id_anggota
    $result = mysqli_query($mysqli, "SELECT * FROM anggota WHERE id_anggota='$IDAnggota'");

    while ($user_data = mysqli_fetch_array($result)) {
        $nama = $user_data['nama'];
        $TingkatKemampuan = $user_data['tingkat_kemampuan'];
        $MinatKhusus = $user_data['minat_khusus'];
        $FrekuensiKehadiran = $user_data['frekuensi_kehadiran'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Anggota</title>
    <style>
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
        <h2>Edit Data Anggota</h2>
        <a href="anggota.php" class="btn-home">Kembali</a>
        
        <form action="editanggota.php" method="post" name="update_user">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>" required>
            </div>

            <div class="form-group">
                <label>Tingkat Kemampuan</label>
                <input type="text" name="tingkat_kemampuan" class="form-control" value="<?php echo $TingkatKemampuan; ?>" required>
            </div>

            <div class="form-group">
                <label>Minat Khusus</label>
                <input type="text" name="minat_khusus" class="form-control" value="<?php echo $MinatKhusus; ?>" required>
            </div>

            <div class="form-group">
                <label>Frekuensi Kehadiran</label>
                <input type="text" name="frekuensi_kehadiran" class="form-control" value="<?php echo $FrekuensiKehadiran; ?>" required>
            </div>

            <div class="form-group">
                <input type="hidden" name="id_anggota" value="<?php echo $IDAnggota; ?>">
                <input type="submit" name="update" value="Update Data" class="btn-submit">
            </div>
        </form>
    </div>
</body>
</html>
