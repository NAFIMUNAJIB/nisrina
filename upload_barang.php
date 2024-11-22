<?php
$servername = "localhost"; // Sesuaikan dengan server MySQL Anda
$username = "root";        // Sesuaikan dengan username MySQL Anda
$password = "";            // Sesuaikan dengan password MySQL Anda
$dbname = "stok_barang";   // Nama database

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$namaBarang = $_POST['namaBarang'];
$jumlahBarang = $_POST['jumlahBarang'];
$kategoriBarang = $_POST['kategoriBarang'];
$deskripsi = $_POST['messageInput'];
$gambar = $_FILES['imageUpload']['name'];
$nisSiswa = $_POST['nisSiswa'];  // Ambil NIS Siswa dari form

// Direktori tempat menyimpan gambar
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);

// Cek apakah file gambar berhasil diupload
if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
    // Query untuk memasukkan data ke tabel barang, termasuk kolom NIS
    $sql = "INSERT INTO barang (nama_barang, deskripsi, jumlah, kategori, gambar, nis)
            VALUES ('$namaBarang', '$deskripsi', '$jumlahBarang', '$kategoriBarang', '$gambar', '$nisSiswa')";

    // Eksekusi query dan cek apakah berhasil
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Sorry, there was an error uploading your file.";
}

// Tutup koneksi
$conn->close();
?>
