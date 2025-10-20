# Sistem-Perpustakaan-Sekolah
Nama Project ini adalah : BookHaven

BookHaven adalah sebuah aplikasi berbasis website yang memberikan pelayanan berupa sistem peminjaman dan pengelolaan buku perpustakaan.

website ini dibuat menggunakan framework bootstrap, javascript, php dan database mysql.

Fitur fitur yang terdapat didalam aplikasi ini :
1. Memiliki 2 akses login, admin dan user/siswa .
2. Akses sebagai admin mendapatkan fasilitas berupa :
  - insert, update dan delete data buku
  - mencari buku berdasarkan judul dan kategori
  - mengelola data siswa yang daftar pada aplikasi
  - mengelola setiap peminjaman buku
  - mengelola setiap pengembalian buku
  - menerapkan denda jika siswa/user terlambat mengembalikan buku sesuai jadwal yang ditentukan.
3. Akses sebagai siswa mendapatkan fasilitas berupa :
  - dapat melihat isi seluruh buku yang ada dalam perpustakaan dan terdapat fitur filter buku berdasarkan kategori.
  - meminjam buku
  - mengembalikan buku
  - membayar denda

## Alur Aplikasi BookHaven

### 1. Sistem Akses dan Autentikasi

#### Portal Masuk Aplikasi
- **Landing Page** (`index.php`): Halaman utama BookHaven dengan informasi tentang perpustakaan
- **Portal Login** (`sign/link_login.html`): Interface pemilihan jenis login
  - **Admin Login** (`sign/admin/sign_in.php`): Login untuk administrator
  - **Member Login** (`sign/member/sign_in.php`): Login untuk siswa/member
  - **Member Registration** (`sign/member/sign_up.php`): Pendaftaran member baru

#### Proses Autentikasi
**Admin Authentication:**
- Input: nama_admin, password
- Validasi terhadap tabel `admin`
- Session: `$_SESSION["admin"]["nama_admin"]`

**Member Authentication:**
- Input: nama, nisn, password
- Validasi terhadap tabel `member` dengan password_verify()
- Session: `$_SESSION["member"]["nama"]` dan `$_SESSION["member"]["nisn"]`

### 2. Dashboard Admin (`DashboardAdmin/`)

#### Interface Admin
- **Main Dashboard** (`dashboardAdmin.php`): Overview statistik perpustakaan
- **Navigasi Sidebar**: Menu utama admin dengan fitur:
  - Dashboard overview
  - Manajemen buku (daftar, tambah, edit, hapus)
  - Manajemen kategori buku
  - Manajemen member/siswa
  - Manajemen peminjaman
  - Manajemen pengembalian
  - Sistem denda
  - Bantuan

#### Fitur Utama Admin

**Manajemen Buku:**
- **Daftar Buku** (`buku/daftarBuku.php`): Menampilkan semua buku dengan pencarian dan filter
- **Tambah Buku** (`buku/tambahBuku.php`): Form input buku baru dengan upload cover
- **Edit Buku** (`buku/editBuku.php`): Update informasi buku
- **Hapus Buku** (`buku/deleteBuku.php`): Menghapus buku dari sistem

**Manajemen Kategori:**
- CRUD kategori buku (bisnis, filsafat, informatika, novel, sains)

**Manajemen Member:**
- **Daftar Member** (`member/daftarMember.php`): Data semua siswa terdaftar
- **Tambah Member** (`member/tambahMember.php`): Registrasi member baru
- **Edit Member** (`member/editMember.php`): Update data member

**Transaksi Peminjaman:**
- **Daftar Peminjaman** (`peminjaman/daftarPeminjaman.php`): Riwayat peminjaman
- **Tambah Peminjaman** (`peminjaman/tambahPeminjaman.php`): Proses peminjaman baru

**Transaksi Pengembalian:**
- **Daftar Pengembalian** (`pengembalian/daftarPengembalian.php`): Riwayat pengembalian
- **Proses Pengembalian** (`pengembalian/pengembalian.php`): Input pengembalian buku

**Sistem Denda:**
- **Daftar Denda** (`denda/daftarDenda.php`): Daftar denda yang harus dibayar
- **Bayar Denda** (`denda/bayarDenda.php`): Proses pembayaran denda

### 3. Dashboard Member (`DashboardMember/`)

#### Interface Member
- **Main Dashboard** (`dashboardMember.php`): Overview status peminjaman member
- **Navigasi Menu**:
  - Dashboard overview
  - Daftar buku dengan filter kategori
  - Riwayat peminjaman
  - Status pengembalian
  - Pembayaran denda

