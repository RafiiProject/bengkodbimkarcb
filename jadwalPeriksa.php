<!DOCTYPE html>
<?php
session_start();

// Mendapatkan data session
$id_dokter = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$id_poli = isset($_SESSION['id_poli']) ? $_SESSION['id_poli'] : null;

// Jika user belum login, arahkan ke halaman login
if (empty($username)) {
    header("location:login.php");
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Udinus Poliklinik</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <?php
        $navbar_file = __DIR__ . '/components/navbar.php';
        if (file_exists($navbar_file)) {
            include($navbar_file);
        } else {
            echo "<p style='color:red;'>Navbar file not found: $navbar_file</p>";
        }
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        $sidebar_file = __DIR__ . '/components/sidebar.php';
        if (file_exists($sidebar_file)) {
            include($sidebar_file);
        } else {
            echo "<p style='color:red;'>Sidebar file not found: $sidebar_file</p>";
        }
        ?>
        <!-- /.sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php
            $content_file = __DIR__ . '/page/jadwalPeriksa/index.php';
            if (file_exists($content_file)) {
                include($content_file);
            } else {
                echo "<p style='color:red;'>Content file not found: $content_file</p>";
            }
            ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Control Sidebar</h5>
                <p>Halo</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
</body>

</html>
