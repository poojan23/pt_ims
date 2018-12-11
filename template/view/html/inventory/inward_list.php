<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Popaya Technology | Inward</title>
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
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $text_list; ?></h5>
                                    <div class="ibox-tools">
                                        <a href="<?php echo $add; ?>" class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>

                                </div>
                                <div class="ibox-content">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" id="table-client">
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
                                                    <th><?= $head_pack; ?></th>
                                                    <th><?= $head_action; ?></th>
                                                </tr>
                                            </thead>

                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php echo $footer; ?>
                <script src="<?php echo HTTP_SERVER; ?>view/dist/js/plugins/dataTables/datatables.min.js"></script>
                <script>
                    $(document).ready(function () {
                        var table = $('#table-client').DataTable({
                            pageLength: 10,
                            responsive: true,
                            dom: '<"html5buttons"B>lTfgitp',
                            buttons: [
                                {extend: 'copy'},
                                {extend: 'csv'},
                                {extend: 'excel', title: 'ExampleFile'},
                                {extend: 'pdf', title: 'ExampleFile'},

                                {extend: 'print',
                                    customize: function (win) {
                                        $(win.document.body).addClass('white-bg');
                                        $(win.document.body).css('font-size', '10px');

                                        $(win.document.body).find('table')
                                                .addClass('compact')
                                                .css('font-size', 'inherit');
                                    }
                                }
                            ],
                            'ajax': {
                                url: 'index.php?url=inventory/inward/getData&user_token=' + getURLVar('user_token'),
                                dataType: 'json',
                                type: 'POST',
                            },
                            "columns": [

                                {"data": "createDate"},
                                {"data": "tructNo"},
                                {"data": "partyName"},
                                
                                {"data": "product_type"},
                                {"data": "grade"},
                                {"data": "coilNo"},
                                {"data": "thickness"},
                                {"data": "width"},
                                {"data": "length"},
                                {"data": "pieces"},
                                {"data": "netWeight"},
                                {"data": "grossWeight"},
                                {
                                    "data": "packaging",
                                    render: function(data, type, row) {
                                        return data == 1 ? 'Yes' : 'No'
                                    },
                                },
                                {
                                "data": function(data, type, row) {
                                    if ( type === 'display' ) {
                                         return '<a href=""  class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>&nbsp;<a href=""  class="btn btn-info btn-sm"><i class="fa fa-trash"></i></a>';
                                     }
                                     return data;
                                },
                                className: "dt-center nowrap text-center",
                                searchable: false,
                                orderable: false,
                                width: 80
                            },
                                
                            ],

                        });

                    });

                </script>

