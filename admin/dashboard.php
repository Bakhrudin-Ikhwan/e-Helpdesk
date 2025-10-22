<?php
session_start();
if(!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

// Batasi akses
$role = $_SESSION['role'];
$username = $_SESSION['username'];
?>

<!doctype html>
<html lang='en'>
<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width,initial-scale=1'>
  <title>Helpdesk - Admin</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
  <link rel='stylesheet' href='../assets/css/style.css'>
  <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
  <style>
    #it-tickets, #facility-tickets {
      max-height: 400px;
      overflow-y: auto;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      padding: 5px;
      background: #fff;
    }
    #it-tickets::-webkit-scrollbar, #facility-tickets::-webkit-scrollbar { width: 8px; }
    #it-tickets::-webkit-scrollbar-thumb, #facility-tickets::-webkit-scrollbar-thumb {
      background: #ccc;
      border-radius: 4px;
    }
    #pdf-loader {
      display: none;
      text-align: center;
      margin-top: 15px;
      color: #1b5e20;
      font-weight: 600;
    }
  </style>
</head>
<!doctype html>
<html lang='en'>
<head>
<link rel="icon" href="alhikmah1.png" type="image/png">
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width,initial-scale=1'>
  <title>Helpdesk - Admin</title>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
  <link rel='stylesheet' href='../assets/css/style.css'>
  <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>

  <style>
    #it-tickets, #facility-tickets {
      max-height: 400px;
      overflow-y: auto;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      padding: 5px;
      background: #fff;
    }

    #pdf-loader {
      display: none;
      text-align: center;
      margin-top: 15px;
      color: #1b5e20;
      font-weight: 600;
    }

    /* ===================== PRINT STYLE ===================== */
    @media print {
      body {
        background: #fff !important;
        margin: 10mm;
        font-size: 12px;
      }

      nav, .btn, .sidebar-right, .nav-tabs, #admin-alert, #pdf-loader {
        display: none !important;
      }

      #it-tickets, #facility-tickets {
        max-height: none !important;
        overflow: visible !important;
        border: 1px solid #000;
        margin-bottom: 20px;
      }

      table {
        width: 100%;
        border-collapse: collapse !important;
      }

      th, td {
        border: 1px solid #000 !important;
        padding: 6px !important;
        text-align: left;
      }

      h3 {
        text-align: center;
        font-size: 18px;
        color: #000 !important;
        margin-bottom: 20px;
      }

      @page {
        size: A4 portrait; /* ubah ke landscape kalau tabel lebar */
        margin: 10mm;
      }
    }
  </style>
</head>

<body class='bg-light'>
<div class='container-fluid'>
  <div class='row'>
    <main class='col-lg-9 col-md-8 col-12 px-5 py-4'>
      <h3 class='mb-4 text-success'>Admin - Ticket Management</h3>

      <!-- Tabs -->
      <ul class="nav nav-tabs" id="ticketTabs" role="tablist">
        <?php if($role === 'super'): ?>
        <li class="nav-item">
          <button class="nav-link active" id="it-tab" data-bs-toggle="tab" data-bs-target="#it" type="button">IT Helpdesk</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="facility-tab" data-bs-toggle="tab" data-bs-target="#facility" type="button">Facility Helpdesk</button>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <button class="nav-link active" id="facility-tab" data-bs-toggle="tab" data-bs-target="#facility" type="button">Facility Helpdesk</button>
        </li>
        <?php endif; ?>
        <li class="nav-item"><button class="nav-link" id="monitoring-tab" data-bs-toggle="tab" data-bs-target="#monitoring" type="button">Monitoring</button></li>
      </ul>

      <div class="tab-content mt-3" id="ticketTabsContent">
        <?php if($role === 'super'): ?>
        <div class="tab-pane fade show active" id="it" role="tabpanel"><div id="it-tickets"></div></div>
        <div class="tab-pane fade" id="facility" role="tabpanel"><div id="facility-tickets"></div></div>
        <?php else: ?>
        <div class="tab-pane fade show active" id="facility" role="tabpanel"><div id="facility-tickets"></div></div>
        <?php endif; ?>
        <div class="tab-pane fade" id="monitoring" role="tabpanel"><canvas id="progressChart" height="120"></canvas></div>
      </div>

      <div id='admin-alert' class='mt-3'></div>
      <div id="pdf-loader">📄 Generating PDF... Please wait</div>
    </main>

    <!-- Sidebar -->
    <aside class='col-lg-3 col-md-4 d-none d-md-block sidebar-right p-3'>
      <div class='text-center mb-3'>
        <img src='../assets/img/alhikmah1.png' class='sidebar-logo'>
        <h6 class="mt-2">AL HIKMAH</h6><small class="text-muted">IIBS BATU</small>
      </div>
      <nav class='nav flex-column'>
        <a class='nav-link' href='../index.php'>👤 User Page</a>
        <a class='nav-link text-success' href='export_excel.php'>📊 Export to Excel</a>
        <a class='nav-link text-primary' href='#' onclick='preparePrint()'>🖨️ Print Report</a>
        <a class='nav-link text-danger' href='logout.php'>🚪 Logout</a>
      </nav>
    </aside>
  </div>
</div>

<!-- Scripts -->
<script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js'></script>

<script>
function loadAdminTickets(cat, container){
  $.get('actions.php',{action:'fetch', category_type:cat}, function(data){
    $(container).html(data);
  });
}

function markDone(id, cat){
  $.post('actions.php',{action:'done', id:id}, function(){
    loadAdminTickets(cat, cat=='IT' ? '#it-tickets' : '#facility-tickets');
    $('#admin-alert').html('<div class="alert alert-success">Ticket marked as done ✅</div>');
    updateChart();
  });
}

function deleteTicket(id, cat){
  if(confirm('Are you sure to delete this ticket?')){
    $.post('actions.php',{action:'delete', id:id}, function(){
      loadAdminTickets(cat, cat=='IT' ? '#it-tickets' : '#facility-tickets');
      $('#admin-alert').html('<div class="alert alert-success">Ticket deleted ❌</div>');
      updateChart();
    });
  }
}

function updateChart(){
  $.get('actions.php',{action:'stats'}, function(data){
    let stats = JSON.parse(data);
    progressChart.data.datasets[0].data = [
      stats.it_open, stats.it_done, stats.fac_open, stats.fac_done
    ];
    progressChart.update();
  });
}

$(document).ready(function(){
  <?php if($role === 'super'): ?>
    loadAdminTickets('IT','#it-tickets');
  <?php endif; ?>
  loadAdminTickets('Facility','#facility-tickets');
  updateChart();

  $('#ticketTabs button').on('shown.bs.tab', function(e){
    let target = $(e.target).attr('data-bs-target');
    if(target=='#it') loadAdminTickets('IT','#it-tickets');
    else if(target=='#facility') loadAdminTickets('Facility','#facility-tickets');
  });
});

let ctx = document.getElementById('progressChart');
let progressChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['IT Open','IT Done','Facility Open','Facility Done'],
    datasets: [{
      label: 'Tickets',
      data: [0,0,0,0],
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)',
        'rgba(75, 192, 75, 0.5)',
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
  options: {
    responsive:true,
    scales:{ y:{ beginAtZero:true, ticks:{ stepSize:1 } } }
  }
});

// === Print Preparation ===
function preparePrint(){
  // Hilangkan scroll agar semua tiket terlihat saat dicetak
  document.querySelectorAll('#it-tickets, #facility-tickets').forEach(el=>{
    el.style.maxHeight = 'none';
    el.style.overflow = 'visible';
  });
  window.print();
}
</script>
</body>
</html>
