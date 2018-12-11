<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Popaya Technology | Add Product</title>
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
                            <?php if ($warning_err) : ?>
                                <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $warning_err; ?>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            <?php endif; ?>
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?= $heading_sub; ?></h5>
                                    <div class="ibox-tools">
                                        <button type="submit" form="form-category" class="collapse-link btn btn-primary">
                                            <i class="fa fa-floppy-o"></i>
                                        </button>
                                        <a href="<?php echo $cancel; ?>" class="dropdown-toggle">
                                            <i class="fa fa-reply"></i>
                                        </a>

                                    </div>
                                </div>

                                <div class="ibox-content">
                                    <form method="get" class="form-horizontal">

                                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_product_name; ?></label>
                                            <div class="col-sm-10"><input type="text" class="form-control" placeholder="<?= $entry_product_name; ?>"></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group"><label class="col-sm-2 control-label"><?= $label_code; ?></label>
                                            <div class="col-sm-10"><input type="text" class="form-control" placeholder="<?= $entry_code; ?>"></div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo $footer; ?>

