<?php
include '../db.php';

$action = $_REQUEST['action'] ?? '';
$cat = isset($_REQUEST['category_type']) ? $conn->real_escape_string($_REQUEST['category_type']) : 'All';

if($action==='fetch'){
    $where = ($cat==='All') ? '' : "WHERE category_type='$cat'";
    $res = $conn->query("SELECT * FROM tickets $where ORDER BY id DESC");

    echo "<div class='table-responsive'>
    <table class='table table-hover align-middle'>
    <thead class='table-light'>
    <tr>
      <th>ID</th><th>Name</th><th>Status</th><th>Unit</th><th>Category</th>
      <th>Description</th><th>Indicator</th><th>Downtime</th>
      <th>Uptime</th><th>Admin Message</th><th>Action</th>
    </tr></thead><tbody>";

    while($r=$res->fetch_assoc()){
        $status = $r['status']==='Open'
            ? '<span class="badge bg-danger">Open</span>'
            : '<span class="badge bg-success">Closed</span>';
        echo "<tr>
        <td>{$r['id']}</td>
        <td>".htmlspecialchars($r['fullname'])."</td>
        <td>".htmlspecialchars($r['status_pelapor'])."</td>
        <td>".htmlspecialchars($r['unit'])."</td>
        <td>".htmlspecialchars($r['kategori'])."</td>
        <td>".htmlspecialchars($r['deskripsi'])."</td>
        <td>$status</td>
        <td>{$r['tanggal_buat']}</td>
        <td>".($r['jam_penanganan'] ?? '-')."</td>
        <td>".htmlspecialchars($r['pesan_admin'] ?? '-')."</td>
        <td>
          <button class='btn btn-sm btn-success me-1' onclick=\"markDone({$r['id']}, '{$cat}')\">Done</button>
          <button class='btn btn-sm btn-danger' onclick=\"deleteTicket({$r['id']}, '{$cat}')\">Delete</button>
        </td>
        </tr>";
    }
    echo "</tbody></table></div>";
    exit;
}

elseif($action==='done'){
    $id = intval($_POST['id']);
    $jam = date('H:i:s');
    $pesan = "Your ticket has been processed by the admin.";
    $conn->query("UPDATE tickets SET status='Closed', jam_penanganan='$jam', pesan_admin='$pesan' WHERE id=$id");
    exit;
}

elseif($action==='delete'){
    $id = intval($_POST['id']);
    $conn->query("DELETE FROM tickets WHERE id=$id");
    exit;
}

elseif($action==='stats'){
    $stats = [
        'it_open' => $conn->query("SELECT id FROM tickets WHERE category_type='IT' AND status='Open'")->num_rows,
        'it_done' => $conn->query("SELECT id FROM tickets WHERE category_type='IT' AND status='Closed'")->num_rows,
        'fac_open' => $conn->query("SELECT id FROM tickets WHERE category_type='Facility' AND status='Open'")->num_rows,
        'fac_done' => $conn->query("SELECT id FROM tickets WHERE category_type='Facility' AND status='Closed'")->num_rows
    ];
    echo json_encode($stats);
    exit;
}
?>
