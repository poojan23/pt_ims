<?php echo $header; ?>
<?php echo $nav; ?>
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $text_reports; ?></h5>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php // echo $text_reports; ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-danger col-md-12">
                                <div class="col-md-12">
                                    <div class="box-header with-border">
                                        <center><h3 class="box-title">Grade wise classification</h3></center>

                                    </div>
                                    <div class="box-body chart-responsive io-bar-chart">
                                        <canvas id="gradePieChart"></canvas>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="box box-danger col-md-12">
                                <div class="col-md-12">
                                    <div class="box-header with-border">
                                        <center><h3 class="box-title">Thickness wise classification</h3></center>

                                    </div>
                                    <div class="box-body chart-responsive io-bar-chart">
                                        <canvas id="thicknessPieChart"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
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

<script>
    var canvas = document.getElementById("gradePieChart");
    var ctx = canvas.getContext('2d');

// Global Options:
    Chart.defaults.global.defaultFontColor = 'black';
    Chart.defaults.global.defaultFontSize = 16;
    var jsonfile = {
        "jsonarray": [
<?php echo trim($grade, "[,]"); ?>

        ]
    };

    var labels = jsonfile.jsonarray.map(function (e) {
        return e.label;
    });
    var data = jsonfile.jsonarray.map(function (e) {
        return e.value;
    });
    ;
    var data = {
        labels: labels,
        datasets: [
            {
                fill: true,
                backgroundColor: [
                    "#3498db",
                    "#9b59b6",
                    "#95a5a6",
                    "#f1c40f",
                    "#34495e",
                    "#2ecc71",
                    "#FAEBD7",
                    "#DCDCDC"],
                data: data,
            }
        ]
    };

// Notice the rotation from the documentation.

    var options = {
        legend: {
            onClick: (e) => e.stopPropagation()
        },
        plugins: {

            labels: {
                render: 'percentage',
                fontColor: '#000',
                position: 'outside',
                fontSize: 12
            }

        },
        title: {
            display: true,
            position: 'top'
        },
        rotation: -0.7 * Math.PI
    };


// Chart declaration:
    var myBarChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
    });

// Fun Fact: I've lost exactly 3 of my favorite T-shirts and 2 hoodies this way :|

</script>
<script>
    var canvas = document.getElementById("thicknessPieChart");
    var ctx = canvas.getContext('2d');

// Global Options:
    Chart.defaults.global.defaultFontColor = '#000';
    Chart.defaults.global.defaultFontSize = 16;
    var jsonfile_1 = {
        "jsonarray_1": [
<?php echo trim($thickness, "[,]"); ?>

        ]
    };

    var labels = jsonfile_1.jsonarray_1.map(function (e) {
        return e.label;
    });
    var data = jsonfile_1.jsonarray_1.map(function (e) {
        return e.value;
    });
    ;
    var data = {
        labels: labels,
        datasets: [
            {
                fill: true,
                backgroundColor: [
                    "#1ab394",
                    "#ed5565"
                    ],
                data: data,

            }
        ]
    };

// Notice the rotation from the documentation.

    var options = {
        legend: {
            onClick: (e) => e.stopPropagation()
        },
        plugins: {

            labels: {
                render: 'percentage',
                fontColor: '#fff',
                fontSize: 16
            }

        },
        title: {
            display: true,

            position: 'top'
        },
        rotation: -0.7 * Math.PI
    };


// Chart declaration:
    var myBarChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
    });


</script>