<?php $this->load->view('common/header'); ?>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <?php $this->load->view('common/navbar'); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <?php $this->load->view('common/sidebar'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <form method="post" action="<?= $action; ?>" id="bankform" enctype="multipart/form-data">
                            <div class="col-9 mt-5">
                                <div class="panel-body">
                                    <h2 class="page-title"> Update Bank Details of <?php echo $name ?></h2>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label>Bank Name</label><span class="text text-danger"> * <?= form_error('bank_name') ?></span>
                                        <div>
                                            <input type="text" name="bank_name" id="bank_name" class="form-control bank_name" value="<?= $bank_name; ?>" autocomplete="off" />
                                        </div>
                                        <span class="text-danger" id="error_bank_name_msg"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>IFSC Code</label><span class="text text-danger"> * <?= form_error('ifsc_code') ?></span>
                                        <div>
                                            <input type="text" name="ifsc_code" id="ifsc_code" class="form-control ifsc_code" value="<?= $ifsc_code; ?>" autocomplete="off" />
                                        </div>
                                        <span class="text-danger" id="error_ifsc_code_msg"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Account Type</label><span class="text text-danger"> * <?= form_error('acc_type') ?></span>
                                        <div>
                                            <input type="text" name="acc_type" id="acc_type" class="form-control acc_type" value="<?= $acc_type; ?>" autocomplete="off" />
                                        </div>
                                        <span class="text-danger" id="error_acc_type_msg"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Account Number</label><span class="text text-danger"> * <?= form_error('acc_no') ?></span>
                                        <div>
                                            <input type="text" name="acc_no" id="acc_no" class="form-control acc_no" value="<?= $acc_no; ?>" autocomplete="off" />
                                        </div>
                                        <span class="text-danger" id="error_acc_no_msg"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Branch Name</label><span class="text text-danger"> * <?= form_error('branch_name') ?></span>
                                        <div>
                                            <input type="text" name="branch_name" id="branch_name" class="form-control branch_name" value="<?= $branch_name; ?>" autocomplete="off" />
                                        </div>
                                        <span class="text-danger" id="error_branch_name_msg"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label><span class="text text-danger"> * <?= form_error('status') ?></span>
                                        <div class="push-left">
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="Active" <?= !empty($status) && ($status == "Active") ? 'checked' : ''; ?>> Active
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="Block" <?= !empty($status) && ($status == "Block") ? 'checked' : ''; ?>> Block
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div>&nbsp; <br />
                                        <button type="button" onclick="return valid()" id="btnId" name="update" class="btn btn-success btn-lg">UPDATE</button>
                                        <button type="button" name="cancel" class="btn btn-danger btn-lg" onclick="window.location='<?= $cancel_action; ?>'"><?= $cancel; ?></button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                            <input type="hidden" id="user_id" name="user_id" value="<?= base64_encode($user_id); ?>">
                            <input type="hidden" id="site_url" name="site_url" value="<?php echo site_url(); ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('common/script'); ?>
    <script>
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
            var id = $("#id").val();
            var site_url = $("#site_url").val();
            var bank_name = $("#bank_name").val();
            var ifsc_code = $("#ifsc_code").val();
            var acc_type = $("#acc_type").val();
            var acc_no = $("#acc_no").val();
            var branch_name = $("#branch_name").val();
           

            // Check for empty fields and validate patterns
            if (bank_name === '') {
                $("#error_bank_name_msg").text('Bank name is required.').show();
                setTimeout(function() {
                    $("#error_bank_name_msg").hide();
                }, 3000);
                $("#bank_name").focus();
                isValid = false;
            } else if (!bank_name.match(bank_name_pattern)) {
                $("#error_bank_name_msg").text('Invalid bank name format.').show();
                setTimeout(function() {
                    $("#error_bank_name_msg").hide();
                }, 3000);
                $("#bank_name").focus();
                isValid = false;
            }

            if (ifsc_code === '') {
                $("#error_ifsc_code_msg").text('IFSC Code is required.').show();
                setTimeout(function() {
                    $("#error_ifsc_code_msg").hide();
                }, 3000);
                $("#ifsc_code").focus();
                isValid = false;
            } else if (!ifsc_code.match(ifsc_code_pattern)) {
                $("#error_ifsc_code_msg").text('Invalid IFSC Code format.').show();
                setTimeout(function() {
                    $("#error_ifsc_code_msg").hide();
                }, 3000);
                $("#ifsc_code").focus();
                isValid = false;
            }

            if (acc_type === '') {
                $("#error_acc_type_msg").text('Account Type is required.').show();
                setTimeout(function() {
                    $("#error_acc_type_msg").hide();
                }, 3000);
                $("#acc_type").focus();
                isValid = false;
            } else if (!acc_type.match(acc_type_pattern)) {
                $("#error_acc_type_msg").text('Invalid Account Type format.').show();
                setTimeout(function() {
                    $("#error_acc_type_msg").hide();
                }, 3000);
                $("#acc_type").focus();
                isValid = false;
            }

            if (acc_no === '') {
                $("#error_acc_no_msg").text('Account No is required.').show();
                setTimeout(function() {
                    $("#error_acc_no_msg").hide();
                }, 3000);
                $("#acc_no").focus();
                isValid = false;
            } else if (!acc_no.match(acc_no_pattern)) {
                $("#error_acc_no_msg").text('Invalid Account No format.').show();
                setTimeout(function() {
                    $("#error_acc_no_msg").hide();
                }, 3000);
                $("#acc_no").focus();
                isValid = false;
            }

            if (branch_name === '') {
                $("#error_branch_name_msg").text('Branch Name is required.').show();
                setTimeout(function() {
                    $("#error_branch_name_msg").hide();
                }, 3000);
                $("#branch_name").focus();
                isValid = false;
            } else if (!branch_name.match(branch_name_pattern)) {
                $("#error_branch_name_msg").text('Invalid Branch Name format.').show();
                setTimeout(function() {
                    $("#error_branch_name_msg").hide();
                }, 3000);
                $("#branch_name").focus();
                isValid = false;
            }
            // alert(isValid);
            if (isValid)
             {
                    // Prepare data for AJAX request   user_id
                    var dataStr = 'bank_name=' + bank_name + '&acc_no=' + acc_no + '&user_id=' + user_id+ '&id='+id;
                    $.ajax({
                        type: 'POST',
                        url: site_url + '/BankController/update_check_duplicates',
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