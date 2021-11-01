</body>
<script>
    $('#tabledetail').dataTable({
        language: {
            searchPlaceholder: "Cari data...",
            lengthMenu: "_MENU_"
        },
        "search": {
            "addClass": 'form-control input-lg col-xs-12'
        },
        "columnDefs": [{
            "targets": 'actionbuttons',
            "searchable": false, // Stops search in the fields 
            "sorting": false, // Stops sorting
            "orderable": false // Stops ordering
        }],
        "dom": 'ft',
        "aaSorting": []
    });

    $('#tabledetail').DataTable();
</script>

</html>