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

            <?php if ($warning_err) : ?>
                <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $warning_err; ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form id="form-user-group" class="form-horizontal" action="<?php echo $action; ?>" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <!--<h4 class="widget-title"><?php echo $text_form; ?></h4>-->
                                </div>

                                <div class="tabs-container">
                                    <div class="widget-main">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                                            <li><a href="#tab-address" data-toggle="tab"><?php echo $tab_address; ?></a></li>
                                            <?php if ($customer_id) : ?>
                                                <li><a href="#tab-file" data-toggle="tab"><?php echo $tab_file; ?></a></li>
                                                <li><a href="#tab-history" data-toggle="tab"><?php echo $tab_history; ?></a></li>
                                                <li><a href="#tab-mail" data-toggle="tab"><?php echo $tab_mail; ?></a></li>
                                            <?php endif; ?>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-general">
                                                <div class="panel-body">
                                                    <fieldset>
                                                        <legend><?php echo $text_account; ?></legend>
                                                        <div class="form-group">
                                                            <label for="input-user-group" class="col-sm-2 control-label"><?php echo $entry_group; ?></label>

                                                            <div class="col-sm-10">
                                                                <select name="customer_group_id" class="form-control" id="input-user-group">
                                                                    <?php foreach ($customer_groups as $customer_group) : ?>
                                                                        <?php if ($customer_group['customer_group_id'] == $customer_group_id) : ?>
                                                                            <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
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

                                                        <hr>

                                                        <!--                                                    <div class="form-group" id="data_1">
                                                                                                                <label class="col-sm-2 control-label"><?php echo $entry_dob; ?></label>
                                                                                                                <div class="input-group date">
                                                                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="birthdate" placeholder="<?php echo $entry_dob; ?>" value="<?php echo $birthdate; ?>" id="id-dob" >
                                                                                                                </div>
                                                                                                            </div>
                                                        
                                                                                                            <hr>
                                                                                                            <div class="form-group" id="data_1">
                                                                                                                <label class="col-sm-2 control-label"><?php echo $entry_ani; ?></label>
                                                                                                                <div class="input-group date">
                                                                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="anniversary" placeholder="<?php echo $entry_ani; ?>" value="<?php echo $anniversary; ?>" id="id-ani" >
                                                                                                                </div>
                                                                                                            </div>-->
                                                    </fieldset>

                                                    <!--                                                <fieldset>
                                                                                                        <legend><?php echo $text_remarks; ?></legend>
                                                                                                        <div class="form-group">
                                                                                                            <label for="input-user" class="col-sm-2 control-label"><?php echo $entry_user; ?></label>
                                                    
                                                                                                            <div class="col-sm-10">
                                                                                                                <input type="text" name="user" placeholder="<?php echo $entry_user; ?>" value="<?php echo $user; ?>" class="form-control" id="input-user">
                                                                                                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                                                                                            </div>
                                                                                                        </div>
                                                    
                                                                                                        <hr>
                                                    
                                                                                                        <div class="form-group">
                                                                                                            <label for="input-remarks" class="col-sm-2 control-label"><?php echo $entry_remarks; ?></label>
                                                    
                                                                                                            <div class="col-sm-10">
                                                                                                                <textarea name="remarks" rows="8" placeholder="<?php echo $entry_remarks; ?>" class="form-control" id="input-remarks"><?php echo $remarks; ?></textarea>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </fieldset>-->

                                                    <fieldset>
                                                        <legend><?php echo $text_other; ?></legend>
                                                        <div class="form-group">
                                                            <label for="input-newsletter" class="col-sm-2 control-label"><?php echo $entry_newsletter; ?></label>

                                                            <div class="col-sm-10">
                                                                <div class="switch">
                                                                    <div class="onoffswitch">
                                                                        <?php if ($newsletter) : ?>
                                                                            <input type="checkbox" checked="checked" value="1" class="onoffswitch-checkbox" id="input-newsletter" name="newsletter">
                                                                        <?php else : ?>
                                                                            <input type="checkbox" checked=""  value="1"class="onoffswitch-checkbox" id="input-newsletter" name="newsletter">
                                                                        <?php endif; ?>

                                                                        <label class="onoffswitch-label" for="input-newsletter">
                                                                            <span class="onoffswitch-inner"></span>
                                                                            <span class="onoffswitch-switch"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label for="input-status" class="col-sm-2 control-label"><?php echo $entry_status; ?></label>

                                                            <div class="col-sm-10">
                                                                <div class="switch">
                                                                    <div class="onoffswitch">
                                                                        <?php if ($status) : ?>
                                                                            <input type="checkbox" checked="checked"  value="1" class="onoffswitch-checkbox" id="input-status" name="status">
                                                                        <?php else : ?>
                                                                            <input type="checkbox" checked="" value="1" class="onoffswitch-checkbox" id="input-status" name="status">
                                                                        <?php endif; ?>
                                                                        <label class="onoffswitch-label" for="input-status">
                                                                            <span class="onoffswitch-inner"></span>
                                                                            <span class="onoffswitch-switch"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--                                                    <div class="form-group">
                                                                                                                <label for="input-safe" class="col-sm-2 control-label"><?php echo $entry_safe; ?></label>
                                                        
                                                                                                                <div class="col-sm-10">
                                                                                                                    <div class="switch">
                                                                                                                        <div class="onoffswitch">
                                                        <?php if ($safe) : ?>
                                                                                                                                <input type="checkbox" checked="checked"  value="1" class="onoffswitch-checkbox" id="input-safe" name="safe">
                                                        <?php else : ?>
                                                                                                                                <input type="checkbox" checked="" value="1" class="onoffswitch-checkbox" id="input-safe" name="safe">
                                                        <?php endif; ?>
                                                                                                                            <label class="onoffswitch-label" for="input-safe">
                                                                                                                                <span class="onoffswitch-inner"></span>
                                                                                                                                <span class="onoffswitch-switch"></span>
                                                                                                                            </label>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>-->
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab-address">
                                                <div class="panel-body">
                                                    <?php $address_row = 1; ?>
                                                    <?php foreach ($addresses as $address) : ?>
                                                        <fieldset id="address-row<?php echo $address_row; ?>">
                                                            <legend><?php echo $text_address; ?> <?php echo $address_row + 1; ?> <button type="button" onclick="$('#address-row<?php echo $address_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-white btn-danger btn-bold btn-sm pull-right"><i class="ace-icon fa fa-minus-circle"></i></button></legend>
                                                            <input type="hidden" name="address[<?php echo $address_row; ?>][address_id]" value="<?php echo $address['address_id']; ?>">

                                                            <div class="form-group <?php echo (!empty($address_err[$address_row]['firstname'])) ? 'has-error' : ''; ?>">
                                                                <label for="input-firstname<?php echo $address_row; ?>" class="col-sm-2 control-label"><?php echo $entry_firstname; ?> <span class="red">*</span></label>

                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="address[<?php echo $address_row; ?>][firstname]" placeholder="<?php echo $entry_firstname; ?>" value="<?php echo $address['firstname']; ?>" id="input-firstname<?php echo $address_row; ?>">
                                                                    <?php if (isset($address_err[$address_row]['firstname'])) : ?>
                                                                        <span class="help-block"><?php echo $address_err[$address_row]['firstname'] ?></span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="form-group <?php echo (!empty($address_err[$address_row]['lastname'])) ? 'has-error' : ''; ?>">
                                                                <label for="input-lastname" class="col-sm-2 control-label"><?php echo $entry_lastname; ?> <span class="red">*</span></label>

                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="address[<?php echo $address_row; ?>][lastname]" placeholder="<?php echo $entry_lastname; ?>" value="<?php echo $address['lastname']; ?>" id="input-lastname<?php echo $address_row; ?>">
                                                                    <?php if (isset($address_err[$address_row]['lastname'])) : ?>
                                                                        <span class="help-block"><?php echo $address_err[$address_row]['lastname'] ?></span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="form-group">
                                                                <label for="input-company" class="col-sm-2 control-label"><?php echo $entry_company; ?> <span class="red">*</span></label>

                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="address[<?php echo $address_row; ?>][company]" placeholder="<?php echo $entry_company; ?>" value="<?php echo $address['company']; ?>" id="input-company<?php echo $address_row; ?>">
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="form-group <?php echo (!empty($address_err[$address_row]['address_1'])) ? 'has-error' : ''; ?>">
                                                                <label for="input-address-1" class="col-sm-2 control-label"><?php echo $entry_address_1; ?> <span class="red">*</span></label>

                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="address[<?php echo $address_row; ?>][address_1]" placeholder="<?php echo $entry_address_1; ?>" value="<?php echo $address['address_1']; ?>" id="input-address-1<?php echo $address_row; ?>">
                                                                    <?php if (isset($address_err[$address_row]['address_1'])) : ?>
                                                                        <span class="help-block"><?php echo $address_err[$address_row]['address_1'] ?></span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="form-group">
                                                                <label for="input-address-2" class="col-sm-2 control-label"><?php echo $entry_address_2; ?> <span class="red">*</span></label>

                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="address[<?php echo $address_row; ?>][address_2]" placeholder="<?php echo $entry_address_2; ?>" value="<?php echo $address['address_2']; ?>" id="input-address-2<?php echo $address_row; ?>">
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="form-group <?php echo (!empty($address_err[$address_row]['city'])) ? 'has-error' : ''; ?>">
                                                                <label for="input-city" class="col-sm-2 control-label"><?php echo $entry_city; ?> <span class="red">*</span></label>

                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="address[<?php echo $address_row; ?>][city]" placeholder="<?php echo $entry_city; ?>" value="<?php echo $address['city']; ?>" id="input-city<?php echo $address_row; ?>">
                                                                    <?php if (isset($address_err[$address_row]['city'])) : ?>
                                                                        <span class="help-block"><?php echo $address_err[$address_row]['city'] ?></span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="form-group <?php echo (!empty($address_err[$address_row]['postcode'])) ? 'has-error' : ''; ?>">
                                                                <label for="input-postcode" class="col-sm-2 control-label"><?php echo $entry_postcode; ?> <span class="red">*</span></label>

                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="address[<?php echo $address_row; ?>][postcode]" placeholder="<?php echo $entry_postcode; ?>" value="<?php echo $address['postcode']; ?>" id="input-postcode<?php echo $address_row; ?>">
                                                                    <?php if (isset($address_err[$address_row]['postcode'])) : ?>
                                                                        <span class="help-block"><?php echo $address_err[$address_row]['postcode'] ?></span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="form-group <?php echo (!empty($address_err[$address_row]['country_id'])) ? 'has-error' : ''; ?>">
                                                                <label for="input-country<?php echo $address_row; ?>" class="col-sm-2 control-label"><?php echo $entry_country; ?> <span class="red">*</span></label>

                                                                <div class="col-sm-10">
                                                                    <select name="address[<?php echo $address_row; ?>][country_id]" id="input-country<?php echo $address_row; ?>" onchange="country(this, '<?php echo $address_row; ?>', '<?php echo $address['zone_id']; ?>');" class="form-control">
                                                                        <option value=""><?php echo $text_select; ?></option>
                                                                        <?php foreach ($countries as $country) : ?>
                                                                            <?php if ($country['country_id'] == $address['country_id']) : ?>
                                                                                <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                                                                            <?php else : ?>
                                                                                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <?php if (isset($address_err[$address_row]['country'])) : ?>
                                                                        <span class="help-block"><?php echo $address_err[$address_row]['country'] ?></span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="form-group <?php echo (!empty($address_err[$address_row]['zone_id'])) ? 'has-error' : ''; ?>">
                                                                <label for="input-zone<?php echo $address_row; ?>" class="col-sm-2 control-label"><?php echo $entry_zone; ?> <span class="red">*</span></label>

                                                                <div class="col-sm-10">
                                                                    <select name="address[<?php echo $address_row; ?>][zone_id]" id="input-zone<?php echo $address_row; ?>" class="form-control">
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="form-group">
                                                                <label for="input-default<?php echo $address_row; ?>" class="col-sm-2 control-label"><?php echo $entry_default; ?></label>

                                                                <div class="col-sm-10">
                                                                    <label>
                                                                        <?php if ($default == $address_row) : ?>
                                                                            <input type="radio" name="default" value="<?php echo $address_row; ?>" id="input-default<?php echo $address_row; ?>" checked="checked">
                                                                        <?php else : ?>
                                                                            <input type="radio" name="default" value="<?php echo $address_row; ?>" id="input-default<?php echo $address_row; ?>">
                                                                        <?php endif; ?>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <?php $address_row = $address_row + 1; ?>
                                                    <?php endforeach; ?>
                                                    <div class="text-right">
                                                        <button type="button" id="button-address" class="btn btn-primary"><i class="ace-icon fa fa-plus-circle"></i> <?php echo $button_address_add; ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if ($customer_id) : ?>
                                                <div class="tab-pane" id="tab-file">
                                                    <fieldset>
                                                        <legend><?php echo $text_file; ?></legend>
                                                        <div id="file"></div>
                                                    </fieldset>
                                                    <br>
                                                    <fieldset>
                                                        <legend><?php echo $text_file_add; ?></legend>
                                                        <div class="form-group">
                                                            <label for="input-download-name" class="col-sm-2 control-label"><?php echo $entry_download_name; ?></label>

                                                            <div class="col-sm-10">
                                                                <input type="text" name="download_name" placeholder="<?php echo $entry_download_name; ?>" class="form-control" id="input-download-name">
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group">
                                                            <label for="input-filename" class="col-sm-2 control-label"><?php echo $entry_filename; ?></label>

                                                            <div class="col-sm-10">
                                                                <div class="input-group">
                                                                    <input type="text" name="filename" placeholder="<?php echo $entry_filename; ?>" class="form-control" id="input-filename">
                                                                    <span class="input-group-btn">
                                                                        <button type="button" id="button-upload" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-white btn-info btn-bold"><i class="fa fa-cloud-upload"></i> <?php echo $button_upload; ?></button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group">
                                                            <label for="input-mask" class="col-sm-2 control-label"><?php echo $entry_mask; ?></label>

                                                            <div class="col-sm-10">
                                                                <input type="text" name="mask" placeholder="<?php echo $entry_mask; ?>" class="form-control" id="input-mask">
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="text-right">
                                                        <button type="button" id="button-file" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?php echo $button_file_add; ?></button>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab-history">
                                                    <fieldset>
                                                        <legend><?php echo $text_history; ?></legend>
                                                        <div id="history"></div>
                                                    </fieldset>
                                                    <br>
                                                    <fieldset>
                                                        <legend><?php echo $text_history_add; ?></legend>
                                                        <div class="form-group">
                                                            <label for="input-comment" class="col-sm-2 control-label"><?php echo $entry_comment; ?></label>

                                                            <div class="col-sm-10">
                                                                <textarea name="comment" rows="8" placeholder="<?php echo $entry_comment; ?>" class="form-control" id="input-comment"></textarea>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="text-right">
                                                        <button type="button" id="button-history" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?php echo $button_history_add; ?></button>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab-mail">
                                                    <fieldset>
                                                        <legend><?php echo $text_mail; ?></legend>
                                                        <div id="mail"></div>
                                                    </fieldset>
                                                </div>
                                            <?php endif; ?>
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

