<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>JEJ MIS -- INVOICE (<?php echo date(DATE_CUSTOM); ?>)</title>
    <meta name="description" content="">

    <!-- CSS -->
    <link href="<?php echo URL . ASSETS; ?>css/normalize.css" rel="stylesheet">
    <link href="<?php echo URL . ASSETS; ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo URL . ASSETS; ?>css/custom.css" rel="stylesheet" media="all">

    <style>
        @media screen and (max-width: 499px){
            #main-body {
                display: none;
            }
            div#resolution-warning {
                display: block;
            }
        }

        html, body {
            background: #fff;
        }
        @media screen {
            body {
                padding-bottom: 50px;
            }
        }
        .container {
            width: 800px !important;
        }
        table {
            width: 100% !important;
        }
    </style>
    <link href="<?php echo URL . ASSETS; ?>css/picol.css" rel="stylesheet">
    <link href="<?php echo URL . ASSETS; ?>css/jquery.dataTables.yadcf.css" rel="stylesheet">

    <script src="<?php echo URL . ASSETS; ?>js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo URL . ASSETS; ?>js/jquery-ui.js"></script>

</head>
<body>

<!-- MODALS -->
<div class="modal" style="padding: 8px;" id="resolution-warning" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="box-shadow: none;">
            <div class="modal-header">
                <h4 class="modal-title">Warning!</h4>
            </div>
            <div class="modal-body">
                Report Generator does not support with this screen resolution.
                You may print anyway but you won't be able to manage results. To do so,
                please resize your device resolution. If you are in portrait, rotate your device into landscape mode
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger" href="javascript:void(0)" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> Print Anyway</a>
                <a class="btn btn-default" href="../">Later</a>
            </div>
        </div>
    </div>
</div>

<div class="modal processing" style="padding: 8px;" id="processing">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Collecting Data</h4>
                <div class="progress progress-popup">
                    <div class="progress-bar progress-bar-striped progress-bar-danger active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="main-body">

    <div role="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <span id="load" href="" class="navbar-brand no-hover" type="button" aria-expanded="false">
                    <span id="logo">JEJ // MIS</span>
                    <span style="font-size: 12px; color: #fff;"> Report Generator Beta</span>
                </span>
            </div>
        </div>
    </div>

    <?php if (!empty($results)) { ?>
        <div role="navigation" class="navbar navbar-default navbar-fixed-bottom pull-right">
            <div class="container">
                <div class="btn-group no-print" style="padding-top: 10px; margin-right: -15px;">
                    <a class="btn btn-danger" href="javascript:void(0)" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> PRINT</a>
                </div>
            </div>
        </div>
    <?php } ?>

    <div role="navigation" class="navbar visible-print" id="print-header">
        <div class="container">
            <div class="navbar-header">
                <span class="navbar-brand no-hover" type="button" aria-expanded="false">
                    <img src="<?php echo URL . 'img/logo.jpg'; ?>" style="height: 50px; margin-top: -20px; margin-right: -15px;"/>
                </span>
            </div>
            JEJ CELLMANIA TRADING CORPORATION<br />
            Operated By: <?php echo $_SESSION['branch']; ?><br />
            Contact Number: _______________________________<br /><br />
            Powered by JEJ_MIS <?php echo file_get_contents(URL . 'mis_version'); ?><br /><br />

            Store #<?php echo $_SESSION['branch_id']; ?><br />
            Staff: <?php echo $_SESSION['user_name']; ?>, ID #<?php echo $_SESSION['user_id']; ?><br />
            Invoice Generated: <?php echo date(DATE_CUSTOM, time()); ?>
        </div>
    </div>

    <div class="container padding-fix hidden-print" style="padding-bottom: 0px; margin-bottom: -10px;">
        <div role="alert" class="alert alert-info">
            <strong>INVOICE PREVIEW</strong>
        </div>
        <?php $this->renderFeedbackMessages(); ?>
    </div>

