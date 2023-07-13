<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "s6a_317";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

function createPelanggan($conn, $id_pelanggan, $Nama, $Alamat, $no_telp)
{
    $sql = "INSERT INTO tbl_pelanggan (id_pelanggan, Nama, Alamat, no_telp)
            VALUES ('$id_pelanggan', '$Nama', '$Alamat', '$no_telp')";

    if ($conn->query($sql) === TRUE) {
        echo "Data pelanggan berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function readPelanggan($conn)
{
    $sql = "SELECT * FROM tbl_pelanggan";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID Pelanggan</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id_pelanggan"] . "</td>
                    <td>" . $row["Nama"] . "</td>
                    <td>" . $row["Alamat"] . "</td>
                    <td>" . $row["no_telp"] . "</td>
                    <td>
                        <a href='update_data.php?id_pelanggan=" . $row["id_pelanggan"] . "'>Edit</a>
                        <a href='delete_data.php?id_pelanggan=" . $row["id_pelanggan"] . "'>Hapus</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data pelanggan.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pelanggan = $_POST["id_pelanggan"];
    $Nama = $_POST["Nama"];
    $Alamat = $_POST["Alamat"];
    $no_telp = $_POST["no_telp"];

    createPelanggan($conn, $id_pelanggan, $Nama, $Alamat, $no_telp);
}

echo "<h2>Form Input Data Pelanggan</h2>";
echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>
        <label for='id_pelanggan'>ID Pelanggan:</label>
        <input type='text' name='id_pelanggan' required><br><br>

        <label for='Nama'>Nama:</label>
        <input type='text' name='Nama' required><br><br>

        <label for='Alamat'>Alamat:</label>
        <input type='text' name='Alamat' required><br><br>

        <label for='no_telp'>No. Telepon:</label>
        <input type='text' name='no_telp' required><br><br>

        <input type='submit' value='Simpan'>
    </form>";

echo "<h2>Data Pelanggan</h2>";
readPelanggan($conn);

$conn->close();
?>
