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
<!--                <div class="ibox-title">
                    <h5><?= $text_title; ?></h5>
                    <div class="ibox-tools">
                        <a href="<?php echo $add; ?>" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-bold" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-inward').submit() : false;"><i class="fa fa-trash-o"></i></button>
                    </div>

                </div>-->
                <div class="ibox-content">
                    <form action="<?php echo $delete; ?>" method="POST" enctype="multipart/form-data" id="form-inward">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="table-inward">
                                <thead>
                                    <tr>
                                        <th style="width: 1px;" class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th><?= $head_client_name; ?></th>
                                        <th><?= $head_opening; ?></th>
                                        <th><?= $head_inward; ?></th>
                                        <th><?= $head_outward; ?></th>
                                        <th><?= $head_closing; ?></th>
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
                                var table = $('#table-inward').DataTable({
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
                                        url: 'index.php?url=report/stock_balance/getData&member_token=' + getURLVar('member_token'),
                                        dataType: 'json',
                                        type: 'POST',
                                    },
                                    "columns": [

                                        {
                                            data: "customer_id",
                                            render: function (data, type, row) {
                                                if (type === 'display') {
                                                    return '<label class="pos-rel"><input type="checkbox" name="selected[]" class="ace" value="' + data + '" /><span class="lbl"></span></label>';
                                                }
                                                return data;
                                            },
                                            "className": "center",
                                            "bSearchable": false,
                                            "bSortable": false
                                        },
                                        {"data": "customer_name"},
                                        {"data": "opening_gross_weight"},
                                        {"data": "inwardTotal"},
                                        {"data": "outwardTotal"},
                                        {"data": "closing_gross_weight"}
                                    
                                    ],

                                });

                            });

</script>

