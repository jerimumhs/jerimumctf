<?php
require './_app/Config.inc.php';
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
            $register = new Register;
            
            $datalogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (!empty($datalogin['email']) && !empty($datalogin['password'])  && !empty($datalogin['username'])):
                $register->IniRegister($datalogin);
                if (!$register->getResult()):
                    WSerro($register->getError()[0], $register->getError()[1]);
                else:
                    header('Location: index.php');
                endif;
            endif;
            ?>
            <form name="UserLoginform" action="" method="post">

                <div class="illustration"><img class="img-responsive" src="assets/img/2logo.png" id="logo"></div>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Email" autofocus required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" name="submit" type="submit">Registrar</button>
                </div><a href="index.php" class="forgot">Log In</a><a href="#" class="forgot">Forgot your email or password?</a></form>
        </div>
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.js"></script>


    </body>

</html>