<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>REPORT GENERATOR</title>
    <meta name="description" content="">

    <!-- CSS -->
    <link href="<?php echo URL . ASSETS; ?>css/normalize.css" rel="stylesheet">
    <link href="<?php echo URL . ASSETS; ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo URL . ASSETS; ?>css/custom.css" rel="stylesheet" media="all">
    <!-- TODO: custom font-size harcoded in custom.css -->
    <link href="<?php echo URL . BOWER; ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="<?php echo URL . BOWER; ?>bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" media="all">

    <style>
        @media screen and (max-width: 799px){
            #main-body {
                display: none;
            }
            div#resolution-warning {
                display: block;
            }
        }
        @media screen and (max-width: 1000px) {
            .container {
                margin-left: 10px;
                margin-right: 10px;
            }
        }

        html, body {
            background: #fff;
        }
        @media screen {
            body {
                padding-top: 15px;
                padding-bottom: 60px;
            }
        }
        #header {
            /*
            -webkit-box-shadow: 0px 9px 7px -6px rgba(0,0,0,0.31);
            -moz-box-shadow: 0px 9px 7px -6px rgba(0,0,0,0.31);
            box-shadow: 0px 9px 7px -6px rgba(0,0,0,0.31);
            */
        }
        #footer {

        }
        .container {
            width: 1200px !important;
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
        <!--<a class="btn btn-danger" href="javascript:void(0)" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> Print Anyway</a>-->
        <!--<a class="btn btn-default" href="../">Later</a>-->
            </div>
        </div>
    </div>
</div>

<div id="main-body">