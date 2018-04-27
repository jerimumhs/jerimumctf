<?php

/**
 * chall.class [ Chall]
 * Descricao
 * @copyright (c) 2017, Boot
 */
class Chall {

    private $evento;
    private $resposta;
    private $userid;

    function getEvento() {
        $read = new Read;
        $read->FullRead("SELECT nome from evento where id = :e limit 1", "e={$this->evento}");
        if ($read->getResult()):
            foreach ($read->getResult() as $evento):
                extract($evento);
                return $nome;
            endforeach;
        endif;
    }

    function getResposta() {
        return $this->resposta;
    }

    function setResposta($resposta) {
        $this->resposta = $resposta;
    }

    function setEvento($evento) {
        $this->evento = $evento;
    }

    function setUserid($userid) {
        $this->userid = $userid;
    }

    public function carregaBotoes() {
        $read = new Read;
        $read->FullRead("SELECT DISTINCT categoria.id,categoria.nome as nomecategoria FROM chall,categoria  where evento_id = :e and chall.categoria_id = categoria.id", "e={$this->evento}");
        if ($read->getResult()):
            foreach ($read->getResult() as $categoria):
                extract($categoria);
                echo "<div class=\"col-md-12 portlets\">\n";
                echo "<div class=\"widget\">\n";
                echo "<div class=\"widget-header \">\n";
                echo "<h2>{$nomecategoria}</h2>\n";
                echo "<div class=\"additional-btn\">\n";
                echo "<a href=\"#\" class=\"hidden reload\"><i class=\"icon-ccw-1\"></i></a>\n";
                echo "<a href=\"#\" class=\"widget-toggle\"><i class=\"icon-down-open-2\"></i></a>\n";
                echo "</div>\n";
                echo "</div>\n";
                echo "<div class=\"widget-content padding\">\n";
                echo "<div class=\"row\">\n";
                echo "<div class=\"col-sm-12\">\n";
                echo "<div class=\"btn-wrapper\">\n";
                $read->FullRead("SELECT DISTINCT chall.id, chall.nome as nomechall, chall.valor, (select score.id from score WHERE score.chall_id = chall.id and score.usuario_id = :userid) as resolvida from chall, score where chall.evento_id = :evento and chall.oculta = 0 and chall.categoria_id = :catid", "userid={$this->userid}&evento={$this->evento}&catid={$id}");
                if ($read->getResult()):
                    foreach ($read->getResult() as $dadosbotoes):
                        extract($dadosbotoes);
                        if ($resolvida != ""):
                            echo "<button data-modal=\"{$nomecategoria}{$id}\" class=\"btn btn-success md-trigger\">{$nomecategoria}{$valor}</button>\n";
                        else:
                            echo "<button data-modal=\"{$nomecategoria}{$id}\" class=\"btn btn-default md-trigger\">{$nomecategoria}{$valor}</button>\n";
                        endif;
                    endforeach;
                else:
                    $read->FullRead("SELECT chall.id, chall.nome as nomechall, chall.valor from chall where chall.evento_id = :evento and chall.oculta = 0 and chall.categoria_id = :catid", "evento={$this->evento}&catid={$id}");
                    foreach ($read->getResult() as $dadosbotoes):
                        extract($dadosbotoes);
                        echo "<button data-modal=\"{$nomecategoria}{$id}\" class=\"btn btn-default md-trigger\">{$nomecategoria}{$valor}</button>\n";
                    endforeach;
                endif;
                echo "</div>\n";
                echo "</div>\n";
                echo "</div>\n";
                echo "</div>\n";
                echo "</div>\n";
                echo "</div>\n";
            endforeach;
            return true;
        endif;
    }

    public function carregaChall() {
        $read = new Read;
        $read->FullRead("SELECT chall.id, chall.nome, chall.descricao,chall.link, chall.valor, chall.autor,categoria.nome as categorianome FROM chall,categoria WHERE evento_id = :e and oculta = 0 and categoria.id = chall.categoria_id", "e={$this->evento}");
        if ($read->getResult()):
            return $read->getResult();
        endif;
    }

    public function totalScore() {
        $read = new Read;
        $read->FullRead("SELECT sum(chall.valor) as total FROM score, chall where score.chall_id = chall.id and score.usuario_id = :user and chall.evento_id = :e", "user={$this->userid}&e={$this->evento}");
        if ($read->getResult()):
            $array = $read->getResult();
            return $array[0]["total"];
        endif;
    }
    
