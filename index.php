<?php include 'db.php'; ?>
<!doctype html>
<html lang="en">
<head>
<link rel="icon" href="alhikmah0.png" type="image/png">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Helpdesk - User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
<div class="container-fluid">
<div class="row">

  <!-- ===== MAIN CONTENT ===== -->
  <div class="col-lg-9 col-md-8 col-12 px-5 py-4">
    <div class="d-flex align-items-center mb-4">
      <img src="assets/img/alhikmah1.png" class="logo me-3">
      <div>
        <h3 class="mb-0 text-success">AL HIKMAH IIBS Batu - Helpdesk</h3>
        <small class="text-muted">Building systems Solving problems</small>
      </div>
    </div>
    
    <!-- ===== TABS ===== -->
    <ul class="nav nav-tabs mb-3 d-flex justify-content-between" id="helpdeskTabs" role="tablist">
      <div class="d-flex">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#it">IT Helpdesk</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#facility">Facility Helpdesk</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#monitoring">Monitoring</button></li>
      </div>
      <div class="nav-item">
        <a class="nav-link text-success" href="admin/login.php">Admin Login</a>
      </div>
    </ul>

    <!-- ===== TAB CONTENT ===== -->
    <div class="tab-content">
      
      <!-- === IT === -->
      <div class="tab-pane fade show active" id="it">
        <div id="alert-it"></div>
        <div class="card p-4 mb-4">
          <h5>New Ticket (IT)</h5>
          <form id="form-it">
            <input type="hidden" name="category_type" value="IT">
            <div class="mb-3"><label class="form-label">Full Name</label><input class="form-control" name="fullname" required></div>
            <div class="mb-3 row">
              <div class="col-md-4 mb-2 mb-md-0"><label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                  <option value='' disabled selected>Select status</option><option>Teacher</option><option>Staff</option><option>Student</option>
                </select>
              </div>
              <div class="col-md-4 mb-2 mb-md-0"><label class="form-label">Unit</label>
                <select name="unit" class="form-select" required>
                  <option value='' disabled selected>Select unit</option><option>SMP</option><option>SMA</option>
                </select>
              </div>
              <div class="col-md-4"><label class="form-label">Category</label>
                <select name="category" class="form-select" required>
                  <option value='' disabled selected>Select category</option><option>Internet</option><option>Device</option><option>Others</option>
                </select>
              </div>
            </div>
            <div class="mb-3"><label class="form-label">Description</label><textarea name="complaint" class="form-control" rows="4" required></textarea></div>
            <button class="btn btn-success w-100" type="submit">Submit Ticket</button>
          </form>
        </div>
        <h5>Ticket List (IT)</h5>
     
        <div class="card p-3 mb-5">
          <div class="table-scroll" id="it-table-container"></div>
        </div>
      </div>

      <!-- === FACILITY === -->
      <div class="tab-pane fade" id="facility">
        <div id="alert-facility"></div>
        <div class="card p-4 mb-4">
          <h5>New Ticket (Facility)</h5>
          <form id="form-facility">
            <input type="hidden" name="category_type" value="Facility">
            <div class="mb-3"><label class="form-label">Full Name</label><input class="form-control" name="fullname" required></div>
            <div class="mb-3 row">
              <div class="col-md-4 mb-2 mb-md-0"><label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                  <option value='' disabled selected>Select status</option><option>Teacher</option><option>Staff</option><option>Student</option>
                </select>
              </div>
              <div class="col-md-4 mb-2 mb-md-0"><label class="form-label">Unit</label>
                <select name="unit" class="form-select" required>
                  <option value='' disabled selected>Select unit</option><option>SMP</option><option>SMA</option>
                </select>
              </div>
              <div class="col-md-4"><label class="form-label">Category</label>
                <select name="category" class="form-select" required>
                  <option value='' disabled selected>Select category</option><option>Repair</option><option>Installation</option><option>Others</option>
                </select>
              </div>
            </div>
            <div class="mb-3"><label class="form-label">Description</label><textarea name="complaint" class="form-control" rows="4" required></textarea></div>
            <button class="btn btn-success w-100" type="submit">Submit Ticket</button>
          </form>
        </div>
        <h5>Ticket List (Facility)</h5>
        <div class="card p-3 mb-5">
          <div class="table-scroll" id="facility-table-container"></div>
        </div>
      </div>

      <!-- === MONITORING === -->
      <div class="tab-pane fade" id="monitoring">
        <h5>Monitoring Ticket Progress</h5>
        <canvas id="progressChart" height="100"></canvas>
      </div>
    </div>
  </div>

  <!-- ===== SIDEBAR ===== -->
  <div class="col-lg-3 col-md-4 d-none d-md-block sidebar-right p-3">
    <div class="text-center mb-4">
      <img src="assets/img/alhikmah1.png" class="sidebar-logo mb-2">
      <h6 class="mt-2">AL HIKMAH</h6><small class="text-muted">IIBS BATU</small>
    </div>
    <nav class="nav flex-column">
      <a class="nav-link" id="nav-it-link" href="#it" data-bs-toggle="tab">💻 IT Helpdesk</a>
      <a class="nav-link" id="nav-fac-link" href="#facility" data-bs-toggle="tab">🛠 Facility Helpdesk</a>
      <a class="nav-link" id="nav-mon-link" href="#monitoring" data-bs-toggle="tab">📊 Monitoring</a>
      <a class="nav-link text-danger" href="admin/login.php">🔐 Admin Login</a>
    </nav>
  </div>

</div>
</div>

<!-- ===== SCRIPTS ===== -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>

<!-- Chart Script -->
<script>
function updateChart(){
  $.get('admin/actions.php',{action:'stats'}, function(data){
    let stats = JSON.parse(data);
    progressChart.data.datasets[0].data = [
      stats.it_open, stats.it_done, stats.fac_open, stats.fac_done
    ];
    progressChart.update();
  });
}
let ctx = document.getElementById('progressChart');
let progressChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['IT Open','IT Done','Facility Open','Facility Done'],
    datasets: [{
      label: 'Tickets',
      data: [0,0,0,0],
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)', // merah - open
        'rgba(75, 192, 75, 0.5)',  // hijau - done
        'rgba(255, 99, 132, 0.5)',
        'rgba(75, 192, 75, 0.5)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(75, 192, 75, 1)',
        'rgba(255, 99, 132, 1)',
        'rgba(75, 192, 75, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {responsive:true, scales:{y:{beginAtZero:true,ticks:{stepSize:1}}}}
});
updateChart();
</script>

</body>
</html>
