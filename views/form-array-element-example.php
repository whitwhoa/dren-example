<?php $view_extends = 'master'; ?>
<?php $view_title = 'Form array element example'; ?>

<?php start_section(); ?>

    <div class="row mt-4">
        <div class="col-lg-6 offset-lg-3">

            <div class="text-center">
                <p>
                Example of submitting a form that contains an array of elements and properly validating said
                elements on server side using built in validation rules
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

            <div class="text-end">
                <button class="btn btn-primary" id="addKeyValButton">Add Key Value Pair</button>
                <button type="button" class="btn btn-secondary" id="testButton">Print element array to console</button>
            </div>
            <form action="/form-array-element-example/save" method="POST" id="keyValuePairForm">


                <button type="submit" class="btn btn-primary mb-2 d-none" id="keyValuePairFormSubmitButton">Save</button>
            </form>
            <hr>
            <h2 class="mt-4">Existing key values</h2>
            <ul>
            <?php foreach($userKeyVals as $v): ?>
            <li>
                <?php echo $v->key;?>:<?php echo $v->val; ?>
                <?php if($v->notes != ''): ?>
                <ul>
                <?php foreach(json_decode($v->notes) as $n): ?>
                <li><?php echo $n->note; ?></li>
                <?php endforeach;?>
                </ul>
                <?php endif;?>
            </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>

<?php $view_body_content = end_section(); ?>




<?php start_section(); ?>
    <script src="/js/form-array-element-example.js"></script>

    <script>
        $('document').ready(function(){

            $('#testButton').click(function(){

                // get all input elements within form
                let inputElements = document.querySelectorAll("input, textarea, select");

                // convert the NodeList to an array, extract the "name" property of each element,
                // and filter out duplicate names
                let namedElements = Array.from(inputElements)
                    .map((element) => element.name)
                    .filter((name, index, array) => array.indexOf(name) === index);

                console.log(namedElements);

            });

            // Used this for testing array parameter form data validation, but will break if submission attempted
            // because route is not configured to return json (just fyi).
            // let ajaxExampleForm = new AsyncForm("keyValuePairForm", {
            //     successMessage:"Custom Success Message!"
            // });


        });
    </script>

<?php $view_page_specific_js = end_section(); ?>