     public function insereScoreTotal() {
        $read = new Read;
        $read->FullRead("SELECT id from evento where id = :e limit 1", "e={$this->evento}");
        if ($read->getResult()):
            $read->FullRead("SELECT score from score_total where evento_id = :e and usuario_id = :user", "e={$this->evento}&user={$this->userid}");
            if ($read->getResult()):
                 return false;
            else:
                $datahora = date("Y-m-d H:i:s");
                $create = new Create;
                $Dados = array("score" => '0', "datahora" => $datahora, "usuario_id" => $this->userid, "evento_id" => $this->evento,);
                $create->IniCreate("score_total", $Dados);
                if ($create->getResult()):
                    return true; // cadastrado novo score
                else:
                    return false; // erro ao cadastrar
                endif;
            endif;
        else:
            return false;
        endif;
    }

    //verifica se realmente existe
    public function validaFlag() {
        //return 0 = errada
        //return 1 = correta
        //return 2 = respondida
        //return 3 = bruteforce ON
        if (!$this->checkBrute()):
            $read = new Read;
            $read->FullRead("SELECT id, valor,evento_id,nome,resposta FROM chall WHERE resposta = :r", "r={$this->resposta}");
            if ($read->getResult()):
                foreach ($read->getResult() as $dadoschall):
                    extract($dadoschall);
                    return $this->confirmaflag($id, $evento_id, $resposta);
                endforeach;
            else:
                return $this->insereErradas(); //flag incorreta
            endif;
        else:
            return 3; //BruteForce Ativo
        endif;
    }

    //Confirma se os dados estão corretos e se o usuário já respondeu
    protected function confirmaFlag($id, $evento_id, $resposta) {
        $read = new Read;
        $read->FullRead("SELECT id FROM score WHERE chall_id = :chall and usuario_id = :user ", "chall={$id}&user={$this->userid}");
        if ($read->getResult()):
            return "2"; //flag respondida
        else:
            if ($resposta == $this->resposta and $evento_id == $this->evento):
                return $this->insereScore($id); //Usa função InsereScore para inserir dados na tabela score e retornar flag correta
            else:
                return 0;
            endif;
        endif;
    }

       //cadastra score/respondidas no bd
    protected function insereScore($chall_id) {
        $datahora = date("Y-m-d H:i:s");
        $create = new Create;
        $Dados = array("datahora" => $datahora, "chall_id" => $chall_id, "usuario_id" => $this->userid,);
        $create->IniCreate("score", $Dados);
        if ($create->getResult()):
            $this->atualizaScoreTotal();
            return 1; // Cadastrado score e flag Correta
        else:
            
            return 0; // erro cadastro flag incorreta
        endif;
    }
    
    protected function atualizaScoreTotal(){
        $datahora = date("Y-m-d H:i:s");
        $alter = new Update;
        $read = new Read;
        $read->FullRead("select sum(chall.valor) as total from chall,score where score.usuario_id = :user and score.chall_id = chall.id and chall.evento_id = :e","user={$this->userid}&e={$this->evento}");
        if ($read->getResult()):
            $array = $read->getResult();
            $Dados = array("score" => $array[0]["total"],"datahora" => $datahora, "evento_id" => $this->evento, "usuario_id" => $this->userid,);
            $alter->IniUpdate("score_total", $Dados, "WHERE usuario_id= :user and evento_id= :e", "user={$this->userid}&e={$this->evento}");      
        endif;
        
    }

    //cadastra flag errada no bd
    protected function insereErradas() {
        date_default_timezone_set('America/Sao_Paulo');
        $datahora = date("Y-m-d H:i:s");
        $create = new Create;
        $Dados = array("datahora" => $datahora, "flag" => $this->resposta, "usuario_id" => $this->userid,);
        $create->IniCreate("erradas", $Dados);
        if ($create->getResult()):
            return 0; // Cadastrado errada e retorna flag Incorreta
        endif;
    }

    protected function checkBrute() {
        $read = new Read;
        $read->FullRead("SELECT count(id) as total FROM erradas WHERE usuario_id = :user and datahora > NOW() - INTERVAL 5 MINUTE", "user={$this->userid}");
        if ($read->getResult()):
            $array = $read->getResult();
            if ($array[0]["total"] > 5):
                return true;
            else:
                return false;
            endif;
        endif;
    }

}
