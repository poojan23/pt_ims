<?php echo $header; ?>
<?php echo $nav; ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $text_title; ?></h2>
        <ol class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb) : ?>
                <li>
                    <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
                </li>
            <?php endforeach; ?> 
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <?php if ($success) : ?>
        <div class="alert alert-success alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?= $text_title; ?></h5>
                    <div class="ibox-tools">
                        <a href="<?php echo $add; ?>" class="btn btn-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-bold" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-product-type').submit() : false;"><i class="fa fa-trash-o"></i></button>
                    </div>

                </div>
                <div class="ibox-content">
                    <form action="<?php echo $delete; ?>" method="POST" enctype="multipart/form-data" id="form-product-type">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="table-producttype">
                                <thead>
                                    <tr>
                                        <th style="width: 1px;" class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace" />
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th><?php echo $column_name; ?></th>
                                        <th><?php echo $column_sort_order; ?></th>
                                        <th><?php echo $column_action; ?></th>
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
                                var myTable =
                                        $('#table-producttype')
                                        .DataTable({
                                            bAutoWidth: false,
                                            order: [[1, 'asc']],
                                            "aoColumns": [
                                                {
                                                    data: "product_type_id",
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
                                                {data: "product_type"},
                                                {data: "sort_order"},
                                                {
                                                    data: function (data, type, row) {
                                                        if (type === 'display') {
                                                            return '<a href="<?php echo $edit; ?>&product_type_id=' + data.product_type_id + '" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></a>';
                                                        }
                                                        return data;
                                                    },
                                                    "bSearchable": false,
                                                    "bSortable": false,
                                                    "width": 80
                                                }
                                            ],
                                            "aaSorting": [],

                                            "bProcessing": true,
                                            //"bServerSide": true,
                                            "sAjaxSource": "index.php?url=product/product_type/getData&member_token=" + getURLVar('member_token'),
                                        });
                            });

</script>