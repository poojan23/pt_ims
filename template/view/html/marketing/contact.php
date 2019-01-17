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
                            <button type="submit" form="form-product" class="btn btn-white btn-info btn-bold" data-toggle="tooltip" title="<?php echo $button_save; ?>"><i class="ace-icon fa fa-envelope-o"></i></button>
                            <a href="<?php echo $cancel; ?>" class="btn btn-white btn-light btn-bold" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"><i class="ace-icon fa fa-reply"></i></a>
                        </div>
                    </div>

                </div>
            </div><!-- /.page-header -->
            <div class="alert-box"></div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="widget-box">
<!--                                <div class="widget-header">
                                    <h4 class="widget-title"><i class="ace-icon fa fa-envelope"></i> <?php echo $text_title; ?></h4>
                                </div>-->

                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                            <label for="input-from" class="col-sm-2 control-label"><?php echo $entry_from; ?> <span class="red">*</span></label>
            
                                            <div class="col-sm-10">
                                                <label style="margin: 5px;"><?php echo $from; ?></label>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <label for="input-to" class="col-sm-2 control-label"><?php echo $entry_to; ?></label>
            
                                            <div class="col-sm-10">
                                                <select name="to" class="form-control" id="input-to">
                                                    <option value="newsletter"><?php echo $text_newsletter; ?></option>
                                                    <option value="customer_all"><?php echo $text_customer_all; ?></option>
                                                    <option value="customer_group"><?php echo $text_customer_group; ?></option>
                                                    <option value="customer"><?php echo $text_customer; ?></option>
                                                    <option value="customer_file"><?php echo $text_customer_file; ?></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="to" id="to-customer-group">
                                            <hr>

                                            <div class="form-group">
                                                <label for="input-customer-group" class="col-sm-2 control-label"><?php echo $entry_customer_group; ?></label>

                                                <div class="col-sm-10">
                                                    <select name="customer_group_id" class="form-control" id="input-customer-group">
                                                        <?php foreach($customer_groups as $customer_group) : ?>
                                                        <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="to" id="to-customer">
                                            <hr>
                                            <div class="form-group">
                                                <label for="input-customer" class="col-sm-2 control-label"><?php echo $entry_customer; ?></label>

                                                <div class="col-sm-10">
                                                    <input type="text" name="customers" placeholder="<?php echo $entry_customer; ?>" value="" class="form-control" id="input-customer">
                                                    <div id="mail-customer" class="form-control" style="height: 150px; overflow: auto;"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="to" id="to-customer-file">
                                            <hr>

                                            <div class="form-group">
                                                <label for="input-customer-file" class="col-sm-2 control-label"><?php echo $entry_customer; ?></label>

                                                <div class="col-sm-10">
                                                    <input type="text" name="customer_files" placeholder="<?php echo $entry_customer; ?>" value="" class="form-control" id="input-customer-file">
                                                    <input type="hidden" name="customer_id" value="">
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="form-group">
                                                <label for="input-file" class="col-sm-2 control-label"><?php echo $entry_file; ?></label>

                                                <div class="col-sm-10">
                                                    <div class="well well-sm" style="height: 150px; overflow: auto;"></div>
                                                    <div id="checked_files"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <label for="input-template" class="col-sm-2 control-label"><?php echo $entry_template; ?></label>

                                            <div class="col-sm-10">
                                                <select name="template_id" class="form-control" id="input-template">
                                                    <option value="0"><?php echo $text_select; ?></option>
                                                    <?php foreach($templates as $template) : ?>
                                                    <option value="<?php echo $template['template_id']; ?>"><?php echo $template['title']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <hr>

                                        <div id="subject" class="form-group">
                                            <label for="input-subject" class="col-sm-2 control-label"><?php echo $entry_subject; ?></label>
            
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="subject" placeholder="<?php echo $entry_subject; ?>" value="" id="input-subject">
                                            </div>
                                        </div>

                                        <hr />

                                        <div id="message" class="form-group">
                                            <label for="input-message" class="col-sm-2 control-label"><?php echo $entry_message; ?></label>

                                            <div class="col-sm-10">
                                                <textarea name="message" placeholder="<?php echo $entry_message; ?>" class="form-control" id="input-message" data-toggle="ckeditor" data-lang="<?php echo $ckeditor; ?>"></textarea>
                                            </div>
                                        </div>

                                        <hr>

                                        <div id="file-attachment" class="form-group">
                                            <label for="input-file-send" class="col-sm-2 control-label"><?php echo $entry_file; ?></label>

                                            <div class="col-sm-10">
                                                <div class="input-group">
                                                    <input type="hidden" name="attachment" value="">
                                                    <span class="input-group-btn">
                                                        <button type="button" id="attach-file-trigger" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-info btn-sm"><i class="fa fa-cloud-upload"></i> <?php echo $button_upload; ?></button>
                                                    </span>
                                                    <span class="file-path"></span>
                                                </div>
                                                <div class="progress progress-mini progress-striped active">
													<div class="progress-bar progress-bar-primary" style="width: 0%;"></div>
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
    CKEDITOR.timestamp = Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
    $('textarea[data-toggle=\'ckeditor\']').ckeditor();

    $('select[name=\'to\']').on('change', function() {
        $('.to').hide();

        $('#to-' + this.value.replace('_', '-')).show();
    });

    $('select[name=\'to\']').trigger('change');
