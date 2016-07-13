<form action="<?php echo URL; ?>system/login" method="post" autocomplete="on">
    <fieldset>
        <div class="form-group has-feedback">
            <input id="required" type="text" name="user_name" class="form-control username" placeholder="Username" required />
        </div>
        <div class="form-group has-feedback">
            <input id="required" type="password" name="user_password" class="form-control password" placeholder="Password" required />
        </div>
        <input type="submit" name="submit" style="color: #000;" class="btn btn-block submit" value="LOGIN" id="page_loader_submit" />
    </fieldset>
</form>