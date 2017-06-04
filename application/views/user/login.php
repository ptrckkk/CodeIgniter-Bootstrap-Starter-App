<h2>Login</h2>

<?php if ($this->session->flashdata('has_login_error')): ?>
    <div class="alert alert-danger" role="alert">
        <?= $this->session->flashdata('login_error') ?>
    </div>
<?php endif; ?>

<?= form_open(base_url() . 'index.php/user/login', ['class' => 'form-horizontal']) ?>
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
                   required="required" placeholder="Password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-5">
            <button type="submit" class="btn btn-default">Login</button>
        </div>
    </div>
</form>
