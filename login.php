<?php 
    include 'plantilla/header.php';
?>
  <body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  blank-page blank-page"
  style="background-image:url('images/Fondo.png');background-size:cover;">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 m-0" style="background-image: url(images/FondoAzul.png);background-size: contain; border-radius: 8px;">
                        <div class="card-header no-border" style="background-color: transparent;">
                            <div class="card-title text-xs-center">
                                <div class="p-1"><img src="images/LogoNombre.png" alt="branding logo" width="150" style="border-radius:80px"></div>
                            </div>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block">
                                <form class="form-horizontal form-simple" action="#" novalidate>
                                    <fieldset class="form-group position-relative has-icon-left mb-0">
                                        <input type="text" class="form-control form-control-lg input-lg" id="user-name" placeholder="Usuario" required>
                                        <div class="form-control-position">
                                            <i class="icon-head"></i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control form-control-lg input-lg" id="user-password" placeholder="Contraseña" required>
                                        <div class="form-control-position">
                                            <i class="icon-key3"></i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group row">
                                        <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                        </div>
                                        <div class="col-md-6 col-xs-12 text-xs-center text-md-right">
                                            <a href="" class="card-link" style="color:black">Olvide mi Contraseña</a>
                                        </div>
                                    </fieldset>
                                    <button id="btnLogin" class="btn btn-primary btn-lg btn-block"><i class="icon-unlock2"></i> Iniciar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include 'plantilla/scripts.php'; ?>
    <script src="js/login.js" type="text/javascript"></script>
  </body>
</html>
