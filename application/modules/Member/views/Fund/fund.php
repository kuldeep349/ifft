
<link rel="stylesheet" href="<?php echo base_url('Assets/'); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
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
        <div class="panel panel-default">
            <div class="panel-heading">
                Payment Details
            </div>
            <div class="panel-body">
                <H3><?php echo $error;?></h3>
                <div class="form-horizontal">
                    <form action="<?php echo base_url('Member/Fund'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <span class="redRequired" title="This field is required." style="color: red">*</span>
                                Payable Amount :</label>
                            <div class="col-sm-6">
                                <input name="amount" type="text" value="8263" id="cntMainContent_txt_payableAmount" class="aspNetDisabled form-control" placeholder="Payable Amount" required="required" readonly="">
                            </div>
<!--                            <div class="col-sm-3">
                                <span id="cntMainContent_reqfield_PayableAmount" style="color:Red;display:none;">Required</span>
                            </div>-->
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <span class="redRequired" title="This field is required." style="color: red">*</span>
                                Deposited Date :</label>
                            <div class="col-sm-6">
                                <input name="deposit_date" type="text" id="datepicker" id="cntMainContent_txt_depositeddate" class="form-control" placeholder="Deposited Date" required="required">

                            </div>
<!--                            <div class="col-sm-3">
                                <span id="cntMainContent_reqfield_depositedDate" style="color:Red;display:none;">Required</span>
                            </div>-->
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <span class="redRequired" title="This field is required." style="color: red">*</span>Mode
                                Of Payment :
                            </label>
                            <div class="col-sm-6">
                                <select class="form-control" name="payment_method" required="required">
                                    <option>Cash</option>
                                    <option>NEFT/RTGS</option>
                                    <option>Cash In Hand</option>
                                </select>
                            </div>
<!--                            <div class="col-sm-3">
                                <span id="cntMainContent_RequiredFieldValidator2" style="color:Red;display:none;">Required</span>
                            </div>-->
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                &nbsp; Description&nbsp;&nbsp;&nbsp;&nbsp; :
                            </label>
                            <div class="col-sm-6">
                                <textarea name="description" rows="2" cols="20" class="form-control" style="height:41px;"></textarea>
                            </div>
                            <div class="col-sm-3">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <span class="redRequired" title="This field is required." style="color: red">*</span>
                                Slip:</label>
                            <div class="col-sm-6">
                                <input name="userfile" type="file" id="imgInp" class="form-control" placeholder="">
                                <img src="" id="blah" height="100%" width="100%"  required="required"/>
                            </div>
<!--                            <div class="col-sm-3">
                                <span id="cntMainContent_reqfield_depositedDate" style="color:Red;display:none;">Required</span>
                            </div>-->
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                            </label>
                            <div class="col-sm-6">
                                <input type="submit" name="btnsave" value="Request" onclick="null" id="cntMainContent_btn_Request" class="btn btn-info">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url('Assets/');?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    })
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function () {
        readURL(this);
    });
</script>