<?php
// Include file konfigurasi database
include_once("koneksi.php");

// Proses update data jika form disubmit
if (isset($_POST['update'])) {   
    // Ambil data dari form
    $IDkegiatan = $_POST['id_kegiatan'];
    $namakegiatan = $_POST['nama_kegiatan'];
    $tanggalkegiatan = $_POST['tanggal_kegiatan'];
    $lokasi = $_POST['lokasi'];
    
    // Query update data
    $result = mysqli_query($mysqli, "UPDATE kegiatan SET 
        nama_kegiatan='$namakegiatan', 
        tanggal_kegiatan='$tanggalkegiatan', 
        lokasi='$lokasi' 
        WHERE id_kegiatan='$IDkegiatan'");

    // Redirect ke halaman utama setelah update
    header("Location: kegiatan.php");
    exit;
}

// Memeriksa apakah id_kegiatan ada di URL
if (isset($_GET['id_kegiatan'])) {
    $IDkegiatan = $_GET['id_kegiatan'];

    // Query untuk mendapatkan data kegiatan berdasarkan id
    $result = mysqli_query($mysqli, "SELECT * FROM kegiatan WHERE id_kegiatan=$IDkegiatan");

    // Mengecek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_array($result);
        $namakegiatan = $user_data['nama_kegiatan'];
        $tanggalkegiatan = $user_data['tanggal_kegiatan'];
        $lokasi = $user_data['lokasi'];
    } else {
        echo "Kegiatan tidak ditemukan.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>  
    <title>Edit Data Kegiatan</title>
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
        <h2>Edit Data Kegiatan</h2>
        <a href="kegiatan.php" class="btn-home">Kembali</a>
        
        <form name="update_user" method="post" action="edit.php">
            <div class="form-group">
                <label>Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" class="form-control" value="<?php echo $namakegiatan; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Tanggal Kegiatan</label>
                <input type="date" name="tanggal_kegiatan" class="form-control" value="<?php echo $tanggalkegiatan; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="form-control" value="<?php echo $lokasi; ?>" required>
            </div>

            <input type="hidden" name="id_kegiatan" value="<?php echo $IDkegiatan; ?>">
            
            <div class="form-group">
                <input type="submit" name="update" value="Update" class="btn-submit">
            </div>
        </form>
    </div>
</body>
</html>
