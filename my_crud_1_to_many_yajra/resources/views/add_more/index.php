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
                    <div class="page-header">
                        <h3 class="page-title">Bank Details of <?php echo $name ?></h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bank Details</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">Manage Bank Details</h2>
                                    <button type="button" class="btn btn-primary mb-3" onclick="window.location='<?= site_url("BankController/create/" . $id); ?>'">Add Bank Details</button>

                                    <?php echo validation_errors(); ?>
                                    <?php echo form_open('BankController/deleteall_action'); ?>
                                    <form method="post">

                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" name="checkall" onclick="check();" /></th>
                                                    <th>Bank Name</th>
                                                    <th>IFSC Code</th>
                                                    <th>Account Type</th>
                                                    <th>Account Number</th>
                                                    <th>Branch Name</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($bank_details as $detail) : ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="selector[]" value="<?= $detail->id; ?>" /></td>
                                                        <td><?= $detail->bank_name ?></td>
                                                        <td><?= $detail->ifsc_code ?></td>
                                                        <td><?= $detail->acc_type ?></td>
                                                        <td><?= $detail->acc_no ?></td>
                                                        <td><?= $detail->branch_name ?></td>
                                                        <td>
                                                            <?php if ($detail->status == "Active") { ?>
                                                                <span class="label label-success"><?= $detail->status; ?></span>
                                                            <?php } elseif ($detail->status == "Block") { ?>
                                                                <span class="label label-danger"><?= $detail->status; ?></span>
                                                            <?php } else { ?>
                                                                <span class="label label-warning"><?= $detail->status; ?></span>
                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?= site_url('BankController/update/' . base64_encode($detail->id)); ?>" class="mdi mdi-pencil btn btn-primary btn-sm" style="padding: 0px"></a>
                                                            <a href="<?= site_url('BankController/delete_action/' . base64_encode($detail->id)); ?>" class="mdi mdi-delete btn btn-danger btn-sm " onclick="return confirm('Do you really want to delete this record?')" style="padding: 0px"></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>


                                                <!-- More view content -->
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7">
                                                        <button type="submit" name="deleteall" class="btn btn-danger" onclick="return confirm('Do you really want to delete these records?')">Delete Selected</button>
                                                        <button type="button" name="cancel" class="btn btn-danger btn-large " onclick="window.location='<?= $cancel_action; ?>'"><?= $cancel; ?></button>
                                                    </td>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    </form>
                                    <?php echo form_close(); ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php $this->load->view('common/footer') ?>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('common/script'); ?>
    <script>
        $(document).ready(function() {
            $('#datatablelist').DataTable();
        });

        function check() {
            var checkAllCheckbox = document.getElementsByName("checkall")[0];
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = checkAllCheckbox.checked;
            }
        }
    </script>
</body>

</html>