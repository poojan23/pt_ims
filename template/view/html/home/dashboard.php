<?php echo $header; ?>
<?php echo $nav; ?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right"><?php echo $text_monthly; ?></span>
                    <h5><?php echo $text_inward; ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo ($total_inwards / 1000) . " MT"; ?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"><?php echo $text_monthly; ?></span>
                    <h5><?php echo $text_outward; ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo ($total_outwards / 1000) . " MT"; ?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right"><?php echo $text_total; ?></span>
                    <h5><?php echo $text_customer; ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $total_customers; ?></h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-danger pull-right"><?php echo $text_total; ?></span>
                    <h5><?php echo $text_products; ?></h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $total_products; ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $text_graph_summary; ?></h5>
                    <div class="pull-right">
                        <div class="btn-group">
                            <input type="button" class="btn btn-xs btn-white active" onclick="showTab1();" value="Inward">
                            <input type="button" class="btn btn-xs btn-white" onclick="showTab2();" value="Outward">
                            <!--<input type="button" class="btn btn-xs btn-white" onclick="showTab3();" value="Annual">-->
                        </div>
                    </div>
                </div>
                <div class="ibox-content" id="tab1">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="io-bar-chart">
                                <canvas id="inward" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-content" id="tab2" style="display: none;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="io-bar-chart">
                                <canvas id="outward" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-content" id="tab3" style="display: none;">
                    <div class="row">
                        <h1>Tab3</h1>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row" style="overflow: auto;">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $text_top_inward; ?></h5>
                </div>
                <div class="ibox-content table-responsive">
                    <table class="table table-hover no-margins">
                        <thead>
                            <tr>
                                <th><?= $head_date; ?></th>
                                <th><?= $head_truck_no; ?></th>
                                <th><?= $head_client_name; ?></th>
                                <th><?= $head_product; ?></th>
                                <th><?= $head_garde; ?></th>
                                <th><?= $head_coil_no; ?></th>
                                <th><?= $head_thickness; ?></th>
                                <th><?= $head_width; ?></th>
                                <th><?= $head_lenght; ?></th>
                                <th><?= $head_pieces; ?></th>
                                <th><?= $head_gr_wt; ?></th>
                                <th><?= $head_net_wt; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            ?>
                            <?php
                            foreach ($inwards as $inward) {
                                if ($i == 10)
                                    break;
                                echo '<tr>
                                <td>' . $inward['inward_date'] . '</td>
                                <td>' . $inward['truck_no'] . '</td>
                                <td>' . $inward['customer_name'] . '</td>
                                <td>' . $inward['product_code'] . '</td>
                                <td>' . $inward['product_type'] . '</td>
                                <td>' . $inward['coil_no'] . '</td>
                                <td>' . $inward['thickness'] . '</td>
                                <td>' . $inward['width'] . '</td>
                                <td>' . $inward['length'] . '</td>
                                <td>' . $inward['pieces'] . '</td>
                                <td>' . $inward['gross_weight'] . '</td>
                                <td>' . $inward['net_weight'] . '</td>
                                </tr>';

                                $i++;
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>
<script src="template/view/dist/js/plugins/flot/jquery.flot.js"></script>
<script src="template/view/dist/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="template/view/dist/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="template/view/dist/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="template/view/dist/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="template/view/dist/js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="template/view/dist/js/plugins/flot/jquery.flot.time.js"></script>

<!-- Peity -->
<script src="template/view/dist/js/plugins/peity/jquery.peity.min.js"></script>
<script src="template/view/dist/js/demo/peity-demo.js"></script>
<script src="template/view/dist/js/plugins/easypiechart/jquery.easypiechart.js"></script>
<script src="template/view/dist/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="template/view/dist/js/demo/sparkline-demo.js"></script>
<script src="template/view/dist/js/plugins/chartJs/Chart.min.js"></script>
<script src="template/view/dist/js/Chart.bundle.js"></script>
<script src="template/view/dist/js/chartjs-plugin-labels.js"></script>
<!-- Mainly scripts -->
<script>
                                function showTab1() {
                                    $('#tab1').show();
                                    $('#tab2').hide();
                                }
                                function showTab2() {
                                    $('#tab1').hide();
                                    $('#tab2').show();
                                }
</script>

<script>
    var jsonfile = {
        "jsonarray":
<?php echo $report; ?>

    };
    var labels = jsonfile.jsonarray.map(function (e) {
        return e.label;
    });
    var data = jsonfile.jsonarray.map(function (e) {
        return e.value;
    });
    ;
    var canvas = document.getElementById('inward');
    var data = {
        labels: labels,
        datasets: [
            {
                label: "Inward(MT)",
                backgroundColor: "#1c84c6",
                borderColor: "#1c84c6",
                borderWidth: 2,
                hoverBackgroundColor: "#1c84c6",
                hoverBorderColor: "#1c84c6",
                data: data,
            }
        ]
    };
    var option = {
        legend: {
            onClick: (e) => e.stopPropagation()
        },
        plugins: {
            labels: {
                render: 'value'
            }
        },
        scaleBeginAtZero: true,
        scales: {
            yAxes: [{
                    ticks: {
                        fontSize: 12
                    },
                    stacked: true,
                    gridLines: {
                        display: true,
                        color: "rgba(255,99,132,0.2)"
                    }
                }],
            xAxes: [{
                    ticks: {
                        fontSize: 12
                    },
                    gridLines: {
                        display: false
                    },
                }]
        },
        responsive: true,
        maintainAspectRatio: false
    };

    var myBarChart = Chart.Bar(canvas, {
        data: data,
        options: option
    });

</script>

<script>
    var jsonfile1 = {
        "jsonarray1": <?php echo $outwardreport; ?>
    };
    var labels = jsonfile1.jsonarray1.map(function (e) {
        return e.label;
    });
    var data = jsonfile1.jsonarray1.map(function (e) {
        return e.value;
    });
    ;
    var canvas = document.getElementById('outward');
    var data = {
        labels: labels,
        datasets: [
            {
                label: "Outward(MT)",
                backgroundColor: "#23c6c8",
                borderColor: "#23c6c8",
                borderWidth: 2,
                hoverBackgroundColor: "#23c6c8",
                hoverBorderColor: "#23c6c8",
                data: data,
            }
        ]
    };
    var option = {
        legend: {
            onClick: (e) => e.stopPropagation()
        },
        plugins: {
            labels: {
                render: 'value'
            }
        },
        legend: {
            onClick: (e) => e.stopPropagation()
        },
        scaleBeginAtZero: true,
        scales: {
            yAxes: [{
                    ticks: {
                        fontSize: 12
                    },
                    stacked: true,
                    gridLines: {
                        display: true,
                        color: "rgba(255,99,132,0.2)"
                    }
                }],
            xAxes: [{
                    ticks: {
                        fontSize: 12
                    },
                    gridLines: {
                        display: false
                    },
                }]
        },
        responsive: true,
        maintainAspectRatio: false
    };

    var myBarChart = Chart.Bar(canvas, {
        data: data,
        options: option
    });

</script>