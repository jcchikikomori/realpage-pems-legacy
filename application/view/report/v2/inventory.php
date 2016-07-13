<?php $this->renderFeedbackMessages(); ?>

<table id="inventory" class="table-striped tb-compact" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>CATEGORY</th>
            <th>BRAND</th>
            <th>PRODUCT</th>
            <th>ORIGINAL_DP</th>
            <th>DEPR_VALUE</th>
            <th>CURRENT_DP</th>
        </tr>
    </thead>
    <tfoot class="col-borderless">
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>

<script>

    var table = $('#inventory');

    $(table).dataTable( {
        "deferRender": true,
        "processing": true,
        "ajax": "<?php echo URL . 'json/reports/inventory'; ?>",
        "columns": [
            { "data": "name" },
            { "data": "brand" },
            { "data": "product_name" },
            { "data": "DP" },
            { "data": "depr_value" },
            { "data": "current_dp" }
        ],
        initComplete: function () {
            filterColumns(this);
        }
    });

    var export_opt = {
        tableName: 'inventory',
        fileName: 'INVENTORY REPORT',
        htmlContent: false,
        worksheetName: 'inventory'
    };
    $(exp).bind('click', function(e){
        doExport(table,{type: this.value}, export_opt);
        e.unbind('click');
    });

</script>
