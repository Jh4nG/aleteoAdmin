<!-- main menu-->
<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
    <!-- main menu header-->
    <div class="main-menu-header">
        <input type="text" placeholder="Search" class="menu-search form-control round"/>
    </div>
    <!-- / main menu header-->
    <!-- main menu content-->
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
            <li class=" nav-item"><a href="#"><i class="icon-home3"></i><span data-i18n="nav.dash.main" class="menu-title">Estadísticos</span></a>
                <ul class="menu-content">
                    <li class="active" id="navleftestadisticos">
                        <a href="#" onclick="_Admin.traerVista('estadisticos','estadisticos')" data-i18n="nav.dash.main" class="menu-item">Estadistico</a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="icon-home3"></i><span data-i18n="nav.dash.main" class="menu-title">Administración</span></a>
                <ul class="menu-content">
                    <li class="active" id="navleftcategorias">
                        <a href="#" onclick="_Admin.traerVista('Admin/categorias','categorias')" data-i18n="nav.dash.main" class="menu-item">Categorías</a>
                    </li>
                    <li id="navleftpodcast">
                        <a href="#" onclick="_Admin.traerVista('podcast/podcast','podcast')" data-i18n="nav.page_layouts.1_column" class="menu-item">Podcast</a>
                    </li>
                    <li id="navleftOrganizaciones">
                        <a href="#" onclick="_Admin.traerVista('organizaciones/organizaciones','organizaciones')" data-i18n="nav.page_layouts.1_column" class="menu-item">Organizaciones</a>
                    </li>
                </ul>
            </li>
            
            <li class=" nav-item"><a href="#"><i class="icon-stack-2"></i><span data-i18n="nav.page_layouts.main" class="menu-title">Inicio</span></a>
                <ul class="menu-content">
                    <li id="navleftdesPrincipal">
                        <a href="#" onclick="_Admin.traerVista('Index/desPrincipal','desPrincipal')" data-i18n="nav.page_layouts.1_column" class="menu-item">Deslizador Principal</a>
                    </li>
                </ul>
            </li>
            <!-- Suport -->
            <li class=" navigation-header">
                <span data-i18n="nav.category.support">Otros</span><i data-toggle="tooltip" data-placement="right" data-original-title="Support" class="icon-ellipsis icon-ellipsis"></i>
            </li>
            <li class=" nav-item">
                <a href="#"><i class="icon-support"></i><span data-i18n="nav.support_raise_support.main" class="menu-title">Usuarios</span></a>
            </li>
            <li class=" nav-item">
                <a href="#"><i class="icon-document-text"></i><span data-i18n="nav.support_documentation.main" class="menu-title">Marketing</span></a>
            </li>
        </ul>
    </div>
    <!-- /main menu content-->
    <!-- main menu footer-->
    <!-- include includes/menu-footer-->
    <!-- main menu footer-->
</div>
<!-- / main menu-->