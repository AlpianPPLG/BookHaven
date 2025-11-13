<?php 
// =========================
// Modul Logout Member
// Menghapus seluruh session dan mengarahkan ke halaman login member
// =========================

// Mulai session
session_start();
// Hapus semua data session
$_SESSION = [];
// Unset semua session
session_unset();
// Hancurkan session
session_destroy();

// Redirect ke halaman login member
header("Location: ../sign/member/sign_in.php");
exit;
?>