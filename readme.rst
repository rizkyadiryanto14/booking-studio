Sistem Informasi Booking Studio - Motomesa.id
=============================================

Project ini merupakan aplikasi booking studio untuk Motomesa.id yang memudahkan pengelolaan pemesanan dan pembayaran secara online. Dibangun menggunakan framework Codeigniter 3 dengan backend MySQL dan PHP 8.0.

Teknologi yang Digunakan
-------------------------
- **Codeigniter 3**
- **MySQL**
- **PHP 8.0**

Fitur
-----
**Admin**
- Kelola Studio: Tambah, ubah, dan hapus informasi studio.
- Kelola Jadwal: Atur jadwal ketersediaan studio.
- Kelola Users: Manajemen pengguna aplikasi.

**Laporan & Statistik**
- Kelola Laporan Pembayaran: Lihat dan kelola laporan transaksi pembayaran.
- Kelola Laporan Pemesanan: Pantau laporan pemesanan studio.
- Laporan Statistik Pendapatan: Lihat statistik pendapatan dari penyewaan studio.
- Laporan Studio Terfavorit: Laporan studio dengan pemesanan terbanyak.

Sistem Pembayaran Terintegrasi
------------------------------
Proyek ini telah terintegrasi dengan payment gateway **Midtrans** untuk memfasilitasi pembayaran online secara aman dan cepat.

Cara Installasi
---------------
1. Clone repository ini
   ::
   
      git clone https://github.com/username/repo-name.git

2. Jalankan ``composer install`` untuk menginstal dependencies.
3. Atur konfigurasi database di ``application/config/database.php``.
4. Jalankan migrasi database
   ::
   
      php index.php migrate

5. Siapkan API key dari Midtrans dan konfigurasikan di file environment.

Screenshots
-----------
.. image:: path/to/dashboard_screenshot.png
   :alt: Dashboard Admin

*Contoh tampilan Dashboard Admin*

.. image:: path/to/payment_report_screenshot.png
   :alt: Laporan Pembayaran

*Contoh tampilan Laporan Pembayaran*

---

Dibuat dengan ❤️ oleh Tim Motomesa.id
