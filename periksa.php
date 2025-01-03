<?php
include_once("koneksi.php");

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $tgl_periksa = $_POST['tgl_periksa'];
    $catatan = $_POST['catatan'];
    $obat = $_POST['obat'];

    if ($id) {
        // Update existing record
        $query = "UPDATE periksa SET id_pasien='$id_pasien', id_dokter='$id_dokter', tgl_periksa='$tgl_periksa', catatan='$catatan', obat='$obat' WHERE id='$id'";
        mysqli_query($mysqli, $query);
    } else {
        // Insert new record
        $query = "INSERT INTO periksa (id_pasien, id_dokter, tgl_periksa, catatan, obat) VALUES ('$id_pasien', '$id_dokter', '$tgl_periksa', '$catatan', '$obat')";
        mysqli_query($mysqli, $query);
    }
    header("Location: index.php?page=periksa");
    exit();
}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($mysqli, "DELETE FROM periksa WHERE id='$id'");
    header("Location: index.php?page=periksa");
    exit();
}

$id_pasien = '';
$id_dokter = '';
$tgl_periksa = '';
$catatan = '';
$obat = '';
$id = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $ambil = mysqli_query($mysqli, "SELECT * FROM periksa WHERE id='$id'");
    $row = mysqli_fetch_array($ambil);
    $id_pasien = $row['id_pasien'];
    $id_dokter = $row['id_dokter'];
    $tgl_periksa = $row['tgl_periksa'];
    $catatan = $row['catatan'];
    $obat = $row['obat'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Periksa</title>
</head>
<body>
<div class="container">
    <br>
    <h3>Periksa</h3>
    <hr>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="mb-3">
            <label for="inputPasien" class="form-label">Pasien</label>
            <select class="form-control" name="id_pasien" required>
                <?php
                $pasien_result = mysqli_query($mysqli, "SELECT * FROM pasien");
                while ($pasien = mysqli_fetch_array($pasien_result)) {
                    $selected = ($pasien['id'] == $id_pasien) ? 'selected="selected"' : '';
                    echo "<option value='{$pasien['id']}' $selected>{$pasien['nama']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="inputDokter" class="form-label">Dokter</label>
            <select class="form-control" name="id_dokter" required>
                <?php
                $dokter_result = mysqli_query($mysqli, "SELECT * FROM dokter");
                while ($dokter = mysqli_fetch_array($dokter_result)) {
                    $selected = ($dokter['id'] == $id_dokter) ? 'selected="selected"' : '';
                    echo "<option value='{$dokter['id']}' $selected>{$dokter['nama']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="inputTanggal" class="form-label">Tanggal Periksa</label>
            <input type="datetime-local" class="form-control" name="tgl_periksa" value="<?php echo $tgl_periksa; ?>" required>
        </div>

        <div class="mb-3">
            <label for="inputCatatan" class="form-label">Catatan</label>
            <textarea class="form-control" name="catatan" ="3" placeholder="catatan" required><?php echo $catatan; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="inputObat" class="form-label">Obat</label>
            <input type="text" class="form-control" name="obat" placeholder="obat" value="<?php echo $obat; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary rounded-pill" name="simpan">Simpan</button>
    </form>

    <table class="table table-hover mt-4">
        <thead>
        <tr>
            <th>#</th>
            <th>Pasien</th>
            <th>Dokter</th>
            <th>Tanggal Periksa</th>
            <th>Catatan</th>
            <th>Obat</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = mysqli_query($mysqli, 
            "SELECT pr.*, d.nama AS 'nama_dokter', p.nama AS 'nama_pasien' 
             FROM periksa pr 
             LEFT JOIN dokter d ON pr.id_dokter = d.id 
             LEFT JOIN pasien p ON pr.id_pasien = p.id 
             ORDER BY pr.tgl_periksa DESC");

        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>{$data['nama_pasien']}</td>";
            echo "<td>{$data['nama_dokter']}</td>";
            echo "<td>{$data['tgl_periksa']}</td>";
            echo "<td>{$data['catatan']}</td>";
            echo "<td>{$data['obat']}</td>";
            echo "<td>
                    <a class='btn btn-success rounded-pill px-3' href='index.php?page=periksa&id={$data['id']}'>Ubah</a>
                    <a class='btn btn-danger rounded-pill px-3' href='index.php?page=periksa&id={$data['id']}&aksi=hapus'>Hapus</a>
                  </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
