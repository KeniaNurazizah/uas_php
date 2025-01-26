<?php
session_start();
if (!isset($_SESSION['login'])) {
    if ($_SESSION['login'] != true) {
        header("Location: login.php");
        exit;
    }
}
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uaspw";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data
$sql = "SELECT id, nim_mahasiswa, alasan, tanggal_izin FROM surat_izin";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Izin Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom purple theme */
        body {
            background-color: #f4f1f9;
            color: #6a3d94; /* Purple text */
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #6a3d94;
        }

        table {
            color: #6a3d94;
        }

        th, td {
            text-align: center;
        }

        .table-bordered {
            border-color: #6a3d94;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #6a3d94;
        }

        .alasan-column {
            text-align: left;
            word-wrap: break-word;
        }

        .alert-info {
            background-color: #e6e1f4;
            color: #6a3d94;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Tabel Izin Mahasiswa</h2>

    <table class="table table-bordered mt-4">
        <thead>
        <tr>
            <th>#</th> <!-- Kolom nomor urut -->
            <th>ID</th>
            <th>NIM Mahasiswa</th>
            <th>Alasan</th>
            <th>Tanggal Izin</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            $no = 1; // Inisialisasi nomor urut
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$no}</td> <!-- Menampilkan nomor urut -->
                        <td>{$row['id']}</td>
                        <td>{$row['nim_mahasiswa']}</td>
                        <td class='alasan-column'>{$row['alasan']}</td> <!-- Apply the class for left alignment -->
                        <td>{$row['tanggal_izin']}</td>
                      </tr>";
                $no++; // Increment nomor urut
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>Tidak ada data.</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <!-- Tombol Kembali -->
    <a href="form.php" class="btn btn-secondary">Kembali</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
