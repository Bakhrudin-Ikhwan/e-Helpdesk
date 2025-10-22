<?php include 'db.php'; 
if($_SERVER['REQUEST_METHOD']==='POST'){ 
    $fullname=$conn->real_escape_string($_POST['fullname']); 
    $status=$conn->real_escape_string($_POST['status']);
    $unit=$conn->real_escape_string($_POST['unit']);
    $category=$conn->real_escape_string($_POST['category']); 
    $complaint=$conn->real_escape_string($_POST['complaint']);
    $category_type=$conn->real_escape_string($_POST['category_type']);
    $sql="INSERT INTO tickets (fullname,status_pelapor,unit,kategori,deskripsi,category_type,status,tanggal_buat) VALUES ('$fullname','$status','$unit','$category','$complaint','$category_type','Open',NOW())"; 
    if($conn->query($sql)) 
    echo json_encode(['ok'=>1]); 
    else { http_response_code(500); 
    echo json_encode(['ok'=>0,'err'=>$conn->error]); } } else { http_response_code(405); } ?>