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
    $kode_pesanan = $_POST["kode_pesanan"];
    $id_pelanggan = $_POST["id_pelanggan"];
    $tanggal = $_POST["tanggal"];
    $harga_paket = $_POST["harga_paket"];
    $berat_paket = $_POST["berat_paket"];
    $total_biaya = $harga_paket * $berat_paket;

    $sql = "INSERT INTO tbl_pesanan (kode_pesanan, id_pelanggan, tanggal, Harga_paket, berat_paket, Total_biaya)
            VALUES ('$kode_pesanan', '$id_pelanggan', '$tanggal', '$harga_paket', '$berat_paket', '$total_biaya')";

    if ($conn->query($sql) === TRUE) {
        header("Location: output_data.php?kode_pesanan=" . $kode_pesanan);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
