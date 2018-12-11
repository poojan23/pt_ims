<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Popaya Technology | User</title>
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
<!--                                                <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-product').submit() : false;">
                                            <i class="fa fa-trash"></i>
                                        </button>-->
                                    </div>
                                </div>
                                <div class="ibox-content">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                            <thead>
                                                <tr>
                                                    <th><?= $head_name; ?></th>
                                                    <th><?= $head_email; ?></th>
                                                    <th><?= $head_mobile; ?></th>
                                                    <th><?= $head_role; ?></th>
                                                    <th><?= $head_action; ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="gradeX">
                                                    <td>Trident1</td>
                                                    <td>Internet
                                                        Explorer 4.0
                                                    </td>
                                                    <td>1234566</td>
                                                    <td>1234566</td>
                                                    <td class="center">X</td>
                                                </tr>
                                                <tr class="gradeX">
                                                    <td>Trident2</td>
                                                    <td>Internet
                                                        Explorer 4.0
                                                    </td>
                                                    <td>1234566</td>
                                                    <td>1234566</td>
                                                    <td class="center">X</td>
                                                </tr>
                                                <tr class="gradeX">
                                                    <td>Trident3</td>
                                                    <td>Internet
                                                        Explorer 4.0
                                                    </td>
                                                    <td>1234566</td>
                                                    <td>1234566</td>
                                                    <td class="center">X</td>
                                                </tr>
                                                <tr class="gradeX">
                                                    <td>Trident4</td>
                                                    <td>Internet
                                                        Explorer 4.0
                                                    </td>
                                                    <td>1234566</td>
                                                    <td>1234566</td>
                                                    <td class="center">X</td>
                                                </tr>
                                                <tr class="gradeX">
                                                    <td>Trident5</td>
                                                    <td>Internet
                                                        Explorer 4.0
                                                    </td>
                                                    <td>1234566</td>
                                                    <td>1234566</td>
                                                    <td class="center">X</td>
                                                </tr>

                                                </tfoot>
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
                        $('.dataTables-example').DataTable({
                            pageLength: 25,
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
                            ]

                        });

                    });

                </script>

