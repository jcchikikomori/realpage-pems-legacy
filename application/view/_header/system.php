<!DOCTYPE html>
<html lang="en" onContextMenu="return true;" ondragstart="return true;" onselectstart="return true;">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <title>REAL PAGE PEMS</title>

    <!-- BOWER -->
    <!-- <link href="<?php // echo URL . BOWER; ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="<?php echo URL . ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="<?php // echo URL . ASSETS; ?>css/bootstrap-theme.min.css" rel="stylesheet"> -->
    <link href="<?php echo URL . BOWER; ?>metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- <link href="<?php // echo URL . BOWER; ?>startbootstrap-sb-admin-2/timeline.css" rel="stylesheet"> -->
    <link href="<?php echo URL . BOWER; ?>morrisjs/morris.css" rel="stylesheet">
    <link href="<?php echo URL . BOWER; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- CUSTOM STYLES -->
    <link href="<?php echo URL . ASSETS; ?>css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo URL . ASSETS; ?>css/custom.css" rel="stylesheet">

    <?php require VIEWS_PATH . '_templates/default_css.php'; ?>

    <!-- JS -->
    <!--[if lt IE 9]>
    <script src="<?php echo URL . ASSETS; ?>js/html5shiv.js"></script>
    <script src="<?php echo URL . ASSETS; ?>js/h5f.min.js"></script>
    <script src="<?php echo URL . ASSETS; ?>js/respond.min.js"></script>
    <![endif]-->
    <!-- <script src="<?php // echo URL . BOWER; ?>less/dist/less.js"></script> -->
    <script src="<?php echo URL . ASSETS; ?>js/jquery-2.1.3.min.js"></script>

</head>

<body>

<div class="wrapper-inverse" id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0;">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- <a class="navbar-brand">REAL PAGE PEMS <?php //echo file_get_contents(URL . 'version'); ?></a> -->
            <a style="padding: 20px;">
                <img src="<?php echo URL . 'img/logo-inversed.png'; ?>" style="width: 160px;" />
            </a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
                                <span class="pull-right text-muted">
                                    <em>Yesterday</em>
                                </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
                                <span class="pull-right text-muted">
                                    <em>Yesterday</em>
                                </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
                                <span class="pull-right text-muted">
                                    <em>Yesterday</em>
                                </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>Read All Messages</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i>
                    <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-alerts -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>
                    Hi <?php echo Session::get('user_name'); ?>
                    <?php if (Session::get('user_account_type') == "admin" AND Session::get('admin_logged_in')) {
                        echo '(Administrator)';
                    } ?>
                    <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo URL . 'system/logout'; ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-inverse sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <div>
                            <!-- content -->
                        </div>
                    </li>
                    <!-- <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                        </div>
                    </li> -->
                    <li>
                        <a href="<?php echo URL . ( Session::get('admin_logged_in') ? 'admin' : 'system/dashboard' ); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <?php if (Session::get('admin_logged_in')) { ?>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> User Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Users <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo URL . 'admin/users/register'; ?>">Add / Registration</a>
                                        </li>
                                        <li>
                                            <a href="#">View</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#">Manage</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?php echo URL . 'admin/users' ?>"><i class="fa fa-user fa-fw"></i> User Mgmt. (non-dropdown)</a>
                        </li>
                        <?php if(ENVIRONMENT == 'development') { // USER AUTH TEST. PLS IGNORE UNTIL RELEASE ?>
                            <li>
                                <a href="<?php echo URL . 'admin/users/test/' . UUID::v4(); ?>"><i class="fa fa-user fa-fw"></i> ADMIN TEST</a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
