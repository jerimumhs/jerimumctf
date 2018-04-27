<?php
session_start();
require '../_app/Config.inc.php';
$login = new Login;
$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);

if (!$login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: ../index.php?acesso=negado');
else:
    $userlogin = $_SESSION['userlogin'];
    if ($userlogin['admin'] == 0) {
        header('Location: ../index.php?acesso=negado');
    }
endif;
if ($logoff):
    unset($_SESSION['userlogin']);
    header('Location: ../index.php?acesso=logoff');
endif;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo TITULO ?></title>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">

        <!-- Base Css Files -->
        <link href="../assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
        <link href="../assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="../assets/libs/fontello/css/fontello.css" rel="stylesheet" />
        <link href="../assets/libs/animate-css/animate.min.css" rel="stylesheet" />
        <link href="../assets/libs/nifty-modal/css/component.css" rel="stylesheet" />
        <link href="../assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" /> 
        <link href="../assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet" /> 
        <link href="../assets/libs/pace/pace.css" rel="stylesheet" />
        <link href="../assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" />
        <link href="../assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
        <link href="../assets/libs/summernote/summernote.css" rel="stylesheet" type="text/css" />

        <link href="../assets/libs/jquery-icheck/skins/all.css" rel="stylesheet" />
        <!-- Code Highlighter for Demo -->
        <link href="../assets/libs/prettify/github.css" rel="stylesheet" />

        <!-- Extra CSS Libraries Start -->
        <link href="../assets/libs/jquery-datatables/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/jquery-datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
        <!-- Extra CSS Libraries End -->
        <link href="../assets/css/style-responsive.css" rel="stylesheet" />
        <link href="../assets/libs/jquery-notifyjs/styles/metro/notify-metro.css" rel="stylesheet" type="text/css" />
        <script src="../assets/libs/jquery/jquery-1.11.1.min.js"></script>
        <script src="../assets/libs/jquery-notifyjs/notify.min.js"></script>
        <script src="../assets/libs/jquery-notifyjs/styles/metro/notify-metro.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <link rel="shortcut icon" href="../assets/img/favicon.ico">
    </head>
    <body class="fixed-left">
        <!-- Modal Start -->
        <!-- Modal Task Progress -->
        <?php require '../metricaschall.php'; ?>

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
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="rounded-image topbar-profile-image"><img src="../images/users/user-35.jpg"></span> <?php echo $userlogin['username']; ?> <strong></strong> <i class="fa fa-caret-down"></i></a>
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
            <?php
            $getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (isset($getPost)):
                //$setPost = array_map('strip_tags', $getPost);
                //$Post = array_map('trim', $setPost);

                $create = new Create;
                $create->IniCreate('chall', $getPost);
                if ($create->getResult()):
                    erroBalon("Cadastrado Com Sucesso", "success");
                else:
                    erroBalon("Não foi possível Cadastrar", "error");
                endif;
            endif;
            ?>
            <!--Start right content -->
            <div class = "content-page">
                <div class = "content">
                    <!--Page Heading Start -->
                    <div class = "row">
                        <div class = "col-sm-12 portlets">
                            <div class = "widget">
                                <div class = "widget-header transparent">
                                    <h2><strong>Cadastrar</strong> Chall</h2>
                                    <div class = "additional-btn">
                                        <a href = "#" class = "hidden reload"><i class = "icon-ccw-1"></i></a>
                                        <a href = "#" class = "widget-toggle"><i class = "icon-down-open-2"></i></a>
                                    </div>
                                </div>
                                <div class = "widget-content padding">
                                    <div id = "basic-form">
                                        <form role = "form" action = "" method="POST">
                                            <div class = "form-group">
                                                <label for = "nome">Título</label>
                                                <input type = "text" class = "form-control" id = "nome" name = "nome" placeholder = "Título Chall" autofocus required>
                                            </div>
                                            <div class="form-group">
                                                <label>Descrição</label>
                                                <textarea class="summernote" name="descricao"></textarea>
                                            </div>

                                            <div class = "form-group">
                                                <label for = "resposta">Resposta</label>
                                                <input type = "text" class = "form-control" id = "resposta" name = "resposta" placeholder = "Flag{}" required>
                                            </div>
                                            <div class = "form-group">
                                                <label for = "link">Link</label>
                                                <input type = "text" class = "form-control" id = "resposta" name = "link" placeholder = "https://">
                                            </div>
                                            <div class = "form-group">
                                                <label for = "ativa">Status Chall</label>
                                                <select class = "form-control" name = "ativa">
                                                    <option value="1">Ativado</option>
                                                    <option value="0">Desativado</option>
                                                </select>
                                            </div>
                                            <div class = "form-group">
                                                <label for = "oculto">Chall Oculto</label>
                                                <select class = "form-control" name = "oculta">
                                                    <option value="0">Desativado</option>
                                                    <option value="1">Ativado</option>
                                                </select>
                                            </div>
                                            <div class = "form-group">
                                                <label for = "categoria">Categoria</label>
                                                <select class = "form-control" name = "categoria_id">
                                                    <?php
                                                    $dados = new Read;
                                                    $dados->FullRead("SELECT * FROM categoria order by id DESC");
                                                    foreach ($dados->getResult() as $value) {
                                                        extract($value);
                                                        echo "<option value = \"{$id}\">{$nome}</option>\n";
                                                    }
                                                    ?> 
                                                </select>
                                            </div>
                                            <div class = "form-group">
                                                <label for = "evento">Evento</label>
                                                <select class = "form-control" name = "evento_id">
                                                    <?php
                                                    $dados = new Read;
                                                    $dados->FullRead("SELECT * FROM evento order by id DESC");
                                                    foreach ($dados->getResult() as $value) {
                                                        extract($value);
                                                        echo "<option value = \"{$id}\">{$nome}</option>\n";
                                                    }
                                                    ?> 
                                                </select>
                                            </div>
                                            <div class = "form-group">
                                                <label for = "autor">Autor</label>
                                                <input type = "text" class = "form-control" id = "resposta" name = "autor" placeholder = "@autor" required>
                                            </div>
                                            <div class = "form-group">
                                                <label for = "valor">Valor</label>
                                                <input type = "text" class = "form-control" id = "resposta" name = "valor" placeholder = "100" required>
                                            </div>
                                    </div>
                                    <button type = "submit" class = "btn btn-success">Cadastrar Chall</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class = "row">
                        <div class = "col-md-12 portlets">
                            <div class = "widget">
                                <div class = "widget-header transparent">
                                    <h2><strong>Cadastrar/Editar/Deletar Chall</strong></h2>
                                    <div class = "additional-btn">
                                        <a href = "#" class = "hidden reload"><i class = "icon-ccw-1"></i></a>
                                        <a href = "#" class = "widget-toggle"><i class = "icon-down-open-2"></i></a>

                                    </div>
                                </div>
                                <div class = "widget-content">
                                    <br>
                                    <div class = "table-responsive">
                                        <form class = 'form-horizontal' role = 'form'>
                                            <table id = "datatables-1" class = "table table-striped table-bordered" cellspacing = "0" width = "100%">
                                                <thead>
                                                    <tr>
                                                        <th><center>Título</center></th>
                                                <th><center>Valor</center></th>
                                                <th><center>Evento</center></th>
                                                <th><center>Resposta</center></th>
                                                <th><center>Action</center></th>
                                                <th><center>Action</center></th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $dados = new Read;
                                                    $dados->FullRead("SELECT chall.id as id, chall.nome as nome,chall.valor as valor,chall.resposta as resposta,evento.nome as evento FROM chall,evento where evento.id = chall.evento_id order by chall.id DESC");
                                                    foreach ($dados->getResult() as $value) {
                                                        echo "<tr>";
                                                        echo "<td><center>{$value['nome']}</center></td>";
                                                        echo "<td><center>{$value['valor']}</center></td>";
                                                        echo "<td><center>{$value['evento']}</center></td>";
                                                        echo "<td><center>{$value['resposta']}</center></td>";
                                                        echo "<td><center><button type=\"button\" onclick=\"window.location='flag.php?evento={$value['id']}'\" class=\"btn btn-info\">Alterar</button></center></td>";
                                                        echo "<td><center><button type=\"button\" onclick=\"window.location='score.php?evento={$value['id']}'\" class=\"btn btn-danger\">Deletar</button></center></td>";
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
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
        <script src="../assets/libs/jquery/jquery-1.11.1.min.js"></script>
        <script src="../assets/libs/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="../assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"></script>
        <script src="../assets/libs/jquery-detectmobile/detect.js"></script>
        <script src="../assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"></script>
        <script src="../assets/libs/ios7-switch/ios7.switch.js"></script>
        <script src="../assets/libs/fastclick/fastclick.js"></script>
        <script src="../assets/libs/jquery-blockui/jquery.blockUI.js"></script>
        <script src="../assets/libs/bootstrap-bootbox/bootbox.min.js"></script>
        <script src="../assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="../assets/libs/jquery-sparkline/jquery-sparkline.js"></script>
        <script src="../assets/libs/nifty-modal/js/classie.js"></script>
        <script src="../assets/libs/nifty-modal/js/modalEffects.js"></script>
        <script src="../assets/libs/sortable/sortable.min.js"></script>
        <script src="../assets/libs/bootstrap-fileinput/bootstrap.file-input.js"></script>
        <script src="../assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
        <script src="../assets/libs/bootstrap-select2/select2.min.js"></script>
        <script src="../assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script> 
        <script src="../assets/libs/pace/pace.min.js"></script>
        <script src="../assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="../assets/libs/jquery-icheck/icheck.min.js"></script>

        <!-- Demo Specific JS Libraries -->
        <script src="../assets/libs/prettify/prettify.js"></script>
        <script src="../assets/libs/summernote/summernote.js"></script>
        <script src="../assets/js/pages/forms.js"></script>
        <script src="../assets/js/init.js"></script>
        <!-- Page Specific JS Libraries -->
        <script src="../assets/libs/jquery-datatables/js/jquery.dataTables.min.js"></script>
        <script src="../assets/libs/jquery-datatables/js/dataTables.bootstrap.js"></script>
        <script src="../assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
        <script src="../assets/js/pages/datatables.js"></script>
        <script>
            $('.summernote').summernote({
                height: 150 //set editable area's height
            });
        </script>
    </body>
</html>