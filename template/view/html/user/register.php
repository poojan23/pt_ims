<?php echo $header; ?>
<?php echo $nav; ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $header_title; ?></h2>
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
<div class="wrapper wrapper-content">

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><?php echo $text_add; ?></h5>
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
                                        <fieldset>
                                            <legend><?php echo $text_account; ?></legend>
                                            <div class="form-group">
                                                <label for="input-user-group" class="col-sm-2 control-label"><?php echo $entry_user_group; ?></label>

                                                <div class="col-sm-10">
                                                    <select name="member_group_id" class="form-control" id="input-user-group">
                                                        <?php foreach ($user_groups as $user_group) : ?>
                                                            <?php if ($user_group['member_group_id'] == $member_group_id) : ?>
                                                                <option value="<?php echo $user_group['member_group_id']; ?>" selected="selected"><?php echo $user_group['name']; ?></option>
                                                            <?php else : ?>
                                                                <option value="<?php echo $user_group['member_group_id']; ?>"><?php echo $user_group['name']; ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                                                <label for="input-firstname" class="col-sm-2 control-label"><?php echo $entry_firstname; ?> <span class="red">*</span></label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="firstname" placeholder="<?php echo $entry_firstname; ?>" value="<?php echo $firstname; ?>" id="input-firstname">
                                                    <?php if (isset($firstname_err)) : ?>
                                                        <span class="help-block"><?php echo $firstname_err; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                                                <label for="input-lastname" class="col-sm-2 control-label"><?php echo $entry_lastname; ?> <span class="red">*</span></label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="lastname" placeholder="<?php echo $entry_lastname; ?>" value="<?php echo $lastname; ?>" id="input-lastname">
                                                    <?php if (isset($lastname_err)) : ?>
                                                        <span class="help-block"><?php echo $lastname_err; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                                <label for="input-email" class="col-sm-2 control-label"><?php echo $entry_email; ?> <span class="red">*</span></label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="email" placeholder="<?php echo $entry_email; ?>" value="<?php echo $email; ?>" id="input-email">
                                                    <?php if (isset($email_err)) : ?>
                                                        <span class="help-block"><?php echo $email_err; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="form-group <?php echo (!empty($telephone_err)) ? 'has-error' : ''; ?>">
                                                <label for="input-telephone" class="col-sm-2 control-label"><?php echo $entry_telephone; ?> <span class="red">*</span></label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="telephone" placeholder="<?php echo $entry_telephone; ?>" value="<?php echo $telephone; ?>" id="input-telephone">
                                                    <?php if (isset($telephone_err)) : ?>
                                                        <span class="help-block"><?php echo $telephone_err; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="form-group">
                                                <label for="input-fax" class="col-sm-2 control-label"><?php echo $entry_fax; ?></label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="fax" placeholder="<?php echo $entry_fax; ?>" value="<?php echo $fax; ?>" id="input-fax">
                                                </div>
                                            </div>

                                        </fieldset>

                                        <fieldset>
                                            <legend><?php echo $text_password; ?></legend>

                                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                                <label for="input-password" class="col-sm-2 control-label"><?php echo $entry_password; ?> <span class="red">*</span></label>

                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" name="password" placeholder="<?php echo $entry_password; ?>" value="<?php echo $password; ?>" id="input-password">
                                                    <?php if (isset($password_err)) : ?>
                                                        <span class="help-block"><?php echo $password_err; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="form-group <?php echo (!empty($confirm_err)) ? 'has-error' : ''; ?>">
                                                <label for="input-confirm" class="col-sm-2 control-label"><?php echo $entry_confirm; ?> <span class="red">*</span></label>

                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control" name="confirm" placeholder="<?php echo $entry_confirm; ?>" value="<?php echo $confirm; ?>" id="input-confirm">
                                                    <?php if (isset($confirm_err)) : ?>
                                                        <span class="help-block"><?php echo $confirm_err; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <fieldset>
                                            <legend><?php echo $text_other; ?></legend>
                                            <div class="form-group">
                                                <label for="input-status" class="col-sm-2 control-label"><?php echo $entry_status; ?></label>

                                                <div class="col-sm-10">
                                                    <select name="status" class="form-control" id="input-status">
                                                        <?php if ($status) : ?>
                                                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                                            <option value="0"><?php echo $text_disabled; ?></option>
                                                        <?php else : ?>
                                                            <option value="1"><?php echo $text_enabled; ?></option>
                                                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>
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
