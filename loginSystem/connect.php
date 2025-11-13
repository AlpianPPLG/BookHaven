<?php
// =========================
// File koneksi database dan fungsi login system
// =========================
// Konfigurasi koneksi database untuk login system
$host = "127.0.0.1"; // Host database
$username = "root"; // Username database
$password = ""; // Password database
$database = "sistem-perpustakaan"; // Nama database
$connect = mysqli_connect($host, $username, $password, $database); // Membuka koneksi

/*
 * Fungsi: signUp
 * Deskripsi: Mendaftarkan member baru ke database
 * Parameter: $data (array data pendaftaran member)
 * Return: jumlah baris yang terpengaruh (1 jika sukses, 0 jika gagal)
 */
function signUp($data) {
  global $connect;
  // Ambil dan sanitasi data input
  $nisn = htmlspecialchars($data["nisn"]);
  $kodeMember = htmlspecialchars($data["kode_member"]);
  $nama = htmlspecialchars(strtolower($data["nama"]));
  $password = mysqli_real_escape_string($connect, $data["password"]);
  $confirmPw = mysqli_real_escape_string($connect, $data["confirmPw"]);
  $jk = htmlspecialchars($data["jenis_kelamin"]);
  $kelas = htmlspecialchars($data["kelas"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $noTlp = htmlspecialchars($data["no_tlp"]);
  $tglDaftar = $data["tgl_pendaftaran"];
  // cek nisn sudah ada / belum
  $nisnResult = mysqli_query($connect, "SELECT nisn FROM member WHERE nisn = $nisn");
  if(mysqli_fetch_assoc($nisnResult)) {
    echo "<script>alert('Nisn sudah terdaftar, silahkan gunakan nisn lain!');</script>";
    return 0;
  }
  // cek kodeMember sudah ada / belum
  $kodeMemberResult = mysqli_query($connect, "SELECT  kode_member FROM member WHERE kode_member = '$kodeMember'");
  if(mysqli_fetch_assoc($kodeMemberResult)){
    echo "<script>alert('Kode member telah terdaftar, silahkan gunakan kode member lain!');</script>";
    return 0;
  }
  // Pengecekan kesamaan confirm password dan password
  if($password !== $confirmPw) {
    echo "<script>alert('password / confirm password tidak sesuai');</script>";
    return 0;
  }
  // Enkripsi password sebelum disimpan ke database
  $password = password_hash($password, PASSWORD_DEFAULT);
  // Query insert member baru
  $querySignUp = "INSERT INTO member VALUES($nisn, '$kodeMember', '$nama', '$password', '$jk', '$kelas', '$jurusan', '$noTlp', '$tglDaftar')";
  mysqli_query($connect, $querySignUp);
  return mysqli_affected_rows($connect);
}

?>