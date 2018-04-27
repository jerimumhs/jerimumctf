<?php

/**
 *  Register.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Boot
 */
class Register {

    private $Email;
    private $Senha;
    private $Username;
    private $Error;
    private $Result;

    public function IniRegister(array $UserData) {
        $this->Email = (string) strip_tags(trim($UserData['email']));
        $this->Senha = (string) strip_tags(trim(hash('sha512', $UserData['password'])));
        $this->Username = (string) strip_tags(trim($UserData['username']));
        $this->setRegister();
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    private function setRegister() {
        if (!$this->Email || !$this->Senha || !Check::Email($this->Email)):
            $this->Error = ['Informe um email Válido ou username Válido', WS_ALERT];
            $this->Result = false;
        elseif ($this->getExisteUser()):
            $this->Error = ['Usuário ou Email já existe', WS_INFO];
            $this->Result = false;
        else:
            $this->insereUser();
        endif;
    }

    private function getExisteUser() {
        $read = new Read;
        $read->IniRead("usuario", "WHERE email = :e or username = :user", "e={$this->Email}&user={$this->Username}");
        if ($read->getResult()):
            return true;
        else:
            return false;
        endif;
    }

    protected function insereUser() {
        date_default_timezone_set('America/Sao_Paulo');
        $datahora = date("Y-m-d H:i:s");
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
        $this->Senha = hash('sha512', $this->Senha . $random_salt);
        $create = new Create;
        $Dados = array("email" => $this->Email, "username" => $this->Username, "password" => $this->Senha, "salt" => $random_salt, "datahora" => $datahora,);
        $create->IniCreate("usuario", $Dados);
        if ($create->getResult()):
            $this->Error = ["Cadastro Efetuado com Sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ['Usuário pode ter no máximo 35 caracter', WS_INFO];
            $this->Result = false;
        endif;
    }

}
