<!-- navbar-fixed-top-->
<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
                <li class="nav-item">
                    <a href="index.php" class="navbar-brand nav-link">
                        <img alt="branding logo" src="images/LogoNombre.png" data-expand="images/LogoNombre.png" data-collapse="images/LogoNombre.png" class="brand-logo" width="50">
                    </a>
                </li>
                <li class="nav-item hidden-md-up float-xs-right">
                    <a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container">
                      <i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                <ul class="nav navbar-nav">
                    <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5">         </i></a></li>
                    <!-- <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon icon-expand2"></i></a></li> -->
                </ul>
                <ul class="nav navbar-nav float-xs-right">
                    <!-- <li class="dropdown dropdown-notification nav-item"><a href="#" data-toggle="dropdown" class="nav-link nav-link-label"><i class="ficon icon-bell4"></i><span class="tag tag-pill tag-default tag-danger tag-default tag-up">1</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notificaciones</span><span class="notification-tag tag tag-default tag-danger float-xs-right m-0">1 Nuevo</span></h6>
                            </li>
                            <li class="list-group scrollable-container">
                                <a href="javascript:void(0)" class="list-group-item">
                                    <div class="media">
                                        <div class="media-left valign-middle"><i class="icon-cart3 icon-bg-circle bg-cyan"></i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading">You have new order!</h6>
                                            <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer elit.</p><small>
                                            <time datetime="2015-06-11T18:29:20+08:00" class="media-meta text-muted">30 minutes ago</time></small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-menu-footer"><a href="javascript:void(0)" class="dropdown-item text-muted text-xs-center">Read all notifications</a></li>
                        </ul>
                    </li> -->
                    <li class="dropdown dropdown-user nav-item">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link">
                            <span class="">
                                <i class="icon-user"></i>
                            </span>
                            <span class="user-name"><?php echo $_SESSION['aleteo_user']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- <a href="#" class="dropdown-item"><i class="icon-head"></i> Editar Peril</a> -->
                            <!-- <div class="dropdown-divider"></div> -->
                            <a href="#" id="btnLogout" class="dropdown-item"><i class="icon-power3"></i> Salir</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>