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

// Variabel untuk menampung pesan sukses atau error
$message = "";

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

        .btn-warning {
            background-color: #f39c12;
            border-color: #e67e22;
        }

        .btn-warning:hover {
            background-color: #e67e22;
            border-color: #f39c12;
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
            <th>Aksi</th>
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
                        <td class='alasan-column'>{$row['alasan']}</td>
                        <td>{$row['tanggal_izin']}</td>
                        <td>
                            <a href='?update_id={$row['id']}' class='btn btn-warning btn-sm'>Update</a>
                        </td>
                      </tr>";
                $no++; // Increment nomor urut
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>Tidak ada data.</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <!-- Tombol Kembali -->
    <a href="form.php" class="btn btn-secondary">Kembali</a>

    <?php
    // Jika tombol update ditekan, tampilkan form update
    if (isset($_GET['update_id'])) {
        $id = $_GET['update_id'];
        $sql = "SELECT * FROM surat_izin WHERE id = $id";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        if ($data) {
            ?>
            <div class="mt-5">
                <h2 class="text-center">Update Data Izin</h2>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <div class="mb-3">
                        <label for="nim_mahasiswa" class="form-label">NIM Mahasiswa</label>
                        <input type="text" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa" value="<?= isset($_POST['nim_mahasiswa']) ? $_POST['nim_mahasiswa'] : $data['nim_mahasiswa'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="alasan" class="form-label">Alasan</label>
                        <textarea name="alasan" class="form-control" id="alasan" required><?= isset($_POST['alasan']) ? $_POST['alasan'] : $data['alasan'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_izin" class="form-label">Tanggal Izin</label>
                        <input type="date" name="tanggal_izin" class="form-control" id="tanggal_izin" value="<?= isset($_POST['tanggal_izin']) ? $_POST['tanggal_izin'] : $data['tanggal_izin'] ?>" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <?php
        }
    }

    // Proses update data
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nim_mahasiswa = $_POST['nim_mahasiswa'];
        $alasan = $_POST['alasan'];
        $tanggal_izin = $_POST['tanggal_izin'];

        $sql = "UPDATE surat_izin SET nim_mahasiswa = '$nim_mahasiswa', alasan = '$alasan', tanggal_izin = '$tanggal_izin' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            // Menampilkan pesan berhasil tanpa pengalihan
            $message = "<div class='alert alert-success mt-3'>Data berhasil diperbarui.</div>";

            // Mengosongkan form setelah update berhasil
            $_POST = array();  // Clear the POST data to reset the form fields
        } else {
            $message = "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
        }
    }

    // Tampilkan pesan jika ada
    if (!empty($message)) {
        echo $message;
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
