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
                            <button type="submit" form="form-user-group" class="btn btn-white btn-info btn-bold" data-toggle="tooltip" title="<?php echo $button_save; ?>"><i class="ace-icon fa fa-floppy-o"></i></button>
                            <a href="<?php echo $cancel; ?>" class="btn btn-white btn-light btn-bold" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"><i class="ace-icon fa fa-reply"></i></a>
                        </div>
                    </div>

                </div>
                <?php
                $date = date("Y-m-d");
                ?>
                <div class="ibox-content">
                    <form id="form-user-group" class="form-horizontal" action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">

                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label"><?= $label_date; ?></label>
                            <div class="col-sm-10 input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="inward_date" value="<?php echo $inward_date; ?>">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
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
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_truck_no; ?></label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="truck_no" value="<?php echo $truck_no; ?>" placeholder="<?= $entry_truck_no; ?>"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_coil_no; ?></label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="coil_no" value="<?php echo $coil_no; ?>" placeholder="<?= $entry_coil_no; ?>"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_product; ?></label>
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
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                       
                        <div style="display:none;" id="show_coil">
                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_thickness; ?></label>
                            <div class="col-sm-10"><input type="number" class="form-control" name="thickness" value="<?php echo $thickness; ?>" placeholder="<?= $entry_thickness; ?>"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_width; ?></label>
                            <div class="col-sm-10"><input type="number" class="form-control" name="width" value="<?php echo $width; ?>" placeholder="<?= $entry_width; ?>"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                         </div>
                        
                        <div style="display:none;" id="show_bundle">
                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_lenght; ?></label>
                            <div class="col-sm-10"><input type="number" class="form-control" name="length"  value="<?php echo $length; ?>" placeholder="<?= $entry_lenght; ?>"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_pieces; ?></label>
                            <div class="col-sm-10"><input type="number" class="form-control" name="pieces" value="<?php echo $pieces; ?>" placeholder="<?= $entry_pieces; ?>"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_garde; ?></label>
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
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_gr_wt; ?></label>
                            <div class="col-sm-10"><input type="number" class="form-control" name="gross_weight" value="<?php echo $gross_weight; ?>" placeholder="<?= $entry_gr_wt; ?>"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_net_wt; ?></label>
                            <div class="col-sm-10"><input type="number" class="form-control" name="net_weight" value="<?php echo $net_weight; ?>" placeholder="<?= $entry_net_wt; ?>"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_pack; ?></label>
                            <div class="col-sm-10">
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
                            </div>    
                        </div>
                    </form>
                    <input type="hidden" id="hdnid" value="<?php echo $product_type_name; ?>">
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
<script>
                                    $(document).ready(function () {
                                        var hdnid = $('#hdnid').val();
                                        
                                        if(hdnid == 'COIL') {
                                            $('#show_coil').show();
                                            $('#show_bundle').hide();
                                            $('#type').prop('disabled', true);
                                        }
                                        if(hdnid == 'SHEET'){
                                            $('#show_bundle').show();
                                            $('#show_coil').show();
                                            $('#type').prop('disabled', true);
                                        }
                                        
                                        $('.tagsinput').tagsinput({
                                            tagClass: 'label label-primary'
                                        });

                                        var $image = $(".image-crop > img")
                                        $($image).cropper({
                                            aspectRatio: 1.618,
                                            preview: ".img-preview",
                                            done: function (data) {
                                                // Output the result data for cropping image.
                                            }
                                        });

                                        var $inputImage = $("#inputImage");
                                        if (window.FileReader) {
                                            $inputImage.change(function () {
                                                var fileReader = new FileReader(),
                                                        files = this.files,
                                                        file;

                                                if (!files.length) {
                                                    return;
                                                }

                                                file = files[0];

                                                if (/^image\/\w+$/.test(file.type)) {
                                                    fileReader.readAsDataURL(file);
                                                    fileReader.onload = function () {
                                                        $inputImage.val("");
                                                        $image.cropper("reset", true).cropper("replace", this.result);
                                                    };
                                                } else {
                                                    showMessage("Please choose an image file.");
                                                }
                                            });
                                        } else {
                                            $inputImage.addClass("hide");
                                        }

                                        $("#download").click(function () {
                                            window.open($image.cropper("getDataURL"));
                                        });

                                        $("#zoomIn").click(function () {
                                            $image.cropper("zoom", 0.1);
                                        });

                                        $("#zoomOut").click(function () {
                                            $image.cropper("zoom", -0.1);
                                        });

                                        $("#rotateLeft").click(function () {
                                            $image.cropper("rotate", 45);
                                        });

                                        $("#rotateRight").click(function () {
                                            $image.cropper("rotate", -45);
                                        });

                                        $("#setDrag").click(function () {
                                            $image.cropper("setDragMode", "crop");
                                        });

                                        $('#data_1 .input-group.date').datepicker({
                                            todayBtn: "linked",
                                            keyboardNavigation: false,
                                            forceParse: false,
                                            calendarWeeks: true,
                                            autoclose: true,
                                            format: "yyyy-mm-dd"
                                        });

                                        $('#data_2 .input-group.date').datepicker({
                                            startView: 1,
                                            todayBtn: "linked",
                                            keyboardNavigation: false,
                                            forceParse: false,
                                            autoclose: true,
                                            format: "dd/mm/yyyy"
                                        });

                                        $('#data_3 .input-group.date').datepicker({
                                            startView: 2,
                                            todayBtn: "linked",
                                            keyboardNavigation: false,
                                            forceParse: false,
                                            autoclose: true
                                        });

                                        $('#data_4 .input-group.date').datepicker({
                                            minViewMode: 1,
                                            keyboardNavigation: false,
                                            forceParse: false,
                                            forceParse: false,
                                            autoclose: true,
                                            todayHighlight: true
                                        });

                                        $('#data_5 .input-daterange').datepicker({
                                            keyboardNavigation: false,
                                            forceParse: false,
                                            autoclose: true
                                        });

                                        var elem = document.querySelector('.js-switch');
                                        var switchery = new Switchery(elem, {color: '#1AB394'});

                                        var elem_2 = document.querySelector('.js-switch_2');
                                        var switchery_2 = new Switchery(elem_2, {color: '#ED5565'});

                                        var elem_3 = document.querySelector('.js-switch_3');
                                        var switchery_3 = new Switchery(elem_3, {color: '#1AB394'});

                                        var elem_4 = document.querySelector('.js-switch_4');
                                        var switchery_4 = new Switchery(elem_4, {color: '#f8ac59'});
                                        switchery_4.disable();

                                        $('.i-checks').iCheck({
                                            checkboxClass: 'icheckbox_square-green',
                                            radioClass: 'iradio_square-green'
                                        });

                                        $('.demo1').colorpicker();

                                        var divStyle = $('.back-change')[0].style;
                                        $('#demo_apidemo').colorpicker({
                                            color: divStyle.backgroundColor
                                        }).on('changeColor', function (ev) {
                                            divStyle.backgroundColor = ev.color.toHex();
                                        });

                                        $('.clockpicker').clockpicker();

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


                                        $(".touchspin1").TouchSpin({
                                            buttondown_class: 'btn btn-white',
                                            buttonup_class: 'btn btn-white'
                                        });

                                        $(".touchspin2").TouchSpin({
                                            min: 0,
                                            max: 100,
                                            step: 0.1,
                                            decimals: 2,
                                            boostat: 5,
                                            maxboostedstep: 10,
                                            postfix: '%',
                                            buttondown_class: 'btn btn-white',
                                            buttonup_class: 'btn btn-white'
                                        });

                                        $(".touchspin3").TouchSpin({
                                            verticalbuttons: true,
                                            buttondown_class: 'btn btn-white',
                                            buttonup_class: 'btn btn-white'
                                        });

                                        $('.dual_select').bootstrapDualListbox({
                                            selectorMinimalHeight: 160
                                        });


                                    });

                                    $('.chosen-select').chosen({width: "100%"});

                                    $("#ionrange_1").ionRangeSlider({
                                        min: 0,
                                        max: 5000,
                                        type: 'double',
                                        prefix: "$",
                                        maxPostfix: "+",
                                        prettify: false,
                                        hasGrid: true
                                    });

                                    $("#ionrange_2").ionRangeSlider({
                                        min: 0,
                                        max: 10,
                                        type: 'single',
                                        step: 0.1,
                                        postfix: " carats",
                                        prettify: false,
                                        hasGrid: true
                                    });

                                    $("#ionrange_3").ionRangeSlider({
                                        min: -50,
                                        max: 50,
                                        from: 0,
                                        postfix: "°",
                                        prettify: false,
                                        hasGrid: true
                                    });

                                    $("#ionrange_4").ionRangeSlider({
                                        values: [
                                            "January", "February", "March",
                                            "April", "May", "June",
                                            "July", "August", "September",
                                            "October", "November", "December"
                                        ],
                                        type: 'single',
                                        hasGrid: true
                                    });

                                    $("#ionrange_5").ionRangeSlider({
                                        min: 10000,
                                        max: 100000,
                                        step: 100,
                                        postfix: " km",
                                        from: 55000,
                                        hideMinMax: true,
                                        hideFromTo: false
                                    });

                                    $(".dial").knob();

                                    var basic_slider = document.getElementById('basic_slider');

                                    noUiSlider.create(basic_slider, {
                                        start: 40,
                                        behaviour: 'tap',
                                        connect: 'upper',
                                        range: {
                                            'min': 20,
                                            'max': 80
                                        }
                                    });

                                    var range_slider = document.getElementById('range_slider');

                                    noUiSlider.create(range_slider, {
                                        start: [40, 60],
                                        behaviour: 'drag',
                                        connect: true,
                                        range: {
                                            'min': 20,
                                            'max': 80
                                        }
                                    });

                                    var drag_fixed = document.getElementById('drag-fixed');

                                    noUiSlider.create(drag_fixed, {
                                        start: [40, 60],
                                        behaviour: 'drag-fixed',
                                        connect: true,
                                        range: {
                                            'min': 20,
                                            'max': 80
                                        }
                                    });
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
