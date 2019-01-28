<head>
    <link href="template/view/dist/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="template/view/dist/css/plugins/select2/select2.min.css" rel="stylesheet">
</head>

<?php echo $header; ?>
<?php echo $nav; ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $header_title; ?></h2>
        <ol class="breadcrumb">
            <?php for ($i = 0; $i < count($breadcrumbs); $i++) : ?>
                <?php if ($i != (count($breadcrumbs) - 1)) : ?>
                    <?php if ($i == 0) : ?>
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="<?php echo $breadcrumbs[$i]['href']; ?>"><?php echo $breadcrumbs[$i]['text']; ?></a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="<?php echo $breadcrumbs[$i]['href']; ?>"><?php echo $breadcrumbs[$i]['text']; ?></a>
                        </li>
                    <?php endif; ?>
                <?php else : ?>
                    <li class="active"><?php echo $breadcrumbs[$i]['text']; ?></li>
                <?php endif; ?>
            <?php endfor; ?>        
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($warning_err) : ?>
                <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $warning_err; ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php endif; ?>
            <div class="alert alert-danger alert-dismissible"  id="piecesLimit" style="display: none;"><i class="fa fa-exclamation-circle"></i> Pieces Exceeds The Limit!
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <div class="alert alert-danger alert-dismissible"  id="errorLimit" style="display: none;"><i class="fa fa-exclamation-circle"></i> Gross Weight Exceeds The Limit!
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <div class="alert alert-danger alert-dismissible"  id="showError" style="display: none;"><i class="fa fa-exclamation-circle"></i> Warning: Please check the form carefully for errors!
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $text_form; ?></h5>
                    <div class="ibox-tools">
                        <div class="text-right">
                            <button type="button" form="form-order" class="btn btn-white btn-info btn-bold" data-toggle="tooltip" title="<?php echo $button_save; ?>" id="submitForm" onclick="addOutward();"><i class="ace-icon fa fa-floppy-o"></i></button>
                            <a href="<?php echo $cancel; ?>" class="btn btn-white btn-light btn-bold" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"><i class="ace-icon fa fa-reply"></i></a>
                        </div>
                    </div>

                </div>
                <?php
                $date = date("Y-m-d");
                ?>
                <div class="ibox-content">
                    <form id="form-order" name="form-order" class="form-horizontal" action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">

                        <?php
                        if ($delivery_id) {
                            echo '<div class="form-group" id="data_1">
                                <label class="col-sm-2 control-label">' . $label_date . '</label>
                                <div class="col-sm-10 input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type = "text" class = "form-control" name = "delivery_date" value = "' . $delivery_date . '">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                                
                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_coil_no . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="coil_no" value="' . $coil_no . '" id="" readonly=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                           <div class="form-group"><label class="col-sm-2 control-label">' . $label_order_no . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="order_no" value="' . $order_no . '" id="order_no" readonly=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                           <div class="form-group"><label class="col-sm-2 control-label">' . $label_challan_no . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="challan_no" value="' . $challan_no . '" id="challan_no"></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_client_name . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="customer_name" value="' . $customer_name . '" id="customer_name" readonly=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_truck_no . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="truck_no" value="' . $truck_no . '" id="truck_no"></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_service . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="service_type" value=' . $service_type . ' id="service_type" readonly=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_garde . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="product_code" value=' . $product_code . ' id="product_code" readonly=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_thickness . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="thickness" value=' . $thickness . ' id="thickness" readonly=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_width . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="width" value=' . $width . ' id="width" readonly=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_lenght . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="length" value=' . $length . ' id="length" readonly=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_pieces . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="pieces" value=' . $pieces . ' id="pieces" onkeyup="calculatePieces();"></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_gr_wt . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="gross_weight" value=' . $gross_weight . ' id="gross_weight"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            
                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_pack . '</label>
                            <div class="col-sm-10">';
                            ?>
                            <?php
                            if ($packaging == 1) {
                                echo '<label class="checkbox-inline">
                                    <input type="radio" value="1" id="yes" name="packaging" checked=""> Yes
                                </label>
                                <label class="checkbox-inline">
                                    <input type="radio" value="0" id="no" name="packaging"> No 
                                </label>';
                            } else {
                                echo '<label class="checkbox-inline">
                                    <input type="radio" value="1" id="yes" name="packaging"> Yes
                                </label>
                                <label class="checkbox-inline">
                                    <input type="radio" value="0" id="no" name="packaging" checked=""> No 
                                </label>
                    
                            </div>    
                        </div>';
                            }
                        } else {
                            ?>
                            <div class="form-group" id="data_1">
                                <label class="col-sm-2 control-label"><?php echo $label_date ?></label>
                                <div class="col-sm-10 input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                    <input type = "text" class = "form-control" name = "delivery_date" value = <?php echo $date ?>>

                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  <?php echo (!empty($error_coil_no)) ? 'has-error' : ''; ?>">
                                <label class="col-sm-2 control-label"><?= $label_coil_no; ?></label>
                                <div class="col-sm-10">
                                    <select data-placeholder="<?= $entry_coil_no; ?>" class="chosen-select" tabindex="-1" style="display: none;" name="coil_no" id="coil_no">
                                        <option value="0"><?= $entry_coil_no; ?></option>
                                        <?php foreach ($coil_nos as $coil) : ?>
                                            <?php if ($coil['coil_no'] == $coil_no) : ?>
                                                <option value="<?php echo $coil['coil_no']; ?>" selected="selected"><?php echo $coil['coil_no']; ?></option>
                                            <?php else : ?>
                                                <option value="<?php echo $coil['coil_no']; ?>"><?php echo $coil['coil_no']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                        <span class="help-block" id="showcoilerror"  style="color: #a94442;">Please select a coil number!</span>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group  <?php echo (!empty($error_order_no)) ? 'has-error' : ''; ?>">
                                <label class="col-sm-2 control-label"><?= $label_order_no; ?></label>
                                <div class="col-sm-10">
                                    <select data-placeholder="<?= $entry_order_no; ?>" class="form-control" id="order_no" name="order_no" onchange="getCuttingDetails();">

                                    </select>
                                        <span class="help-block" id="showordererror" style="color: #a94442;">Please select a order number!</span>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div id='showDetails'>
                                <div class="form-group <?php echo (!empty($error_challan_no)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_challan_no; ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="challan_no"  id="challan_no" placeholder="<?= $label_challan_no; ?>">
                                            <span class="help-block" id="showchallanerror" style="color: #a94442;">Please enter challan number!</span>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_client_name; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="customer_name"  id="customer_name" readonly=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group <?php echo (!empty($error_truck_no)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_truck_no; ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="truck_no"  id="truck_no" placeholder="<?= $label_truck_no; ?>">
                                            <span class="help-block" id="showtruckerror" style="color: #a94442;">Please enter truck number!</span>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_service; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="service_type"  id="service_type" readonly=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_garde; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="product_code" id="product_code" readonly=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_thickness; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="thickness" id="thickness" readonly=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_width; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="width" id="width" readonly=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_lenght; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="length" id="length" readonly=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group <?php echo (!empty($error_pieces)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_pieces; ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="pieces" id="pieces" onkeyup="calculatePieces();" placeholder="<?= $label_pieces; ?>">
                                            <span class="help-block" id="showpieceerror" style="color: #a94442;">Please enter pieces!</span>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group <?php echo (!empty($error_gross_weight)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_gr_wt; ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="gross_weight" id="gross_weight" placeholder="<?= $label_gr_wt; ?>" onkeyup="calculateGrossWt();">
                                            <span class="help-block" id="showweighterror" style="color: #a94442;">Please enter gross weight!</span>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_pack; ?></label>
                                    <div class="col-sm-10">
                                        <label class="checkbox-inline">
                                            <input type="radio" value="1" id="yes" name="packaging" checked=""> Yes
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="radio" value="0" id="no" name="packaging"> No 
                                        </label>
                                    </div>    
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group" id="showCloseDiv" style="display:none;">
                                    <label for="inputName" class="col-sm-2 control-label"><?= $label_close ?></label>
                                    <div class="col-sm-10">
                                        <label class="checkbox-inline"><input type="radio" name="closed" value="<?php echo $closed; ?>" id="closed">Yes</label>
                                    </div>
                                </div>
                                <input type="hidden" id="hdnOrderId" name="hdnOrderId">
                                <input type="hidden" id="hdnthickness" name="hdnthickness">
                                <input type="hidden" id="hdnwidth" name="hdnwidth">
                                <input type="hidden" id="hdnCustomerId" name="hdnCustomerId">
                                <input type="hidden" id="hdnProductId" name="hdnProductId">
                                <input type="hidden" id="hdnlength" name="hdnlength">
                                <input type="hidden" id="hdnservice" name="hdnservice">

                            </div>
                            <?php
                        }
                        ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>
<script src="template/view/dist/js/plugins/chosen/chosen.jquery.js"></script>
<script src="template/view/dist/js/plugins/select2/select2.full.min.js"></script>
<script src="template/view/dist/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="template/view/dist/js/plugins/cropper/cropper.min.js"></script>
<script src="template/view/dist/js/plugins/fullcalendar/moment.min.js"></script>
<script src="template/view/dist/js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="template/view/dist/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="template/view/dist/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

<script type="text/javascript">

                                        function addOutward()
                                        {
                                            var coil_no = $('#coil_no').val();
                                            var order_no = $('#order_no').val();
                                            var challan_no = $('#challan_no').val();
                                            var truck_no = $('#truck_no').val();
                                            var pieces = $('#pieces').val();
                                            var gross_weight = $('#gross_weight').val();

                                            if (coil_no == '0')
                                            {
                                                $('#coil_no').css('border-color', 'red');
                                                $('#showError').show();
                                                $('#showcoilerror').show();
                                                return false;
                                            }
                                            if (order_no == '0')
                                            {
                                                $('#order_no').css('border-color', 'red');
                                                $('#showError').show();
                                                 $('#showordererror').show();
                                                return false;
                                            }
                                            if (challan_no == '')
                                            {
                                                $('#challan_no').css('border-color', 'red');
                                                $('#showError').show();
                                                 $('#showchallanerror').show();
                                                return false;
                                            }
                                            if (truck_no == '')
                                            {
                                                $('#truck_no').css('border-color', 'red');
                                                $('#showError').show();
                                                 $('#showtruckerror').show();
                                                return false;
                                            }
                                            if (pieces == '')
                                            {
                                                $('#pieces').css('border-color', 'red');
                                                $('#showError').show();
                                                 $('#showpieceerror').show();
                                                return false;
                                            }
                                            if (gross_weight == '')
                                            {
                                                $('#gross_weight').css('border-color', 'red');
                                                 $('#showweighterror').show();
                                                $('#showError').show();
                                                return false;
                                            }
                                            if (coil_no != '0' && order_no != '0' && challan_no != '' && truck_no != '' && pieces != '' && gross_weight != '') {
                                                document.getElementById("form-order").submit();
                                            }
                                        }


                                        $('select[name=\'coil_no\']').on('change', function () {
                                            var $this = $(this).val();

                                            $.ajax({
                                                url: 'index.php?url=sale/outward/getOrderNosByCoilNo&member_token=' + getURLVar('member_token'),
                                                dataType: 'json',
                                                type: 'POST',
                                                data: 'coil_no=' + $this,
                                                beforeSend: function () {
                                                    $('#showOrderNo').hide();
                                                },
                                                complete: function () {
                                                    $('#showOrderNo').show();
                                                },
                                                success: function (json) {
                                                    console.log(json);
                                                    var bind = '';
                                                    bind += "<option value='0'>Select Order No</option>";
                                                    for (var i = 0; i < json.length; i++)
                                                    {
                                                        var order = json[i].order_no;
                                                        if (order == '<?php echo $order_no; ?>') {
                                                            bind += '<option value="' + order + '" selected="selected">' + order + '</option>';
                                                        } else {
                                                            bind += '<option value="' + order + '">' + order + '</option>';
                                                        }
                                                    }
                                                    $('#order_no').html(bind);
                                                },
                                                error: function (xhr, ajaxOptions, thrownError) {
                                                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                                }
                                            });
                                        });
                                        $('#showDetails').hide();
                                        if ($('select[name=\'coil_no\']').val() != '') {
                                            console.log($('select[name=\'order_no\']'));
                                        } else {
                                            if ($('select[name=\'order_no\']').val() == '') {
                                                $('#showDetails').hide();
                                            }
                                        }

                                        function getCuttingDetails()
                                        {

                                            var $this = $('#order_no').val();
                                            $.ajax({
                                                url: 'index.php?url=sale/outward/getOutwardDetailsByOrderNo&member_token=' + getURLVar('member_token'),
                                                dataType: 'json',
                                                type: 'POST',
                                                data: 'order_no=' + $this,
                                                beforeSend: function () {
                                                    $('#showDetails').hide();
                                                },
                                                complete: function () {

                                                },
                                                success: function (json) {
                                                    $('#showDetails').show();
                                                    $("#hdnOrderId").val(json['order_id']);
                                                    $("#hdnCustomerId").val(json['customer_id']);
                                                    $("#customer_name").val(json['customer_name']);
                                                    $("#hdnProductId").val(json['product_id']);
                                                    $("#product_code").val(json['product_code']);
                                                    $("#thickness").val(json['thickness']);
                                                    $("#hdnthickness").val(json['thickness']);
                                                    $("#width").val(json['width']);
                                                    $("#hdnwidth").val(json['width']);
                                                    $("#length").val(json['length']);
                                                    $("#hdnlength").val(json['thickness']);
                                                    $("#service_type").val(json['service_type']);
                                                    $("#hdnservice").val(json['service_type']);
                                                },
                                                error: function (xhr, ajaxOptions, thrownError) {
                                                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                                }
                                            });

                                        }

                                        $(document).ready(function () {

                                            $('#data_1 .input-group.date').datepicker({
                                                todayBtn: "linked",
                                                keyboardNavigation: false,
                                                forceParse: false,
                                                calendarWeeks: true,
                                                autoclose: true,
                                                format: "yyyy-mm-dd"
                                            });

                                        });

                                        $('#coil_no').chosen({width: "100%"});

                                        function calculatePieces()
                                        {
                                            var order_id = $('#hdnOrderId').val();

                                            $.ajax({
                                                url: 'index.php?url=sale/outward/getPieces&member_token=' + getURLVar('member_token'),
                                                dataType: 'json',
                                                type: 'POST',
                                                data: 'order_id=' + order_id,
                                                beforeSend: function () {

                                                },
                                                complete: function () {

                                                },
                                                success: function (json) {
                                                    var rempieces = json['pieces'];

                                                    var cuttingpieces = parseInt($('#pieces').val());

                                                    var pieceDiff = parseInt(rempieces) - parseInt(cuttingpieces);
                                                    if (pieceDiff < -1) {
                                                        $('#pieces').css('border-color', 'red');
                                                        $('#piecesLimit').show();
                                                        $('#showCloseDiv').hide();
                                                        document.getElementById("submitForm").disabled = true;

                                                    } else {
                                                        $('#pieces').css('border-color', '');
                                                        $('#piecesLimit').hide();
                                                        $('#showCloseDiv').hide();
                                                        $("#closed").val('0');
                                                        document.getElementById("submitForm").disabled = false;
                                                    }

                                                    if (pieceDiff <= 0 && pieceDiff > -2) {
                                                        $('#showCloseDiv').show();
                                                        $("#closed").val('1');
                                                        $('#piecesLimit').hide();
                                                    }
                                                },
                                                error: function (xhr, ajaxOptions, thrownError) {

                                                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                                }
                                            });
                                        }

                                        function calculateGrossWt()
                                        {
                                            var coil_no = $('#coil_no').val();

                                            $.ajax({
                                                url: 'index.php?url=sale/outward/getRemGrossWeight&member_token=' + getURLVar('member_token'),
                                                dataType: 'json',
                                                type: 'POST',
                                                data: 'coil_no=' + coil_no,
                                                beforeSend: function () {

                                                },
                                                complete: function () {

                                                },
                                                success: function (json) {
                                                    var remainingGRWt = parseInt(json['gross_weight']);
                                                    var grossWeight = parseInt($('#gross_weight').val());
                                                    var thickness = $('#thickness').val();
                                                    var width = $('#width').val();
                                                    var cuttinglength = $('#length').val();
                                                    var cuttingpieces = $('#pieces').val();
                                                    var lowerLimit = parseInt(remainingGRWt - 500);
                                                    var upperLimit = parseInt(remainingGRWt + 500);
                                                    if (grossWeight > upperLimit)
                                                    {
                                                        $('#gross_weight').css('border-color', 'red');
                                                        $('#errorLimit').show();
                                                        document.getElementById("submitForm").disabled = true;

                                                    } else {
                                                        $('#gross_weight').css('border-color', '');
                                                        $('#errorLimit').hide();
                                                        document.getElementById("submitForm").disabled = false;
                                                    }
                                                },
                                                error: function (xhr, ajaxOptions, thrownError) {

                                                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                                }
                                            });
                                        }
</script>
