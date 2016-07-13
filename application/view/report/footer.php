
    <div class="container pull-right" style="width: 600px !important; margin-right: 15px;">
        <div class="row">
            <div class="col-sm-6" style="width: 300px;">
                Received By:<br /><br />
                _______________________________________
                <input type="text" style="width: 100%; text-align: center;" />
            </div>
            <div class="col-sm-6" style="width: 300px;">
                Approved By:<br /><br />
                _______________________________________
                <input type="text" style="width: 100%; text-align: center;" />
            </div>
        </div>

    </div>
    <br /><br /><br /><br /><br /><br />


    <!-- EXPORT -->
    <script type="text/javascript" src="<?php echo URL . ASSETS; ?>js/FileSaver/FileSaver.min.js"></script>
    <script type="text/javascript" src="<?php echo URL . ASSETS; ?>js/html2canvas/html2canvas.min.js"></script>
    <script type="text/javascript" src="<?php echo URL . ASSETS; ?>js/jsPDF/jspdf.min.js"></script>
    <script type="text/javascript" src="<?php echo URL . ASSETS; ?>js/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
    <script type="text/javascript" src="<?php echo URL . ASSETS; ?>js/tableExport.min.js"></script>
    <!-- OTHERS -->
    <script src="<?php echo URL . ASSETS; ?>js/ajax.js" type="text/javascript"></script>
    <script src="<?php echo URL . ASSETS; ?>js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo URL . ASSETS; ?>datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo URL . ASSETS; ?>js/jquery.dataTables.yadcf.js"></script>
    <script src="<?php echo URL . BOWER; ?>bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo URL . ASSETS; ?>js/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo URL . ASSETS; ?>js/daterangepicker.js" type="text/javascript"></script>
    <script src="<?php echo URL . ASSETS; ?>js/animate.js" type="text/javascript"></script>

    <?php require VIEWS_PATH . '_script/datatables.php'; ?>

</div>

</body>
</html>
