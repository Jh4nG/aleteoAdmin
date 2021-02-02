<?php 
    include 'plantilla/validaSession.php';
    include 'plantilla/header.php';
?>    

  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    <?php include 'plantilla/navHeader.php'; ?>

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include 'plantilla/navbar.php'?>

    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div id="contentDiv"></div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2017 <a href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank" class="text-bold-800 grey darken-2">PIXINVENT </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block">Hand-crafted & Made with <i class="icon-heart5 pink"></i></span></p>
    </footer>

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include 'plantilla/scripts.php'; ?>
    <!-- END PAGE LEVEL JS-->
  </body>
</html>
