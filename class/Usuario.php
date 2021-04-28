<?php

class Usuario{

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function setIdusuario($value){
        $this->idusuario=$value;
    }

    public function getIdusuario(){
        return $this->idusuario;
    }


    public function setLogin($value){
        $this->deslogin=$value;
    }

    public function getLogin(){
        return $this->deslogin;
    }


    public function setSenha($value){
        $this->dessenha=$value;
    }

    public function getSenha(){
        return $this->dessenha;
    }

    public function getDtcadastro(){
        return $this->dtcadastro;
    }

    public function setDtcadastro($value){
        $this->dtcadastro=$value;
    }

    public function loadById($id){
        $sql = new Sql();

        $results = $sql->select("select * from tb_usuarios where id_usuario=:ID",array(
            ":ID"=>$id
        ));

        if (count($results)>0){
            $row = $results[0];

            $this->setIdusuario($row["id_usuario"]);
            $this->setSenha($row["ds_senha"]);
            $this->setLogin($row["ds_login"]);
            $this->setDtcadastro(new DateTime($row["dt_cadastro"]));
        }
    }

    public function __toString(){
        return json_encode(array(
            "id"=>$this->getIdusuario(),
            "login"=>$this->getLogin(),
            "senha"=>$this->getSenha(),
            "dt cadastro"=>$this->getDtcadastro()->format("d/m/y H:i:s")
        ));
    }

}

?>