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

            <?php if(isset($errors)): ?>
            <?php echo var_export($errors, true); ?>
            <?php endif; ?>

            <div class="text-right">
                <button class="btn btn-primary" id="addKeyValButton">Add Key Value Pair</button>
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
<?php $view_page_specific_js = end_section(); ?>