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

    public function setData($row){
        $this->setIdusuario($row["id_usuario"]);
        $this->setSenha($row["ds_senha"]);
        $this->setLogin($row["ds_login"]);
        $this->setDtcadastro(new DateTime($row["dt_cadastro"]));
    }

    public function loadById($id){
        $sql = new Sql();

        $results = $sql->select("select * from tb_usuarios where id_usuario=:ID",array(
            ":ID"=>$id
        ));

        if (count($results)>0){
            $this->setData($results[0]);

        }
    }

    public static function getList(){
        $sql = new Sql();

        return $sql->select("select * from tb_usuarios order by ds_login");

    }

    public static function search($deslogin){
        $sql = new Sql();

        return $sql->select("select * from tb_usuarios where ds_login like :SEARCH order by ds_login", array(
            ":SEARCH"=>"%".$deslogin."%"
        ));

    }

    public function __construct($deslogin="", $dessenha="")
    {
       $this->setLogin($deslogin);
       $this->setSenha($dessenha); 
    }

    public function insert(){
        $sql = new Sql();

        $results = $sql->select("CALL sp_usuario_insert(:LOGIN, :SENHA)", array(
            ':LOGIN'=>$this->getLogin(),
            ':SENHA'=>$this->getSenha()
        ));

        if (count($results)>0){
            $this->setData($results[0]);
        }else{
            throw new Exception("Insert sem sucesso!");
        }

    }

    public function update($deslogin, $dessenha){
        $sql = new Sql();
        $this->setLogin($deslogin);
        $this->setSenha($dessenha);

        $sql->executeQuery("UPDATE tb_usuarios SET ds_login = :LOGIN, ds_senha = :SENHA where id_usuario=:ID", array(
            ':LOGIN'=>$deslogin,
            ':SENHA'=>$dessenha,
            ':ID'=>$this->getIdusuario()
        ));
    }

    public function delete(){
        $sql = new Sql();
        
        $sql->executeQuery("DELETE tb_usuarios where id_usuario=:ID", array(
            ':ID'=>$this->getIdusuario()
        ));

        $this->setIdusuario(0);
        $this->setLogin("");
        $this->setSenha("");
        $this->setDtcadastro(new DateTime());
        
    }

    

    public function __toString(){
        return json_encode(array(
            "id"=>$this->getIdusuario(),
            "login"=>$this->getLogin(),
            "senha"=>$this->getSenha(),
            "dt cadastro"=>$this->getDtcadastro()->format("d/m/y H:i:s")
        ));
    }

    public function login($login, $senha){
        $sql = new Sql();

        $results = $sql->select("select * from tb_usuarios where ds_login=:login and ds_senha=:senha",array(
            ":login"=>$login,
            ":senha"=>$senha
        ));

        if (count($results)>0){
            $this->setData($results[0]);
        }else{
            throw new Exception("Dados de autenticação invalidos");
        }
    }

}

?>