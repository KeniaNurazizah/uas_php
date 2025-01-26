<?php
\session_start();
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
$dbname = "uaspw"; // Ganti dengan nama database yang Anda gunakan

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data izin mahasiswa
$sql = "SELECT id, nim_mahasiswa, alasan, tanggal_izin FROM surat_izin";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Izin Mahasiswa</title>
    <!-- Menggunakan Bootstrap CDN -->
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
    
    <!-- Tombol Tambah Data -->
    <div class="d-flex justify-content-end mb-3">
        <a href="form.php" class="btn btn-primary">Tambah Data</a>
    </div>

    <table class="table table-bordered">
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
            // Menampilkan data dari database
            if ($result && $result->num_rows > 0) {
                $no = 1; // Inisialisasi nomor urut
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $no . "</td> <!-- Menampilkan nomor urut -->
                            <td>" . htmlspecialchars($row["id"]) . "</td>
                            <td>" . htmlspecialchars($row["nim_mahasiswa"]) . "</td>
                            <td class='alasan-column'>" . htmlspecialchars($row["alasan"]) . "</td>
                            <td>" . htmlspecialchars($row["tanggal_izin"]) . "</td>
                          </tr>";
                    $no++; // Increment nomor urut
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Tidak ada data izin mahasiswa yang tersedia.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Menggunakan Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>
