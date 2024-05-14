<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

include("connection.php");

if (isset($_GET["nim"])) {
    $nim = $_GET["nim"];

    // Retrieve student data based on NIM
    $query = "SELECT * FROM student WHERE nim='$nim'";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_assoc($result);

    // Check if data exists
    if (!$data) {
        die("Data mahasiswa tidak ditemukan.");
    }

    // Assign data to variables
    $name = $data["name"];
} else {
    die("NIM tidak ditemukan.");
}

if (isset($_POST["confirm"])) {
    // Delete data from the database
    $query = "DELETE FROM student WHERE nim='$nim'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $message = "Data mahasiswa \"$name\" berhasil dihapus.";
        $message = urlencode($message);
        header("Location: student_view.php?message={$message}");
    } else {
        die("Query gagal dijalankan: " . mysqli_errno($connection) . " - " . mysqli_error($connection));
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hapus Data Mahasiswa</title>
    <link href="assets/style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div id="header">
            <h1 id="logo">Hapus Data Mahasiswa</h1>
        </div>
        <hr>
        <nav>
            <ul>
                <li><a href="student_view.php">Tampil</a></li>
                <li><a href="student_add.php">Tambah</a>
                <li><a href="logout.php">Logout</a>
            </ul>
        </nav>
        <h2>Konfirmasi Hapus Data Mahasiswa</h2>
        <p>Anda yakin ingin menghapus data mahasiswa <strong><?php echo $name; ?></strong>?</p>
        <form action="student_delete.php?nim=<?php echo $nim; ?>" method="post">
            <input type="submit" name="confirm" value="Ya, Hapus Data">
            <a href="student_view.php">Batal</a>
        </form>
    </div>
</body>

</html>
<?php
mysqli_close($connection);
?>
