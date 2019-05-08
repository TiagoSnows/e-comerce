<?php

namespace EcommerceController;

require_once("../Model DB/usuarioModel.php");
use EcommerceModel\UsuarioModel;

//outras Exceptions
use Exception;

if($_POST) {

    switch ($_POST['origem']) {
        case 'logar':
            if( 
                (!is_null($_POST['email']) and !empty($_POST['email']))
                and
                (!is_null($_POST['senha']) and !empty($_POST['senha']))
            ) {
                $controller = new LoginController();

                try {
                    $controller->autenticarUsuario($_POST['email'], md5($_POST['senha']));
                } 
                catch (Exception $th) {
                    header("location:../View/login.php?error=".$th->getMessage());
                }
                
            }else {
                header("location:../View/login.php?error=campos");
            }
            break;
        case 'deslogar':
            $controller = new LoginController();
            $controller->deslogarUsuario();
            break;
        default:
            header("location:../View/login.php?error=acao");
            break;
    }
}


class LoginController{

    public function autenticarUsuario($email, $senha){
        $usuarioModel = new UsuarioModel("../Model DB/DBconfig.ini");
        $usuarioModel->setEmail($email);
        $usuarioModel->setSenha($senha);
        try {
            $dados_usuario = $usuarioModel->autenticarUsuario();
    
            session_start();
            $_SESSION["usuarioId"]      = $dados_usuario[0]['usuarioId'];
            $_SESSION["emailUsuario"]   = $dados_usuario[0]['email'];
            $_SESSION["nomeUsuario"]    = $dados_usuario[0]['nomeUsuario'];

            header("location:../View");
        } catch (Exception $e) {
            throw $e;
        }
        
    }

    public function deslogarUsuario(){
        session_start();
        unset($_SESSION["usuarioId"]);
        unset($_SESSION["emailUsuario"]);
        unset($_SESSION["nomeUsuario"]);

        header("location:../View");
    }

}