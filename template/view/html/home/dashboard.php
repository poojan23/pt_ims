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
                    <h1 class="no-margins">40 886,200</h1>
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
                    <h1 class="no-margins">275,800</h1>
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
                    <h1 class="no-margins">106,120</h1>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-danger pull-right"><?php echo $text_total; ?></span>
                    <h5>Product</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">80,600</h1>
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
                            <input type="button" class="btn btn-xs btn-white active" onclick="showTab1();" value="Tab 1">
                            <input type="button" class="btn btn-xs btn-white" onclick="showTab2();" value="Tab 2">
                            <!--<input type="button" class="btn btn-xs btn-white" onclick="showTab3();" value="Annual">-->
                        </div>
                    </div>
                </div>
                <div class="ibox-content" id="tab1">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">2,346</h2>
                                    <small>Total orders in period</small>
                                    <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">4,422</h2>
                                    <small>Orders in last month</small>
                                    <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 60%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">9,180</h2>
                                    <small>Monthly income from orders</small>
                                    <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="ibox-content" id="tab2" style="display: none;">
                    <div class="row">
                        <div class="col-lg-9">
                            <div>
                                <canvas id="lineChart" height="50"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <ul class="stat-list">
                                <li>
                                    <h2 class="no-margins">2,346</h2>
                                    <small>Total orders in period</small>
                                    <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">4,422</h2>
                                    <small>Orders in last month</small>
                                    <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 60%;" class="progress-bar"></div>
                                    </div>
                                </li>
                                <li>
                                    <h2 class="no-margins ">9,180</h2>
                                    <small>Monthly income from orders</small>
                                    <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i></div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar"></div>
                                    </div>
                                </li>
                            </ul>
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

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $text_top_inward; ?></h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover no-margins">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Date</th>
                                <th>User</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><small>Pending...</small></td>
                                <td><i class="fa fa-clock-o"></i> 11:20pm</td>
                                <td>Samantha</td>
                                <td class="text-navy"> <i class="fa fa-level-up"></i> 24% </td>
                            </tr>
                            <tr>
                                <td><span class="label label-warning">Canceled</span> </td>
                                <td><i class="fa fa-clock-o"></i> 10:40am</td>
                                <td>Monica</td>
                                <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                            </tr>
                            <tr>
                                <td><small>Pending...</small> </td>
                                <td><i class="fa fa-clock-o"></i> 01:30pm</td>
                                <td>John</td>
                                <td class="text-navy"> <i class="fa fa-level-up"></i> 54% </td>
                            </tr>
                            <tr>
                                <td><small>Pending...</small> </td>
                                <td><i class="fa fa-clock-o"></i> 02:20pm</td>
                                <td>Agnes</td>
                                <td class="text-navy"> <i class="fa fa-level-up"></i> 12% </td>
                            </tr>
                            <tr>
                                <td><small>Pending...</small> </td>
                                <td><i class="fa fa-clock-o"></i> 09:40pm</td>
                                <td>Janet</td>
                                <td class="text-navy"> <i class="fa fa-level-up"></i> 22% </td>
                            </tr>
                            <tr>
                                <td><span class="label label-primary">Completed</span> </td>
                                <td><i class="fa fa-clock-o"></i> 04:10am</td>
                                <td>Amelia</td>
                                <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                            </tr>
                            <tr>
                                <td><small>Pending...</small> </td>
                                <td><i class="fa fa-clock-o"></i> 12:08am</td>
                                <td>Damian</td>
                                <td class="text-navy"> <i class="fa fa-level-up"></i> 23% </td>
                            </tr>
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
<!-- Mainly scripts -->
<script>

                                function showTab1() {
                                    $('#tab1').show();
                                    $('#tab2').hide();
//                $('#tab3').hide();
                                }
                                function showTab2() {
                                    $('#tab1').hide();
                                    $('#tab2').show();
//                $('#tab3').hide();
                                }
//            function showTab3() {
//                $('#tab1').hide();
//                $('#tab2').hide();
//                $('#tab3').show();
//            }
</script>
<script>
    $(document).ready(function () {
        $('.chart').easyPieChart({
            barColor: '#f8ac59',
            //                scaleColor: false,
            scaleLength: 5,
            lineWidth: 4,
            size: 80
        });

        $('.chart2').easyPieChart({
            barColor: '#1c84c6',
            //                scaleColor: false,
            scaleLength: 5,
            lineWidth: 4,
            size: 80
        });

        var data2 = [
            [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
            [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
            [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
            [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
            [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
            [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
            [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
            [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
        ];

        var data3 = [
            [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
            [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
            [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
            [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
            [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
            [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
            [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
            [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
        ];


        var dataset = [
            {
                label: "Number of orders",
                data: data3,
                color: "#1ab394",
                bars: {
                    show: true,
                    align: "center",
                    barWidth: 24 * 60 * 60 * 600,
                    lineWidth: 0
                }

            }, {
                label: "Payments",
                data: data2,
                yaxis: 2,
                color: "#1C84C6",
                lines: {
                    lineWidth: 1,
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: [{
                                opacity: 0.2
                            }, {
                                opacity: 0.4
                            }]
                    }
                },
                splines: {
                    show: false,
                    tension: 0.6,
                    lineWidth: 1,
                    fill: 0.1
                },
            }
        ];


        var options = {
            xaxis: {
                mode: "time",
                tickSize: [3, "day"],
                tickLength: 0,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 10,
                color: "#d5d5d5"
            },
            yaxes: [{
                    position: "left",
                    max: 1070,
                    color: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 3
                }, {
                    position: "right",
                    clolor: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 67
                }
            ],
            legend: {
                noColumns: 1,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: false,
                borderWidth: 0
            }
        };

        function gd(year, month, day) {
            return new Date(year, month - 1, day).getTime();
        }

        var previousPoint = null, previousLabel = null;

        $.plot($("#flot-dashboard-chart"), dataset, options);

        var mapData = {
            "US": 298,
            "SA": 200,
            "DE": 220,
            "FR": 540,
            "CN": 120,
            "AU": 760,
            "BR": 550,
            "IN": 200,
            "GB": 120,
        };

        $('#world-map').vectorMap({
            map: 'world_mill_en',
            backgroundColor: "transparent",
            regionStyle: {
                initial: {
                    fill: '#e4e4e4',
                    "fill-opacity": 0.9,
                    stroke: 'none',
                    "stroke-width": 0,
                    "stroke-opacity": 0
                }
            },

            series: {
                regions: [{
                        values: mapData,
                        scale: ["#1ab394", "#22d6b1"],
                        normalizeFunction: 'polynomial'
                    }]
            },
        });
    });
</script>
<script>
    $(document).ready(function () {

        var lineData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "Example dataset",
                    backgroundColor: "rgba(26,179,148,0.5)",
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    label: "Example dataset",
                    backgroundColor: "rgba(220,220,220,0.5)",
                    borderColor: "rgba(220,220,220,1)",
                    pointBackgroundColor: "rgba(220,220,220,1)",
                    pointBorderColor: "#fff",
                    data: [65, 59, 80, 81, 56, 55, 40]
                }
            ]
        };

        var lineOptions = {
            responsive: true
        };


        var ctx = document.getElementById("lineChart").getContext("2d");
        new Chart(ctx, {type: 'line', data: lineData, options: lineOptions});

    });
</script>