</script>
<script type="text/javascript">
    $('select[name=\'to\']').on('change', function() {
        var selected = this.value;
        
        if(selected != 'customer_file') {
            $('.widget-main:last-child hr').show();
            $('#file-attachment').show();
        } else {
            $('.widget-main:last-child hr').hide();
            $('#file-attachment').hide();
        }
    });

    $('.progress').hide();

    $('#attach-file-trigger').on('click', function() {
        $('#form-attachment').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-attachment" style="display: none;"><input type="file" name="file" /></form>');

        $('#form-attachment input[name=\'file\']').trigger('click');

        if(typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function() {
            if($('#form-attachment input[name=\'file\']').val() != '') {
                clearInterval(timer);

                $('.progress-bar').remove('progress-bar-success')
                
                var formData = new FormData($('#form-attachment')[0]),
                    request = new XMLHttpRequest();

                $('.progress').show();

                // Progress event ...
                request.upload.addEventListener('progress', function(e) {
                    var percentageComplete = Math.floor(e.loaded/e.total * 100);

                    $('.progress-bar').width(percentageComplete + '%').html(percentageComplete + '%');
                });

                // Progress completed load event
                request.addEventListener('load', function(e) {
                    $('.progress-bar').addClass('progress-bar-success').html('upload completed');
                });

                request.open('post', 'index.php?url=marketing/contact/upload&member_token=<?php echo $member_token; ?>');
                request.onload = function() {
                    var jsonResponse = request.response;
                    var json = JSON.parse(jsonResponse);

                    if(json.success) {
                        //alert(json.success);

                        $('input[name=\'attachment\']').val(json.path);
                        $('span.file-path').text(json.filename);
                        
                        setInterval(function() {
                            $('.progress').hide();
                        }, 3000);
                    }
                }
                request.send(formData);
            }
        }, 500);
    });

    // var fileInput   = document.querySelector(".attach-file"),
    //     button      = document.querySelector(".attach-file-trigger"),
    //     path        = document.querySelector(".path");

    // button.addEventListener("keydown", function(event) {
    //     if(event.keyCode == 13 || event.keyCode == 32) {
    //         fileInput.focus();
    //     }
    // });

    // button.addEventListener("click", function(event) {
    //     fileInput.focus();
    //     return false;
    // });

    // fileInput.addEventListener("change", function(event) {
    //     path.innerHTML = this.value;
    // });
