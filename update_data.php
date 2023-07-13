<!DOCTYPE html>
<html>
<head>
    <title>Update Data Pelanggan</title>
</head>
<body>
    <h2>Update Data Pelanggan</h2>

    <?php
    $servername = "localhost"; 
    $username = "root";
    $password = ""; 
    $dbname = "s6a_317";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_pelanggan = $_POST["id_pelanggan"];
        $Nama = $_POST["Nama"];
        $Alamat = $_POST["Alamat"];
        $no_telp = $_POST["no_telp"];

        $sql = "UPDATE tbl_pelanggan
                SET Nama='$Nama', Alamat='$Alamat', no_telp='$no_telp'
                WHERE id_pelanggan='$id_pelanggan'";

        if ($conn->query($sql) === TRUE) {
            echo "Data pelanggan berhasil diperbarui.";
            echo "<script>window.location.href = 'index.php';</script>"; 
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    if (isset($_GET["id_pelanggan"])) {
        $id_pelanggan = $_GET["id_pelanggan"];
        $sql = "SELECT * FROM tbl_pelanggan WHERE id_pelanggan='$id_pelanggan'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if ($row) {
    ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="id_pelanggan" value="<?php echo $row['id_pelanggan']; ?>">

                <label for="Nama">Nama:</label>
                <input type="text" name="Nama" value="<?php echo $row['Nama']; ?>" required><br><br>

                <label for="Alamat">Alamat:</label>
                <input type="text" name="Alamat" value="<?php echo $row['Alamat']; ?>" required><br><br>

                <label for="no_telp">No. Telepon:</label>
                <input type="text" name="no_telp" value="<?php echo $row['no_telp']; ?>" required><br><br>

                <input type="submit" value="Simpan">
            </form>
    <?php
        } else {
            echo "Data pelanggan tidak ditemukan.";
        }
    } else {
        echo "ID pelanggan tidak ditemukan.";
    }

    $conn->close();
    ?>
</body>
</html>
