<?php echo $header; ?>
<?php echo $nav; ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $header_title; ?></h2>
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
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><?php echo $text_form; ?></h5>
            <div class="ibox-tools">
                <div class="text-right">
                    <button type="submit" form="form-product" class="btn btn-white btn-info btn-bold" data-toggle="tooltip" title="<?php echo $button_save; ?>"><i class="ace-icon fa fa-floppy-o"></i></button>
                    <a href="<?php echo $cancel; ?>" class="btn btn-white btn-light btn-bold" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"><i class="ace-icon fa fa-reply"></i></a>
                </div>
            </div>

        </div>
        <div class="ibox-content">

            <?php if ($warning_err) : ?>
                <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $warning_err; ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form id="form-product" class="form-horizontal" action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="widget-box">
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="form-group <?php echo (!empty($error_product_name)) ? 'has-error' : ''; ?>">
                                            <label for="input-product-name" class="col-sm-2 control-label"><?php echo $entry_product_name; ?></label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="product_name" placeholder="<?php echo $entry_product_name; ?>" value="<?php echo $product_name; ?>" id="input-product-name">
                                                <?php if (isset($error_product_name)) : ?>
                                                    <span class="help-block"><?php echo $error_product_name; ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                       
                                        <hr>
                                        
                                        <div class="form-group <?php echo (!empty($error_product_code)) ? 'has-error' : ''; ?>">
                                            <label for="input-product-code" class="col-sm-2 control-label"><?php echo $entry_product_code; ?></label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="product_code" placeholder="<?php echo $entry_product_code; ?>" value="<?php echo $product_code; ?>" id="input-product-code">
                                                <?php if (isset($error_product_code)) : ?>
                                                    <span class="help-block"><?php echo $error_product_code; ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="form-group">
                                            <label for="input-sort-order" class="col-sm-2 control-label"><?php echo $entry_sort_order; ?></label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="sort_order" placeholder="<?php echo $entry_sort_order; ?>" value="<?php echo $sort_order; ?>" id="input-sort-order">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form><!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div>
<?php echo $footer; ?>
