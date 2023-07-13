<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "s6a_317"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


if (isset($_GET["id_pelanggan"])) {
    $id_pelanggan = $_GET["id_pelanggan"];

    $sql = "DELETE FROM tbl_pelanggan WHERE id_pelanggan='$id_pelanggan'";

    if ($conn->query($sql) === TRUE) {
        echo "Data pelanggan berhasil dihapus.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
