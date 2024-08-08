<?php
// Konfigurasi koneksi database (sesuaikan dengan informasi Anda)
$servername = "localhost"; // Biasanya 'localhost' untuk server lokal
$username = "root";        // Ganti dengan username MySQL Anda
$password = "";            // Ganti dengan password MySQL Anda
$dbname = "salutic"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli("localhost","root","","salutic");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangani pengiriman formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir (dengan validasi)
    $nama = $_POST["fullName"];
    $email = $_POST["email"];
    $tempatlahir = $_POST["tempatlahir"];
    $tgllahir = $_POST["tanggallahir"];
    $jurusan = $_POST["major"];

    // Tangani unggah berkas (pastikan direktori 'uploads' ada)
    $targetDir = "uploads/"; 
    $namaFilePasFoto = basename($_FILES["ktp"]["name"]);
    $targetFilePathPasFoto = $targetDir . $namaFilePasFoto;
    move_uploaded_file($_FILES["ktp"]["tmp_name"], $targetFilePathPasFoto);

    $namaFileKTP = basename($_FILES["ktp"]["name"]);
    $targetFilePathKTP = $targetDir . $namaFileKTP;
    move_uploaded_file($_FILES["ktp"]["tmp_name"], $targetFilePathKTP);

    $namaFileIjazah = basename($_FILES["ijazah"]["name"]);
    $targetFilePathIjazah = $targetDir . $namaFileIjazah;
    move_uploaded_file($_FILES["ijazah"]["tmp_name"], $targetFilePathIjazah);

    $namaFileFormulir = basename($_FILES["formpmb"]["name"]);
    $targetFilePathFormulir = $targetDir . $namaFileFormulir;
    move_uploaded_file($_FILES["formpendaftaran"]["tmp_name"], $targetFilePathFormulir);

    // Query SQL INSERT (sesuaikan nama tabel dan kolom)
    $sql = "INSERT INTO mahasiswa_baru (Nama_Lengkap, Email, Tempat_Lahir, Tanggal_Lahir, Program_Studi, Foto, KTP, Ijazah, Formulir) 
            VALUES ('$namaLengkap', '$email', '$tempatLahir', '$tanggalLahir', '$programStudi', '$namaFilePasFoto', '$namaFileKTP', '$namaFileIjazah', '$namaFileFormulir')";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        echo "Pendaftaran berhasil!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
