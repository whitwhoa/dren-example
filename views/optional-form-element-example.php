<?php $view_extends = 'master'; ?>
<?php $view_title = 'Form array element example'; ?>

<?php start_section(); ?>

    <div class="row mt-4">
        <div class="col-lg-6 offset-lg-3">

            <div class="text-center">
                <p>
                Example of submitting a form where the value being submitted is optional
                </p>
            </div>

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


            <form action="/optional-form-element-example/save" method="POST" id="optionalFormElementForm">
                <input type="text" class="form-control" name="testTextInput"/>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary mt-2 " id="optionalFormElementFormSubmitButton">Save</button>
                </div>

            </form>

        </div>
    </div>

<?php $view_body_content = end_section(); ?>




<?php start_section(); ?>

<?php $view_page_specific_js = end_section(); ?>