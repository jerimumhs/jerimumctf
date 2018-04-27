<?php

/**
 *  Login.class [ MODEL ]
 * Descricao
 * @copyright (c) year, BootFramework
 */
class Login {

    private $Email;
    private $Senha;
    private $Error;
    private $Result;

    public function IniLogin(array $UserData) {
        $this->Email = (string) strip_tags(trim($UserData['email']));
        $this->Senha = (string) strip_tags(trim(hash('sha512', $UserData['password'])));
        $this->setLogin();
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    public function CheckLogin() {
        if (empty($_SESSION['userlogin'])):
            unset($_SESSION['userlogin']);
            return false;
        else:
            return true;
        endif;
    }

    //private

    private function setLogin() {
        if (!$this->Email || !$this->Senha || !Check::Email($this->Email)):
            $this->Error = ['Informe seu E-mail e Senha para Efetuar o Login', WS_ALERT];
            $this->Result = false;
        elseif (!$this->getUser()):
            $this->Error = ['Dados informados incorretos', WS_ALERT];
            $this->Result = false;
        else:
            $this->ExecuteLogin();
        endif;
    }

    private function getUser() {
        $read = new Read;
        $read->IniRead("usuario", "WHERE email = :e", "e={$this->Email}");
        if ($read->getResult()):
            $this->Result = $read->getResult()[0];
            $password = hash('sha512', $this->Senha . $this->Result['salt']);
            if ($password == $this->Result['password']):
                return true;
            endif;
        else:
            return false;
        endif;
    }

    private function ExecuteLogin() {
        if (!session_id()):
            session_start();
        endif;

        $_SESSION['userlogin'] = $this->Result;
        $this->Error = ["Olá {$this->Result['username']}, seja bem vindo.", WS_ACCEPT];
        
        $this->Result = true;
    }

}
