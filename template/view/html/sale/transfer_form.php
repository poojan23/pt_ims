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
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $text_form; ?></h5>
                    <div class="ibox-tools">
                        <div class="text-right">
                            <button type="submit" form="form-order" class="btn btn-white btn-info btn-bold" data-toggle="tooltip" title="<?php echo $button_save; ?>"><i class="ace-icon fa fa-floppy-o"></i></button>
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
                        if ($customer_id) {
                            echo '<div class="form-group" id="data_1">
                                <label class="col-sm-2 control-label">' . $label_date . '</label>
                                <div class="col-sm-10 input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type = "text" class = "form-control" name = "transfer_date" value = "' . $transfer_date . '">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                                
                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_coil_no . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="coil_no" value="' . $coil_no . '" id="" disabled=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                           <div class="form-group"><label class="col-sm-2 control-label">' . $label_order_no . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="order_no" value="' . $order_no . '" id="order_no" disabled=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                           <div class="form-group"><label class="col-sm-2 control-label">' . $label_challan_no . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="challan_no" value="' . $challan_no . '" id="challan_no"></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_client_name . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="customer_name" value="' . $customer_name . '" id="customer_name" disabled=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_truck_no . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="truck_no" value="' . $truck_no . '" id="truck_no"></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_service . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="service_type" value=' . $service_type . ' id="service_type" disabled=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_garde . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="product_code" value=' . $product_code . ' id="product_code" disabled=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_thickness . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="thickness" value=' . $thickness . ' id="thickness" disabled=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_width . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="width" value=' . $width . ' id="width" disabled=""></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group"><label class="col-sm-2 control-label">' . $label_lenght . '</label>
                                <div class="col-sm-10"><input type="text" class="form-control" name="length" value=' . $length . ' id="length" disabled=""></div>
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

                                    <input type = "text" class = "form-control" name = "transfer_date" value = <?php echo $date ?>>

                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?= $label_transfer_from; ?></label>
                                <div class="col-sm-10">
                                   
                                    <select data-placeholder="<?= $entry_client_name; ?>" class="chosen-select" tabindex="-1" style="display: none;" name="customer_id" id="customer_id">
                                        <option value=""><?= $entry_client_name; ?></option>
                                        
                                        <?php foreach ($customers as $customer) : ?>
                                            <?php if ($customer['customer_id'] == $customer_id) : ?>
                                                <option value="<?php echo $customer['customer_id']; ?>" selected="selected"><?php echo $customer['customer']; ?></option>
                                            <?php else : ?>
                                                <option value="<?php echo $customer['customer_id']; ?>"><?php echo $customer['customer']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div id='getcuttingID'></div>
                            <div class="hr-line-dashed"></div>

                            <div id='showDetails' style="display: none;">

                                <div class="form-group">
                                <label class="col-sm-2 control-label"><?= $label_transfer_to; ?></label>
                                <div class="col-sm-10">
                                    <select data-placeholder="<?= $entry_client_name; ?>" class="chosen-select" tabindex="-1" style="display: none;" name="transfer_to" id="transfer_to">
                                        <option value=""><?= $entry_client_name; ?></option>
                                        <?php foreach ($transfersTo as $transferTo) : ?>
                                            <?php if ($transferTo['customer_id'] == $transferTo) : ?>
                                                <option value="<?php echo $transferTo['customer_id']; ?>" selected="selected"><?php echo $transferTo['customer']; ?></option>
                                            <?php else : ?>
                                                <option value="<?php echo $transferTo['customer_id']; ?>"><?php echo $transferTo['customer']; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_truck_no; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="truck_no"  id="truck_no" placeholder="<?= $label_truck_no; ?>"></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_product_type; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="product_type" id="product_type" disabled=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_garde; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="product_code" id="product_code" disabled=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_thickness; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="thickness" id="thickness" disabled=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_width; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="width" id="width" disabled=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_lenght; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="length" id="length" disabled=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_pieces; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="pieces" id="pieces" disabled=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_net_wt; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="net_weight" id="net_weight"  disabled=""></div>
                                </div>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label"><?= $label_gr_wt; ?></label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="gross_weight" id="gross_weight"  disabled=""></div>
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

                                <input type="hidden" id="hdnInwardId" name="hdnInwardId">
                                <input type="hidden" id="hdnThickness" name="hdnThickness">
                                <input type="hidden" id="hdnWidth" name="hdnWidth">
                                <input type="hidden" id="hdnProductId" name="hdnProductId">
                                <input type="hidden" id="hdnLength" name="hdnLength">
                                <input type="hidden" id="hdnPieces" name="hdnPieces">
                                <input type="hidden" id="hdnProductTypeId" name="hdnProductTypeId">
                                <input type="hidden" id="hdnNetWeight" name="hdnNetWeight">
                                <input type="hidden" id="hdnGrossWeight" name="hdnGrossWeight">

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
$('select[name=\'customer_id\']').on('change', function () {
    var $this = $(this).val();
    $.ajax({
        url: 'index.php?url=sale/transfer_inward/getCoilNosByCustomerId&member_token=' + getURLVar('member_token'),
        dataType: 'json',
        type: 'POST',
        data: 'customer_id=' + $this,
        beforeSend: function () {

        },
        complete: function () {

        },
        success: function (json) {
            var bind = '<div class="form-group">'
            bind += '<label for="inputName" class="col-sm-2 control-label">Coil No &nbsp; </label>'
            bind += '<div class="col-sm-10">'
            bind += '<select class="form-control" id="coil_no" name="coil_no" onchange="getInwardDetails();">'
            bind += '<option value="0">Select Coil No</option>'
            for (var i = 0; i < json.length; i++)
            {
                var coil_no = json[i].coil_no;
                bind += '<option value=' + coil_no + '>' + coil_no + '</option>'
            }
            bind += '</select>'
            bind += '</div>'
            bind += '</div>';
            $('#getcuttingID').html(bind);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});
function getInwardDetails()
{
    var $this = $('#coil_no').val();
    $.ajax({
        url: 'index.php?url=sale/transfer_inward/getInwardDetailsByCoilNo&member_token=' + getURLVar('member_token'),
        dataType: 'json',
        type: 'POST',
        data: 'coil_no=' + $this,
        beforeSend: function () {

        },
        complete: function () {

        },
        success: function (json) {
            $('#showDetails').show();
            $("#hdnInwardId").val(json['inward_id']);
            $("#product_id").val(json['product_id']);
            $("#hdnProductId").val(json['product_id']);
            $("#product_code").val(json['product_code']);
            $("#product_type").val(json['product_type']);
            $("#hdnProductTypeId").val(json['product_type_id']);
            $("#thickness").val(json['thickness']);
            $("#hdnThickness").val(json['thickness']);
            $("#width").val(json['width']);
            $("#hdnWidth").val(json['width']);
            $("#length").val(json['length']);
            $("#hdnLength").val(json['length']);
            $("#pieces").val(json['pieces']);
            $("#hdnPieces").val(json['pieces']);
            $("#net_weight").val(json['net_weight']);
            $("#hdnNetWeight").val(json['net_weight']);
            $("#gross_weight").val(json['gross_weight']);
            $("#hdnGrossWeight").val(json['gross_weight']);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });

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

    $('#customer_id').chosen({width: "100%"});
    $('#transfer_to').chosen({width: "100%"});


</script>
