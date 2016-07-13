<?php $this->renderFeedbackMessages(); ?>

<table id="products" class="table-striped tb-compact" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>PRODUCT ID</th>
            <th>PRODUCT NAME</th>
            <th>CATEGORY ID</th>
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

    var table = document.getElementById('products');

    $(table).dataTable( {
        "lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
        "deferRender": true,
        "serverSide": true,
        "processing": true,
        "ajax": "<?php echo URL . 'json/data/products'; ?>",
        initComplete: function () {
            filterColumns(this);
        }
    });

    var export_opt = {
        tableName: 'products',
        fileName: 'PRODUCT REPORT',
        htmlContent: false,
        worksheetName: 'products'
    };
    $(exp).bind('click', function(e){
        doExport(table,{type: this.value}, export_opt);
        e.unbind('click');
    });

</script>
