<div class="container-fluid footer bg-comp py-2">
  <div class="container text-center text-white smfs-6">&copy; <?php echo date('Y'); ?></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.datatable').forEach(function(table) {
        new DataTable(table);
    });
});
</script>
<script src="scripts/main.js"></script>
  </body>
</html>