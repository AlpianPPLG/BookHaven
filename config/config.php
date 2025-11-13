<?php
// =========================
// File konfigurasi koneksi database dan fungsi utama aplikasi
// =========================

// Konfigurasi koneksi database
$host = "127.0.0.1"; // Host database
$username = "root"; // Username database
$password = ""; // Password database
$database_name = "sistem-perpustakaan"; // Nama database
$connection = mysqli_connect($host, $username, $password, $database_name); // Membuka koneksi

// =========================
// Fungsi: Menampilkan data dari query SQL
// Parameter: $dataKategori (query SQL)
// Return: array data hasil query
function queryReadData($dataKategori) {
  global $connection;
  $result = mysqli_query($connection, $dataKategori); // Eksekusi query
  $items = [];
  while($item = mysqli_fetch_assoc($result)) {
    $items[] = $item; // Simpan setiap baris hasil ke array
  }
  return $items; // Kembalikan array hasil
}

// =========================
// Fungsi: Menambah data buku baru ke database
// Parameter: $dataBuku (array data buku)
// Return: jumlah baris yang terpengaruh (1 jika sukses, 0 jika gagal)
function tambahBuku($dataBuku) {
  global $connection;
  // Upload cover buku
  $cover = upload();
  $idBuku = htmlspecialchars($dataBuku["id_buku"]);
  $kategoriBuku = $dataBuku["kategori"];
  $judulBuku = htmlspecialchars($dataBuku["judul"]);
  $pengarangBuku = htmlspecialchars($dataBuku["pengarang"]);
  $penerbitBuku = htmlspecialchars($dataBuku["penerbit"]);
  $tahunTerbit = $dataBuku["tahun_terbit"];
  $jumlahHalaman = $dataBuku["jumlah_halaman"];
  $deskripsiBuku = htmlspecialchars($dataBuku["buku_deskripsi"]);
  // Jika upload cover gagal
  if(!$cover) {
    return 0;
  }
  // Query insert data buku
  $queryInsertDataBuku = "INSERT INTO buku VALUES('$cover', '$idBuku', '$kategoriBuku', '$judulBuku', '$pengarangBuku', '$penerbitBuku', '$tahunTerbit', $jumlahHalaman, '$deskripsiBuku')";
  mysqli_query($connection, $queryInsertDataBuku);
  return mysqli_affected_rows($connection);
}

// =========================
// Fungsi: Upload file cover buku
// Return: nama file cover jika sukses, 0 jika gagal
function upload() {
  $namaFile = $_FILES["cover"]["name"];
  $ukuranFile = $_FILES["cover"]["size"];
  $error = $_FILES["cover"]["error"];
  $tmpName = $_FILES["cover"]["tmp_name"];
  
  // cek apakah ada gambar yg diupload
  if($error === 4) {
    echo "<script>
    alert('Silahkan upload cover buku terlebih dahulu!')
    </script>";
    return 0;
  }
  
  // cek kesesuaian format gambar
  $jpg = "jpg";
  $jpeg = "jpeg";
  $png = "png";
  $svg = "svg";
  $bmp = "bmp";
  $psd = "psd";
  $tiff = "tiff";
  $formatGambarValid = [$jpg, $jpeg, $png, $svg, $bmp, $psd, $tiff];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  
  if(!in_array($ekstensiGambar, $formatGambarValid)) {
    echo "<script>
    alert('Format file tidak sesuai');
    </script>";
    return 0;
  }
  
  // batas ukuran file
  if($ukuranFile > 2000000) {
    echo "<script>
    alert('Ukuran file terlalu besar!');
    </script>";
    return 0;
  }
  
   //generate nama file baru, agar nama file tdk ada yg sama
  $namaFileBaru = uniqid();
  $namaFileBaru .= ".";
  $namaFileBaru .= $ekstensiGambar;
  
  move_uploaded_file($tmpName, '../../imgDB/' . $namaFileBaru);
  return $namaFileBaru;
} 

