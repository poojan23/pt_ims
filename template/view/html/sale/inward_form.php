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
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $text_form; ?></h5>
                    <div class="ibox-tools">
                        <div class="text-right">
                            <button type="submit" form="form-inward" class="btn btn-white btn-info btn-bold" data-toggle="tooltip" title="<?php echo $button_save; ?>"><i class="ace-icon fa fa-floppy-o"></i></button>
                            <a href="<?php echo $cancel; ?>" class="btn btn-white btn-light btn-bold" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"><i class="ace-icon fa fa-reply"></i></a>
                        </div>
                    </div>

                </div>
                <?php
                $date = date("Y-m-d");
                ?>
                <div class="ibox-content">
                    <?php if ($warning_err) : ?>
                        <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $warning_err; ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    <?php endif; ?>
                    <form id="form-inward" class="form-horizontal" action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">

                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label"><?= $label_date; ?></label>
                            <div class="col-sm-10 input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <?php
                                if ($inward_date) {
                                    echo '<input type="text" class="form-control" name="inward_date" value="' . $inward_date . '">';
                                } else {
                                    echo '<input type="text" class="form-control" name="inward_date" value="' . $date . '">';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group  <?php echo (!empty($customer_error)) ? 'has-error' : ''; ?>">
                            <label class="col-sm-2 control-label"><?= $label_client_name; ?></label>
                            <div class="col-sm-10">
                                <select data-placeholder="<?= $entry_client_name; ?>" class="chosen-select" tabindex="-1" style="display: none;" name="customer_id">
                                    <option value=""><?= $entry_client_name; ?></option>
                                    <?php foreach ($customers as $customer) : ?>
                                        <?php if ($customer['customer_id'] == $customer_id) : ?>
                                            <option value="<?php echo $customer['customer_id']; ?>" selected="selected"><?php echo $customer['customer']; ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $customer['customer_id']; ?>"><?php echo $customer['customer']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($customer_error)) : ?>
                                    <span class="help-block"><?php echo $customer_error; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  <?php echo (!empty($error_truck_no)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_truck_no; ?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="truck_no" value="<?php echo $truck_no; ?>" placeholder="<?= $entry_truck_no; ?>">

                                <?php if (isset($error_truck_no)) : ?>
                                    <span class="help-block"><?php echo $error_truck_no; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  <?php echo (!empty($error_coil_no)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_coil_no; ?></label>
                            <div class="col-sm-10">
                                <?php if ($coil_no) : ?>
                                    <input type="text" class="form-control" name="coil_no" value="<?php echo $coil_no; ?>" placeholder="<?= $entry_coil_no; ?>">
                                <?php else : ?>
                                    <input type="text" class="form-control" name="coil_no"  placeholder="<?= $entry_coil_no; ?>">
                                <?php endif; ?>

                                <?php if (isset($error_coil_no)) : ?>
                                    <span class="help-block"><?php echo $error_coil_no; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  <?php echo (!empty($error_product_type)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_product; ?></label>
                            <div class="col-sm-10">
                                <select data-placeholder="<?= $entry_product; ?>" class="chosen-select" tabindex="-1" style="display: none;" id="type" name="product_type_id" onchange="getproduct();">
                                    <option value=""><?= $entry_product; ?></option>
                                    <?php foreach ($product_types as $product_type) : ?>
                                        <?php if ($product_type['product_type_id'] == $product_type_id) : ?>

                                            <option value="<?php echo $product_type['product_type_id']; ?>" selected="selected" ><?php echo $product_type['product_type']; ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $product_type['product_type_id']; ?>"><?php echo $product_type['product_type']; ?></option>
                                        <?php endif; ?>

                                    <?php endforeach; ?>
                                </select>

                                <?php if (isset($error_product_type)) : ?>
                                    <span class="help-block"><?php echo $error_product_type; ?></span>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div id="show_coil">
                            <div class="form-group  <?php echo (!empty($error_thickness)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_thickness; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="thickness" value="<?php echo $thickness; ?>" placeholder="<?= $entry_thickness; ?>">
                                    <?php if (isset($error_thickness)) : ?>
                                        <span class="help-block"><?php echo $error_thickness; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group  <?php echo (!empty($error_width)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_width; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="width" value="<?php echo $width; ?>" placeholder="<?= $entry_width; ?>">
                                    <?php if (isset($error_width)) : ?>
                                        <span class="help-block"><?php echo $error_width; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                        </div>

                        <div style="display:none;" id="show_bundle">
                            <div class="form-group  <?php echo (!empty($error_length)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_lenght; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="length"  value="<?php echo $length; ?>" placeholder="<?= $entry_length; ?>">
                                    <?php if (isset($error_length)) : ?>
                                        <span class="help-block"><?php echo $error_length; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group  <?php echo (!empty($error_pieces)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_pieces; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pieces" value="<?php echo $pieces; ?>" placeholder="<?= $entry_pieces; ?>">
                                    <?php if (isset($error_pieces)) : ?>
                                        <span class="help-block"><?php echo $error_pieces; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                        </div>
                        <div class="form-group  <?php echo (!empty($error_product)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_garde; ?></label>
                            <div class="col-sm-10">
                                <select data-placeholder="<?= $entry_garde; ?>" class="chosen-select" tabindex="-1" name="product_id" style="display: none;">
                                    <option value=""><?= $entry_garde; ?></option>
                                    <?php foreach ($products as $product) : ?>
                                        <?php if ($product['product_id'] == $product_id) : ?>
                                            <option value="<?php echo $product['product_id']; ?>" selected="selected"><?php echo $product['product_code']; ?></option>
                                        <?php else : ?>
                                            <option value="<?php echo $product['product_id']; ?>"><?php echo $product['product_code']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>

                                <?php if (isset($error_product)) : ?>
                                    <span class="help-block"><?php echo $error_product; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  <?php echo (!empty($error_gross_weight)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_gr_wt; ?></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="gross_weight" value="<?php echo $gross_weight; ?>" placeholder="<?= $entry_gr_wt; ?>">
                                <?php if (isset($error_gross_weight)) : ?>
                                    <span class="help-block"><?php echo $error_gross_weight; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group  <?php echo (!empty($error_net_weight)) ? 'has-error' : ''; ?>"><label class="col-sm-2 control-label"><?= $label_net_wt; ?></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="net_weight" value="<?php echo $net_weight; ?>" placeholder="<?= $entry_net_wt; ?>">
                                <?php if (isset($error_net_weight)) : ?>
                                    <span class="help-block"><?php echo $error_net_weight; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_pack; ?></label>
                            <div class="col-sm-10">
                                <?php if ($customer_id) : ?>
                                    <?php if ($packaging == 1) : ?>
                                        <label class="checkbox-inline">
                                            <input type="radio" value="1" id="yes" name="packaging" checked=""> Yes
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="radio" value="0" id="no" name="packaging"> No 
                                        </label>
                                    <?php else : ?>
                                        <label class="checkbox-inline">
                                            <input type="radio" value="1" id="yes" name="packaging"> Yes
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="radio" value="0" id="no" name="packaging" checked=""> No 
                                        </label>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="1" id="yes" name="packaging" checked=""> Yes
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="radio" value="0" id="no" name="packaging"> No 
                                    </label>
                                <?php endif; ?>
                            </div>    
                        </div>
                     
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="hdnproductType" name="hdnproductType">
<?php echo $footer; ?>
<script src="template/view/dist/js/plugins/chosen/chosen.jquery.js"></script>
<script src="template/view/dist/js/plugins/select2/select2.full.min.js"></script>
<script src="template/view/dist/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="template/view/dist/js/plugins/cropper/cropper.min.js"></script>
<script src="template/view/dist/js/plugins/fullcalendar/moment.min.js"></script>
<script src="template/view/dist/js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="template/view/dist/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="template/view/dist/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script>

//                                        if ($('select[name=\'product_type_id\']').val() == '3') {
//                                            $('#show_coil').show();
//                                            $('#show_bundle').show();
//                                        }
                                    $(document).ready(function () {
//                                            var hdnid = $('#hdnid').val();
//
//                                            if (hdnid == 'COIL') {
//                                                $('#show_coil').show();
//                                                $('#show_bundle').hide();
//                                                $('#type').prop('disabled', true);
//                                            }
//                                            if (hdnid == 'SHEET') {
//                                                $('#show_bundle').show();
//                                                $('#show_coil').show();
//                                                $('#type').prop('disabled', true);
//                                            }
//
//                                            $('.tagsinput').tagsinput({
//                                                tagClass: 'label label-primary'
//                                            });




                                        $('#data_1 .input-group.date').datepicker({
                                            todayBtn: "linked",
                                            keyboardNavigation: false,
                                            forceParse: false,
                                            calendarWeeks: true,
                                            autoclose: true,
                                            format: "yyyy-mm-dd"
                                        });



                                        $('input[name="daterange"]').daterangepicker();

                                        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

                                        $('#reportrange').daterangepicker({
                                            format: 'MM/DD/YYYY',
                                            startDate: moment().subtract(29, 'days'),
                                            endDate: moment(),
                                            minDate: '01/01/2012',
                                            maxDate: '12/31/2015',
                                            dateLimit: {days: 60},
                                            showDropdowns: true,
                                            showWeekNumbers: true,
                                            timePicker: false,
                                            timePickerIncrement: 1,
                                            timePicker12Hour: true,
                                            ranges: {
                                                'Today': [moment(), moment()],
                                                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                                            },
                                            opens: 'right',
                                            drops: 'down',
                                            buttonClasses: ['btn', 'btn-sm'],
                                            applyClass: 'btn-primary',
                                            cancelClass: 'btn-default',
                                            separator: ' to ',
                                            locale: {
                                                applyLabel: 'Submit',
                                                cancelLabel: 'Cancel',
                                                fromLabel: 'From',
                                                toLabel: 'To',
                                                customRangeLabel: 'Custom',
                                                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                                                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                                                firstDay: 1
                                            }
                                        }, function (start, end, label) {
                                            console.log(start.toISOString(), end.toISOString(), label);
                                            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                                        });

                                        $(".select2_demo_1").select2();
                                        $(".select2_demo_2").select2();
                                        $(".select2_demo_3").select2({
                                            placeholder: "Select a state",
                                            allowClear: true
                                        });

                                    });

                                    $('.chosen-select').chosen({width: "100%"});

                                    function getproduct() {
                                        var product_type = $('#type').val();

                                        $.ajax({
                                            url: 'index.php?url=sale/inward/getproductType&member_token=' + getURLVar('member_token'),
                                            dataType: 'json',
                                            type: 'POST',
                                            data: 'product_type=' + product_type,
                                            beforeSend: function () {

                                            },
                                            complete: function () {

                                            },
                                            success: function (json) {
                                                $("#hdnproductType").val(json['product_type']);
                                                if (json['product_type'] == 'COIL') {
                                                    $('#show_coil').show();
                                                    $('#show_bundle').hide();
                                                }
                                                if (json['product_type'] == 'SHEET') {
                                                    $('#show_coil').show();
                                                    $('#show_bundle').show();
                                                }
                                                if (json['product_type'] == 'SCRAP') {
                                                    $('#show_coil').hide();
                                                    $('#show_bundle').hide();
                                                }

                                            },
                                            error: function (xhr, ajaxOptions, thrownError) {

                                                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                            }
                                        });

                                    }


</script>
