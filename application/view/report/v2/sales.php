<?php $this->renderFeedbackMessages(); ?>

<!-- Filter dates -->
<div>
    <label>Filter Date</label>
    <div id="external_filter_container"></div>
</div><br />
<table id="sales" class="table-striped tb-compact" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>BRANCH</th>
            <th>BRAND</th>
            <th>PROD.</th>
            <th>PAID</th>
            <th>SRP</th>
            <th>Q</th>
            <th>TL</th>
            <th>NET</th>
            <th>DWN</th>
            <th>BAL</th>
            <th>DATE</th>
            <th>CUSTOMER</th>
        </tr>
    </thead>
</table>

<script>

    var table = $('#sales');
    //var sales = document.getElementById('sales');

    $(table).dataTable( {
        "stateSave" : true,
        "deferRender": true,
        "processing": true,
        "ajax": "<?php echo URL . 'json/reports/sales'; ?>",
        "columns": [
            { "data": "branch_name" },
            { "data": "brand" },
            { "data": "product_name" },
            { "data": "payment" },
            { "data": "price" },
            { "data": "qty" },
            { "data": "total_amt" },
            { "data": "net" },
            { "data": "downpayment" },
            { "data": "remaining" },
            { "data": "time" },
            { "data": "customer_name" }
        ],
        "order": [[0, 'desc']],
        "jQueryUI": false,
        "initComplete": function () {
            filterColumns(this);
        }
    }).yadcf([
        {column_number : 10, filter_type: "range_date", filter_container_id: "external_filter_container"}
    ]);

    var export_opt = {
        tableName: 'sales',
        fileName: 'SALES REPORT',
        htmlContent: false,
        worksheetName: 'sales'
    };
    $(exp).bind('click', function(e){
        doExport(table,{type: this.value}, export_opt);
        e.unbind('click');
    });

</script>
