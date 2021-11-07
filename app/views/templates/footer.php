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

    //pay options if  = term of payment
    function paySelectCheck(paySelect) {
        console.log(paySelect);
        if (paySelect) {
            payOptionValue = document.getElementById("top").value;
            if (payOptionValue == paySelect.value) {
                document.getElementById("due_date").style.display = "block";
                document.getElementById("due_date_label").style.display = "block";
            } else {
                document.getElementById("due_date").style.display = "none";
                document.getElementById("due_date_label").style.display = "none";
                setValue("due_date", null);
            }
        } else {
            document.getElementById("due_date").style.display = "none";
            document.getElementById("due_date_label").style.display = "none";
            setValue("due_date", null);
        }
    }
</script>

</html>