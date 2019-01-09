<?php echo $header; ?>
<?php echo $nav; ?>
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $text_reports; ?></h5>

                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="io-bar-chart">
                                <canvas id="weekly_report" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php // echo $text_reports; ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-danger col-md-12">
                                <div class="col-md-12">
                                    <div class="box-body chart-responsive io-bar-chart">
                                        <canvas id="monthly_report"></canvas>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php // echo $text_reports; ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-danger col-md-12">
                                <div class="col-md-12">
                                    <div class="box-body chart-responsive io-bar-chart">
                                        <canvas id="quarterly_report"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php // echo $text_reports; ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-danger col-md-12">
                                <div class="col-md-12">
                                    <div class="box-body chart-responsive io-bar-chart">
                                        <canvas id="yearly_report"></canvas>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
<!--            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php // echo $text_reports; ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-danger col-md-12">
                                <div class="col-md-12">
                                    <div class="box-body chart-responsive io-bar-chart">
                                        <canvas id="quarterly_report"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>-->
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
        var jsonfile = {
            "jsonarray": [
<?php echo $weekly_report; ?>
            ]
        };


        var labels = jsonfile.jsonarray.map(function (e) {
            return e.commonDate;
        });
        var data = jsonfile.jsonarray.map(function (e) {
            return e.inwardTotal;
        });
        ;
        var data1 = jsonfile.jsonarray.map(function (e) {
            return e.outwardTotal;
        });
        ;
var barChartData = {
  labels: labels,
  datasets: [
    {
      label: "Inward(MT)",
      backgroundColor: "#1c84c6",
      borderColor: "#1c84c6",
      borderWidth: 1,
      data: data
    },
    {
      label: "Outward(MT)",
      backgroundColor: "#23c6c8",
      borderColor: "#23c6c8",
      borderWidth: 1,
      data: data1
    }
  ]
};

var chartOptions = {
    legend: {
        onClick: (e) => e.stopPropagation()
    },
    plugins: {
        labels: {
            render: 'value'
        }
    },
    maintainAspectRatio: false,
  responsive: true,
  legend: {
    position: "top"
  },
  title: {
    display: true,
    text: "Last 7 Days Inward Vs Outward"
  },
  scales: {
    yAxes: [{
      ticks: {
        beginAtZero: true
      }
    }]
  }
}


 var jsonfile2 = {
            "jsonarray2": [
<?php echo $monthly_report; ?>
            ]
        };


        var labels1 = jsonfile2.jsonarray2.map(function (e) {
            return e.common_Date;
        });
        var data2 = jsonfile2.jsonarray2.map(function (e) {
            return e.inward_Total;
        });
        ;
        var data3 = jsonfile2.jsonarray2.map(function (e) {
            return e.outward_Total;
        });
        ;
var barChartData2 = {
  labels: labels1,
  datasets: [
    {
      label: "Inward(MT)",
      backgroundColor: "#1c84c6",
      borderColor: "#1c84c6",
      borderWidth: 1,
      data: data2
    },
    {
      label: "Outward(MT)",
      backgroundColor: "#23c6c8",
      borderColor: "#23c6c8",
      borderWidth: 1,
      data: data3
    }
  ]
};

var chartOptions2 = {
    legend: {
        onClick: (e) => e.stopPropagation()
    },
    plugins: {
        labels: {
            render: 'value'
        }
    },
    
  responsive: true,
  legend: {
    position: "top"
  },
  title: {
    display: true,
    text: "Monthly Inward Vs Outward"
  },
  scales: {
    yAxes: [{
            
      ticks: {
        beginAtZero: true
      }
    }],
    xAxes: [{
             barPercentage: 0.8,
     
    }]
  }
}

var jsonfile3 = { "jsonarray3": <?php echo $quarterly_report; ?> };


        var labels2 = jsonfile3.jsonarray3.map(function (e) {
            return e.common_date;
        });
        var data4 = jsonfile3.jsonarray3.map(function (e) {
            return e.inward_total;
        });
        ;
        var data5 = jsonfile3.jsonarray3.map(function (e) {
            return e.outward_total;
        });
        ;
var barChartData3 = {
  labels: labels2,
  datasets: [
    {
      label: "Inward(MT)",
      backgroundColor: "#1c84c6",
      borderColor: "#1c84c6",
      borderWidth: 1,
      data: data4
    },
    {
      label: "Outward(MT)",
      backgroundColor: "#23c6c8",
      borderColor: "#23c6c8",
      borderWidth: 1,
      data: data5
    }
  ]
};

