<link rel="stylesheet" href="<?php echo base_url('Assets/'); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
                            <th>Transaction ID</th>
                            <th>Payment Method</th>
                            <th>Description </th>
                            <th>Status</th>
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

<script src="<?php echo base_url('Assets/'); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('Assets/'); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
</script>