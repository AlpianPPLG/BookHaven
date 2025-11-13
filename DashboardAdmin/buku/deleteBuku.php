<?php 
// =========================
// Halaman hapus buku admin
// Menghapus data buku berdasarkan ID
// =========================
require "../../config/config.php";
// Ambil ID buku dari URL
$bukuId = $_GET["id"];
// Proses hapus buku
if(delete($bukuId) > 0) {
  // Jika berhasil
  echo "
  <script>
  alert('Data buku berhasil dihapus');
  document.location.href = 'daftarBuku.php';
  </script>";
}else {
  // Jika gagal
  echo "
  <script>
  alert('Data buku gagal dihapus');
  document.location.href = 'daftarBuku.php';
  </script>";
}
?>
