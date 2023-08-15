<?php $view_extends = 'master'; ?>
<?php $view_title = 'Login'; ?>

<?php start_section(); ?>

<form action="/auth/login/save" method="POST">
    <input type="hidden" name="csrf" value="<?php echo $sessionManager->getCsrf(); ?>"/>

    <div class="row mt-4">
        <div class="col-lg-6 offset-lg-3">

            <h2>Login</h2>
            <hr/>



            <?php if(isset($errors) && $errors->count() > 0): ?>
                <div class="row">
                    <div class="col">
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach($errors->all() as $e): ?>
                                    <li><?php echo $e; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control<?php echo $errors->has('email') ? ' is-invalid' : '' ?>" id="email" name="email" placeholder="Email"
                               aria-label="Email" value="<?php echo isset($old->email) ? $old->email : ''; ?>">
                        <?php if($errors->has('email')): ?>
                            <div class="invalid-feedback">
                                <strong><?php echo $errors->first('email'); ?></strong>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="password" class="form-control<?php echo $errors->has('password') ? ' is-invalid' : '' ?>" id="password" name="password" placeholder="Password"
                               aria-label="Password" value="">
                        <?php if($errors->has('password')): ?>
                            <div class="invalid-feedback">
                                <strong><?php echo $errors->first('password'); ?></strong>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</form>

<?php $view_body_content = end_section(); ?>




<?php start_section(); ?>
<script>
    $(document).ready(function(){

    });
</script>
<?php $view_page_specific_js = end_section(); ?>