// =========================
// Fungsi: Mencari data buku, member, atau pengembalian berdasarkan keyword
// Parameter: $keyword (string yang dicari)
// Return: array data hasil pencarian
function search($keyword): array
{
  // search data buku
  $querySearch = "SELECT * FROM buku 
  WHERE
  judul LIKE '%$keyword%' OR
  kategori LIKE '%$keyword%'
  ";
  return queryReadData($querySearch);
  
  // search data pengembalian || member
  $dataPengembalian = "SELECT * FROM pengembalian 
  WHERE 
  id_pengembalian '%$keyword%' OR
  id_buku LIKE '%$keyword%' OR
  judul LIKE '%$keyword%' OR
  kategori LIKE '%$keyword%' OR
  nisn LIKE '%$keyword%' OR
  nama LIKE '%$keyword%' OR
  nama_admin LIKE '%$keyword%' OR
  tgl_pengembalian LIKE '%$keyword%' OR
  keterlambatan LIKE '%$keyword%' OR
  denda LIKE '%$keyword%'";
  return queryReadData($dataPengembalian);
}

// =========================
// Fungsi: Mencari data member berdasarkan keyword
// Parameter: $keyword (string yang dicari)
// Return: array data hasil pencarian
function searchMember ($keyword) {
     // search member terdaftar || admin
   $searchMember = "SELECT * FROM member WHERE 
   nisn LIKE '%$keyword%' OR 
   kode_member LIKE '%$keyword%' OR
   nama LIKE '%$keyword%' OR 
   jurusan LIKE '%$keyword%'
   ";
   return queryReadData($searchMember);
}


// =========================
// Fungsi: Menghapus data buku berdasarkan ID
// Parameter: $bukuId (ID buku yang akan dihapus)
// Return: jumlah baris yang terpengaruh (1 jika sukses, 0 jika gagal)
function delete($bukuId) {
  global $connection;
  $queryDeleteBuku = "DELETE FROM buku WHERE id_buku = '$bukuId'
  ";
  mysqli_query($connection, $queryDeleteBuku);
  
  return mysqli_affected_rows($connection);
}

// =========================
// Fungsi: Memperbarui data buku
// Parameter: $dataBuku (array data buku yang diperbarui)
// Return: jumlah baris yang terpengaruh (1 jika sukses, 0 jika gagal)
function updateBuku($dataBuku) {
  global $connection;

  $gambarLama = htmlspecialchars($dataBuku["coverLama"]);
  $idBuku = htmlspecialchars($dataBuku["id_buku"]);
  $kategoriBuku = $dataBuku["kategori"];
  $judulBuku = htmlspecialchars($dataBuku["judul"]);
  $pengarangBuku = htmlspecialchars($dataBuku["pengarang"]);
  $penerbitBuku = htmlspecialchars($dataBuku["penerbit"]);
  $tahunTerbit = $dataBuku["tahun_terbit"];
  $jumlahHalaman = $dataBuku["jumlah_halaman"];
  $deskripsiBuku = htmlspecialchars($dataBuku["buku_deskripsi"]);
  
  
  // pengecekan mengganti gambar || tidak
  if($_FILES["cover"]["error"] === 4) {
    $cover = $gambarLama;
  }else {
    $cover = upload();
  }
  
  $queryUpdate = "UPDATE buku SET 
  cover = '$cover',
  id_buku = '$idBuku',
  kategori = '$kategoriBuku',
  judul = '$judulBuku',
  pengarang = '$pengarangBuku',
  penerbit = '$penerbitBuku',
  tahun_terbit = '$tahunTerbit',
  jumlah_halaman = $jumlahHalaman,
  buku_deskripsi = '$deskripsiBuku'
  WHERE id_buku = '$idBuku'
  ";
  
  mysqli_query($connection, $queryUpdate);
  return mysqli_affected_rows($connection);
}

// =========================
// Fungsi: Menghapus data member berdasarkan NISN
// Parameter: $nisnMember (NISN member yang akan dihapus)
// Return: jumlah baris yang terpengaruh (1 jika sukses, 0 jika gagal)
function deleteMember($nisnMember) {
  global $connection;
  
  $deleteMember = "DELETE FROM member WHERE nisn = $nisnMember";
  mysqli_query($connection, $deleteMember);
  return mysqli_affected_rows($connection);
}

// =========================
// Fungsi: Menghapus data pengembalian buku berdasarkan ID pengembalian
// Parameter: $idPengembalian (ID pengembalian yang akan dihapus)
// Return: jumlah baris yang terpengaruh (1 jika sukses, 0 jika gagal)
function deleteDataPengembalian($idPengembalian) {
  global $connection;
  
  $deleteDataPengembalianBuku = "DELETE FROM pengembalian WHERE id_pengembalian = $idPengembalian";
  mysqli_query($connection, $deleteDataPengembalianBuku);
  return mysqli_affected_rows($connection);
}

