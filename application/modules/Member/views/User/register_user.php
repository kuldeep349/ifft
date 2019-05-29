<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Join Member
            <small>Add New Associate</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Join Member</li>
        </ol>
    </section>
    <section class="content container-fluid">
        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Member Form</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <h1><?php echo $error; ?></h1>
                <form class="form-horizontal" action="<?php echo base_url('Member/User/register_user');?>" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Nationality</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="nationality" required="required">
                                    <option>India</option>
                                    <option>Nepal</option>
                                    <option>USA</option>
                                    <option>UK</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="first_name" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="last_name" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Proof</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="proof_type">
                                    <option>Aadhar Card</option>
                                    <option>Election Card</option>
                                    <option>Passport</option>
                                    <option>Driving license</option>
                                </select>
                                <input type="text" style="text-transform: uppercase;" class="form-control" name="proof" required="required">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right">Sign in</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box -->
        </div>
    </section>
</div>