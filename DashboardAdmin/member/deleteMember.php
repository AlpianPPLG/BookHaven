<?php 
// =========================
// Halaman hapus member admin
// Menghapus data member berdasarkan NISN
// =========================
require "../../config/config.php";
// Ambil NISN member dari URL
$nisnMember = $_GET["id"];
// Proses hapus member
if(deleteMember($nisnMember) > 0) {
    // Jika berhasil
    echo "<script>
    alert('Member berhasil dihapus!');
    document.location.href = 'member.php';
    </script>";
  }else {
    // Jika gagal
    echo "<script>
    alert('Member gagal dihapus!');
    document.location.href = 'member.php';
    </script>";
}
?>
