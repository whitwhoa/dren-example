<?php $view_extends = 'master'; ?>
<?php $view_title = '500'; ?>

<?php start_section(); ?>

<style>
    .error-message-container{
        height:calc(100vh - 100px);
    }
    .error-message-container .error-message-basic{
        font-size:2em;
        font-family: 'Nunito', sans-serif;
        color:#636b6f;
        margin-bottom:15px;
    }
</style>

<?php $view_page_specific_css = end_section(); ?>

<?php start_section(); ?>

    <div class="row error-message-container">

        <div class="col justify-content-center align-self-center text-center">

            <div class="error-message-basic">500 | Internal Server Error</div>
            <?php if(isset($detailedMessage) && $detailedMessage != ''): ?>
                <div class="alert alert-danger text-center pt-4 pb-4">
                    <?php echo $detailedMessage; ?>
                </div>
            <?php endif; ?>


        </div>

    </div>

<?php $view_body_content = end_section(); ?>