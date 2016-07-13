<script>
    //var file = "<?php echo 'AUDIT_TRAIL_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<!--<script type="text/javascript" src="--><?php //echo URL; ?><!--assets_new/js/_MIS/AUDIT.js"></script>-->

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Audit Trail</h4>
        </div>
        <div class="panel-body">
            <div class="table">
                <div class="row">
                    <div class="col-md-12">
                        <br />
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($au)) { ?>
                            <div class="row-fluid">
                                <div id="toolbar">
                                    <select class="form-control">
                                        <option value="">Export Basic</option>
                                        <option value="all">Export All</option>
                                        <option value="selected">Export Selected</option>
                                    </select>
                                </div>
                                <table class="table table-hover" id="au"
                                       data-toggle="table"
                                       data-show-refresh="true"
                                       data-show-export="true"
                                       data-pagination="true"
                                       data-click-to-select="true"
                                       data-toolbar="#toolbar"
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
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>

<script>
    var $table = $('#au');
    $(function () {
        $('#toolbar').find('select').change(function () {
            $table.bootstrapTable('refreshOptions', {
                exportDataType: $(this).val()
            });
        });
    });
</script>
