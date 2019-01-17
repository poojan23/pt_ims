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
            <div class="alert alert-danger alert-dismissible"  id="errorLimit" style="display: none;"><i class="fa fa-exclamation-circle"></i> Net Weight Exceeds The Limit!
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $text_form; ?></h5>
                    <div class="ibox-tools">
                        <div class="text-right">
                            <button type="submit" form="form-order" class="btn btn-white btn-info btn-bold" data-toggle="tooltip" title="<?php echo $button_save; ?>" id="submitForm"><i class="ace-icon fa fa-floppy-o"></i></button>
                            <a href="<?php echo $cancel; ?>" class="btn btn-white btn-light btn-bold" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"><i class="ace-icon fa fa-reply"></i></a>
                        </div>
                    </div>

                </div>
                <?php
                $date = date("Y-m-d");
                ?>
                <div class="ibox-content">
                    <form id="form-order" class="form-horizontal" action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">

                        <?php
                        if ($order_id) {

                            echo'<div class="form-group"><label class="col-sm-2 control-label">' . $label_coil_no . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="coil_no" value="' . $coil_no . '" id="customer_name" readonly=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_client_name . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="customer_name" value="' . $customer_name . '" id="customer_name" readonly=""></div>
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
                                <div class="col-sm-10"><input type="text" class="form-control" name="length" value=' . $length . ' id="length" onkeyup="calculateWt();"></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_pieces . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="pieces" value=' . $pieces . ' id="pieces" onkeyup="calculateWt();"></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">' . $label_service . '</label>
                                <div class="col-sm-10">
                                    <select data-placeholder="' . $entry_service . '" class="chosen-select" tabindex="-1" style="display: none;"   name="service_type" id="service_type">
                                        <option value=' . $service_type . ' selected="selected">' . $service_type . '</option>
                                        <option value="">' . $entry_service . '</option>
                                        <option value="CTC">CTC</option>
                                        <option value="CTL">CTL</option>
                                        <option value="SHEET">SHEET</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_net_wt . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="netWeight" value=' . $net_weight . ' id="netWeight" readonly=""></div>
                            </div>';
                        } else {

                            echo '<div class="form-group" id="data_1">
                                    <label class="col-sm-2 control-label">' . $label_date . '</label>
                                    <div class="col-sm-10 input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
                            ?>
                            <?php
                            if ($order_date) {
                                echo '<input type = "text" class = "form-control" name = "order_date" value = "' . $order_date . '">';
                            } else {
                                echo '<input type = "text" class = "form-control" name = "order_date" value = "' . $date . '">';
                            }
                            ?>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>

                <div class="form-group  <?php echo (!empty($error_coil_no)) ? 'has-error' : ''; ?>">
                    <label class="col-sm-2 control-label"><?= $label_coil_no; ?></label>
                    <div class="col-sm-10">
                        <select data-placeholder="<?= $entry_coil_no; ?>" class="chosen-select" tabindex="-1" style="display: none;" name="coil_no" id="coil_no">
                            <option value=""><?= $entry_coil_no; ?></option>
                            <?php foreach ($coil_nos as $coil) : ?>
                                <?php if ($coil['coil_no'] == $coil_no) : ?>
                                    <option value="<?php echo $coil['coil_no']; ?>" selected="selected"><?php echo $coil['coil_no']; ?></option>
                                <?php else : ?>
                                    <option value="<?php echo $coil['coil_no']; ?>"><?php echo $coil['coil_no']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>

                        <?php if (isset($error_coil_no)) : ?>
                            <span class="help-block"><?php echo $error_coil_no; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div id='showDetails'>
                    <div class="form-group"><label class="col-sm-2 control-label"><?= $label_client_name; ?></label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="customer_name" value="<?php echo $customer_name; ?>" id="customer_name" readonly=""></div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group"><label class="col-sm-2 control-label"><?= $label_garde; ?></label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="product_code" id="product_code" value="<?php echo $product_code; ?>" readonly=""></div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group"><label class="col-sm-2 control-label"><?= $label_thickness; ?></label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="thickness" id="thickness" value="<?php echo $thickness; ?>" readonly=""></div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group"><label class="col-sm-2 control-label"><?= $label_width; ?></label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="width" id="width" value="<?php echo $width; ?>" readonly=""></div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group  <?php echo (!empty($error_length)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_lenght; ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="length" id="length"  value="<?php echo $length; ?>" onkeyup="calculateWt();">
                            <?php if (isset($error_length)) : ?>
                                <span class="help-block"><?php echo $error_length; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group  <?php echo (!empty($error_pieces)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_pieces; ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="pieces" id="pieces"  value="<?php echo $pieces; ?>"onkeyup="calculateWt();">
                            <?php if (isset($error_pieces)) : ?>
                                <span class="help-block"><?php echo $error_pieces; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group  <?php echo (!empty($error_service_type)) ? 'has-error' : ''; ?>">
                        <label class="col-sm-2 control-label"><?= $label_service; ?></label>
                        <div class="col-sm-10">
                            <select data-placeholder="<?= $entry_service; ?>" class="chosen-select" tabindex="-1" style="display: none;"  name="service_type" id="service_type">
                                <option value=""><?= $entry_service; ?></option>
                                <option value="CTC">CTC</option>
                                <option value="CTL">CTL</option>
                                <option value="SHEET">SHEET</option>
                            </select>
                            <?php if (isset($error_service_type)) : ?>
                                <span class="help-block"><?php echo $error_service_type; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group"><label class="col-sm-2 control-label"><?= $label_net_wt; ?></label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="netWeight" id="netWeight" readonly=""></div>
                    </div>
                     <div class="hr-line-dashed"></div>
                     
                    <div class="form-group" id="showCloseDiv" style="display:none;">
                        <label for="inputName" class="col-sm-2 control-label"><?= $label_close ?> </label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline"><input type="radio" name="closed" value="<?php echo $closed; ?>" id="closed">Yes</label>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="hdnInwardId" name="hdnInwardId">
                <input type="hidden" id="hdnInwardWeightId" name="hdnInwardWeightId">
                <input type="hidden" id="hdnthickness" name="hdnthickness">
                <input type="hidden" id="hdnwidth" name="hdnwidth">
                <input type="hidden" id="hdnCustomerId" name="hdnCustomerId">
                <input type="hidden" id="hdnProductId" name="hdnProductId">
                <input type="hidden" id="hdnNetWeight" name="hdnNetWeight">
                <input type="hidden" id="hdnGrossWeight" name="hdnGrossWeight">
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
                                if ($('select[name=\'coil_no\']').val() == '') {
                                    $('#showDetails').hide();
                                }

                                $('select[name=\'coil_no\']').on('change', function () {
                                    var $this = $(this).val();
                                    $('#showDetails').hide();
                                    $.ajax({
                                        url: 'index.php?url=sale/order/getOrderDetailsByCoilNo&member_token=' + getURLVar('member_token'),
                                        dataType: 'json',
                                        type: 'POST',
                                        data: 'coil_no=' + $this,
                                        beforeSend: function () {
                                            $('#showDetails').hide();
                                        },
                                        complete: function () {
                                            $('#showDetails').show();
                                        },
                                        success: function (json) {
                                            $('#showDetails').show();
                                            $("#hdnInwardId").val(json['inward_id']);
                                            $("#hdnInwardWeightId").val(json['inward_weight_id']);
                                            $("#hdnCustomerId").val(json['customer_id']);
                                            $("#customer_name").val(json['customer_name']);
                                            $("#hdnProductId").val(json['product_id']);
                                            $("#product_code").val(json['product_code']);
                                            $("#thickness").val(json['thickness']);
                                            $("#hdnthickness").val(json['thickness']);
                                            $("#hdnNetWeight").val(json['net_weight']);
                                            $("#hdnGrossWeight").val(json['gross_weight']);
                                            $("#width").val(json['width']);
                                            $("#hdnwidth").val(json['width']);
                                            
                                         
                                        },
                                        error: function (xhr, ajaxOptions, thrownError) {

                                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                        }
                                    });
                                });

                                function calculateWt()
                                {
                                    var inward_id = $('#hdnInwardId').val();
                                    var thickness = $('#thickness').val();
                                    var width = $('#width').val();
                                    var cuttinglength = $('#length').val();
                                    var cuttingpieces = $('#pieces').val();

                                    if (cuttinglength != '')
                                    {
                                        $('#cuttinglength').css('border-color', '');
                                        $('#showError').hide();
                                    }
                                    if (cuttingpieces != '')
                                    {
                                        $('#cuttingpieces').css('border-color', '');
                                        $('#showError').hide();
                                    }


                                    var netWeight_1 = (thickness * (width / 1000) * (cuttinglength / 1000) * cuttingpieces * 7.85);
                                    var net_Weight = Math.round(netWeight_1 * 100) / 100;


                                    $.ajax({
                                        url: 'index.php?url=sale/order/getNetWeight&member_token=' + getURLVar('member_token'),
                                        dataType: 'json',
                                        type: 'POST',
                                        data: 'inward_id=' + inward_id,
                                        beforeSend: function () {
//                                            $('#showDetails').hide();
                                        },
                                        complete: function () {
//                                            $('#showDetails').show();
                                        },
                                        success: function (json) {
                                            var remainingNetWt = json['net_weight'];

                                            var lowerLimit = parseInt(remainingNetWt) - parseInt(500);
                                            var upperLimit = parseInt(remainingNetWt) + parseInt(500);
                                            if (net_Weight >= upperLimit)
                                            {
                                                $('#netWeight').css('border-color', 'red');
                                                $('#errorLimit').show();
                                                document.getElementById("submitForm").disabled = true;

                                            } else {
                                                $('#netWeight').css('border-color', '');
                                                $('#errorLimit').hide();
                                                $('#showCloseDiv').hide();
                                                $("#closed").val('0');
                                                document.getElementById("submitForm").disabled = false;
                                            }

                                            if ((net_Weight >= lowerLimit) && (net_Weight <= upperLimit)) {
                                                $('#showCloseDiv').show();
                                                $("#closed").val('1');
                                                $("#closed").prop("checked", true);

                                            }
                                            if (cuttinglength == '0' && cuttingpieces == '0') {
                                                $('#showCloseDiv').show();
                                            }
                                        },
                                        error: function (xhr, ajaxOptions, thrownError) {

                                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                        }
                                    });

                                    //        var remwt = remainingNetWt - net_Weight;



                                    $('#netWeight').val(net_Weight);
                                }
</script>
<script>
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

    $('.chosen-select').chosen({width: "100%"});
    $('.chosen-select1').chosen({width: "100%"});
    $(".select2_demo_1").select2();
    $(".select2_demo_1").select2();
    $('#service_type').chosen({width: "100%"});
    function getproduct() {
        var type = $('#type').val();
        if (type == '1') {
            $('#show_coil').show();
            $('#show_bundle').hide();
        }
        if (type == '3') {
            $('#show_coil').show();
            $('#show_bundle').show();
        }
        if (type == '4') {
            $('#show_coil').hide();
            $('#show_bundle').hide();
        }

    }


</script>
