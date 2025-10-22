<?php include 'db.php'; 
$cat=isset($_GET['category_type'])? $conn->real_escape_string($_GET['category_type']) : 'IT'; 
$res=$conn->query("SELECT * FROM tickets WHERE category_type='$cat' ORDER BY id DESC LIMIT 1000"); 
$out = '<ul>';
echo '<div class="table-responsive"><table class="table table-striped">
                <thead><tr><th>No.</th><th>Name</th><th>Status</th><th>Unit</th><th>Category</th><th>Description</th><th>Indicator</th>
                <th>Downtime</th><th>Uptime</th>
                <th>Admin Message</th><th>Action</th></tr></thead><tbody>'; 
                $no = 1;
while
    ($r=$res->fetch_assoc()){ 
        $status = $r['status']==='Open'? '<span class="badge bg-danger">Open</span>' : '<span class="badge bg-success">Closed</span>';
         echo '<tr>'; 
         echo '<td>'.$no.'</td>';
         //echo '<td>'.$r['id'].'</td>'; 
         echo '<td>'.htmlspecialchars($r['fullname']).'</td>'; 
         echo '<td>'.htmlspecialchars($r['status_pelapor']).'</td>'; 
         echo '<td>'.htmlspecialchars($r['unit']).'</td>'; 
         echo '<td>'.htmlspecialchars($r['kategori']).'</td>'; 
         echo '<td>'.htmlspecialchars($r['deskripsi']).'</td>'; 
         echo '<td>'.$status.'</td>'; 
         echo '<td>'.$r['tanggal_buat'].'</td>';
         echo '<td>'.htmlspecialchars($r['jam_penanganan']).'</td>';
         echo '<td>'.htmlspecialchars($r['pesan_admin']).'</td>'; 


         echo '<td><button class="btn btn-sm btn-success" onclick="markDone('.$r['id'].')">Done</button> <button class="btn btn-sm btn-danger" onclick="deleteTicket('.$r['id'].')">Delete</button></td>';
          echo '</tr>'; 
          $no++;
          } echo '</tbody></table></div>'; 
          $out .= '</ul>';
echo $out;
          ?>

