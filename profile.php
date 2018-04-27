<?php
session_start();
require './_app/Config.inc.php';
$login = new Login;
$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: index.php?acesso=negado');
else:
    $userlogin = $_SESSION['userlogin'];
endif;
if ($logoff):
    unset($_SESSION['userlogin']);
    header('Location: index.php?acesso=logoff');
endif;
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TITULO ?></title> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta charset="UTF-8">

        <!-- Base Css Files -->
        <link href="assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet" />
        <link href="assets/libs/animate-css/animate.min.css" rel="stylesheet" />
        <link href="assets/libs/nifty-modal/css/component.css" rel="stylesheet" />
        <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" /> 
        <link href="assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet" /> 
        <link href="assets/libs/pace/pace.css" rel="stylesheet" />
        <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
        <link href="assets/libs/jquery-icheck/skins/all.css" rel="stylesheet" />
        <!-- Code Highlighter for Demo -->
        <link href="assets/libs/prettify/github.css" rel="stylesheet" />

        <!-- Extra CSS Libraries Start -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <!-- Extra CSS Libraries End -->
        <link href="assets/css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <link rel="shortcut icon" href="assets/img/favicon.ico">
        <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="assets/img/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="assets/img/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="assets/img/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="assets/img/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="assets/img/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="assets/img/apple-touch-icon-152x152.png" />
    </head>
    <body class="fixed-left">

         <!-- Modal Task Progress -->
        <?php require './metricaschall.php'; ?>
        <!-- Modal Logout -->
        <div class="md-modal md-just-me" id="logout-modal">
            <div class="md-content">
                <h3><strong>Logout</strong></h3>
                <div>
                    <p class="text-center">Deseja realmente sair do Site?</p>
                    <p class="text-center">
                        <button class="btn btn-danger md-close">Não</button>
                        <a href="login.html" class="btn btn-success md-close">Sim, Quero!</a>
                    </p>
                </div>
            </div>
        </div> 
        <!-- Modal End -->	
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">
                <div class="topbar-left">

                    <button class="button-menu-mobile open-left">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

               <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="navbar-collapse2">
                            <ul class="nav navbar-nav hidden-xs">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th"></i></a>
                                    
                                </li>
                                <!--linguagem-->
                                <li class="language_bar dropdown hidden-xs">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Português (PT-BR) <i class="fa fa-caret-down"></i></a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">English (US)</a></li>
                                    </ul>
                                </li>
                                <!--linguagem-->
                            </ul>
                            <ul class="nav navbar-nav navbar-right top-navbar">
                                <li class="dropdown topbar-profile">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="rounded-image topbar-profile-image"><img src="images/users/user-35.jpg"></span> Boot <strong></strong> <i class="fa fa-caret-down"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Meu Perfil</a></li>
                                        <li><a href="#">Alterar Senha</a></li>
                                        <li><a href="#">Configurações de Conta</a></li>
                                        <li class="divider"></li>
                                        <li><a class="md-trigger" data-modal="logout-modal"><i class="icon-logout-1"></i> Sair</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->

            <!-- Left Sidebar Start -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <div class="clearfix"></div>
                    <!--- Profile -->
                    <div class="profile-info">
                        <div class="col-xs-4">
                            <a href="profile.html" class="rounded-image profile-image"><img src="images/users/user-100.jpg"></a>
                        </div>
                        <div class="col-xs-8">
                            <div class="profile-text">Welcome <b>Boot</b></div>

                        </div>
                    </div>
                    <!--- Divider -->
                    <div class="clearfix"></div>
                    <hr class="divider" />
                    <div class="clearfix"></div>
                    <!--- Divider -->
                    <!--menu-->
                    <?php require 'menu.php'; ?>
                    <!--menu-->
                    <div class="clearfix"></div>

                    <div class="clearfix"></div><br><br><br>
                </div>
                <div class="left-footer">
                    <div class="progress progress-xs">
                        <div class="progress-bar bg-green-1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            <span class="progress-precentage">0%</span>
                        </div>
                        <a data-toggle="tooltip" title="Task Progress" class="btn btn-default md-trigger" data-modal="task-progress"><i class="fa fa-inbox"></i></a>
                    </div>
                </div>
            </div>
            <!-- Left Sidebar End -->	

            <!-- Start right content -->
            <div class="content-page">
                <!-- ============================================================== -->
                <!-- Start Content here -->
                <!-- ============================================================== -->
                <div class="profile-banner" style="background-image: url(images/stock/1epgUO0.jpg);">
                    <div class="col-sm-3 avatar-container">
                        <img src="images/users/user-256.jpg" class="img-circle profile-avatar" alt="User avatar">
                    </div>
                    <div class="col-sm-12 profile-actions text-right">
                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Friends</button>
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-envelope"></i> Send Message</button>
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-ellipsis-v"></i></button>
                    </div>
                </div>
                <div class="content">

                    <div class="row">
                        <div class="col-sm-3">
                            <!-- Begin user profile -->
                            <div class="text-center user-profile-2">
                                <h4><b>Boot Santos</b></h4>

                                <h5><b>318BR</b></h5>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <span class="badge">2</span>
                                        Level
                                    </li>
                                    <li class="list-group-item">
                                        <span class="badge">2</span>
                                        Pontos
                                    </li>
                                </ul>

                                <!-- User button -->
                                <div class="user-button">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button type="button" class="btn btn-default btn-sm btn-block"><i class="fa fa-user"></i> Add as friend</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- End div .user-button -->
                            </div><!-- End div .box-info -->
                            <!-- Begin user profile -->
                        </div><!-- End div .col-sm-4 -->

                        <div class="col-sm-9">
                            <div class="widget widget-tabbed">
                                <!-- Nav tab -->
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#my-timeline" data-toggle="tab"><i class="fa fa-pencil"></i> Writeups</a></li>
                                    <li><a href="#about" data-toggle="tab"><i class="fa fa-user"></i> Sobre</a></li>
                                    <li><a href="#user-activities" data-toggle="tab"><i class="fa fa-laptop"></i> Atividades</a></li>
                                </ul>
                                <!-- End nav tab -->

                                <!-- Tab panes -->
                                <div class="tab-content">


                                    <!-- Tab timeline -->
                                    <div class="tab-pane animated active fadeInRight" id="my-timeline">
                                        <div class="user-profile-content">

                                            <!-- Begin timeline -->
                                            <div class="the-timeline">
                                                <form role="form" class="post-to-timeline">
                                                    <textarea class="form-control" style="height: 70px;" placeholder="Envie o Link para seu writeup"></textarea>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            
                                                        </div>
                                                        <div class="col-sm-6 text-right"><button type="submit" class="btn btn-primary">Post</button></div>
                                                    </div>
                                                </form>
                                                <br><br>
                                                <ul>
                                                    <li>
                                                        <div class="the-date">
                                                            <span>01</span>
                                                            <small>Jan</small>
                                                        </div>
                                                        <h4>Writeup MISC 100</h4>
                                                        <p>
                                                            https://github.com/Migdalo/writeups/tree/master/2016-3ds-ctf/
                                                        </p>
                                                    </li>                                          
                                                    <li class="the-year"><p>2016</p></li>
                                                    <li>
                                                        <div class="the-date">
                                                            <span>27</span>
                                                            <small>Nov</small>
                                                        </div>
                                                        <p>
                                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div><!-- End div .the-timeline -->
                                            <!-- End timeline -->
                                        </div><!-- End div .user-profile-content -->
                                    </div><!-- End div .tab-pane -->
                                    <!-- End Tab timeline -->

                                    <!-- Tab about -->
                                    <div class="tab-pane animated fadeInRight" id="about">
                                        <div class="user-profile-content">
                                            <h5><strong>ABOUT</strong> ME</h5>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. 
                                            </p>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h5><strong>CONTACT</strong> ME</h5>
                                                    <address>
                                                        <strong>Telegram</strong><br>
                                                        <abbr title="Phone">@h4kboot</abbr>
                                                    </address>
                                                    <address>
                                                        <strong>facebook</strong><br>
                                                        <a href="#">@h4kboot</a>
                                                    </address>
                                                    <address>
                                                        <strong>Twitter</strong><br>
                                                        <a href="#">@h4kboot</a>
                                                    </address>
                                               
                                                </div>
                                                <div class="col-sm-6">
                                                    <h5><strong>MY</strong> SKILLS</h5>
                                                    <p>Web - 100%</p>
                                                    <p>For - 80%</p>
                                                    <p>Misc - 20%</p>
                                                    <p>Cripto - 10%</p>
                                                </div>
                                            </div><!-- End div .row -->
                                        </div><!-- End div .user-profile-content -->
                                    </div><!-- End div .tab-pane -->
                                    <!-- End Tab about -->


                                    <!-- Tab user activities -->
                                    <div class="tab-pane animated fadeInRight" id="user-activities">
                                        <div class="scroll-user-widget">
                                            <ul class="media-list">
                                                <li class="media">
                                                    <a href="#fakelink">
                                                        <p><strong>#_Boot Santos</strong> Errou o chall <strong>MISC 100</strong>
                                                            <br /><i>2 minutes ago</i></p>
                                                    </a>
                                                </li>
                                                <li class="media">
                                                    <a href="#fakelink">
                                                        <p><strong>#_Boot Santos</strong> Errou o chall <strong>MISC 100</strong>
                                                            <br /><i>3 minutes ago</i></p>
                                                    </a>
                                                </li>
                                               
                                            </ul>
                                        </div><!-- End div .scroll-user-widget -->
                                    </div><!-- End div .tab-pane -->
                                    <!-- End Tab user activities -->
                                </div><!-- End div .tab-content -->
                            </div><!-- End div .box-info -->
                        </div>
                    </div>		
                </div>
                <!-- ============================================================== -->
                <!-- End content here -->
                <!-- ============================================================== -->

            </div>
            <!-- End right content -->

        </div>
        <!-- End of page -->
        <!-- the overlay modal element -->
        <div class="md-overlay"></div>
        <!-- End of eoverlay modal -->
        <script>
            var resizefunc = [];
        </script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="assets/libs/jquery/jquery-1.11.1.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"></script>
        <script src="assets/libs/jquery-detectmobile/detect.js"></script>
        <script src="assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"></script>
        <script src="assets/libs/ios7-switch/ios7.switch.js"></script>
        <script src="assets/libs/fastclick/fastclick.js"></script>
        <script src="assets/libs/jquery-blockui/jquery.blockUI.js"></script>
        <script src="assets/libs/bootstrap-bootbox/bootbox.min.js"></script>
        <script src="assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="assets/libs/jquery-sparkline/jquery-sparkline.js"></script>
        <script src="assets/libs/nifty-modal/js/classie.js"></script>
        <script src="assets/libs/nifty-modal/js/modalEffects.js"></script>
        <script src="assets/libs/sortable/sortable.min.js"></script>
        <script src="assets/libs/bootstrap-fileinput/bootstrap.file-input.js"></script>
        <script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="assets/libs/bootstrap-select2/select2.min.js"></script>
        <script src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script> 
        <script src="assets/libs/pace/pace.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/libs/jquery-icheck/icheck.min.js"></script>

        <!-- Demo Specific JS Libraries -->
        <script src="assets/libs/prettify/prettify.js"></script>

        <script src="assets/js/init.js"></script>

    </body>
</html>