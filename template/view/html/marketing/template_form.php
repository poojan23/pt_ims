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
        <div id="content" class="ibox-content">
            <div class="">
<!--                <h1 class="pull-left">
                    <?php echo $text_title; ?>
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        <?php echo $text_title; ?>
                    </small>
                </h1>-->
                <div class="">
                   
                    <div class="ibox-tools">
                        <div class="text-right">
                            <button type="submit" form="form-template" class="btn btn-white btn-info btn-bold" data-toggle="tooltip" title="<?php echo $button_save; ?>"><i class="ace-icon fa fa-envelope-o"></i></button>
                            <a href="<?php echo $cancel; ?>" class="btn btn-white btn-light btn-bold" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"><i class="ace-icon fa fa-reply"></i></a>
                        </div>
                    </div>

                </div>
            </div><!-- /.page-header -->
            <div class="alert-box"></div>
             <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form id="form-template" class="form-horizontal" action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="widget-box">
<!--                                <div class="widget-header">
                                    <h4 class="widget-title"><i class="ace-icon fa fa-envelope"></i> <?php echo $text_form; ?></h4>
                                </div>-->

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                                            <label for="input-title" class="col-sm-2 control-label"><?php echo $entry_title; ?> <span class="red">*</span></label>

                                            <div class="col-sm-10">
                                                <input type="text" name="title" placeholder="<?php echo $entry_title; ?>" value="<?php echo $title; ?>" class="form-control" id="input-title">
                                                <?php if(isset($title_err)) : ?>
                                                <span class="help-block"><?php echo $title_err; ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <hr>

                                        <div id="subject" class="form-group <?php echo (!empty($subject_err)) ? 'has-error' : ''; ?>">
                                            <label for="input-subject" class="col-sm-2 control-label"><?php echo $entry_subject; ?> <span class="red">*</span></label>
            
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="subject" placeholder="<?php echo $entry_subject; ?>" value="<?php echo $subject; ?>" id="input-subject">
                                                <?php if(isset($subject_err)) : ?>
                                                <span class="help-block"><?php echo $subject_err; ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <hr />

                                        <div id="message" class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                                            <label for="input-message" class="col-sm-2 control-label"><?php echo $entry_message; ?> <span class="red">*</span></label>

                                            <div class="col-sm-10">
                                                <textarea name="message" placeholder="<?php echo $entry_message; ?>" class="form-control" id="input-message" data-toggle="ckeditor" data-lang="<?php echo $ckeditor; ?>"><?php echo $message; ?></textarea>
                                                <?php if(isset($message_err)) : ?>
                                                <span class="help-block"><?php echo $message_err; ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <label for="input-status" class="col-sm-2 control-label"><?php echo $text_status; ?></label>

                                            <div class="col-sm-10">
                                                <label>
                                                    <?php if($status) : ?>
                                                    <input id="input-status" name="status" value="1" checked="checked" type="checkbox" class="ace ace-switch ace-switch-5">
                                                    <?php else : ?>
                                                    <input id="input-status" name="status" value="1" type="checkbox" class="ace ace-switch ace-switch-5">
                                                    <?php endif; ?>
                                                    <span class="lbl middle"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_legends; ?>"><?php echo $text_placeholder; ?></span></label>

                                            <div class="col-sm-10">
                                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" style="font-size: 14px;">
                                                            <thead>
                                                                <tr>
                                                                    <th><?php echo $text_legend; ?></th>
                                                                    <th><?php echo $text_remarks; ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach($legends as $key => $value) : ?>
                                                                <tr>
                                                                    <td><?php echo $key; ?></td>
                                                                    <td><?php echo $value; ?></td>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
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
</div><!-- /.main-content -->

<?php echo $footer; ?>
<script type="text/javascript">
    $('textarea[data-toggle=\'ckeditor\']').ckeditor();
</script>