<?php
//echo $errors->confirmPassword;
//die;

?>

<?php $view_extends = 'master'; ?>
<?php $view_title = 'Register'; ?>

<?php start_section(); ?>

<form action="/auth/register/save" method="POST">
    <input type="hidden" name="csrf" value="<?php echo $sessionManager->getCsrf(); ?>"/>


    <div class="row mt-4">
        <div class="col-lg-6 offset-lg-3">

            <h2>Register</h2>
            <hr/>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control<?php echo $errors->has('firstName') ? ' is-invalid' : '' ?>" id="firstName" name="firstName" placeholder="First name"
                               aria-label="First name" value="<?php echo isset($old->firstName) ? $old->firstName : ''; ?>">
                        <?php if($errors->has('firstName')): ?>
                            <div class="invalid-feedback">
                                <strong><?php echo $errors->first('firstName'); ?></strong>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control<?php echo $errors->has('lastName') ? ' is-invalid' : '' ?>" id="lastName" name="lastName" placeholder="Last name"
                               aria-label="Last name" value="<?php echo isset($old->lastName) ? $old->lastName : ''; ?>">
                        <?php if($errors->has('lastName')): ?>
                            <div class="invalid-feedback">
                                <strong><?php echo $errors->first('lastName'); ?></strong>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>

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
                <div class="col">
                    <div class="form-group">
                        <input type="password" class="form-control<?php echo $errors->has('confirmPassword') ? ' is-invalid' : '' ?>" id="confirmPassword" name="confirmPassword"
                               placeholder="Confirm Password" aria-label="Confirm Password" value="">
                        <?php if($errors->has('confirmPassword')): ?>
                            <div class="invalid-feedback">
                                <strong><?php echo $errors->first('confirmPassword'); ?></strong>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100">Register</button>
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
