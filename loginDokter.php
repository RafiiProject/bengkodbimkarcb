<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'koneksi.php';
include_once 'navbar.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menggunakan prepared statement
    $stmt = $mysqli->prepare("SELECT * FROM dokter WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id_user'];
            $_SESSION['akses'] = $row['role']; // Set role untuk digunakan di sidebar

            // Redirect berdasarkan role
            if ($row['role'] == 'dokter') {
                header("Location: dashboard_dokter.php");
            } else {
                header("Location: loginDokter.php");
            }
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #517f5a;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .login-container {
            display: flex;
            max-width: 1200px;
            margin: auto;
            background-color: #fff;
            color: #00000;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .left-container {
            flex: 1;
            overflow: hidden;
        }

        .left-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .right-container {
            flex: 1;
            padding: 40px;
        }

        .login-form {
            max-width: 400px;
            margin: 0 auto;
        }

        .login-form h2 {
            text-align: center;
        }

        .login-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: none;
            border-bottom: 1px solid #ccc;
            outline: none;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #588163;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a {
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php include_once 'navbar.php'; ?>

    <div class="login-container">
        <div class="left-container">
            <img src="assets/images/logo_poli.jpg" alt="Login Image">
        </div>
        <div class="right-container">
            <div class="login-form">
                <h4 class="text-center">Login</h4>
                <p class="login-box-msg text-center">Lakukan login <b class="text-success">DOKTER</b></p>
                <br><br>
                <form action="checkLoginDokter.php" method="post">
                    <label for="nama">Username :</label>
                    <input type="text" class="form-control" name="username" required>

                    <label for="no_hp">Password :</label>
                    <input type="password" class="form-control" name="password" required>

                    <button type="submit" class="btn btn-block btn-success">
                        Masuk
                    </button>
                </form>
            </div>
            <div class="text-center mt-3">
                <a href="register.php"><span class="text-primary">Belum Punya Akun? klik disini</span></a>
            </div>
        </div>
    </div>

    <?php if ($error): ?>
        <script>
            Swal.fire('Error', '<?php echo $error; ?>', 'error');
        </script>
    <?php endif; ?>
</body>
</html>
