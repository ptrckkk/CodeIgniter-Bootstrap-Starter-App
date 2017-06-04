<h2>Create a new User Account</h2>

<?php if ($this->session->flashdata('has_validation_error')): ?>
    <div class="alert alert-danger" role="alert">
        <?= $this->session->flashdata('validation_error_message') ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('has_success_message')): ?>
    <div class="alert alert-success" role="alert">
        <?= $this->session->flashdata('success_message') ?>
    </div>
<?php endif; ?>

<?= form_open(base_url() . 'index.php/user/create', ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label for="display_name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="display_name" name="display_name"
                   required="required" placeholder="The name we will greet you with"
                   value="<?= $this->session->flashdata('display_name') ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-5">
            <input type="email" class="form-control" id="email" name="email" required="required"
                   placeholder="Email"
                   value="<?= $this->session->flashdata('email') ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-5">
            <input type="password" class="form-control" id="password" name="password"
                   required="required" placeholder="Password"
                   value="<?= $this->session->flashdata('password') ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="captcha" class="col-sm-2 control-label">Captcha</label>
        <div class="col-sm-5">
            <?= $captcha_image ?>
            <br><br>
            <input type="text" class="form-control" id="captcha" name="captcha" required="required"
                   placeholder="Captcha">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-5">
            <button type="submit" class="btn btn-default">Create</button>
        </div>
    </div>
</form>