// =========================
// Fungsi: Meminjam buku
// Parameter: $dataBuku (array data peminjaman buku)
// Return: jumlah baris yang terpengaruh (1 jika sukses, 0 jika gagal)
function pinjamBuku($dataBuku) {
  global $connection;
  
  $idBuku = $dataBuku["id_buku"];
  $nisn = $dataBuku["nisn"];
  $idAdmin = $dataBuku["id"];
  $tglPinjam = $dataBuku["tgl_peminjaman"];
  $tglKembali = $dataBuku["tgl_pengembalian"];
  // cek apakah user memiliki denda 
  $cekDenda = mysqli_query($connection, "SELECT denda FROM pengembalian WHERE nisn = $nisn && denda > 0");
  if(mysqli_num_rows($cekDenda) > 0) {
    $item = mysqli_fetch_assoc($cekDenda);
    $jumlahDenda = $item["denda"];
    if($jumlahDenda > 0) {
       echo "<script>
       alert('Anda belum melunasi denda, silahkan lakukan pembayaran terlebih dahulu !');
       </script>";
       return 0;
    }
  }
  // cek batas user meminjam buku berdasarkan nisn
  $nisnResult = mysqli_query($connection, "SELECT nisn FROM peminjaman WHERE nisn = $nisn");
  if(mysqli_fetch_assoc($nisnResult)) {
    echo "<script>
    alert('Anda sudah meminjam buku, Harap kembalikan dahulu buku yg anda pinjam!');
    </script>";
    return 0;
  }
  
  $queryPinjam = "INSERT INTO peminjaman VALUES(null, '$idBuku', $nisn, $idAdmin, '$tglPinjam', '$tglKembali')";
  mysqli_query($connection, $queryPinjam);
  return mysqli_affected_rows($connection);
}

// =========================
// Fungsi: Mengembalikan buku
// Parameter: $dataBuku (array data pengembalian buku)
// Return: jumlah baris yang terpengaruh (1 jika sukses, 0 jika gagal)
function pengembalian($dataBuku) {
  global $connection;
  
  // Variabel pengembalian
  $idPeminjaman = $dataBuku["id_peminjaman"];
  $idBuku = $dataBuku["id_buku"];
  $nisn = $dataBuku["nisn"];
  $idAdmin = $dataBuku["id_admin"];
  $tenggatPengembalian = $dataBuku["tgl_pengembalian"];
  $bukuKembali = $dataBuku["buku_kembali"];
  $keterlambatan = $dataBuku["keterlambatan"];
  $denda = $dataBuku["denda"];
  
  if($bukuKembali > $tenggatPengembalian) {
    echo "<script>
    alert('Anda terlambat mengembalikan buku, harap bayar denda sesuai dengan jumlah yang ditentukan!');
    </script>";
  }
  
  // Menghapus data siswa yang sudah mengembalikan buku
  $hapusDataPeminjam = "DELETE FROM peminjaman WHERE id_peminjaman = $idPeminjaman";

  // Memasukkan data kedalam tabel pengembalian
  $queryPengembalian = "INSERT INTO pengembalian VALUES(null, $idPeminjaman, '$idBuku', $nisn, $idAdmin, '$bukuKembali', '$keterlambatan', $denda)";

  
  mysqli_query($connection, $hapusDataPeminjam);
  mysqli_query($connection, $queryPengembalian);
  return mysqli_affected_rows($connection);
}

// =========================
// Fungsi: Membayar denda
// Parameter: $data (array data pembayaran denda)
// Return: jumlah baris yang terpengaruh (1 jika sukses, 0 jika gagal)
function bayarDenda($data) {
  global $connection;
  $idPengembalian = $data["id_pengembalian"];
  $jmlDenda = $data["denda"];
  $jmlDibayar = $data["bayarDenda"];
  $calculate = $jmlDenda - $jmlDibayar;

  $bayarDenda = "UPDATE pengembalian SET denda = $calculate WHERE id_pengembalian = $idPengembalian";
  mysqli_query($connection, $bayarDenda);
  return mysqli_affected_rows($connection);
}

// Check database connection
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}

// =========================
// DASHBOARD STATISTICS FUNCTIONS
// =========================

// =========================
// Fungsi: Mengambil total anggota terdaftar
// Return: jumlah total anggota
function getTotalMembers() {
  global $connection;
  if (!$connection) return 0;

  $query = "SELECT COUNT(*) as total FROM member";
  $result = mysqli_query($connection, $query);

  if (!$result) return 0;

  $data = mysqli_fetch_assoc($result);
  return $data['total'] ?? 0;
}

