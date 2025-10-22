$(function() {

    // === Load Ticket List ===
    function loadList(cat, container) {
      $.get('get_tickets.php', { category_type: cat }, function(html) {
        $(container).html(html);
      });
    }
  
    // === Initial Load ===
    loadList('IT', '#it-table-container');
    loadList('Facility', '#facility-table-container');
  
    // === Tab Switch ===
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
      var target = $(e.target).attr('data-bs-target');
      if (target === '#it') loadList('IT', '#it-table-container');
      else if (target === '#facility') loadList('Facility', '#facility-table-container');
      else if (target === '#monitoring') updateChart();
    });
  
    // === Submit Ticket (IT) ===
    $('#form-it').on('submit', function(e) {
      e.preventDefault();
      $.post('submit_ticket.php', $(this).serialize(), function() {
        $('#alert-it').html('<div class="alert alert-success">Ticket submitted successfully ✅</div>');
        $('#form-it')[0].reset();
        loadList('IT', '#it-table-container');
        updateChart();
      });
    });
  
    // === Submit Ticket (Facility) ===
    $('#form-facility').on('submit', function(e) {
      e.preventDefault();
      $.post('submit_ticket.php', $(this).serialize(), function() {
        $('#alert-facility').html('<div class="alert alert-success">Ticket submitted successfully ✅</div>');
        $('#form-facility')[0].reset();
        loadList('Facility', '#facility-table-container');
        updateChart();
      });
    });
  
    // === Chart Updater ===
    window.updateChart = function() {
      if (typeof progressChart !== 'undefined') {
        $.get('admin/actions.php', { action: 'stats' }, function(data) {
          let stats = JSON.parse(data);
          progressChart.data.datasets[0].data = [
            stats.it_open, stats.it_done, stats.fac_open, stats.fac_done
          ];
          progressChart.update();
        });
      }
    };
  
  });
  