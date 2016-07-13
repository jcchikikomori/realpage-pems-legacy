<div id="page-header">

    <!--Header in print view-->
    <div role="navigation" class="navbar visible-print" id="print-header">
        <div class="container">
            <div class="navbar-header">
                <span class="navbar-brand no-hover" type="button" aria-expanded="false">
                    <img src="<?php echo URL . 'img/logo.jpg'; ?>" style="height: 50px; margin-top: -20px; margin-right: -15px;"/>
                </span>
            </div><br />
            System Version <?php echo file_get_contents(URL . 'version'); ?>
        </div>
    </div>

    <!--hidden in print view-->
    <div id="header" class="container padding-fix hidden-print" style="border: 0; ;padding-bottom: 0px; margin-bottom: -10px;">
        <!--header-->
        <div role="navigation" class="navbar navbar-default" id="header">
            <div class="container-fluid">
                <div class="navbar-header">
                <span id="load" href="" class="navbar-brand" type="button" aria-expanded="false">
                    <span>
                        <span id="logo">
                            REALPAGE INC.
                        </span>
                    <span style="font-size: 12px;"> Reports </span><br />
                    </span>
                </span>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="menu" style="display: none !important;">
                    <ul class="nav navbar-nav navbar-right">
                        <li id="home-btn" class="active"><a href='javascript:void(0);' onclick='loadData()'>Home</a></li>
                        <!--
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                        -->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
            <!--loading-->
            <div class="progress" id="loader" style="margin: 0;">
                <div id="progress" class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 10%"></div>
            </div>
        </div>
    </div>
</div>

<!-- main content -->
<div id="page-body" class="container" style="display: none;">
    <!--menu-->
    <p class="hidden-print">What kind of data you want to display?</p>
    <div id="page-menu" style="display: none;">
        <div class="row hidden-print">
            <div class="col-sm-9">
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                        <button id="sales-btn" onclick="loadData('sales','Sales Transactions')" type="button" class="btn btn-default">Sales</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button id="inventory-btn" onclick="loadData('inventory','Main Inventory')" type="button" class="btn btn-default">Inventory</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button id="products-btn" onclick="loadData('products','All Products')" type="button" class="btn btn-default">Products</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button id="orders-btn" type="button" class="btn btn-default">Orders</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
        <!--<form action="#" method="GET">-->
            <!--<fieldset>-->
                        <div class="input-group">
                            <input id="search_data" type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="search" type="submit">Go!</button>
                            </span>
                        </div>
            <!--</fieldset>-->
        <!--</form>-->
            </div>
        </div>
        <br />
        <h4 id="page-title"></h4>
    </div>
    <div id="report-alert" role="alert" class="alert alert-info hidden-print" style="display: none;">
        <strong>REMINDER: </strong>
        <p>
            This is not yet a final report preview. Printed records may vary across different browsers.<br />
            You may modify data by <strong>filter, search (may vary), and sort</strong> as well.
            If you want to print by pages, you may do it <strong>separately</strong>
        </p>
    </div>
    <strong id="date_time_wrap" style="display: none;">
        Generated at <?php echo $_SESSION['branch']; ?>
        <span class="pull-right" id="date_time">
        <?php //echo date(DATE_CUSTOM); ?><!--<br />-->
    </span>
    </strong><br /><br />
    <!--dynamic content-->
    <div id="page-body-content"></div>
    <!--print panel-->
    <div id="nav-print" style="display: none;">
        <div role="navigation" class="navbar navbar-default navbar-fixed-bottom pull-right" id="footer">
            <div class="container">
                <div class="btn-group no-print" style="padding-top: 10px; margin-right: -15px;">
                    <a class="btn btn-default" href="javascript:void(0)" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> PRINT or press&nbsp;<kbd><kbd>ctrl</kbd> + <kbd>P</kbd></kbd></a>
                </div>
                <div class="btn-group dropup no-print pull-right" style="padding-top: 10px; margin-right: -15px;">
                    <apan class="btn btn-default disabled"><span class="glyphicon glyphicon-print"></span>&nbsp;Export: </apan>
                    <button value="csv" class="btn btn-default export" href="javascript:void(0)" >CSV</button>
                    <button value="excel" class="btn btn-default export" href="javascript:void(0)" >Excel</button>
                </div>
            </div>
        </div>
        <div class="container pull-right" style="width: 600px !important; margin: 30px 0px;">
            <div class="row">
                <div class="col-sm-6" style="width: 300px;">
                    Received By:<br /><br />
                    _______________________________________
                    <input type="text" style="width: 100%; text-align: center;" placeholder="Place Full Name here" />
                </div>
                <div class="col-sm-6" style="width: 300px;">
                    Approved By:<br /><br />
                    _______________________________________
                    <input type="text" style="width: 100%; text-align: center;" placeholder="Place Full Name here" />
                </div>
            </div>
        </div>
    </div>
