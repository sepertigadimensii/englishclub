<!DOCTYPE html>
<html>
<head>
    <title>Tambahkan Data</title>
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
        <h2>Tambah Data Anggota</h2>
        <a href="anggota.php" class="btn-home">Kembali</a>
        
        <form action="addanggota.php" method="post" name="form1">
            <div class="form-group">
                <label>ID Anggota</label>
                <input type="text" name="id_anggota" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Tingkat Kemampuan</label>
                <input type="text" name="tingkat_kemampuan" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Minat Khusus</label>
                <input type="text" name="minat_khusus" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Frekuensi Kehadiran</label>
                <input type="text" name="frekuensi_kehadiran" class="form-control" required>
            </div>

            <div class="form-group">
                <input type="submit" name="Submit" value="Tambah Data" class="btn-submit">
            </div>
        </form>

        <?php
        // Check If form submitted, insert form data into table anggota
        if (isset($_POST['Submit'])) {
            $id_anggota = $_POST['id_anggota'];
            $nama = $_POST['nama'];
            $tingkat_kemampuan = $_POST['tingkat_kemampuan'];
            $minat_khusus = $_POST['minat_khusus'];
            $frekuensi_kehadiran = $_POST['frekuensi_kehadiran'];

            // Include database connection file
            include_once("koneksi.php");

            // Insert data into table anggota
            $result = mysqli_query($mysqli, "INSERT INTO anggota(id_anggota, nama, tingkat_kemampuan, minat_khusus, frekuensi_kehadiran) 
                                            VALUES('$id_anggota', '$nama', '$tingkat_kemampuan', '$minat_khusus', '$frekuensi_kehadiran')");

            // Show message when data is successfully added
            echo "<p style='color: green; text-align: center;'>Data berhasil ditambahkan! <a href='anggota.php'>Lihat Data</a></p>";
        }
        ?>
    </div>
</body>
</html>