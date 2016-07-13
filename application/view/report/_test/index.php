<div class="container padding-fix">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong style="line-height:26px;">Sales Report -- <?php echo date(DATE_CUSTOM); ?></strong>
        </div>
        <div class="panel-body">
            <div id="sales_toolbar">
                <select class="form-control">
                    <option value="">Export Basic</option>
                    <option value="all">Export All</option>
                    <option value="selected">Export Selected</option>
                </select>
            </div>
            <table class="table table-hover table-no-bordered" id="sales"
                   data-toggle="table"
                   data-show-export="true"
                   data-show-refresh="true"
                   data-side-pagination="client"
                   data-show-pagination-switch="true"
                   data-pagination="true"
                   data-click-to-select="true"
                   data-toolbar="#sales_toolbar"
                   data-filter-control="true"
                   data-show-footer="true"
                   data-url="<?php echo URL; ?>SOM/sales/test"
                >
                <thead>
                <tr>
                    <th data-field="state" data-checkbox="true"></th>
                    <th data-field="sale_id" data-sortable="true">SALES ID</th>
                    <th data-field="brand" data-sortable="true">BRAND</th>
                    <th data-field="branch_name" data-sortable="true" data-filter-control="select">BRANCH</th>
                    <th data-field="qty" data-sortable="true">QTY</th>
                    <th data-field="price" data-sortable="true">PRICE</th>
                    <th data-field="payment" data-sortable="true">PAYMENT</th>
                    <th data-field="remaining" data-sortable="true">REMAINING</th>
                    <th data-field="time" data-sortable="true">TIME</th>
                    <th data-field="customer_name" data-sortable="true">CUSTOMER</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong style="line-height:26px;">Audit Report -- <?php echo date(DATE_CUSTOM); ?></strong>
        </div>
        <div class="panel-body">
            <div id="au_toolbar">
                <select class="form-control">
                    <option value="">Export Basic</option>
                    <option value="all">Export All</option>
                    <option value="selected">Export Selected</option>
                </select>
            </div>
            <table class="table table-hover table-no-bordered" id="au"
                   data-toggle="table"
                   data-show-refresh="true"
                   data-show-export="true"
                   data-pagination="true"
                   data-click-to-select="true"
                   data-toolbar="#au_toolbar"
                   data-search="true"
                   data-url="<?php echo URL; ?>json/audit_logs"
            >
                <thead>
                <tr>
                    <th data-field="state" data-checkbox="true"></th>
                    <th data-field="id" data-sortable="true">ID</th>
                    <th data-field="type" data-sortable="true">TYPE</th>
                    <th data-field="description" data-sortable="true">MESSAGE</th>
                    <th data-field="user" data-sortable="true">USER</th>
                    <th data-field="ip_address" data-sortable="true">IP</th>
                    <th data-field="UA" data-sortable="true">UA</th>
                    <th data-field="date" data-sortable="true">DATE</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>

    //for sales
    function salesParams(params) {
        params.your_param1 = 1; // add param1
        params.your_param2 = 2; // add param2
        // console.log(JSON.stringify(params));
        // {"limit":10,"offset":0,"order":"asc","your_param1":1,"your_param2":2}
        return params;
    }

    //custom ajax test (for UA)
    function ajaxRequest(params) {
        // data you need
        console.log(params.data);
        // just use setTimeout
        setTimeout(function () {
            params.success({
                total: 100,
                rows:
            });
            // hide loading
            params.complete();
        }, 1000);
    }

    $(document).ready(function() {
        var $sales = $('table#sales');
        $(function () {
            $('#sales_toolbar').find('select').change(function () {
                $sales.bootstrapTable('refreshOptions', {
                    exportDataType: $(this).val()
                });
            });
        });
        var $au = $('table#au');
        $(function () {
            $('#au_toolbar').find('select').change(function () {
                $au.bootstrapTable('refreshOptions', {
                    exportDataType: $(this).val()
                });
            });
        });
    });
</script>