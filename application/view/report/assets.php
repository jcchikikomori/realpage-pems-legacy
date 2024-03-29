<script>
    var file = "<?php echo 'ASSET_QUICK_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<script type="text/javascript" src="<?php echo URL . ASSETS; ?>/js/_MIS/AMS.js"></script>

<div class="container padding-fix">
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">Quick Asset Report</strong><br />
            Generated at <?php echo $_SESSION['branch']; ?>
            <span class="pull-right">
                <strong><?php echo date(DATE_CUSTOM); ?></strong><br />
            </span>
        </div>
    </div>
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">ASSETS</strong><br />
        </div>
        <div class="panel-body">
            <?php if (!empty($assets)) { ?>
            
                <!-- Filter dates -->
                <div class="row">
                    <div class="col-md-3">
                        <div id="external_filter_container_wrapper">
                            <label>Filter Creation Date</label>
                            <div id="external_filter_container"></div>
                        </div><br />
                    </div>
                </div>
            
                <table class="table-striped tb-compact" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TYPE</th>
                            <th>ITEM</th>
                            <th>BRANCH</th>
                            <th>O_VAL</th>
                            <th>Q</th>
                            <th>TOTAL</th>
                            <th>DEP_RATE</th>
                            <th>RECORDED</th>
                            <th>VALUED</th>
                            <th>VALID</th>
                            <th>REM_VAL</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($assets as $asset) { ?>
                            <tr>
                                <td><?php if (isset($asset->asset_id)) echo htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->type)) echo htmlspecialchars($asset->atype, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->name)) echo htmlspecialchars($asset->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->branch)) echo htmlspecialchars($asset->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->price)) echo htmlspecialchars(number_format($asset->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->price)) echo htmlspecialchars($asset->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->price)) echo htmlspecialchars(number_format($asset->price * $asset->qty), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->depreciation)) echo htmlspecialchars(Math::decToPer($asset->depreciation) . '%', ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->timestamp)) echo htmlspecialchars(date(DATE_MMDDYY_C, $asset->timestamp), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->value_date)) echo htmlspecialchars(date(DATE_MMDDYY_C, $asset->value_date), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if ($asset->lifespan != 0) echo htmlspecialchars($asset->lifespan . ' Yr/s', ENT_QUOTES, 'UTF-8'); else echo 'None'; ?></td>
                                <td>
                                    <?php
                                    if (Math::computeAge($asset->created) != 0) {
                                        echo htmlspecialchars($asset->price - ($asset->accu_depreciation * $age), ENT_QUOTES, 'UTF-8'); }
                                    else {
                                        echo 'No changes';
                                    }
                                    ?>
                                </td>
                                <td><?php if (isset($asset->asset_id)) echo htmlspecialchars($asset->status, ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tfoot>
                </table>
                <br />
                <div class="hidden-print">
                    <select class="selectpicker pull-right" data-style="btn-danger" data-width="120" onchange="doExport('#table1',{type: this.options[this.selectedIndex].value});" data-container="body">
                        <option selected data-icon="glyphicon glyphicon-book"> &nbsp;Export</option>
                        <option value="csv" data-icon="">CSV</option>
                        <option value="excel" data-icon="">Excel</option>
                        <option value="pdf" data-icon="">PDF</option>
                    </select>
                </div>
            <?php } else { ?>
                <strong>No any records yet.</strong>
            <?php } ?>
        </div>
    </div>
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">MAIN INVENTORY</strong><br />
        </div>
        <div class="panel-body">
            <?php if (!empty($products)) { ?>
                <table class="table-striped tb-compact" id="table2">
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
                    <tbody>
                        <?php foreach ($products as $product) { ?>
                            <tr>
                                <td><?php if (isset($product->category)) echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->brand)) echo htmlspecialchars($product->brand, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->DP)) echo htmlspecialchars(number_format($product->DP), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->depr_value)) echo htmlspecialchars(number_format($product->depr_value), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->DP)) echo htmlspecialchars(number_format($product->DP - $product->depr_value), ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tfoot>
                </table>
                <br />
                <div class="hidden-print">
                    <select class="selectpicker pull-right" data-style="btn-danger" data-width="120" onchange="doExport('#table2',{type: this.options[this.selectedIndex].value});" data-container="body">
                        <option selected data-icon="glyphicon glyphicon-book"> &nbsp;Export</option>
                        <option value="csv" data-icon="">CSV</option>
                        <option value="excel" data-icon="">Excel</option>
                        <option value="pdf" data-icon="">PDF</option>
                    </select>
                </div>
            <?php } else { ?>
                <strong>No any records yet.</strong>
            <?php } ?>
        </div>
    </div>
</div>

    <script type="text/javascript" charset="utf-8">
        var url = "<?php echo URL; ?>";
        $(document).ready(function() {
            $('table#table1').dataTable( {
                order: [[8, 'desc']],
                <?php require VIEWS_PATH . '_script/column_filter.txt'; ?>,
                "lengthMenu": [[-1, 25, 50, 100, 200], ["All", 25, 50, 100, 200]],
                "paging": true,
                "jQueryUI": false,
                "searching": true,
                "ordering": true,
                "stateSave": false,
                "pageLength": 25,
                "pagination": true
                //"sDom": "tp"
            } ).yadcf([
                //{ column_number : 1, filter_type: "select", filter_default_label: "TYPE" },
                //{ column_number : 2, filter_type: "select", filter_default_label: "ITEM" },
                //{ column_number : 3, filter_type: "select", filter_default_label: "BRANCH" },
                { column_number : 7, filter_type: "range_date", filter_container_id: "external_filter_container" }
            ]);
            $('table#table2').dataTable( {
                <?php require VIEWS_PATH . '_script/column_filter.txt'; ?>,
                "lengthMenu": [[-1, 25, 50, 100, 200], ["All", 25, 50, 100, 200]],
                "paging": true,
                "jQueryUI": false,
                "searching": true,
                "ordering": true,
                "stateSave": false,
                "pageLength": 25,
                "pagination": true
                //"sDom": "tp"
            } );
        } );
    </script>