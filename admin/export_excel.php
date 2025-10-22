<?php
session_start();
if(!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

$role = $_SESSION['role'];

// Koneksi ke database
$conn = new mysqli('localhost','root','','eticketing_system');
if($conn->connect_error){ die('Koneksi gagal: ' . $conn->connect_error); }

// Optional: set charset & timezone
$conn->set_charset('utf8mb4');
date_default_timezone_set('Asia/Jakarta');

// Nama file Excel
$filename = "laporan_helpdesk_" . date('Ymd_His') . ".xls";

// Header agar browser mendownload file Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=\"$filename\"");

// Mulai output tabel
echo "<table border='1'>";
echo "<tr>
        <th>No</th>
        <th>Helpdesk</th>
        <th>Nama Pelapor</th>
        <th>Status</th>
        <th>Unit</th>
        <th>Kategori</th>
        <th>Deskripsi</th>
        <th>Downtime</th>
        <th>Uptime</th>
        <th>Status</th>
      </tr>";

// Perhatikan nama kolom di SELECT — pastikan sama dengan kolom di DB kamu
if($role === 'super') {
  $sql = "SELECT id, category_type, fullname, status_pelapor, unit, kategori, deskripsi, tanggal_buat, jam_penanganan, status FROM tickets ORDER BY id DESC";
} else {
  $sql = "SELECT id, category_type, fullname, status_pelapor, unit, kategori, deskripsi, tanggal_buat, jam_penanganan, status FROM tickets WHERE category_type='Facility' ORDER BY id DESC";
}

$res = $conn->query($sql);

// **CEK ERROR QUERY** sebelum menggunakan fetch_assoc()
if(!$res){
    // Jika ingin debugging di local, tampilkan error lalu hentikan script.
    // Karena kita sudah mengirim header excel, lebih aman mengirim teks biasa:
    header('Content-Type: text/plain; charset=UTF-8');
    die("Query error: " . $conn->error . "\nSQL: " . $sql);
}

$no = 1;
while($r = $res->fetch_assoc()){
  echo "<tr>
          <td>{$no}</td>
          <td>".htmlspecialchars($r['category_type'])."</td>
          <td>".htmlspecialchars($r['fullname'])."</td>
          <td>".htmlspecialchars($r['status_pelapor'])."</td>
          <td>".htmlspecialchars($r['unit'])."</td>
          <td>".htmlspecialchars($r['kategori'])."</td>
          <td>".htmlspecialchars($r['deskripsi'])."</td>
          <td>".htmlspecialchars($r['tanggal_buat'])."</td>
          <td>".htmlspecialchars($r['jam_penanganan'])."</td>
          <td>".htmlspecialchars($r['status'])."</td>
          

        </tr>";
  $no++;
}

echo "</table>";
$conn->close();
?>
