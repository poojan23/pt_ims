<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>INSPINIA | Login</title>

        <link href="template/view/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="template/view/dist/font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="template/view/dist/css/animate.css" rel="stylesheet">
        <link href="template/view/dist/css/style.css" rel="stylesheet">

    </head>
    <body class="gray-bg">

        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
<!--                <div>

                    <h2>Popaya Technology</h2>

                </div>-->
 <div class="ibox-content">
                <h3><b>Popaya</b>Technologies</h3>
                <?php if ($success) : ?>
                    <div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> <?php echo $sucess; ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>

                <?php if ($warning_err) : ?>
                    <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> <?php echo $warning_err; ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>
               
                  
                <form class="m-t" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group has-feedback <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <input type="email" class="form-control" name="email" placeholder="<?php echo $entry_email; ?>" value="<?php echo $email; ?>">
<!--                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <span class="help-block"><?php echo $email_err; ?></span>-->
                    </div>
                    <div class="form-group has-feedback <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <input type="password" class="form-control" name="password" placeholder="<?php echo $entry_password; ?>">
<!--                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <span class="help-block"><?php echo $password_err; ?></span>-->
                    </div>
                    <div class="row">
                        <!--<div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> <?php echo $entry_remember; ?>
                                </label>
                            </div>
                        </div>-->
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo $button_login; ?></button>
                        </div>
                        <!-- /.col -->
                        <?php if ($redirect) : ?>
                            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>">
                        <?php endif; ?>
                    </div>

                </form>
               
                <?php if ($forgotten) : ?>
                    <a href="<?php echo $forgotten; ?>"><small><?php echo $text_forgotten; ?></small></a>
                <?php endif; ?>
                <!--<p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>-->
            </div>
            </div>
        </div>
        <!-- Mainly scripts -->
        <script src="template/view/dist/js/jquery-3.1.1.min.js"></script>
        <script src="template/view/dist/js/bootstrap.min.js"></script>

    </body>
