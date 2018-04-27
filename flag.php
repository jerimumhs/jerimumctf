<?php
session_start();
require './_app/Config.inc.php';
$login = new Login;
$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
$eventoid = filter_input(INPUT_GET, 'evento', FILTER_VALIDATE_INT);
$respotaflag = filter_input(INPUT_POST, 'flag', FILTER_SANITIZE_STRING);


if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: index.php?acesso=negado');
else:
    $userlogin = $_SESSION['userlogin'];
    $chall = new Chall;
    if ($eventoid):
        $chall->setEvento($eventoid);
    endif;
    $dados = new Read;
    $dados->FullRead("SELECT  datainicio FROM evento where ativo = 1 and id = :id", "id={$eventoid}");
    if ($dados->getResult()):
        foreach ($dados->getResult() as $value) :
            $array = $dados->getResult();
            $datahora = date("Y-m-d H:i:s");
            if ($datahora >= $array[0]['datainicio']):
                $chall->setUserid($userlogin['id']);
                $chall->insereScoreTotal();
            else:
                echo "Evento não iniciado";
                die;
            endif;

        endforeach;

    endif;





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
        <link href="assets/libs/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/morrischart/morris.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/jquery-jvectormap/css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/jquery-clock/clock.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/bootstrap-calendar/css/bic_calendar.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/jquery-weather/simpleweather.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/bootstrap-xeditable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <!-- Extra CSS Libraries End -->
        <link href="assets/css/style-responsive.css" rel="stylesheet" />
        <link href="assets/libs/jquery-notifyjs/styles/metro/notify-metro.css" rel="stylesheet" type="text/css" />
        <script src="assets/libs/jquery/jquery-1.11.1.min.js"></script>
        <script src="assets/libs/jquery-notifyjs/notify.min.js"></script>
        <script src="assets/libs/jquery-notifyjs/styles/metro/notify-metro.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <link rel="shortcut icon" href="assets/img/favicon.ico">

    </head>
    <body class="fixed-left" onload="">
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
                        <a href="?logoff=true" class="btn btn-success md-close">Sim, Quero!</a>
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
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="rounded-image topbar-profile-image"><img src="images/users/user-35.jpg"></span> <?php echo $userlogin['username']; ?> <strong></strong> <i class="fa fa-caret-down"></i></a>
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


                    <div class="profile-info">
                        <hr class="divider" />
                        <div class="col-xs-12">

                            <center><div class="profile-text"><b>Evento: </b><?php echo $chall->getEvento() ?></div></center>
                            <center><div class="profile-text" id="score"></div></center>

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
                <div class="content">

                    <div class="row">
                        <div class="col-md-12 portlets">
                            <div class="widget">
                                <div class="widget-header ">
                                    <h2>Validar Flag</h2>
                                    <div class="additional-btn">
                                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                                    </div>
                                </div>
                                <div class="widget-content padding">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form action="" method="POST">
                                                <div class="input-group">
                                                    <input type="text" id="flag" name="flag" class="form-control" autofocus required>
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-info" type="button">Go!</button>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        //valida chall
                        if ($respotaflag != ""):
                            $chall->setResposta($respotaflag);
                            $correto = $chall->validaFlag();
                            switch ($correto) {
                                case 0:
                                    erroBalon("Flag Incorreta, tente Mais", "error");
                                    break;
                                case 1:
                                    erroBalon("Flag Correta, Parabéns!", "success");
                                    break;
                                case 2:
                                    erroBalon("Essa flag já foi Respondida", "warning");
                                    break;
                                case 3:
                                    erroBalon("Bloqueado por número excessivo de tentativas - 5min", "warning");
                                    break;
                            }
                        endif;

                        //carrega botoes chall
                        if ($chall->carregaBotoes()):
                            ?>

                        </div>
                    </div>


                </div>
            </div>
            <?php
            $modal = $chall->carregaChall();
            foreach ($modal as $dadoschall):
                extract($dadoschall);
                ?>
                <div class="md-modal md-3d-sign" id="<?php echo $categorianome . $id; ?>">
                    <div class="md-content">
                        <h3><?= $nome; ?></h3>
                        <hr>
                        <div>
                            <p><?= $descricao; ?></p>
                            <p></p>
                            <p></p>
                            <p>
                                <?php if ($link != ""):
                                  echo "<button onclick=\"window.location='{$link}'\" class=\"btn btn-info\">Download</button>";  
                                endif;
                                ?>
                                <button class="btn btn-danger md-close">Close</button>
                            </p>          
                        </div>


                    </div>
                </div>
                <?php
            endforeach;
        endif;
        ?>

        <!-- End of page -->
        <!-- the overlay modal element -->
        <div class="md-overlay"></div>

        <!-- End of eoverlay modal -->
        <script>
            var resizefunc = [];
        </script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

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

        <script src="assets/libs/prettify/prettify.js"></script>

        <script src="assets/js/init.js"></script>

        <script src="assets/libs/d3/d3.v3.js"></script>
        <script src="assets/libs/rickshaw/rickshaw.min.js"></script>
        <script src="assets/libs/raphael/raphael-min.js"></script>
        <script src="assets/libs/morrischart/morris.min.js"></script>
        <script src="assets/libs/jquery-knob/jquery.knob.js"></script>
        <script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js"></script>
        <script src="assets/libs/jquery-clock/clock.js"></script>
        <script src="assets/libs/jquery-easypiechart/jquery.easypiechart.min.js"></script>
        <script src="assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js"></script>
        <script src="assets/libs/bootstrap-calendar/js/bic_calendar.min.js"></script>
        <script src="assets/js/apps/todo.js"></script>
        <script src="assets/js/apps/notes.js"></script>

        <script>
            document.getElementById("score").innerHTML = "<b>Total: </b> <?php echo $chall->totalScore() ?>";
        </script>
    </body>
</html>
