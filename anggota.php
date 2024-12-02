<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>
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
            background-color: #5e0095;
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

        .action-links {
    display: flex; /* Mengatur tata letak horizontal */
    gap: 10px; /* Memberikan jarak antar tombol */
}

.action-links a {
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 14px;
    color: white;
    transition: background-color 0.3s;
}

.edit-btn {
    background-color: #DDA0DD;
}

.delete-btn {
    background-color: #FF69B4;
}

.edit-btn:hover {
    background-color: #BA55D3;
}

.delete-btn:hover {
    background-color: #FF1493;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Data Anggota</h2>
        
        <a href="index.html" class="btn-add">Home</a>
        <a href="addanggota.php" class="btn-add">Tambah Data Baru</a>

        <table>
            <tr>
                <th>No</th>
                <th>ID Anggota</th>
                <th>Nama</th>
                <th>Tingkat Kemampuan</th>
                <th>Minat Khusus</th>
                <th>Frekuensi Kehadiran</th>
                <th>Aksi</th>
            </tr>
            <?php
            include_once("koneksi.php");

            $result = mysqli_query($mysqli, "SELECT * FROM anggota ORDER BY id_anggota DESC");
            $no = 1;

            while ($user_data = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$no++."</td>";
                echo "<td>".$user_data['id_anggota']."</td>";
                echo "<td>".$user_data['nama']."</td>";
                echo "<td>".$user_data['tingkat_kemampuan']."</td>";
                echo "<td>".$user_data['minat_khusus']."</td>";
                echo "<td>".$user_data['frekuensi_kehadiran']."</td>";
                echo "<td class='action-links'>
                        <a href='editanggota.php?id_anggota=$user_data[id_anggota]' class='edit-btn'>Edit</a>
                        <a href='deleteanggota.php?id_anggota=$user_data[id_anggota]' class='delete-btn' 
                           onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>
                           Hapus</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