<script src="template/view/dist/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="template/view/dist/js/plugins/cropper/cropper.min.js"></script>
<script src="template/view/dist/js/plugins/fullcalendar/moment.min.js"></script>
<script src="template/view/dist/js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="template/view/dist/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="template/view/dist/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script type="text/javascript">
                                                                    $('input[name=\'user\']').autocomplete({
                                                                        'source': function (request, response) {
                                                                            $.ajax({
                                                                                url: 'index.php?url=user/user/autocomplete&member_token=<?php echo $member_token; ?>&filter_name=' + encodeURIComponent(request),
                                                                                dataType: 'json',
                                                                                success: function (json) {
                                                                                    json.unshift({
                                                                                        member_id: 0,
                                                                                        name: '<?php echo $text_none; ?>'
                                                                                    });

                                                                                    response($.map(json, function (item) {
                                                                                        return {
                                                                                            label: item['name'],
                                                                                            value: item['member_id']
                                                                                        }
                                                                                    }));
                                                                                }
                                                                            });
                                                                        },
                                                                        'select': function (item) {
                                                                            $('input[name=\'user\']').val(item['label']);
                                                                            $('input[name=\'user_id\']').val(item['value']);
                                                                        }
                                                                    });
</script>
<!--<link rel="stylesheet" href="template/view/dist/css/bootstrap-datepicker3.min.css" />-->
<!--<script src="template/view/dist/js/bootstrap-datepicker.min.js"></script>-->
<!--<script type="text/javascript">
    $('.date-picker').datepicker({
        autoclose: true,
        todayHighlight: true
    })
            //show datepicker when clicking on the icon
            .next().on(ace.click_event, function () {
        $(this).prev().focus();
    });
