<?php echo $header; ?>
<?php echo $nav; ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $text_title; ?></h2>
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
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $text_title; ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="">
                                <canvas id="inward"></canvas>
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
    var canvas = document.getElementById('inward');

    var jsonfile = {
        "jsonarray": [
<?php echo $inwardSummary; ?>
        ]
    };
    var jsonfile1 = {
        "jsonarray1": [
<?php echo $outwradSummary; ?>
        ]
    };

    var labels = jsonfile.jsonarray.map(function (e) {
        return e.label;
    });
    var data = jsonfile.jsonarray.map(function (e) {
        return e.value;
    });
    ;
    var data1 = jsonfile1.jsonarray1.map(function (e) {
        return e.value;
    });
    ;


    var data = {
        labels: labels,
        datasets: [{
                label: "Inward(MT)",
                backgroundColor: "#1c84c6",
                borderColor: "#1c84c6",
                borderWidth: 1,
                hoverBackgroundColor: "#1c84c6",
                hoverBorderColor: "#1c84c6",
                data: data,
                xAxisID: 'x1',
            }, {
                label: "Outward(MT)",
                backgroundColor: "#23c6c8",
                borderColor: "#23c6c8",
                borderWidth: 1,
                hoverBackgroundColor: "#23c6c8",
                hoverBorderColor: "#23c6c8",
                data: data1
            }]
    };
    var option = {
        legend: {
            onClick: (e) => e.stopPropagation()
        },
        "animation": {
            "duration": 1,
            "onComplete": function () {
                var chartInstance = this.chart,
                        ctx = chartInstance.ctx;

                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';

                this.data.datasets.forEach(function (dataset, i) {
                    var meta = chartInstance.controller.getDatasetMeta(i);
                    meta.data.forEach(function (bar, index) {
                        var data = dataset.data[index];
                        ctx.fillText(data, bar._model.x + 25, bar._model.y + 7);
                    });
                });
            }
        },
        scales: {

            yAxes: [{
                    barPercentage: 0.6,
                    gridLines: {
                        display: true,
                        color: "rgba(255,99,132,0.2)"
                    },
                    ticks: {
                        fontColor: "#000"

                    }
                }],
            xAxes: [{
                    id: 'x1',
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        fontColor: "#000"

                    }},

                {
                    id: 'x2',
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        display: false
                    }
                }
            ]
        }
    };
    var ctx = document.getElementById("inward").getContext('2d');

    var myBarChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: data,
        options: option
    });

</script>