var chartOptions3 = {
    legend: {
        onClick: (e) => e.stopPropagation()
    },
    plugins: {
        labels: {
            render: 'value'
        }
    },
  responsive: true,
  legend: {
    position: "top"
  },
  title: {
    display: true,
    text: "Quarterly Inward Vs Outward"
  },
  scales: {
    yAxes: [{
      ticks: {
        beginAtZero: true
      }
    }]
  }
}


//var jsonfile4 = {
//            "jsonarray4": [
//
//            <?php echo $chart_data_in_out_month; ?>
//            ]
//        };
//
//
//        var labels3 = jsonfile4.jsonarray4.map(function (e) {
//            return e.common_Date;
//        });
//        var data6 = jsonfile4.jsonarray4.map(function (e) {
//            return e.inward_Total;
//        });
//        ;
//        var data7 = jsonfile4.jsonarray4.map(function (e) {
//            return e.outward_Total;
//        });
//        ;
//var barChartData4 = {
//    
//  labels: labels3,
//  datasets: [
//    {
//      label: "Inward(MT)",
//      backgroundColor: "#1c84c6",
//      borderColor: "#1c84c6",
//      borderWidth: 1,
//      data: data6
//    },
//    {
//      label: "Outward(MT)",
//      backgroundColor: "#23c6c8",
//      borderColor: "#23c6c8",
//      borderWidth: 1,
//      data: data7
//    }
//  ]
//};
//
//var chartOptions4 = {
//    legend: {
//        onClick: (e) => e.stopPropagation()
//    },
//    plugins: {
//        labels: {
//            render: 'value'
//        }
//    },
//  responsive: true,
//  legend: {
//    position: "top"
//  },
//  title: {
//    display: true,
//    text: "Last 6 Month Inward Vs Outward"
//  },
//  scales: {
//    yAxes: [{
//      ticks: {
//        beginAtZero: true
//      }
//    }]
//  }
//}
//


var jsonfile5 = {
            "jsonarray5": [

            <?php echo $yearly_report; ?>
            ]
        };


        var labels4 = jsonfile5.jsonarray5.map(function (e) {
            return e.common_Date;
        });
        var data8 = jsonfile5.jsonarray5.map(function (e) {
            return e.inward_Total;
        });
        ;
        var data9 = jsonfile5.jsonarray5.map(function (e) {
            return e.outward_Total;
        });
        ;
var barChartData5 = {
  labels: labels4,
  datasets: [
    {
      label: "Inward(MT)",
      backgroundColor: "#1c84c6",
      borderColor: "#1c84c6",
      borderWidth: 1,
      data: data8
    },
    {
      label: "Outward(MT)",
      backgroundColor: "#23c6c8",
      borderColor: "#23c6c8",
      borderWidth: 1,
      data: data9
    }
  ]
};

var chartOptions5 = {
  responsive: true,
  legend: {
        onClick: (e) => e.stopPropagation()
    },
    plugins: {
        labels: {
            render: 'value'
        }
    },
    
  title: {
    display: true,
    text: "Yearly Inward Vs Outward"
  },
  scales: {
    yAxes: [{
      ticks: {
        beginAtZero: true
      }
    }],
    xAxes: [{
             barPercentage: 0.8,
     
    }]
  }
}


window.onload = function() {
  var ctx = document.getElementById("weekly_report").getContext("2d");
  window.myBar = new Chart(ctx, {
    type: "bar",
    data: barChartData,
    options: chartOptions
  });
  
    var ctx1 = document.getElementById("monthly_report").getContext("2d");
  window.myBar = new Chart(ctx1, {
    type: "bar",
    data: barChartData2,
    options: chartOptions2
  });
  
    var ctx2 = document.getElementById("quarterly_report").getContext("2d");
  window.myBar = new Chart(ctx2, {
    type: "bar",
    data: barChartData3,
    options: chartOptions3
  });
//    var ctx3 = document.getElementById("canvas_lastsixmonth").getContext("2d");
//  window.myBar = new Chart(ctx3, {
//    type: "bar",
//    data: barChartData4,
//    options: chartOptions4
//  });
    var ctx4 = document.getElementById("yearly_report").getContext("2d");
  window.myBar = new Chart(ctx4, {
    type: "bar",
    data: barChartData5,
    options: chartOptions5
  });
};

    </script>