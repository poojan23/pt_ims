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
                        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-bold" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-user-group').submit() : false;"><i class="fa fa-trash-o"></i></button>
                    </div>

                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="table-user_group">
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
                                var table = $('#table-user_group').DataTable({
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
                                        url: 'index.php?url=user/user_permission/getData&member_token=' + getURLVar('member_token'),
                                        dataType: 'json',
                                        type: 'POST',
                                    },
                                    "columns": [

                                        {
                                            data: "member_group_id",
                                            render: function (data, type, row) {
                                                if (type === 'display') {
                                                    return '<label class="pos-rel"><input type="checkbox" name="selected[]" class="ace" value="' + data[0] + '" /><span class="lbl"></span></label>';
                                                }
                                                return data;
                                            },
                                            "className": "center",
                                            "bSearchable": false,
                                            "bSortable": false
                                        },
                                        {data: "name"},
                                        {data: 'sort_order'},
                                        {
                                            data: function (data, type, row) {
                                                if (type === 'display') {
                                                    return '<a href="<?php echo $edit; ?>&member_group_id=' + data.member_group_id + '" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></a>';
                                                }
                                                return data;
                                            },
                                            "bSearchable": false,
                                            "bSortable": false,
                                            "width": 80
                                        }
                                    ],

                                });

                            });

</script>