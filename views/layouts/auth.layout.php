<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo $this->e($title) ?></title>
        <link rel="icon" href="<?php echo URL ?>favicon.ico">
        <link href="<?php echo URL ?>min/?f=public/assets/vendor/bootstrap/css/bootstrap.min.css,public/assets/vendor/font-awesome/css/font-awesome.min.css,public/assets/css/sb-admin.css" type="text/css" rel="stylesheet" />
    </head>
    <body class="bg-dark">
        <div class="container">
            <?php echo $this->section('body') ?>
        </div>
        <script src="<?php echo URL ?>min/?f=public/assets/vendor/jquery/jquery.min.js,public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js,public/assets/vendor/jquery-easing/jquery.easing.min.js,public/assets/js/scripts.js"/></script>
    </body>
</html>