// =========================
// Fungsi: Mengambil total buku terdaftar
// Return: jumlah total buku
function getTotalBooks() {
  global $connection;
  if (!$connection) return 0;

  $query = "SELECT COUNT(*) as total FROM buku";
  $result = mysqli_query($connection, $query);

  if (!$result) return 0;

  $data = mysqli_fetch_assoc($result);
  return $data['total'] ?? 0;
}

// =========================
// Fungsi: Mengambil jumlah pinjaman aktif
// Return: jumlah total pinjaman aktif
function getActiveLoans() {
  global $connection;
  if (!$connection) return 0;

  $query = "SELECT COUNT(*) as total FROM peminjaman p
            WHERE NOT EXISTS (
                SELECT 1 FROM pengembalian pe
                WHERE pe.id_peminjaman = p.id_peminjaman
            )";
  $result = mysqli_query($connection, $query);

  if (!$result) return 0;

  $data = mysqli_fetch_assoc($result);
  return $data['total'] ?? 0;
}

// =========================
// Fungsi: Mengambil jumlah pengembalian hari ini
// Return: jumlah total pengembalian hari ini
function getReturnsToday() {
  global $connection;
  if (!$connection) return 0;

  $today = date('Y-m-d');
  $query = "SELECT COUNT(*) as total FROM pengembalian WHERE DATE(buku_kembali) = '$today'";
  $result = mysqli_query($connection, $query);

  if (!$result) return 0;

  $data = mysqli_fetch_assoc($result);
  return $data['total'] ?? 0;
}

// =========================
// Fungsi: Mengambil total denda yang belum dibayar
// Return: jumlah total denda
function getTotalFines() {
  global $connection;
  if (!$connection) return 0;

  $query = "SELECT COALESCE(SUM(denda), 0) as total FROM pengembalian WHERE denda > 0";
  $result = mysqli_query($connection, $query);

  if (!$result) return 0;

  $data = mysqli_fetch_assoc($result);
  return $data['total'] ?? 0;
}

// =========================
// Fungsi: Memformat angka ke dalam bentuk Rupiah
// Parameter: $number (angka yang akan diformat)
// Return: string dalam format Rupiah
function formatRupiah($number): string
{
  return 'Rp ' . number_format($number, 0, ',', '.');
}

// =========================
// MEMBER DASHBOARD STATISTICS FUNCTIONS
// =========================

// =========================
// Fungsi: Mengambil jumlah buku yang sedang dipinjam oleh anggota tertentu
// Parameter: $nisn (NISN anggota)
// Return: jumlah total buku yang dipinjam
function getMemberBooksBorrowed($nisn) {
  global $connection;
  if (!$connection) return 0;

  $query = "SELECT COUNT(*) as total FROM peminjaman p
            WHERE p.nisn = $nisn AND NOT EXISTS (
                SELECT 1 FROM pengembalian pe
                WHERE pe.id_peminjaman = p.id_peminjaman
            )";
  $result = mysqli_query($connection, $query);

  if (!$result) return 0;

  $data = mysqli_fetch_assoc($result);
  return $data['total'] ?? 0;
}

// =========================
// Fungsi: Mengambil jumlah buku yang telah dikembalikan oleh anggota tertentu
// Parameter: $nisn (NISN anggota)
// Return: jumlah total buku yang telah dikembalikan
function getMemberBooksReturned($nisn) {
  global $connection;
  if (!$connection) return 0;

  $query = "SELECT COUNT(*) as total FROM pengembalian pe
            INNER JOIN peminjaman p ON pe.id_peminjaman = p.id_peminjaman
            WHERE p.nisn = $nisn";
  $result = mysqli_query($connection, $query);

  if (!$result) return 0;

  $data = mysqli_fetch_assoc($result);
  return $data['total'] ?? 0;
}

// =========================
// Fungsi: Mengambil total denda yang belum dibayar oleh anggota tertentu
// Parameter: $nisn (NISN anggota)
// Return: jumlah total denda
function getMemberTotalFines($nisn) {
  global $connection;
  if (!$connection) return 0;

  $query = "SELECT COALESCE(SUM(denda), 0) as total FROM pengembalian
            WHERE nisn = $nisn AND denda > 0";
  $result = mysqli_query($connection, $query);

  if (!$result) return 0;

  $data = mysqli_fetch_assoc($result);
  return $data['total'] ?? 0;
}

?>