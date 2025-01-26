<?php
session_start();

// Cek jika sudah login menggunakan session
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: data_izin.php");
    exit;
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form login
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? true : false; // Cek apakah remember me dipilih

    // Query untuk mencari user berdasarkan email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Periksa password
        $users = $result->fetch_assoc();
        if ($password === $users['password']) {
            // Jika password cocok, login berhasil

            // Menyimpan data user di session
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $users['id'];
            $_SESSION['email'] = $users['email'];

            // Menyimpan email di cookie untuk 1 minggu jika remember me dipilih
            if ($remember) {
                setcookie("user_email", $users['email'], time() + (86400 * 7), "/"); // 86400 = 1 hari
            }

            // Pengalihan ke halaman form data izin
            header("Location: data_izin.php");
            exit; // Pastikan tidak ada kode lain yang dieksekusi setelah header
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Email tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f1f9;
            color: #6a3d94; /* Ungu */
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #6a3d94; /* Ungu */
        }

        .btn-primary {
            background-color: #6a3d94; /* Ungu */
            border-color: #6a3d94; /* Ungu */
        }

        .btn-primary:hover {
            background-color: #5e2b80; /* Ungu gelap */
            border-color: #5e2b80; /* Ungu gelap */
        }

        .checkbox-label {
            color: #6a3d94; /* Ungu */
        }

        .form-control {
            border-color: #6a3d94; /* Ungu */
        }

        .form-check-input:checked {
            background-color: #6a3d94; /* Ungu */
            border-color: #6a3d94; /* Ungu */
        }

        .form-check-label {
            color: #6a3d94; /* Ungu */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Login</h2>

    <form method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <!-- Checkbox Remember Me -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label checkbox-label" for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
