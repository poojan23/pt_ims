<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="<?php echo $image; ?>"/>
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $firstname; ?> <?php echo $lastname; ?></strong>
                            </span> <span class="text-muted text-xs block"><?php echo $member_group; ?> <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="index.php?url=user/profile&member_token=lREg2yXoC7AvxcZIeLqb7731FQrO2PgR">Profile</a></li>
                        <li><a href="<?php echo $logout; ?>">Logout</a></li>
                        <!--<li><a href="mailbox.html">Mailbox</a></li>-->
<!--                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>-->
                    </ul>
                </div>
                <div class="logo-element">
                    PYA
                </div>
            </li>
            <?php foreach ($menus as $menu) : ?>
                <li id="<?php echo $menu['id']; ?>" class="<?php echo ($menu['href']) ? '' : 'treeview'; ?>">
                    <?php if ($menu['href']) : ?>
                        <a href="<?php echo $menu['href']; ?>">
                            <i class="fa <?php echo $menu['icon']; ?>"></i>
                            <span>
                                <?php echo $menu['name']; ?>
                            </span>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo $menu['href']; ?>">
                            <i class="fa <?php echo $menu['icon']; ?>"></i>
                            <span class="nav-label">
                                <?php echo $menu['name']; ?>
                            </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                    <?php endif; ?>
                    <?php if ($menu['children']) : ?>
                        <ul class="nav nav-second-level collapse">
                            <?php foreach ($menu['children'] as $child1) : ?>
                                <li class="<?php echo ($child1['href']) ? '' : 'treeview' ?>">
                                    <?php if ($child1['href']) : ?>
                                        <a href="<?php echo $child1['href']; ?>">
                                            <i class="fa fa-circle-o"></i>
                                            <?php echo $child1['name']; ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php echo $child1['href']; ?>">
                                            <i class="fa fa-circle-o"></i>
                                            <?php echo $child1['name']; ?>
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($child1['children']) : ?>
                                        <ul class="nav nav-third-level collapse">
                                            <?php foreach ($child1['children'] as $child2) : ?>
                                                <li class="<?php echo ($child2['href']) ? '' : 'treeview' ?>">
                                                    <?php if ($child2['href']) : ?>
                                                        <a href="<?php echo $child2['href']; ?>">
                                                            <i class="fa fa-circle-o"></i>
                                                            <?php echo $child2['name']; ?>
                                                        </a>
                                                    <?php else : ?>
                                                        <a href="<?php echo $child2['link']; ?>">
                                                            <i class="fa fa-cirlcle-o"></i>
                                                            <?php echo $child2['name']; ?>
                                                            <span class="pull-right-container">
                                                                <i class="fa fa-angle-left pull-right"></i>
                                                            </span>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if ($child2['children']) : ?>
                                                        <ul class="treeview-menu">
                                                            <?php foreach ($child2['children'] as $child3) : ?>
                                                                <li>
                                                                    <a href="<?php echo $child3['href']; ?>">
                                                                        <i class="fa fa-cirlcle-o"></i>
                                                                        <?php echo $child3['name']; ?>
                                                                    </a>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                </li>
            <?php endforeach; ?>

        </ul>

    </div>
</nav>

<div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <form role="search" class="navbar-form-custom" action="search_results.html">
<!--                    <div class="form-group">
                        <input type="text" placeholder="<?php echo $text_search; ?>" class="form-control" name="top-search" id="top-search">
                    </div>-->
                </form>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message"><?php echo $text_welcome;?></span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="<?php echo $logout; ?>">
                        <i class="fa fa-sign-out"></i> <?php echo $text_logout; ?>
                    </a>
                </li>
                <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li>
            </ul>

        </nav>
    </div>
