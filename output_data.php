<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "s6a_317";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$kode_pesanan = $_GET["kode_pesanan"];

$sql = "SELECT * FROM tbl_pesanan WHERE kode_pesanan='$kode_pesanan'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h2>DATA PEMESANAN</h2>";
        echo "<p>Kode Pesanan   : " . $row["kode_pesanan"] . "</p>";
        echo "<p>ID Pelanggan   : " . $row["id_pelanggan"] . "</p>";
        echo "<p>Tanggal        : " . $row["tanggal"] . "</p>";
        echo "<p>Harga Paket    : Rp " . $row["Harga_paket"] . " / Kg</p>";
        echo "<p>Berat Paket    : " . $row["berat_paket"] . " Kg</p>";
        echo "<p>Total Biaya    : Rp " . $row["Total_biaya"] . "</p>";
        echo "<p>Status         : Selesai " . $row["Status"] . "</p>";
    }
} else {
    echo "Tidak ada data pesanan.";
}

$conn->close();
?>
