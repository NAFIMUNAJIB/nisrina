<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $testimoni = $_POST['testimoni'];
    $gambar = null;

    // ini buat upload gambar
    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $gambar = $target_file;
        }
    }

    //  Kalau yang ini buat simpan data ke database
    $conn = new mysqli('localhost', 'root', '', 'testimoni_db');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "INSERT INTO testimoni (nama, gambar, testimoni) VALUES ('$nama', '$gambar', '$testimoni')";
    if ($conn->query($sql) === TRUE) {
        echo "Testimoni berhasil diunggah!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
