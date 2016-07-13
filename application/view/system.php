<div class="container padding-fix">
    <div class="row centered-row login-row-fix">
        <div class="col-sm-8 visible-sm visible-md visible-lg">
            <!--<img src="<?php //echo URL . 'img/realpage-bar.png'; ?>" style="width: 100%; margin-top: 12px;" />-->
            <img src="<?php echo URL . 'img/realpage-pc-registration.png'; ?>" style="width: 100%; margin-top: 25px;" />
        </div>
        <div class="col-sm-4">
            <div class="panel panel-transparent no-shadow">
                <div class="panel-heading">
                    <div class="sys_logo">
                        <img src="<?php echo URL . 'img/logo-inversed.png'; ?>" style="width: 100%;" />
                    </div>
                </div>
                <div class="panel-body nod-white login-panel-fix" id="login-body">
                    <?php $this->renderFeedbackMessages(); ?>
                    <p>
                        <b>REAL PAGE PeMS</b>&nbsp;<b class=""><?php echo file_get_contents(URL . 'version'); ?></b>
                    </p>
                    <?php View::detectUser(); ?>
                    <br />
                    <br /><p>(C) REAL PAGE INC.</p>
                </div>
            </div>
        </div>
    </div>
</div>


