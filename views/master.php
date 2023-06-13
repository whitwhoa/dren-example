<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo isset($view_title) ? $view_title : ''; ?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">



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











<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<?php echo isset($view_page_specific_js) ? $view_page_specific_js : ''; ?>


</body>
</html>