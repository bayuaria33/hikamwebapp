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
            },
            {
                "targets": 'datetime',
                "type": 'date'
            }
        ],
        "dom": '<"pull-left"f><"pull-right"l>ti<"text-left"p>',
        "aaSorting": []
    });

    $('#tabledetail').DataTable();
</script>

</html>