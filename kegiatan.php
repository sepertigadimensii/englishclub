    <!DOCTYPE html>
    <html>
    <head>
        <title>Data Kegiatan</title>
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
                color: #ffffff;
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
                background-color: #7600bc;
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
        </style>
</head>
<body>
    <div class="container">
        <h2>Data Kegiatan</h2>
        
        <a href="index.html" class="btn-add">Home</a>
        <a href="add.php" class="btn-add">Tambah Data Baru</a>

        <table>
            <tr>
                <th>ID Kegiatan</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Kegiatan</th>
                <th>Lokasi</th>
                <th>‎ </th>
            </tr>
            <?php
            include_once("koneksi.php");

            $result = mysqli_query($mysqli, "SELECT * FROM kegiatan ORDER BY id_kegiatan DESC");

            while($user_data = mysqli_fetch_array($result)) {
                echo "<td>".$user_data['id_kegiatan']."</td>";
                echo "<td>".$user_data['nama_kegiatan']."</td>";
                echo "<td>".$user_data['tanggal_kegiatan']."</td>";
                echo "<td>".$user_data['lokasi']."</td>";
                echo "<td class='action-links'>
                        <a href='edit.php?id_kegiatan=$user_data[id_kegiatan]' class='edit-btn'>Edit</a>
                        <a href='delete.php?id_kegiatan=$user_data[id_kegiatan]' class='delete-btn' 
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
