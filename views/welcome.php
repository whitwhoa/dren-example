<?php $view_extends = 'master'; ?>
<?php $view_title = 'Welcome'; ?>

<?php start_section(); ?>

<div class="row mt-4">
    <div class="col-lg-6 offset-lg-3">

        <div class="text-center">
<!--            <h2>RajPHP</h2>-->
            <br/>
            Welcome<?php if($user): ?>, <?php echo $user->first_name; ?><?php endif; ?>
            <br/>
            <br/>
            <?php if(!$user): ?>
                <a href="/auth/register" class="btn btn-primary w-100">Register</a><br/>
                <a href="/auth/login" class="btn btn-primary w-100 mt-2">Login</a>
            <?php else: ?>
                <a href="/auth/logout" class="btn btn-primary w-100">Logout</a>
            <?php endif; ?>

        </div>

    </div>
</div>

<?php $view_body_content = end_section(); ?>




<?php start_section(); ?>
<script>
    $(document).ready(function(){

    });
</script>
<?php $view_page_specific_js = end_section(); ?>
