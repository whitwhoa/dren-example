<?php $view_extends = 'master'; ?>
<?php $view_title = 'Form array element example'; ?>

<?php start_section(); ?>

    <div class="row mt-4">
        <div class="col-lg-6 offset-lg-3">

            <div class="text-center">
                <p>
                Example of submitting and validating a form asynchronously<br/>
                    <br/>
                    This is where we're leaving off for the time being as I'm going to create
                    an "AsyncForm" javascript class that can be re-used for submitting forms
                    via ajax that automatically handles displaying validation rule messages and
                    changing bootstrap classes and effects such as loading spinners and fadeins/outs
                    and locking form until response received from server...this way omg handling any
                    form will be so much better than having all that custom logic in a php view and then
                    redirect flashing and that whole pipeline...yes...
                </p>
            </div>

            <!--
                This is just here for the time being so that I can verify that validation rules are working as they
                should be before we introduce the async form submission logic
             -->
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

            <form action="/ajax-form-example/save" method="POST" id="ajaxExampleForm">
                <div class="form-group mb-3">
                    <label for="exampleText">Email text</label>
                    <input type="text" class="form-control" id="exampleText" name="exampleText" placeholder="Enter text">
                </div>

                <div class="form-group mb-3">
                    <label for="exampleSelect">Example select</label>
                    <select class="form-control" id="exampleSelect" name="exampleSelect">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="exampleTextarea">Example textarea</label>
                    <textarea class="form-control" id="exampleTextarea" name="exampleTextarea" rows="3"></textarea>
                </div>

                <div>Example radio buttons</div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios1" value="opt1" checked="">
                    <label class="form-check-label" for="optionsRadios1">
                        Option one
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios2" value="opt2">
                    <label class="form-check-label" for="optionsRadios2">
                        Option two
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="optionsRadios" id="optionsRadios3" value="opt3">
                    <label class="form-check-label" for="optionsRadios3">
                        Option three
                    </label>
                </div>




                <div class="mt-3">Example check boxes</div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="optionCheckboxes1" name="optionCheckboxes[1]" value="value1" checked="">
                    <label class="form-check-label" for="optionCheckboxes1">
                        Option one
                    </label>
                </div>
                <div class="form-check disabled">
                    <input class="form-check-input" type="checkbox" id="optionCheckboxes2" name="optionCheckboxes[2]" value="value2">
                    <label class="form-check-label" for="optionCheckboxes2">
                        Option two
                    </label>
                </div>

                <button type="submit" class="btn btn-primary mb-2 mt-4 w-100" id="ajaxExampleFormSubmitButton">Submit</button>
            </form>

        </div>
    </div>

<?php $view_body_content = end_section(); ?>




<?php start_section(); ?>
    <script>
        $(document).ready(function(){

            let ajaxExampleForm = new AsyncForm("ajaxExampleForm", {
                successMessage:"Custom Success Message!",
                validationErrorsDisplayType:"grouped"
            });

        });
    </script>
<?php $view_page_specific_js = end_section(); ?>