<body class="skin-blue">
   <header class="header">
            <a href="<?=site_url('home/dashboard');?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                LTShoes
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                       
                        <!-- Notifications: style can be found in dropdown.less -->
                        
                        <!-- Tasks: style can be found in dropdown.less -->
                    
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><? $usuario=$this->session->userdata("ltshoes");
                                          echo $usuario['usuario']?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="../../img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?=$usuario['nombre'].','.$usuario['apellido']?>
                                        <!--<small>Member since Nov. 2012</small>-->
                                    </p>
                                </li>
                               
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?=site_url('empleados/cerrar_sesion')?>" class="btn btn-default btn-flat">Cerrar Sesion</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
<?php $this->load->view("menu-principal");