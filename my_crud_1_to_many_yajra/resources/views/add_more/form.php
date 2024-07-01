<?php $this->load->view('common/header'); ?>
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" type="text/css">

<body>
    <div class="container-scroller">
        <?php $this->load->view('common/navbar'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php $this->load->view('common/sidebar'); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Add Bank Details</h2>

                                    <form method="post" action="<?php echo site_url('BankController/save'); ?>" id="bankform">

                                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $id ?>">
                                        <input type="hidden" id="site_url" name="site_url" value="<?php echo site_url(); ?>">
                                        <div class="table-responsive">

                                            <table id="bankTable" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th width="20%">Bank Name <span class="text-danger">*</span></th>
                                                        <th width="20%">IFSC Code <span class="text-danger">*</span></th>
                                                        <th width="20%">Account Type <span class="text-danger">*</span></th>
                                                        <th width="20%">Account Number <span class="text-danger">*</span></th>
                                                        <th width="20%">Branch Name <span class="text-danger">*</span></th>
                                                        <th><button type="button" class="btn btn-info btn-sm" onclick="addRow()">+</button></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" name="bank_name[]" placeholder="Bank Name" class="form-control bank_name" required></td>
                                                        <td><input type="text" name="ifsc_code[]" placeholder="IFSC Code" class="form-control ifsc_code" required></td>
                                                        <td><input type="text" name="acc_type[]" placeholder="Account Type" class="form-control acc_type" required></td>
                                                        <td><input type="text" name="acc_no[]" placeholder="Account Number" class="form-control acc_no" required></td>
                                                        <td><input type="text" name="branch_name[]" placeholder="Branch Name" class="form-control branch_name" required></td>
                                                        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">-</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <button onclick="return valid()" type="button" id="btnId" class="btn btn-success  btn-sm">Save</button>
                                        <!-- <button type="button" name="cancel" class="btn btn-danger btn-sm" onclick="cancelAction()">Cancel</button> -->
                                        <button type="button" name="cancel" class="btn btn-danger btn-sm " onclick="window.location='<?= $cancel_action; ?>'"><?= $cancel; ?></button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('common/footer'); ?>
        <?php $this->load->view('common/script'); ?>
        <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
        <script>
            function addRow() {
                var table = document.getElementById("bankTable").getElementsByTagName('tbody')[0];
                var row = table.insertRow();
                row.innerHTML = `
                    <td><input type="text" name="bank_name[]" placeholder="Bank Name" class="form-control bank_name" required></td>
                    <td><input type="text" name="ifsc_code[]" placeholder="IFSC Code" class="form-control ifsc_code" required></td>
                    <td><input type="text" name="acc_type[]" placeholder="Account Type" class="form-control acc_type" required></td>
                    <td><input type="text" name="acc_no[]" placeholder="Account Number" class="form-control acc_no" required></td>
                    <td><input type="text" name="branch_name[]" placeholder="Branch Name" class="form-control branch_name" required></td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">-</button></td>
                `;
            }

            function removeRow(button) {
                var row = button.closest('tr');
                var table = document.getElementById("bankTable").getElementsByTagName('tbody')[0];
                if (table.rows.length > 1) {
                    row.parentNode.removeChild(row);
                } else {
                    alert("The first row cannot be removed.");
                }
            }

            function valid() {
                var bank_name_pattern = /^[a-zA-Z\s]{3,}$/;
                var ifsc_code_pattern = /^[A-Za-z]{4}[a-zA-Z0-9]{7}$/;
                var acc_type_pattern = /^(Savings|Current)$/i;
                var acc_no_pattern = /^[0-9]{9,18}$/;
                var branch_name_pattern = /^[a-zA-Z\s]{3,}$/;
                var isValid = true;
                var bank_name_array = [];
                var bank_acc_array = [];
                var user_id = $("#user_id").val();
                var site_url = $("#site_url").val();
                var count_fds = 0;
                // Check for empty fields
                $('.bank_name, .ifsc_code, .acc_type, .acc_no, .branch_name').each(function() {
                    if ($(this).val() === '') {
                        count_fds++;
                    }
                });
                if (count_fds > 0) {
                    alert('Please fill out all required fields.');
                    isValid = false;
                    return false; // exit each loop
                }

                // Pattern validation
                $('.bank_name').each(function() {
                    // alert('hii');
                    if (!bank_name_pattern.test($(this).val())) {
                        alert('Please enter a valid bank name.');
                        isValid = false;
                        return false; // exit each loop
                    }
                    if ($(this).val() != '') {
                        bank_name_array.push($(this).val());
                    }
                });

                $('.ifsc_code').each(function() {
                    if (!ifsc_code_pattern.test($(this).val())) {
                        alert('Please enter a valid IFSC code.');
                        isValid = false;
                        return false; // exit each loop
                    }
                });

                $('.acc_type').each(function() {
                    if (!acc_type_pattern.test($(this).val())) {
                        alert('Please enter a valid account type (Savings or Current).');
                        isValid = false;
                        return false; // exit each loop
                    }
                });

                $('.acc_no').each(function() {
                    if (!acc_no_pattern.test($(this).val())) {
                        alert('Please enter a valid account number.');
                        isValid = false;
                        return false; // exit each loop
                    }
                    if ($(this).val() != '') {
                        bank_acc_array.push($(this).val());
                    }
                });

                $('.branch_name').each(function() {
                    if (!branch_name_pattern.test($(this).val())) {
                        alert('Please enter a valid branch name.');
                        isValid = false;
                        return false; // exit each loop
                    }
                });

                if(isValid) {
                    // Check for duplicate entries
                    var seen = {};
                    var duplicate = false;

                    $('input[name="bank_name[]"]').each(function() {
                        if (seen[$(this).val()]) {
                            alert('Duplicate bank name found.');
                            duplicate = true;
                            return false; // exit each loop
                        }
                        seen[$(this).val()] = true;
                    });

                    if (duplicate) {
                        isValid = false;
                    }

                    seen = {};
                    $('input[name="ifsc_code[]"]').each(function() {
                        if (seen[$(this).val()]) {
                            alert('Duplicate IFSC code found.');
                            duplicate = true;
                            return false; // exit each loop
                        }
                        seen[$(this).val()] = true;
                    });

                    if (duplicate) {
                        isValid = false;
                    }

                    seen = {};
                    $('input[name="acc_no[]"]').each(function() {
                        if (seen[$(this).val()]) {
                            alert('Duplicate account number found.');
                            duplicate = true;
                            return false; // exit each loop
                        }
                        seen[$(this).val()] = true;
                    });

                    if (duplicate) {
                        isValid = false;
                    }
                }

                if (isValid) {
                    // Prepare data for AJAX request   user_id
                    var dataStr = 'bank_name_array=' + bank_name_array + '&bank_acc_array=' + bank_acc_array + '&user_id=' + user_id;
                    $.ajax({
                        type: 'POST',
                        url: site_url + '/BankController/check_duplicates',
                        data: dataStr,
                        cache: false,
                        success: function(response) {
                            var obj = jQuery.parseJSON(response);
                            if (obj.status == 'error') {
                                alert(obj.message);
                                isValid = false;
                            } else {
                                // alert("hi");
                                $('#btnId').attr('type', 'submit');
                                $('#bankform').submit();
                            }
                        }
                        //async: false // Ensures that the AJAX call is completed before form submission
                    });
                }

                return isValid;
            }
        </script>

</body>

</html>