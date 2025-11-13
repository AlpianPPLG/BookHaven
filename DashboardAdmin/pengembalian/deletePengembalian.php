<?php 
// =========================
// Halaman hapus data pengembalian admin
// Menghapus data pengembalian berdasarkan ID
// =========================
require "../../config/config.php";
// Ambil ID pengembalian dari URL
$idPengembalian = $_GET["id"];
// Proses hapus data pengembalian
if(deleteDataPengembalian($idPengembalian) > 0) {
  // Jika berhasil
  echo "
  <script>
  alert('Data berhasil dihapus');
  document.location.href = 'pengembalianBuku.php';
  </script>";
}else {
  // Jika gagal
  echo "
  <script>
  alert('Data gagal dihapus');
  document.location.href = 'pengembalianBuku.php';
  </script>";
}
?>