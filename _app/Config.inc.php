<?php
//CONFIGURAÇÕES DO SITE
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'sucurihc_ctf');
define('TITULO', 'JampaSec 2018');

date_default_timezone_set('America/Sao_Paulo');
//CONFIGURAÇÕES DO SITE

function __autoload($Class) {
    $cDir = ['Conn', 'Helpers', 'Models'];
    $iDir = null;

    foreach ($cDir as $dirname):
        if (!$iDir && file_exists(__DIR__ . "//{$dirname}//{$Class}.class.php") && !is_dir($dirname)):
            include_once (__DIR__ . "//{$dirname}//{$Class}.class.php");
            $iDir = true;
        endif;
    endforeach;
    
    if(!$iDir):
        trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
        die;
    endif;
}

//tratamento de erros//
define('WS_ACCEPT', 'alert alert-success');
define('WS_INFO', 'alert alert-info');
define('WS_ALERT', 'alert alert-warning');
define('WS_ERROR', 'alert alert-danger');

//WsErro :: Exibe erros lançados

function erroBalon($title, $tipo){
     echo "<script>";
     echo "$.notify({";
     echo "           title: '{$title}',";
     echo "           image: \"<i class='fa fa-exclamation'></i>\"";
     echo "       }, {";
     echo "           style: 'metro',";
     echo "           globalPosition: 'top center',";
     echo "           className: '{$tipo}',";
     echo "           showAnimation: 'show',";
     echo "           showDuration: 0,";
     echo "           hideDuration: 0,";
     echo "           autoHideDelay: 5000,";
     echo "           autoHide: true,";
     echo "           clickToHide: true";
     echo "       });";
     echo "</script>";
}

function WSerro($ErrMsg, $ErrNo, $ErrDie = Null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFO : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_NOTICE ? WS_ERROR : $ErrNo)));
    echo "<p class=\"{$CssClass}\">{$ErrMsg}<span class=\"md-close\"></span></p>";
    
    if($ErrDie):
        die;
    endif;
}

//PhpErro :: Personaliza o gatilho PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
   $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFO : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
   echo "<p class=\"{$CssClass}\">";
   echo "<b>Erro na Linha: {$ErrLine} ::</b> {$ErrMsg}<br>";
   echo "<small>{$ErrFile}</small>";
   echo "<span class=\"ajax_close\"></span>";
   echo "</p>";
   
   if($ErrNo == E_USER_ERROR):
       die;
   endif;
   
}

set_error_handler('PHPErro');