#### Fitur Member

**Pencarian dan Penelusuran Buku:**
- **Daftar Buku** (`buku/daftarBuku.php`): Browse semua buku dengan filter kategori
- **Detail Buku** (`buku/detailBuku.php`): Informasi lengkap buku dan tombol pinjam

**Transaksi Peminjaman:**
- **Form Peminjaman** (`formPeminjaman/TransaksiPeminjaman.php`): Proses peminjaman buku
- **Riwayat Peminjaman** (`formPeminjaman/riwayatPeminjaman.php`): History peminjaman pribadi

**Pengembalian Buku:**
- **Transaksi Pengembalian** (`formPeminjaman/TransaksiPengembalian.php`): Proses pengembalian

**Denda:**
- **Transaksi Denda** (`formPeminjaman/TransaksiDenda.php`): Pembayaran denda

### 4. Struktur Database

#### Tabel Utama:
1. **`admin`**: Data administrator (id, nama_admin, password, kode_admin, no_tlp)
2. **`member`**: Data siswa/member (nisn, kode_member, nama, password, jenis_kelamin, kelas, jurusan, no_tlp, tgl_pendaftaran)
3. **`buku`**: Data buku (id_buku, kategori, judul, pengarang, penerbit, tahun_terbit, jumlah_halaman, buku_deskripsi, cover)
4. **`kategori_buku`**: Kategori buku (bisnis, filsafat, informatika, novel, sains)
5. **`peminjaman`**: Transaksi peminjaman (id_peminjaman, id_buku, nisn, id_admin, tgl_peminjaman, tgl_pengembalian)
6. **`pengembalian`**: Transaksi pengembalian (id_pengembalian, id_peminjaman, id_buku, nisn, id_admin, buku_kembali, keterlambatan, denda)

#### Relasi Database:
- `buku.kategori` → `kategori_buku.kategori` (Foreign Key)
- `peminjaman.id_buku` → `buku.id_buku` (Foreign Key)
- `peminjaman.nisn` → `member.nisn` (Foreign Key)
- `peminjaman.id_admin` → `admin.id` (Foreign Key)
- `pengembalian.id_peminjaman` → `peminjaman.id_peminjaman` (Foreign Key)

### 5. Flow Aplikasi Lengkap

#### Flow Admin:
1. **Login Admin** → Dashboard Admin
2. **Manajemen Buku**: CRUD buku dan kategori
3. **Manajemen Member**: CRUD data siswa
4. **Transaksi**:
   - Approve/Tolak peminjaman
   - Proses pengembalian buku
   - Hitung dan terapkan denda (Rp 1.000/hari keterlambatan)
5. **Monitoring**: Lihat statistik dan laporan

#### Flow Member:
1. **Login Member** → Dashboard Member
2. **Browse Buku**: Cari dan filter buku berdasarkan kategori
3. **Peminjaman**:
   - Pilih buku → Detail Buku → Pinjam Buku
   - Sistem mencatat peminjaman (7 hari batas waktu)
   - Notifikasi jika mendekati batas waktu
4. **Pengembalian**:
   - Kembalikan buku sebelum/sesudah batas waktu
   - Jika terlambat → Denda otomatis dihitung
5. **Pembayaran Denda**: Bayar denda melalui sistem

#### Flow Transaksi:
1. **Peminjaman**: Member → Pilih Buku → Admin Approve → Record ke DB
2. **Pengembalian**: Member → Kembalikan Buku → Admin Proses → Cek Keterlambatan
3. **Denda**: Jika YA (terlambat) → Hitung denda → Record ke tabel pengembalian
4. **Pembayaran**: Member bayar denda → Update status pembayaran

### 6. Teknologi Stack
- **Frontend**: HTML5, CSS3, Bootstrap 5.3.2, JavaScript, Font Awesome
- **Backend**: PHP 7.3+
- **Database**: MySQL/MariaDB
- **Web Server**: Apache (XAMPP)
- **Authentication**: PHP Session
- **Password Security**: password_hash() dan password_verify()

### 7. Fitur Keamanan
- Session-based authentication
- Password hashing untuk member
- Input validation dan sanitization
- File upload security untuk cover buku
- Role-based access control (Admin vs Member)

### 8. Konfigurasi Sistem
- **Database**: `database/perpustakaan.sql`
- **Connection**: `loginSystem/connect.php`
- **Assets**: `assets/` (logo, gambar)
- **Upload**: `imgDB/` (cover buku)

Created by Alpian - Student At SMKN 7 Samarinda