</script>-->
<script type="text/javascript">
    var address_row = '<?php echo $address_row; ?>';

    $('#button-address').on('click', function (e) {
        e.preventDefault();

        html = '<fieldset id="address-row' + address_row + '">';
        html += '<legend><?php echo $text_address; ?> <?php echo $address_row + 1; ?> <button type="button" onclick="$(\'#address-row' + address_row + '\').remove();" data-toggle="tooltip" title="<?php $button_remove; ?>" class="btn btn-white btn-danger btn-bold btn-sm pull-right"><i class="ace-icon fa fa-minus-circle"></i></button></legend>';
        html += '<input type="hidden" name="address[' + address_row + '][address_id]" value="">';

        html += '<div class="form-group <?php echo (!empty($address_err[' + address_row + ']['firstname'])) ? has - error : ''; ?>">';
        html += '<label for="input-firstname' + address_row + '" class="col-sm-2 control-label"><?php echo $entry_firstname; ?> <span class="red">*</span></label>';

        html += '<div class="col-sm-10"><input type="text" class="form-control" name="address[' + address_row + '][firstname]" placeholder="<?php echo $entry_firstname; ?>" value="" id="input-firstname' + address_row + '"></div>';
        html += '</div><hr>';

        html += '<div class="form-group <?php echo (!empty($address_err[' + address_row + ']['lastname'])) ? has - error : ''; ?>">';
        html += '<label for="input-lastname" class="col-sm-2 control-label"><?php echo $entry_lastname; ?> <span class="red">*</span></label>';

        html += '<div class="col-sm-10"><input type="text" class="form-control" name="address[' + address_row + '][lastname]" placeholder="<?php echo $entry_lastname; ?>" value="" id="input-lastname' + address_row + '"></div>';
        html += '</div><hr>';

        html += '<div class="form-group">';
        html += '<label for="input-company" class="col-sm-2 control-label"><?php echo $entry_company; ?> <span class="red">*</span></label>';

        html += '<div class="col-sm-10"><input type="text" class="form-control" name="address[' + address_row + '][company]" placeholder="<?php echo $entry_company; ?>" value="" id="input-company' + address_row + '"></div>';
        html += '</div><hr>';

        html += '<div class="form-group <?php echo (!empty($address_err[' + address_row + ']['address_1'])) ? has - error : ''; ?>">';
        html += '<label for="input-address-1" class="col-sm-2 control-label"><?php echo $entry_address_1; ?> <span class="red">*</span></label>';

        html += '<div class="col-sm-10"><input type="text" class="form-control" name="address[' + address_row + '][address_1]" placeholder="<?php echo $entry_address_1; ?>" value="" id="input-address-1' + address_row + '"></div>'
        html += '</div><hr>';

        html += '<div class="form-group">';
        html += '<label for="input-address-2" class="col-sm-2 control-label"><?php echo $entry_address_2; ?> <span class="red">*</span></label>';

        html += '<div class="col-sm-10"><input type="text" class="form-control" name="address[' + address_row + '][address_2]" placeholder="<?php echo $entry_address_2; ?>" value="" id="input-address-2' + address_row + '"></div>';
        html += '</div><hr>';

        html += '<div class="form-group <?php echo (!empty($address_err[' + address_row + ']['city'])) ? has - error : ' '; ?>">';
        html += '<label for="input-city" class="col-sm-2 control-label"><?php echo $entry_city; ?> <span class="red">*</span></label>';

        html += '<div class="col-sm-10"><input type="text" class="form-control" name="address[' + address_row + '][city]" placeholder="<?php echo $entry_city; ?>" value="" id="input-city' + address_row + '"></div>';
        html += '</div><hr>';

        html += '<div class="form-group <?php echo (!empty($address_err[' + address_row + ']['postcode'])) ? has - error : ' '; ?>">'
        html += '<label for="input-postcode" class="col-sm-2 control-label"><?php echo $entry_postcode; ?> <span class="red">*</span></label>';

        html += '<div class="col-sm-10"><input type="text" class="form-control" name="address[' + address_row + '][postcode]" placeholder="<?php echo $entry_postcode; ?>" value="" id="input-postcode' + address_row + '"></div>';
        html += '</div><hr>';

        html += '<div class="form-group <?php echo (!empty($address_err[' + address_row + ']['country_id'])) ? has - error : ' '; ?>">';
        html += '<label for="input-country' + address_row + '" class="col-sm-2 control-label"><?php echo $entry_country; ?> <span class="red">*</span></label>';

        html += '<div class="col-sm-10"><select name="address[' + address_row + '][country_id]" id="input-country' + address_row + '" onchange="country(this, \'' + address_row + '\', \'0\');" class="form-control">';
        html += '<option value=""><?php echo $text_select; ?></option>';
        var countries = <?php echo json_encode($countries); ?>;

        for (var i = 0; i < countries.length; i++) {
            html += '<option value="' + countries[i]['country_id'] + '">' + countries[i]['name'] + '</option>';
        }
        html += '</select></div>';
        html += '</div><hr>';

        html += '<div class="form-group <?php echo (!empty($address_err[' + address_row + ']['zone_id'])) ? has - error : ' '; ?>">';
        html += '<label for="input-zone' + address_row + '" class="col-sm-2 control-label"><?php echo $entry_zone; ?> <span class="red">*</span></label>';

        html += '<div class="col-sm-10"><select name="address[' + address_row + '][zone_id]" id="input-zone' + address_row + '" class="form-control"></select></div>';
        html += '</div><hr>';

        html += '<div class="form-group">';
        html += '<label for="input-default' + address_row + '" class="col-sm-2 control-label"><?php echo $entry_default; ?></label>';

        html += '<div class="col-sm-10"><label><input type="radio" name="default" value="' + address_row + '" id="input-default' + address_row + '"></label></div>';
        html += '</div>';
        html += '</fieldset>';

        $(this).parent().before(html);

        $('select[name=\'customer_group_id\']').trigger('change');

        $('select[name=\'address[' + address_row + '][country_id]\']').trigger('change');

        address_row++;
    });
