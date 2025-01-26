<?php
session_start();
if (!isset($_SESSION['login'])) {
    if ($_SESSION['login'] != true) {
        header("Location: login.php");
        exit;
    }
}
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "uaspw"; // Ganti dengan nama database Anda

$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses jika formulir dikirim
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) { // Periksa apakah tombol submit diklik
    $nim_mahasiswa = $_POST['nim_mahasiswa'];
    $alasan = $_POST['alasan'];
    $tanggal_izin = $_POST['tanggal_izin'];

    // Simpan ke database
    $sql = "INSERT INTO surat_izin (nim_mahasiswa, alasan, tanggal_izin) 
            VALUES ('$nim_mahasiswa', '$alasan', '$tanggal_izin')";
    if ($conn->query($sql) === TRUE) {
        $message = "Data berhasil disimpan!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Izin Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f1f9;
            color: #6a3d94;
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
        .btn-primary {
            background-color: #6a3d94;
            border-color: #6a3d94;
        }
        .btn-primary:hover {
            background-color: #5a2e79;
            border-color: #5a2e79;
        }
        .btn-secondary {
            background-color: #d1c6e0;
            border-color: #d1c6e0;
        }
        .btn-secondary:hover {
            background-color: #b8a9ce;
            border-color: #b8a9ce;
        }
        .alert-success {
            background-color: #e6e1f4;
            color: #6a3d94;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Form Izin Mahasiswa</h2>

        <!-- Tampilkan pesan jika ada -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Formulir -->
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="nim_mahasiswa" class="form-label">NIM Mahasiswa:</label>
                <input type="text" id="nim_mahasiswa" name="nim_mahasiswa" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="alasan" class="form-label">Alasan:</label>
                <textarea id="alasan" name="alasan" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="tanggal_izin" class="form-label">Tanggal Izin:</label>
                <input type="date" id="tanggal_izin" name="tanggal_izin" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100 mb-3">Kirim</button>
        </form>

        <!-- Tombol Lihat Data -->
        <a href="index.php" class="btn btn-secondary w-100">Lihat Data</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>