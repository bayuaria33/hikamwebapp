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

    function validatePassword() {
        var currentPassword, newPassword, confirmPassword, output = true;

        currentPassword = document.frmChange.currentPassword;
        newPassword = document.frmChange.newPassword;
        confirmPassword = document.frmChange.confirmPassword;

        if (!currentPassword.value) {
            currentPassword.focus();
            document.getElementById("currentPassword").innerHTML = "required";
            output = false;
        } else if (!newPassword.value) {
            newPassword.focus();
            document.getElementById("newPassword").innerHTML = "required";
            output = false;
        } else if (!confirmPassword.value) {
            confirmPassword.focus();
            document.getElementById("confirmPassword").innerHTML = "required";
            output = false;
        }
        if (newPassword.value != confirmPassword.value) {
            newPassword.value = "";
            confirmPassword.value = "";
            newPassword.focus();
            document.getElementById("confirmPassword").innerHTML = "Konfirmasi Password tidak sama";
            output = false;
        }
        return output;
    }
</script>
<script>
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
            let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");
        });
    }
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".logo-details");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });
</script>

</html>