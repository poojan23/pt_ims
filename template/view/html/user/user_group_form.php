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
                    <button type="submit" form="form-user-group" class="btn btn-white btn-info btn-bold" data-toggle="tooltip" title="<?php echo $button_save; ?>"><i class="ace-icon fa fa-floppy-o"></i></button>
                    <a href="<?php echo $cancel; ?>" class="btn btn-white btn-light btn-bold" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"><i class="ace-icon fa fa-reply"></i></a>
                </div>
            </div>

        </div>
        <div class="ibox-content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form id="form-user-group" class="form-horizontal" action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="widget-box">

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                            <label for="input-name" class="col-sm-2 control-label"><?php echo $entry_name; ?> <span class="red">*</span></label>

                                            <div class="col-sm-10">
                                                <?php foreach ($languages as $language) : ?>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><img src="template/language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" alt=""></span>
                                                        <input type="text" class="form-control" name="user_group_description[<?php echo $language['language_id']; ?>][name]" placeholder="<?php echo $entry_name; ?>" value="<?php echo isset($user_group_description[$language['language_id']]) ? $user_group_description[$language['language_id']]['name'] : ''; ?>" id="input-name">
                                                    </div>
                                                    <?php if (isset($name_err[$language['language_id']])) : ?>
                                                        <span class="help-block"><?php echo $name_err[$language['language_id']]; ?></span>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <hr>

                                        <?php foreach ($languages as $language) : ?>
                                            <div class="form-group">
                                                <label for="input-description<?php echo $language['language_id']; ?>" class="col-sm-2 control-label"><?php echo $entry_description; ?></label>

                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><img src="template/language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" alt=""></span>
                                                        <textarea name="user_group_description[<?php echo $language['language_id']; ?>][description]" rows="5" placeholder="<?php echo $entry_description; ?>" id="input-description<?php echo $language['language_id']; ?>" class="form-control"><?php echo isset($user_group_description[$language['language_id']]) ? $user_group_description[$language['language_id']]['description'] : ''; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <hr>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $entry_access; ?></label>

                                            <div class="col-sm-10">
                                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                                    <?php foreach ($permissions as $permission) : ?>
                                                        <div class="checkbox">
                                                            <label>
                                                                <?php if (in_array($permission, $access)) : ?>
                                                                    <input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>" checked="checked"> <?php echo $permission; ?> <?php else : ?>
                                                                    <input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>"> <?php echo $permission; ?>
                                                                <?php endif; ?>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <button type="button" onclick="$(this).parent().find(':checkbox').prop('checked', true);" class="btn btn-link"><?php echo $text_select_all; ?></button> /
                                                <button type="button" onclick="$(this).parent().find(':checkbox').prop('checked', false);" class="btn btn-link"><?php echo $text_unselect_all; ?></button>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo $entry_modify; ?></label>

                                            <div class="col-sm-10">
                                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                                    <?php foreach ($permissions as $permission) : ?>
                                                        <div class="checkbox">
                                                            <label>
                                                                <?php if (in_array($permission, $modify)) : ?>
                                                                    <input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>" checked="checked"> <?php echo $permission; ?> <?php else : ?>
                                                                    <input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>"> <?php echo $permission; ?>
                                                                <?php endif; ?>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <button type="button" onclick="$(this).parent().find(':checkbox').prop('checked', true);" class="btn btn-link"><?php echo $text_select_all; ?></button> /
                                                <button type="button" onclick="$(this).parent().find(':checkbox').prop('checked', false);" class="btn btn-link"><?php echo $text_unselect_all; ?></button>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <label for="input-sort-order" class="col-sm-2 control-label"><?php echo $entry_sort_order; ?></label>

                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="sort_order" placeholder="<?php echo $entry_sort_order; ?>" value="<?php echo $sort_order; ?>" id="input-sort-order">
                                            </div>
                                        </div>

                                        <hr />
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