</script>
<script type="text/javascript">
    function country(element, index, zone_id) {
        $.ajax({
            url: 'index.php?url=localisation/country/country&member_token=<?php echo $member_token; ?>&country_id=' + element.value,
            dataType: 'json',
            beforeSend: function () {
                $('select[name=\'address[' + index + '][country_id]\']').prop('disabled', true);
            },
            complete: function () {
                $('select[name=\'address[' + index + '][country_id]\']').prop('disabled', false);
            },
            success: function (json) {
                if (json['postcode_required'] == '1') {
                    $('input[name=\'address[' + index + '][postcode]\']').parent().parent().addClass('required');
                } else {
                    $('input[name=\'address[' + index + '][postcode]\']').parent().parent().removeClass('required');
                }

                html = '<option value=""><?php echo $text_select; ?></option>';

                if (json['zone'] && json['zone'] != '') {
                    for (i = 0; i < json['zone'].length; i++) {
                        html += '<option value="' + json['zone'][i]['zone_id'] + '"';

                        if (json['zone'][i]['zone_id'] == zone_id) {
                            html += ' selected="selected"';
                        }

                        html += '>' + json['zone'][i]['name'] + '</option>';
                    }
                } else {
                    html += '<option value="0"><?php echo $text_none; ?></option>';
                }

                $('select[name=\'address[' + index + '][zone_id]\']').html(html);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    $('select[name$=\'[country_id]\']').trigger('change');
</script>
<script type="text/javascript">
    $('#button-upload').on('click', function () {
        $('#form-upload').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

        $('#form-upload input[name=\'file\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function () {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                clearInterval(timer);

                $.ajax({
                    url: 'index.php?url=customer/customer/upload&member_token=<?php echo $member_token; ?>',
                    dataType: 'json',
                    type: 'POST',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#button-upload').button('loading');
                    },
                    complete: function () {
                        $('#button-upload').button('reset');
                    },
                    success: function (json) {
                        if (json['error']) {
                            alert(json['error']);
                        }

                        if (json['success']) {
                            alert(json['success']);

                            $('input[name=\'filename\']').val(json['filename']);
                            $('input[name=\'mask\']').val(json['mask']);
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });

    $('#file').on('click', '.pagination a', function (e) {
        e.preventDefault();

        $('#file').load(this.href);
    });

    $('#file').load('index.php?url=customer/customer/file&member_token=<?php echo $member_token; ?>&customer_id=<?php echo $customer_id; ?>');

    $('#button-file').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            url: 'index.php?url=customer/customer/addfile&member_token=<?php echo $member_token; ?>&customer_id=<?php echo $customer_id; ?>',
            type: 'POST',
            dataType: 'json',
            data: '&download_name=' + encodeURIComponent($('#tab-file input[name=\'download_name\']').val()) + '&filename=' + encodeURIComponent($('#tab-file input[name=\'filename\']').val()) + '&mask=' + encodeURIComponent($('#tab-file input[name=\'mask\']').val()),
            beforeSend: function () {
                $('#button-file').button('loading');
            },
            complete: function () {
                $('#button-file').button('reset');
            },
            success: function (json) {
                $('.alert-dismissible').remove();

                if (json['error']) {
                    $('#tab-file').prepend('<div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

                if (json['success']) {
                    $('#tab-file').prepend('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('#file').load('index.php?url=customer/customer/file&member_token=<?php echo $member_token; ?>&customer_id=<?php echo $customer_id; ?>');

                    $('#tab-file input[name=\'download_name\']').val('');
                    $('#tab-file input[name=\'filename\']').val('');
                    $('#tab-file input[name=\'mask\']').val('');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
</script>
<script type="text/javascript">
    $('#history').on('click', '.pagination a', function (e) {
        e.preventDefault();

        $('#history').load(this.href);
    });

    $('#history').load('index.php?url=customer/customer/history&member_token=<?php echo $member_token; ?>&customer_id=<?php echo $customer_id; ?>');

    $('#button-history').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            url: 'index.php?url=customer/customer/addhistory&member_token=<?php echo $member_token; ?>&customer_id=<?php echo $customer_id; ?>',
            type: 'POST',
            dataType: 'json',
            data: 'comment=' + encodeURIComponent($('#tab-history textarea[name=\'comment\']').val()),
            beforeSend: function () {
                $('#button-history').button('loading');
            },
            complete: function () {
                $('#button-history').button('reset');
            },
            success: function (json) {
                $('.alert-dismissible').remove();

                if (json['error']) {
                    $('#tab-history').prepend('<div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

                if (json['success']) {
                    $('#tab-history').prepend('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('#history').load('index.php?url=customer/customer/history&member_token=<?php echo $member_token; ?>&customer_id=<?php echo $customer_id; ?>');

                    $('#tab-history textarea[name=\'comment\']').val('');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
</script>
<script type="text/javascript">
    $('#mail').on('click', '.pagination a', function (e) {
        e.preventDefault();

        $('#mail').load(this.href);
    });

    $('#mail').load('index.php?url=customer/customer/mail&member_token=<?php echo $member_token; ?>&customer_id=<?php echo $customer_id; ?>');

</script>
<script>
    $(document).ready(function () {

        $('.tagsinput').tagsinput({
            tagClass: 'label label-primary'
        });

        var $image = $(".image-crop > img")
        $($image).cropper({
            aspectRatio: 1.618,
            preview: ".img-preview",
            done: function (data) {
                // Output the result data for cropping image.
            }
        });

        var $inputImage = $("#inputImage");
        if (window.FileReader) {
            $inputImage.change(function () {
                var fileReader = new FileReader(),
                        files = this.files,
                        file;

                if (!files.length) {
                    return;
                }

                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function () {
                        $inputImage.val("");
                        $image.cropper("reset", true).cropper("replace", this.result);
                    };
                } else {
                    showMessage("Please choose an image file.");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }

        $("#download").click(function () {
            window.open($image.cropper("getDataURL"));
        });

        $("#zoomIn").click(function () {
            $image.cropper("zoom", 0.1);
        });

        $("#zoomOut").click(function () {
            $image.cropper("zoom", -0.1);
        });

        $("#rotateLeft").click(function () {
            $image.cropper("rotate", 45);
        });

        $("#rotateRight").click(function () {
            $image.cropper("rotate", -45);
        });

        $("#setDrag").click(function () {
            $image.cropper("setDragMode", "crop");
        });

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        $('#data_2 .input-group.date').datepicker({
            startView: 1,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: "dd/mm/yyyy"
        });

        $('#data_3 .input-group.date').datepicker({
            startView: 2,
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        $('#data_4 .input-group.date').datepicker({
            minViewMode: 1,
            keyboardNavigation: false,
            forceParse: false,
            forceParse: false,
            autoclose: true,
            todayHighlight: true
        });

        $('#data_5 .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, {color: '#1AB394'});

        var elem_2 = document.querySelector('.js-switch_2');
        var switchery_2 = new Switchery(elem_2, {color: '#ED5565'});

        var elem_3 = document.querySelector('.js-switch_3');
        var switchery_3 = new Switchery(elem_3, {color: '#1AB394'});

        var elem_4 = document.querySelector('.js-switch_4');
        var switchery_4 = new Switchery(elem_4, {color: '#f8ac59'});
        switchery_4.disable();

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });

        $('.demo1').colorpicker();

        var divStyle = $('.back-change')[0].style;
        $('#demo_apidemo').colorpicker({
            color: divStyle.backgroundColor
        }).on('changeColor', function (ev) {
            divStyle.backgroundColor = ev.color.toHex();
        });

        $('.clockpicker').clockpicker();

        $('input[name="daterange"]').daterangepicker();

        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

        $('#reportrange').daterangepicker({
            format: 'MM/DD/YYYY',
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2015',
            dateLimit: {days: 60},
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'right',
            drops: 'down',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-default',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });

        $(".select2_demo_1").select2();
        $(".select2_demo_2").select2();
        $(".select2_demo_3").select2({
            placeholder: "Select a state",
            allowClear: true
        });


        $(".touchspin1").TouchSpin({
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $(".touchspin2").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $(".touchspin3").TouchSpin({
            verticalbuttons: true,
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $('.dual_select').bootstrapDualListbox({
            selectorMinimalHeight: 160
        });


    });

    $('.chosen-select').chosen({width: "100%"});

    $("#ionrange_1").ionRangeSlider({
        min: 0,
        max: 5000,
        type: 'double',
        prefix: "$",
        maxPostfix: "+",
        prettify: false,
        hasGrid: true
    });

    $("#ionrange_2").ionRangeSlider({
        min: 0,
        max: 10,
        type: 'single',
        step: 0.1,
        postfix: " carats",
        prettify: false,
        hasGrid: true
    });

    $("#ionrange_3").ionRangeSlider({
        min: -50,
        max: 50,
        from: 0,
        postfix: "°",
        prettify: false,
        hasGrid: true
    });

    $("#ionrange_4").ionRangeSlider({
        values: [
            "January", "February", "March",
            "April", "May", "June",
            "July", "August", "September",
            "October", "November", "December"
        ],
        type: 'single',
        hasGrid: true
    });

    $("#ionrange_5").ionRangeSlider({
        min: 10000,
        max: 100000,
        step: 100,
        postfix: " km",
        from: 55000,
        hideMinMax: true,
        hideFromTo: false
    });

    $(".dial").knob();

    var basic_slider = document.getElementById('basic_slider');

    noUiSlider.create(basic_slider, {
        start: 40,
        behaviour: 'tap',
        connect: 'upper',
        range: {
            'min': 20,
            'max': 80
        }
    });

    var range_slider = document.getElementById('range_slider');

    noUiSlider.create(range_slider, {
        start: [40, 60],
        behaviour: 'drag',
        connect: true,
        range: {
            'min': 20,
            'max': 80
        }
    });

    var drag_fixed = document.getElementById('drag-fixed');

    noUiSlider.create(drag_fixed, {
        start: [40, 60],
        behaviour: 'drag-fixed',
        connect: true,
        range: {
            'min': 20,
            'max': 80
        }
    });


</script>