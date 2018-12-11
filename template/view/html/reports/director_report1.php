<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Popaya Technology | Director Report</title>
        <link href="<?php echo HTTP_SERVER; ?>view/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo HTTP_SERVER; ?>view/dist/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo HTTP_SERVER; ?>view/dist/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
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
                        <div class="col-lg-6">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Line Chart Example
                                        <small>With custom colors.</small>
                                    </h5>
                                </div>
                                <div class="ibox-content">
                                    <div>
                                        <canvas id="lineChart" height="140"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Bar Chart Example</h5>
                                </div>
                                <div class="ibox-content">
                                    <div>
                                        <canvas id="barChart" height="140"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Polar Area</h5>

                                </div>
                                <div class="ibox-content">
                                    <div class="text-center">
                                        <canvas id="polarChart" height="140"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Pie </h5>

                                </div>
                                <div class="ibox-content">
                                    <div>
                                        <canvas id="doughnutChart" height="140"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <?php echo $footer; ?>
<script>
    $(function () {

        var lineData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [

                {
                    label: "Data 1",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [28, 48, 40, 19, 86, 27, 90]
                }, {
                    label: "Data 2",
                    backgroundColor: 'rgba(220, 220, 220, 0.5)',
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

        var barData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "Data 1",
                    backgroundColor: 'rgba(220, 220, 220, 0.5)',
                    pointBorderColor: "#fff",
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
                {
                    label: "Data 2",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [28, 48, 40, 19, 86, 27, 90]
                }
            ]
        };

        var barOptions = {
            responsive: true
        };


        var ctx2 = document.getElementById("barChart").getContext("2d");
        new Chart(ctx2, {type: 'bar', data: barData, options: barOptions});

        var polarData = {
            datasets: [{
                    data: [
                        300, 140, 200
                    ],
                    backgroundColor: [
                        "#a3e1d4", "#dedede", "#b5b8cf"
                    ],
                    label: [
                        "My Radar chart"
                    ]
                }],
            labels: [
                "App", "Software", "Laptop"
            ]
        };

        var polarOptions = {
            segmentStrokeWidth: 2,
            responsive: true

        };

        var ctx3 = document.getElementById("polarChart").getContext("2d");
        new Chart(ctx3, {type: 'polarArea', data: polarData, options: polarOptions});

        var doughnutData = {
            labels: ["App", "Software", "Laptop"],
            datasets: [{
                    data: [300, 50, 100],
                    backgroundColor: ["#a3e1d4", "#dedede", "#b5b8cf"]
                }]
        };


        var doughnutOptions = {
            responsive: true
        };


        var ctx4 = document.getElementById("doughnutChart").getContext("2d");
        new Chart(ctx4, {type: 'doughnut', data: doughnutData, options: doughnutOptions});

    });
</script>