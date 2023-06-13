<?php $view_extends = 'master'; ?>
<?php $view_title = 'File upload example'; ?>


<?php start_section(); ?>

    <div class="row mt-4">
        <div class="col-lg-6 offset-lg-3">

            <div class="text-center">
                <p>
                Example of submitting a form that contains file uploads
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

            <form action="/file-upload-example/save" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="images">Select Multiple Images</label>
                    <input type="file" class="form-control-file" id="images" name="images[]" multiple required>
                </div>
                <div class="form-group">
                    <label for="image1">Select Single Image 1</label>
                    <input type="file" class="form-control-file" id="image1" name="image1" required>
                </div>
                <div class="form-group">
                    <label for="image2">Select Single Image 2</label>
                    <input type="file" class="form-control-file" id="image2" name="image2" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload Images</button>
            </form>

        </div>
    </div>

<?php $view_body_content = end_section(); ?>




<?php start_section(); ?>

<?php $view_page_specific_js = end_section(); ?>