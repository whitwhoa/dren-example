<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo isset($view_title) ? $view_title : ''; ?></title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <?php echo isset($view_page_specific_css) ? $view_page_specific_css : ''; ?>
</head>
<body>


<div class="container">
    <div class="row">
        <div class="col">


            <?php echo $view_body_content; ?>


        </div>
    </div>
</div>










<!-- Site Wide Dependencies -->

<!-- Third Party -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- First Party Custom Elements, defined in drencrom-frontend.js -->
<loading-overlay></loading-overlay>
<alert-message></alert-message>
<debug-screen-size></debug-screen-size>

<!-- Compiled via npm, never modify this directly -->
<script src="/js/drencrom-frontend.js"></script>



<?php echo isset($view_page_specific_js) ? $view_page_specific_js : ''; ?>


</body>
</html>