</script>
<script type="text/javascript">
    $('input[name=\'customers\']').autocomplete({
        'source': function(request, response) {
            $.ajax({
                url: 'index.php?url=customer/customer/autocomplete&member_token=<?php echo $member_token; ?>&filter_name=' + encodeURIComponent(request),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['customer_id']
                        }
                    }));
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        },
        'select': function(item) {
            $('input[name=\'customers\']').val('');

            $('#mail-customer' + item['value']).remove();

            $('#mail-customer').append('<div id="mail-customer' + item['value'] + '"><i class="ace-icon fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="customer[]" value="' + item['value'] + '" /></div>');
        }
    });

    $('#mail-customer').on('click', '.fa-minus-circle', function() {
        $(this).parent().remove();
    });

    $('input[name=\'customer_files\']').autocomplete({
        'source': function(request, response) {
            $.ajax({
                url: 'index.php?url=customer/customer/autocomplete&member_token=<?php echo $member_token; ?>&filter_name=' + encodeURIComponent(request),
                dataType: 'json',
                success: function(json) {
                    json.unshift({
                        customer_id: 0,
                        name: '<?php echo $text_none; ?>'
                    });

                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['customer_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'customer_files\']').val(item['label']);
            $('input[name=\'customer_id\']').val(item['value']);

            var value = $('input[name=\'customer_id\']').val();

            $.ajax({
                url: 'index.php?url=marketing/contact/customerFiles&member_token=<?php echo $member_token; ?>',
                dataType: 'json',
                type: 'POST',
                data: '&customer_id=' + value,
                success: function(json) {
                    $('.well.well-sm').html('');

                    if(json.length != 0) {
                        for(var i in json) {
                            $('.well.well-sm').append('<div class="checkbox"><label><input type="checkbox" onclick="check(' + json[i].customer_file_id + ')" name="files[]" id="files' + json[i].customer_file_id + '" value="' + json[i].customer_file_id + '">' + json[i].name + ' <small>(' + json[i].size + ')</small></label></div>');
                        }
                    } else {
                        $('.well.well-sm').html('Please select customer to see related files!');
                    }
                }
            });
        }
    });

    $('input[name=\'customer_files\']').on('keyup', function() {
        if(!$(this).val().length) {
            $('input[name=\'customer_id\']').val('');
            $('.well.well-sm').html('Please select customer to see related files!');
        }
    });

    $('.well.well-sm').html('Please select customer to see related files!');

    function check(id) {
        if($('input[type=\'checkbox\']').is(':checked')) {
            $('#files' + id).attr('checked', 'checked');
        } else {
            $('#files' + id).removeAttr('checked', 'checked');
        }
    }
    
    $('select[name=\'template_id\']').on('change', function() {
        var value = $(this).val();
        
        if(value != 0) {
            $.ajax({
                url: 'index.php?url=marketing/contact/template&member_token=<?php echo $member_token; ?>',
                dataType: 'json',
                type: 'POST',
                data: '&template_id=' + value,
                success: function(json) {
                    $('input[name=\'subject\']').val(json['subject']);
                    $('textarea[name=\'message\']').val(json['message']);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.statusText);

                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        } else {
            $('input[name=\'subject\']').val('');
            $('textarea[name=\'message\']').val('');
        }
    });

    function send(url) {
        for(instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }

        /*var fileData = $('input[name=\'attachment\']').prop('files')[0],
            formData = new FormData(url);

        formData.append('file', fileData);

        alert(formData);*/

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: $('#content select, #content input[type="text"], #content input[type="hidden"], #content input[type="checkbox"]:checked, #content input[type="file"], #content textarea'),
            beforeSend: function() {
                $('#button-send').button('loading');
            },
            complete: function() {
                $('#button-send').button('reset');
            },
            success: function(json) {
                console.log(json);

                $('.alert-dismissible, .help-block').remove();

                if(json['error']) {
                    if(json['error']['warning']) {
                        $('#content > .alert-box').prepend('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times-circle-o"></i></strong> ' + json['error']['warning'] + ' </div>');
                    }

                    if(json['error']['email']) {
                        $('#content > .alert-box').prepend('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-times-circle-o"></i></strong> ' + json['error']['email'] + ' </div>');
                    }

                    if(json['error']['subject']) {
                        $('#subject').addClass('has-error');
                        $('input[name=\'subject\']').after('<div class="help-block col-xs-12 col-sm-reset inline">' + json['error']['subject'] + '</div>');
                    }

                    if(json['error']['message']) {
                        $('#message').addClass('has-error');
                        $('textarea[name=\'message\']').parent().append('<div class="help-block col-xs-12 col-sm-reset inline">' + json['error']['message'] + '</div>');
                    }
                }

                if(json['success']) {
                    $('#content > .alert-box').prepend('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong><i class="ace-icon fa fa-check-circle-o"></i></strong> ' + json['success'] + ' </div>');
                }

                if(json['next']) {
                    send(json['next']);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);

                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
</script>