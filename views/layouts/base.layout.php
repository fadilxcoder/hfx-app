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
        <link href="<?php echo URL ?>min/?f=public/assets/vendor/bootstrap/css/bootstrap.min.css,public/assets/vendor/font-awesome/css/font-awesome.min.css,public/assets/vendor/datatables/dataTables.bootstrap4.css,public/assets/css/sb-admin.css" type="text/css" rel="stylesheet" />
    </head>
    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <a class="navbar-brand" href="#">ADMIN PANEL</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                        <a class="nav-link" href="<?php echo URL ?>">
                            <i class="fa fa-fw fa-dashboard"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Products">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
                            <i class="fa fa-fw fa-sitemap"></i>
                            <span class="nav-link-text">Users</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseExamplePages">
                            <li>
                                <a href="#">Add </a>
                            </li>
                            <li>
                                <a href="#">View All</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav sidenav-toggler">
                    <li class="nav-item">
                        <a class="nav-link text-center" id="sidenavToggler">
                            <i class="fa fa-fw fa-angle-left"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" title="<?php echo $this->e($this->session('name_user')) ?>" href="#" target="_blank"><?php echo $this->e($this->session('uname_user')) ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="content-wrapper">
            <?php echo $this->section('body') ?>
            <footer class="sticky-footer">
                <div class="container">
                    <div class="text-center">
                        <small>&copy; <?php echo date('Y'); ?></small>
                    </div>
                </div>
            </footer>
        </div>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top"><i class="fa fa-angle-up"></i> </a>
        <?php $this->insert('modals/logout.html') ?>
        <?php // echo $this->fetch('modals/logout.html') ?>
        <script src="<?php echo URL ?>min/?f=public/assets/vendor/jquery/jquery.min.js,public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js,public/assets/vendor/jquery-easing/jquery.easing.min.js,public/assets/vendor/datatables/jquery.dataTables.js,public/assets/vendor/datatables/dataTables.bootstrap4.js,public/assets/js/sb-admin.min.js,public/assets/js/sb-admin-datatables.min.js,public/assets/js/scripts.js"/></script>
</body>

</html>