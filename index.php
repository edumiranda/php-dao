<?php

    require_once("config.php");

    /*$sql = new Sql();

    $usuarios = $sql->select("select * from tb_usuarios");

    echo json_encode($usuarios);
    exit
    */
    
    /*
    $usuario = new Usuario();
    $usuario->loadById(1);
    echo $usuario;
    */

    /*
    $lista = Usuario::getList();
    echo json_encode($lista);
    */

    
    /*
    $lista = Usuario::search("user");
    echo json_encode($lista);
    */

    /*
    $usuario = new Usuario();
    $usuario->login("user","12345");
    echo $usuario;
    */

    /*
    $usuario = new Usuario("aluno","1234_2");
    $usuario->insert();
    echo $usuario;
    */

    /*
    $usuario = new Usuario();
    $usuario->loadById(8);
    echo $usuario;
    $usuario->update("professor","654321");
    echo $usuario;
    */

    $usuario = new Usuario();
    $usuario->loadById(8);
    echo $usuario;
    $usuario->delete();
    echo $usuario;

?>