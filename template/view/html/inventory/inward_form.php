<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Popaya Technology | Inward</title>
        <link href="<?php echo HTTP_SERVER; ?>view/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo HTTP_SERVER; ?>view/dist/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
        <link href="css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">

    <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/switchery/switchery.css" rel="stylesheet">

    <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

    <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">

    <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

        <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/select2/select2.min.css" rel="stylesheet">

        <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

        <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
        <link href="<?php echo HTTP_SERVER; ?>view/dist/css/animate.css" rel="stylesheet">
        <link href="<?php echo HTTP_SERVER; ?>view/dist/css/style.css" rel="stylesheet">
        
    </head>

    <body>
        <div id="wrapper">
            <?php echo $nav; ?>
            <div id="page-wrapper" class="gray-bg">
                <?php echo $header; ?>

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
                                    <h5><?= $heading_sub; ?></h5>
                                    <div class="ibox-tools">
                                        <button type="submit" form="form-category" class="collapse-link btn btn-primary">
                                            <i class="fa fa-floppy-o"></i>
                                        </button>
                                        <a href="<?php echo $cancel; ?>" class="dropdown-toggle">
                                            <i class="fa fa-reply"></i>
                                        </a>

                                    </div>
                                </div>

                                <div class="ibox-content">
                                    <form method="get" class="form-horizontal">

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_date; ?></label>
                                            <div class="col-sm-10"><input type="date" class="form-control"></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?= $label_client_name; ?></label>
                                            <div class="col-sm-10">
                                                <select data-placeholder="<?= $entry_client_name; ?>" class="chosen-select" tabindex="-1" style="display: none;">
                                                    <option value=""><?= $entry_client_name; ?></option>
                                                    <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        
                                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_truck_no; ?></label>
                                            <div class="col-sm-10"><input type="text" class="form-control" placeholder="<?= $entry_truck_no; ?>"></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        
                                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_coil_no; ?></label>
                                            <div class="col-sm-10"><input type="text" class="form-control" placeholder="<?= $entry_coil_no; ?>"></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        
                                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_product; ?></label>
                                            <div class="col-sm-10">
                                                <select data-placeholder="<?= $entry_product; ?>" class="chosen-select" tabindex="-1" style="display: none;" id="type" onchange="getproduct();">
                                                    <option value=""><?= $entry_product; ?></option>
                                                    <option value="Coil">Coil</option>
                                                    <option value="Sheet">Sheet</option>
                                                    <option value="Scrap">Scrap</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                       
                                        <div style="display:none;" id="show_coil">
                                            <div class="form-group"><label class="col-sm-2 control-label"><?= $label_thickness; ?></label>
                                                <div class="col-sm-10"><input type="number" class="form-control" placeholder="<?= $entry_thickness; ?>"></div>
                                            </div>
                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group"><label class="col-sm-2 control-label"><?= $label_width; ?></label>
                                                <div class="col-sm-10"><input type="number" class="form-control" placeholder="<?= $entry_width; ?>"></div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                        </div>
                                        
                                        <div style="display:none;" id="show_bundle">
                                            <div class="form-group"><label class="col-sm-2 control-label"><?= $label_lenght; ?></label>
                                                <div class="col-sm-10"><input type="number" class="form-control" placeholder="<?= $entry_lenght; ?>"></div>
                                            </div>
                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group"><label class="col-sm-2 control-label"><?= $label_pieces; ?></label>
                                                <div class="col-sm-10"><input type="number" class="form-control" placeholder="<?= $entry_pieces; ?>"></div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                        </div>
                                        
                                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_garde; ?></label>
                                            <div class="col-sm-10">
                                                <select data-placeholder="<?= $entry_garde; ?>" class="chosen-select" tabindex="-1" style="display: none;">
                                                    <option value=""><?= $entry_garde; ?></option>
                                                    <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        
                                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_gr_wt; ?></label>
                                            <div class="col-sm-10"><input type="number" class="form-control" placeholder="<?= $entry_gr_wt; ?>"></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_net_wt; ?></label>
                                            <div class="col-sm-10"><input type="number" class="form-control" placeholder="<?= $entry_net_wt; ?>"></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_pack; ?></label>
                                        <div class="col-sm-10">
                                            <label class="checkbox-inline">
                                                <input type="radio" value="yes" id="inlineCheckbox1" name="inlineCheckbox1"> Yes
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="radio" value="no" id="inlineCheckbox2" name="inlineCheckbox1"> No 
                                            </label>
                                        </div>    
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo $footer; ?>
                  <!-- Date range picker -->
    <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/chosen/chosen.jquery.js"></script>

   <!-- JSKnob -->
   <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/jsKnob/jquery.knob.js"></script>
<script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
   <!-- NouSlider -->
   <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/nouslider/jquery.nouislider.min.js"></script>

   <!-- Switchery -->
   <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/switchery/switchery.js"></script>

    <!-- IonRangeSlider -->
    <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

    <!-- iCheck -->
    <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/iCheck/icheck.min.js"></script>

    <!-- MENU -->
    <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Color picker -->
    <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <!-- Clock picker -->
    <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Image cropper -->
    <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/cropper/cropper.min.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/fullcalendar/moment.min.js"></script>
   <!-- Input Mask-->
    <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/jasny/jasny-bootstrap.min.js"></script>
   <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/select2/select2.full.min.js"></script>
    <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>
     <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/datapicker/bootstrap-datepicker.js"></script>


  

    <script>
                function getproduct() {
                    var type = $('#type').val();
                    if (type == 'Coil') {
                        $('#show_coil').show();
                        $('#show_bundle').hide();
                    } 
                    if (type == 'Sheet') {
                        $('#show_coil').show();
                        $('#show_bundle').show();
                    } 
                    if (type == 'Scrap') {
                        $('#show_coil').hide();
                        $('#show_bundle').hide();
                    } 

                }
        $(document).ready(function(){

            $('.tagsinput').tagsinput({
                tagClass: 'label label-primary'
            });

            var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1.618,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $("#inputImage");
            if (window.FileReader) {
                $inputImage.change(function() {
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

            $("#download").click(function() {
                window.open($image.cropper("getDataURL"));
            });

            $("#zoomIn").click(function() {
                $image.cropper("zoom", 0.1);
            });

            $("#zoomOut").click(function() {
                $image.cropper("zoom", -0.1);
            });

            $("#rotateLeft").click(function() {
                $image.cropper("rotate", 45);
            });

            $("#rotateRight").click(function() {
                $image.cropper("rotate", -45);
            });

            $("#setDrag").click(function() {
                $image.cropper("setDragMode", "crop");
            });

            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
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
            var switchery = new Switchery(elem, { color: '#1AB394' });

            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

            var elem_3 = document.querySelector('.js-switch_3');
            var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

            var elem_4 = document.querySelector('.js-switch_4');
            var switchery_4 = new Switchery(elem_4, { color: '#f8ac59' });
                switchery_4.disable();

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.demo1').colorpicker();

            var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
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
                dateLimit: { days: 60 },
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
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
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
                'min':  20,
                'max':  80
            }
        });

        var range_slider = document.getElementById('range_slider');

        noUiSlider.create(range_slider, {
            start: [ 40, 60 ],
            behaviour: 'drag',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });

        var drag_fixed = document.getElementById('drag-fixed');

        noUiSlider.create(drag_fixed, {
            start: [ 40, 60 ],
            behaviour: 'drag-fixed',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });


    </script>
