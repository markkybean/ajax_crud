<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/themes/default.min.css" />
</head>

<body class="bg-success p-2 bg-opacity-25">

    <?php
    // Include navbar.php assuming it contains your navigation bar code
    include "navbar.php";
    ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-end">
            <a href="#" class="btn btn-dark mb-4" id="btn_add">Add New</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Birth Date</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Civil Status</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="employeeTableBody">
                    <?php
                    require_once('db_config.php');

                    $xqry = "SELECT * FROM employeefile";
                    $xstmt = $link_id->prepare($xqry);
                    $xstmt->execute();

                    while ($xrs = $xstmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($xrs["recid"]) ?></td>
                            <td><?php echo htmlspecialchars($xrs["fullname"]) ?></td>
                            <td><?php echo htmlspecialchars($xrs["address"]) ?></td>
                            <td><?php echo htmlspecialchars($xrs["birthdate"]) ?></td>
                            <td><?php echo htmlspecialchars($xrs["age"]) ?></td>
                            <td><?php echo htmlspecialchars($xrs["gender"]) ?></td>
                            <td><?php echo htmlspecialchars($xrs["civilstat"]) ?></td>
                            <td><?php echo htmlspecialchars($xrs["contactnum"]) ?></td>
                            <td><?php echo htmlspecialchars($xrs["salary"]) ?></td>
                            <td><?php echo $xrs["isactive"] ? 'Active' : 'Inactive' ?></td>
                            <td>
                                <button  class="btn btn-info btn-sm" onclick="edit_click(<?php echo $xrs['recid'] ?>)">Edit</button>
                                <!-- <a href="edit_employee.php?recid=<?php echo $xrs['recid'] ?>" class="btn btn-info btn-sm">Edit</a> -->
                                <button class="btn btn-danger btn-sm" onclick="delete_click(<?php echo $xrs['recid'] ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Add New Employee -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding new employee -->
                    <form id="addEmployeeFormModal">
                        <div class="mb-3">
                            <label for="txt_fullname" class="form-label">Full Name:</label>
                            <input type="text" class="form-control" name="txtfld[fullname]" id="txt_fullname" required>
                        </div>
                        <div class="mb-3">
                            <label for="txt_address" class="form-label">Address:</label>
                            <input type="text" class="form-control" name="txtfld[address]" id="txt_address" required>
                        </div>
                        <div class="mb-3">
                            <label for="txt_birthdate" class="form-label">Birth Date:</label>
                            <input type="date" class="form-control" name="txtfld[birthdate]" id="txt_birthdate" required>
                        </div>
                        <div class="mb-3">
                            <label for="txt_age" class="form-label">Age:</label>
                            <input type="number" class="form-control" name="txtfld[age]" id="txt_age" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="txtfld[gender]" id="rdo_male" value="Male" required>
                                <label class="form-check-label" for="rdo_male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="txtfld[gender]" id="rdo_female" value="Female" required>
                                <label class="form-check-label" for="rdo_female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="txtfld[gender]" id="rdo_other" value="Other" required>
                                <label class="form-check-label" for="rdo_other">Other</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="cbo_civilstat" class="form-label">Civil Status:</label>
                            <select class="form-select" id="cbo_civilstat" name="txtfld[civilstat]" required>
                                <option selected disabled>Choose...</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Separated">Separated</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="txt_contactnum" class="form-label">Contact Number:</label>
                            <input type="text" class="form-control" name="txtfld[contactnum]" id="txt_contactnum" required>
                        </div>
                        <div class="mb-3">
                            <label for="txt_salary" class="form-label">Salary:</label>
                            <input type="number" class="form-control" name="txtfld[salary]" id="txt_salary" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="txtfld[isactive]" id="chk_inactive">
                            <label class="form-check-label" for="chk_inactive">Active</label>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn_save_modal">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Edit Employee -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing employee -->
                    <form id="editEmployeeFormModal">
                        <input type="hidden" id="edit_recid" name="edit_recid">
                        <div class="mb-3">
                            <label for="edit_txt_fullname" class="form-label">Full Name:</label>
                            <input type="text" class="form-control" name="edit_txtfld[fullname]" id="edit_txt_fullname" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_txt_address" class="form-label">Address:</label>
                            <input type="text" class="form-control" name="edit_txtfld[address]" id="edit_txt_address" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_txt_birthdate" class="form-label">Birth Date:</label>
                            <input type="date" class="form-control" name="edit_txtfld[birthdate]" id="edit_txt_birthdate" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_txt_age" class="form-label">Age:</label>
                            <input type="number" class="form-control" name="edit_txtfld[age]" id="edit_txt_age" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="edit_txtfld[gender]" id="edit_rdo_male" value="Male" required>
                                <label class="form-check-label" for="edit_rdo_male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="edit_txtfld[gender]" id="edit_rdo_female" value="Female" required>
                                <label class="form-check-label" for="edit_rdo_female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="edit_txtfld[gender]" id="edit_rdo_other" value="Other" required>
                                <label class="form-check-label" for="edit_rdo_other">Other</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_cbo_civilstat" class="form-label">Civil Status:</label>
                            <select class="form-select" id="edit_cbo_civilstat" name="edit_txtfld[civilstat]" required>
                                <option selected disabled>Choose...</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Separated">Separated</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_txt_contactnum" class="form-label">Contact Number:</label>
                            <input type="text" class="form-control" name="edit_txtfld[contactnum]" id="edit_txt_contactnum" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_txt_salary" class="form-label">Salary:</label>
                            <input type="number" class="form-control" name="edit_txtfld[salary]" id="edit_txt_salary" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="edit_txtfld[isactive]" id="edit_chk_inactive">
                            <label class="form-check-label" for="edit_chk_inactive">Active</label>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn_update_modal">Update</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // Add New button click handler to open add modal
        $("#btn_add").click(function() {
            $('#addEmployeeModal').modal('show');
        });

        // Save button click handler in add modal
        $("#btn_save_modal").click(function() {
            // Gather form data
            var fullName = $("#txt_fullname").val();
            var address = $("#txt_address").val();
            var birthdate = $("#txt_birthdate").val();
            var age = $("#txt_age").val();
            var gender = $("input[name='txtfld[gender]']:checked").val();
            var civilStatus = $("#cbo_civilstat").val();
            var contactNumber = $("#txt_contactnum").val();
            var salary = $("#txt_salary").val();
            var isActive = $("#chk_inactive").prop("checked") ? 1 : 0;

            // AJAX request to add employee
            $.ajax({
                url: "add_employee.php",
                type: "POST",
                dataType: "json",
                data: {
                    fullName: fullName,
                    address: address,
                    birthdate: birthdate,
                    age: age,
                    gender: gender,
                    civilStatus: civilStatus,
                    contactNumber: contactNumber,
                    salary: salary,
                    isactive: isActive
                },
                success: function(response) {
                    if (response.status == 'success') {
                        alertify.alert(response.message, function() {
                            location.reload();
                        });
                    } else {
                        alertify.alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alertify.alert("An error occurred while processing your request.");
                }
            });

            $('#addEmployeeModal').modal('hide');
        });

        // Edit button click handler
        window.edit_click = function(xrecid) {
            $.ajax({
                url: "get_employee.php",
                type: "POST",
                dataType: "json",
                data: {
                    recid: xrecid
                },
                success: function(response) {
                    $("#edit_recid").val(response.recid);
                    $("#edit_txt_fullname").val(response.fullname);
                    $("#edit_txt_address").val(response.address);
                    $("#edit_txt_birthdate").val(response.birthdate);
                    $("#edit_txt_age").val(response.age);
                    $("input[name='edit_txtfld[gender]'][value='" + response.gender + "']").prop("checked", true);
                    $("#edit_cbo_civilstat").val(response.civilstat);
                    $("#edit_txt_contactnum").val(response.contactnum);
                    $("#edit_txt_salary").val(response.salary);
                    $("#edit_chk_inactive").prop("checked", response.isactive == 1);

                    $('#editEmployeeModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alertify.alert("An error occurred while processing your request.");
                }
            });
        };

        // Update button click handler in edit modal
        $("#btn_update_modal").click(function() {
            var recid = $("#edit_recid").val();
            var fullName = $("#edit_txt_fullname").val();
            var address = $("#edit_txt_address").val();
            var birthdate = $("#edit_txt_birthdate").val();
            var age = $("#edit_txt_age").val();
            var gender = $("input[name='edit_txtfld[gender]']:checked").val();
            var civilStatus = $("#edit_cbo_civilstat").val();
            var contactNumber = $("#edit_txt_contactnum").val();
            var salary = $("#edit_txt_salary").val();
            var isActive = $("#edit_chk_inactive").prop("checked") ? 1 : 0;

            // AJAX request to update employee
            $.ajax({
                url: "edit_employee.php",
                type: "POST",
                dataType: "json",
                data: {
                    recid: recid,
                    fullName: fullName,
                    address: address,
                    birthdate: birthdate,
                    age: age,
                    gender: gender,
                    civilStatus: civilStatus,
                    contactNumber: contactNumber,
                    salary: salary,
                    isactive: isActive
                },
                success: function(response) {
                    if (response.status == 'success') {
                        alertify.alert(response.message, function() {
                            location.reload();
                        });
                    } else {
                        alertify.alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alertify.alert("An error occurred while processing your request.");
                }
            });

            $('#editEmployeeModal').modal('hide');
        });

        // Delete button click handler
        window.delete_click = function(xrecid) {
            alertify.confirm("Delete employee?", function() {
                var xdata = "recid=" + xrecid + "&event_action=delete_emp";
                $.ajax({
                    url: "delete_employee.php",
                    type: "POST",
                    dataType: "json",
                    data: xdata,
                    success: function(xres) {
                        alertify.alert(xres["msg"], function() {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alertify.alert("An error occurred while processing your request.");
                    }
                });
            });
        };
    });
</script>


</body>

</html>