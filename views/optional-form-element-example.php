<?php $view_extends = 'master'; ?>
<?php $view_title = 'Form array element example'; ?>

<?php start_section(); ?>

    <div class="row mt-4">
        <div class="col-lg-6 offset-lg-3">

            <div class="text-center">
                <p>
                Example of submitting a form where the value being submitted is optional. <br/><br/>
                    Validator expects the form element to either not be present in the request, ie you will need
                    to open dev tools and remove the form input and then submit the form to test this, or the value to
                    be at least 3 characters if the form element is provided.<br/><br/>
                    If you click save and the page reloads and you see no errors, the request was successful<br/><br/>
                    If you go to OptionalFormElementRequest.php and swap the "nullable" method out with "sometimes", then
                    you will be able to submit the form IF you remove the text input element completely, BUT if it exists
                    in the request it MUST contain a value that is not null....so basically "nullable" and "sometimes"
                    do the exact same thing, only "nullable" allows the element to be submitted with a null value or empty
                    string, whereas "sometimes" requires a value to be present if the form element is present in the request
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

                <div class="text-end">
                    <button type="submit" class="btn btn-primary mt-2 " id="optionalFormElementFormSubmitButton">Save</button>
                </div>

            </form>

        </div>
    </div>

<?php $view_body_content = end_section(); ?>




<?php start_section(); ?>

<?php $view_page_specific_js = end_section(); ?>