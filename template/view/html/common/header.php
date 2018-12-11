<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <?php if($description) : ?>
    <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>
    <meta name="author" content="Diamant Gjota" />
    <?php if($keywords) : ?>
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <base href="<?php echo $base; ?>">
    
    <!-- css files -->
    <link rel="stylesheet" type="text/css" href="template/view/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="template/view/dist/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="template/view/dist/css/animate.css" />
    <link href="template/view/dist/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <?php foreach($styles as $style) : ?>
    <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
    <?php endforeach; ?>

    <!-- JavaScript Files -->
    <script type="text/javascript" src="template/view/dist/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="template/view/dist/js/bootstrap.min.js"></script>
    <script src="template/view/dist/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="template/view/dist/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="template/view/dist/js/jquery.sticky.js"></script>
    <script type="text/javascript" src="template/view/dist/js/pace.min.js"></script>
    <script type="text/javascript" src="template/view/dist/js/wow.min.js"></script>
    
    <?php foreach($scripts as $script) : ?>
    <script type="text/javascript" src="<?php echo $script; ?>"></script>
    <?php endforeach; ?>
    
    <!-- this is default skin you can replace that with: dark.css, yellow.css, red.css ect -->
    <link rel="stylesheet" type="text/css" href="template/view/dist/css/style.css" />
    
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
    
    <?php foreach($links as $link) : ?>
    <link rel="<?php echo $link['rel']; ?>" href="<?php echo $link['href']; ?>" />
    <?php endforeach; ?>
</head>

<body>
    <div id="wrapper">