</div>

<!-- scripts -->
<script type="text/javascript">

    //set variables first
    var loader = document.getElementById('loader');
    $(loader).slideDown();

    var head_title = "JEJ MIS -- ";
    var home_btn = document.getElementById('home-btn');
    var report_alert = document.getElementById('report-alert');

    //for pages
    var title = document.getElementById('page-title');
    var page = document.getElementById('page-body');
    var content = document.getElementById('page-body-content');
    var print_e = document.getElementById('nav-print');

    //date time display
    var date_time_wrap = document.getElementById('date_time_wrap');

    var content_menu = document.getElementById('menu');
    var page_menu = document.getElementById('page-menu');

    // change page title
    function changePageTitle(page_title, has_data){
        if (has_data) {
            document.title = head_title + page_title + " Report";
            // change page title
            $(title).text(page_title);
        } else {
            document.title = head_title + page_title;
        }
    }

    //for export
    var exp = document.getElementsByClassName('export');

    function printWarning(cond) {
        if (cond) {$(report_alert).show();} else {$(report_alert).hide();}
    }

    /**
     * This function will fall here if the request was undefined
     * @param data
     */
    function resetForm(data){
        window.history.replaceState("", "", location.protocol + '//' + location.host + location.pathname);
        setProgress(40, true);
        $(print_e).hide();
        resetBtn();
        switch(data){
            default:
                $(content).fadeOut(200, function(){
                    $(content).empty();
                    $(content).load('<?php echo URL . 'report/load/' ?>', function(){
                        // console.log(this);
                        setTimeout(function() {
                            setProgress(100, false, 400);
                            var home_class = $(home_btn).hasClass('active');
                            if (!home_class) {
                                $(home_btn).addClass('active');
                            }
                        }, 300);
                        changePageTitle('REPORT GENERATOR', false);
                        $(title).text('');
                        printWarning(false);
                    });
                    $(date_time_wrap).hide();
                    $(content_menu).fadeIn();
                    $(page_menu).fadeIn();
                    disable_func(q = true);
                 });
                break;
        }
    }

    function resetBtn()
    {
        var btn = $(".btn");
        if (btn.hasClass('active')) {
            btn.removeClass('active');
        }
    }

    function setProgress(value, set_only, interval) {
        $(".progress-bar")
            .css("width", value + "%")
            .attr("aria-valuenow", value);
            //.text(value + "%");
        if (!set_only) {
            if (interval == undefined) { interval = 1000; }
            setTimeout(function() {
                $(page).show();
                $(loader).slideUp();
            }, interval);
        }
    }

    function loadData(data, title){
        resetBtn();
        $(page).fadeOut(100);
        setProgress(20, true);
        $(loader).slideDown();
        //NOTE: You can try 'undefined' if the object was undefined instead of ''
        if (data != undefined) {
            $(content).fadeOut(200, function(){
                $(content).empty();
                $(content).load('<?php echo URL . 'report/load/' ?>' + data, function(response){
                    if (!response) {
                        resetForm();
                    } else {
                        window.history.replaceState("", "", location.protocol + '//' + location.host + location.pathname + '?data=' + data);
                        setProgress(100, false, 600);
                        $(home_btn).removeClass('active');
                        $('#'+data+'-btn').addClass('active');
                    }
                });
                $(content_menu).fadeIn();
                $(page_menu).fadeIn();
                changePageTitle(title, true);
                printWarning(true);
                date_time('date_time');
                $(date_time_wrap).fadeIn();
                $(content).fadeIn();
                $(print_e).fadeIn();
                disable_func(q = false);
            });
        } else {
            resetForm();
            console.log('error!');
        }
    }

    //table manipulations

    /**
     * Select filter
     * @param table
     */
    function filterColumns(table)
    {
        table.api().columns().every( function () {
            var column = this;
            var select = $('<select class="form-control-sm selectpicker show-tick" title="" data-header="Filter by" data-container="body" data-size="5" data-live-search="true"><option hidden value="" title="">None<option></select>')
                .appendTo( $(column.footer()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                    column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                } );
            column.data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
        } );
    }

    //misc
    function date_time(id)
    {
        var date = new Date; var year = date.getFullYear(); var month = date.getMonth();
        var months = Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
        var d = date.getDate(); var day = date.getDay();
        var days = Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        var h = date.getHours();
            if(h < 10) {h = "0"+h;}
            m = date.getMinutes();
            if(m < 10) {var m = "0"+m;}
            s = date.getSeconds();
            if(s < 10) {var s = "0"+s;}
        var result = ''+days[day]+', '+months[month]+' '+d+', '+year+' - '+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");',1000);
        return true;
    }

    function disable_func(bool) {
        //if request was true
        if (bool) {
            //set traps
            Mousetrap.bind(['ctrl+p', 'command+p'], function(e) {
                e.preventDefault();
                bootbox.alert({
                    title: "OOPS!",
                    size: 'small',
                    className: "modal-no-print",
                    animate: false,
                    backdrop: false,
                    closeButton: false,
                    message: "Printing without data is not allowed!"
                });
            });
        } else {
            Mousetrap.unbind(['ctrl+p', 'command+p']);
        }
    }

    /** EXPORT FUNCTIONS **/
    function doExport(selector, params, options) {
        $.extend(true, options, params);
        $(selector).tableExport(options);
    }
    function DoCellData(cell, row, col, data) {}
    function DoBeforeAutotable(table, headers, rows, AutotableSettings) {}
    function doExportPDF(selector, params) {
        var options = {tableName: 'Assets',
            fileName: file,
            htmlContent: false,
            worksheetName: 'Consists of Asset Records',
            jspdf: {orientation: 'l',
                autotable: {extendWidth: true,
                    tableExport: {onBeforeAutotable: DoBeforeAutotable,
                        onCellData: DoCellData}}}
        };
        $.extend(true, options, params);
        $(selector).tableExport(options);
    }
    var header = function (doc, pageCount, options) {
        doc.text("header", options.margins.horizontal, doc.autoTableEndPosY() - doc.internal.getLineHeight() / 2);
    };
    var footer = function (doc, lastCellPos, pageCount, options) {
        doc.text("footer", options.margins.horizontal, doc.autoTableEndPosY() + doc.internal.getLineHeight());
    };

    //when the document is ready
    $(document).ready(function() {

    <?php
        if (isset($data)) { ?>
    loadData('<?php echo $data . "','" . ucfirst($data) . "'"; ?>);
        <?php } else {echo "resetForm();";}
    ?>

        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });

        //search
        $('#search').on('click', function(e){
            e.preventDefault;
            var value = $('#search_data').val();
            loadData(value, value);
        });
        $('#search_data').keypress(function(e) {
            if(e.which == 13) {
                e.preventDefault();
                var value = $('#search_data').val();
                var title = value.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                });
                loadData(value, title);
            }
        });

    });

</script>