<?php
require './_app/Config.inc.php';
session_start();
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo TITULO ?></title>
        <link rel="stylesheet" href="assets/libs/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/styles.min.css">
    </head>

    <body>

        <div class="login-dark">
            <?php
            $login = new Login;

            if ($login->CheckLogin()):
                header('Location: eventos.php');
            endif;

            $datalogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($datalogin['email']) && !empty($datalogin['password'])):
                $login->IniLogin($datalogin);
                if (!$login->getResult()):
                    WSerro($login->getError()[0], $login->getError()[1]);
                else:
                    header('Location: eventos.php');
                endif;
            endif;

            $get = filter_input(INPUT_GET, 'acesso', FILTER_DEFAULT);
            if (!empty($get)):
                if ($get == 'negado'):
                    WSerro("Acesso Negado favor Efetue Login!", WS_ALERT);
                elseif ($get == 'logoff'):
                    WSerro("<b>Sucesso ao Deslogar!</b>", WS_ACCEPT);
                endif;
            endif;
            ?>

            <form name="UserLoginform" action="" method="post">

                <div class="illustration"><img class="img-responsive" src="assets/img/2logo.png" id="logo"></div>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Email" autofocus>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" name="submit" type="submit">Log In</button>
                </div><a href="register.php" class="forgot">Register</a><a href="#" class="forgot">Forgot your email or password?</a></form>
        </div>
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.js"></script>


    </body>

</html>