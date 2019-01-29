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
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form action="<?php echo $delete; ?>" method="POST" enctype="multipart/form-data" id="form-inward">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="table_stock">
                                <thead>
                                    <tr>
                                        <th><?= $head_coil_no; ?></th>
                                        <th><?= $head_inward; ?></th>
                                        <th><?= $head_outward; ?></th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form action="<?php echo $delete; ?>" method="POST" enctype="multipart/form-data" id="form-inward">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="table_stock_balance">
                                <thead>
                                    <tr>
                                        <th><?= $head_date; ?></th>
                                        <th><?= $head_purchase_no; ?></th>
                                        <th><?= $head_description; ?></th>
                                        <th><?= $head_coil_no; ?></th>
                                        <th><?= $head_product_type; ?></th>
                                        <th><?= $head_service_type; ?></th>
                                        <th><?= $head_delivery_no; ?></th>
                                        <th><?= $head_inward; ?></th>
                                        <th><?= $head_outward; ?></th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
<?php echo $footer; ?>

<script src="template/view/dist/js/jquery.dataTables.min.js"></script>
<script src="template/view/dist/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="template/view/dist/js/dataTables.buttons.min.js"></script>
<script src="template/view/dist/js/buttons.flash.min.js"></script>
<script src="template/view/dist/js/buttons.html5.min.js"></script>
<script src="template/view/dist/js/buttons.print.min.js"></script>
<script src="template/view/dist/js/buttons.colVis.min.js"></script>
<script src="template/view/dist/js/dataTables.select.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $('#table_stock').DataTable({
            processing: true,
            serverSide: false,
            order: [[1, 'asc']],
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
                url: 'index.php?url=report/stock_report/getData&member_token=' + getURLVar('member_token') + '&customer_id=<?php echo $customer_id; ?>',
                dataType: 'json',
                type: 'POST',
            },
            "columns": [
                {"data": "coil_no"},
                {"data": "inwardTotal"},
                {"data": "outwardTotal"}
            ],

        });
        var table1 = $('#table_stock_balance').DataTable({
            processing: true,
            serverSide: false,
            order: [[1, 'desc']],
            paging: false,
            ordering: false,
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

                        $(win.document.body).find('table1')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                    }
                }
            ],
            'ajax': {
                url: 'index.php?url=report/stock_report/getStockBalance&member_token=' + getURLVar('member_token') + '&customer_id=<?php echo $customer_id; ?>',
                dataType: 'json',
                type: 'POST',
            },
            "columns": [

                {"data": "crtDate"},
                {"data": "purchase_no"},
                {"data": "description"},
                {"data": "coil_no"},
                {"data": "product_type"},
                {"data": "service_type"},
                {"data": "delivery_no"},
                {"data": "in_gross_weight"},
                {"data": "out_gross_weight"}
            ],

        });

    });

</script>

