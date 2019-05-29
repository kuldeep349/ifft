<!--<link rel="stylesheet" href="<?php echo base_url('Assets/'); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">-->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Page Header
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>
    <section class="content container-fluid">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>User ID</th>
                            <th>Transaction ID</th>
                            <th>Payment Method</th>
                            <th>Description </th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Remark</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            foreach ($transactions as $key => $transaction) {
                                ?>
                            <tr>
                                <td><?php echo ($key + 1) ?></td>
                                <td><?php echo $transaction['amount']; ?></td>
                                <td><?php echo $transaction['user_id']; ?></td>
                                <td><?php echo $transaction['payment_method']; ?></td>
                                <td><?php echo $transaction['transaction_id']; ?></td>
                                <td><?php echo $transaction['description']; ?></td>
                                <td><?php
                                    if ($transaction['status'] == 0) {
                                        echo'Pending';
                                    } elseif ($transaction['status'] == 1) {
                                        echo'Approved';
                                    } elseif ($transaction['status'] == 2) {
                                        echo'Rejected';
                                    }
                                    ?></td>
                                <td>
                                    <?php
                                    if ($transaction['status'] != 1) {
                                        ?>
                                        <button class="btn btn-success pymntmodal" type="button"
                                                data-request_id="<?php echo $transaction['id']; ?>"
                                                data-user_id="<?php echo $transaction['user_id']; ?>"
                                                data-amount="<?php echo $transaction['amount']; ?>"
                                                data-payment_method="<?php echo $transaction['payment_method']; ?>"
                                                data-transaction_id="<?php echo $transaction['transaction_id']; ?>"
                                                data-description="<?php echo $transaction['description']; ?>"
                                                data-deposit_date="<?php echo $transaction['deposit_date']; ?>"
                                                >Update</button>
                                                <?php
                                            }
                                            ?>
                                </td>
                                <td><?php echo $transaction['remark']; ?></td>
                                <td><?php echo $transaction['created_at']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>User ID</th>
                            <th>Transaction ID</th>
                            <th>Payment Method</th>
                            <th>Description </th>
                            <th>Deposit Date</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
</div>


<!-------Modal code---->
<!-- Modal -->
<div class="modal fade" id="PaymentModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Payment Request Details</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('Admin/Fund/update_request'); ?>" method="POST" id='PaymntForm'/>
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" id="puser_id" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input type="text" id="pamount" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Transaction ID</label>
                    <input type="text" id="ptransaction_id" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Payment Method</label>
                    <input type="text" id="ppayment_method" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" id="pdescription" class="form-control"/>
                </div>
                <div class="form-group">
                    <select name="action" class="form-control" id="paymentAction">
                        <option>Approve</option>
                        <option>Reject</option>
                    </select>
                </div>
                <div class="form-group" id="remarkfield" style="display:none">
                    <label>Remark</label>
                    <input type="text" id="premark" name="remark" class="form-control"/>
                    <input type="hidden" name="request_id" id="prequest_id" class="form-control"/>
                </div>
                <button type="submit" class="btn btn-default" id="pymntbtn">Update</button>
                </form>

            </div>
        </div>

    </div>
</div>

<!--<script src="<?php echo base_url('Assets/'); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('Assets/'); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>-->
<script>
    $(document).on('click', '.pymntmodal', function () {
        $('#puser_id').val($(this).data('user_id'));
        $('#pamount').val($(this).data('amount'));
        $('#ptransaction_id').val($(this).data('transaction_id'));
        $('#ppayment_method').val($(this).data('payment_method'));
        $('#pdescription').val($(this).data('description'));
        $('#prequest_id').val($(this).data('request_id'));
        $('#PaymentModal').modal('show');
    });

    $(document).on('change', '#paymentAction', function () {
        if ($(this).val() == 'Approve') {
            $('#remarkfield').css('display', 'none')
            $('#premark').removeAttr('required')
        } else {
            $('#remarkfield').css('display', 'block')
            $('#premark').prop('required', 'true')
        }
    });
    $(document).on('submit', '#PaymntForm', function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var formData = $(this).serialize();
        //$('#pymntbtn').css('display','none');
        $.post(url, formData, function (res) {
            alert(res.message)
            if (res.success == 1) {
                location.reload();
            } else {
                $('#pymntbtn').css('display', 'block');
            }
        }, 'json')
    })
//    $(function () {
//        $('#example1').DataTable()
//        $('#example2').DataTable({
//            'paging': true,
//            'lengthChange': false,
//            'searching': false,
//            'ordering': true,
//            'info': true,
//            'autoWidth': false
//        })
//    })
</script>