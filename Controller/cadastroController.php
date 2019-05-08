<?php

namespace EcommerceController;

require_once("../Controller/classePadraoController/controllerPadrao.php");
require_once("../Controller/loginController.php");
require_once("../Model DB/usuarioModel.php");


//outras Exceptions
use Exception;
use ControllerPadrao\ClassePadrao;
use EcommerceModel\UsuarioModel;

if(!empty($_POST)) {
    switch ($_POST['origem']) {
        case 'cadastrar':
        //Caso seja um cadastro, validos se todos os campos esperados
        //como obrigatório estão preenchidos, caso estejam chamo
        //o método cadastrar usuário da classe CadastroController
            $dadosValidados = ClassePadrao::validaCamposObrigatorios($_POST);
            if(!$dadosValidados)
                header("location:../View/cadastro.php?error=campos");
            else 
            {
                $cadastro = new CadastroController();
                try {
                    if($cadastro->cadastrarUsuario($dadosValidados)) {
                        echo 'Cadastrado';
                        $autenticar = new LoginController();
                        
                        //Monto a origem como logar para que possa ser autenticado o usuário
                        $_POST['origem'] = 'logar';
                        $autenticar->autenticarUsuario($dadosValidados['email'], md5($dadosValidados['senha']));
                    }
                } catch (Exception $th) {
                    header("location:../View/cadastro.php?error=".$th->getMessage());
                }
            }
            break;
        default:
            header("location:../View/cadastro.php?error=acao");
            break;
    }
}
else {
    header("location:../View/cadastro.php");
}


class CadastroController{

    public function cadastrarUsuario($arrayDados) {
        $usuarioModel = new UsuarioModel("../Model DB/DBconfig.ini");
    
        $usuarioModel->setNomeUsuario($arrayDados['primeiroNome'] . ' ' . $arrayDados['sobreNome']);
        $usuarioModel->setCPF(str_replace( ['.', '-'], '', $arrayDados['cpf']));
        $usuarioModel->setEmail($arrayDados['email']);
        $usuarioModel->setSenha(md5($arrayDados['senha']));

        /*Dados do endereco*/
        $usuarioModel->setTipoEnderecoId($arrayDados['tipoLogradouro']);
        $usuarioModel->setLogradouro($arrayDados['logradouro']);
        $usuarioModel->setNumero($arrayDados['numero']);
        $usuarioModel->setCep(str_replace('-', '', $arrayDados['cep']));
        $usuarioModel->setBairro($arrayDados['bairro']);
        $usuarioModel->setCidade($arrayDados['cidade']);


        try {
             if($usuarioModel->cadastrarUsuario() == 1){
                 return true;
             }else {
                throw new Exception("Não foi possível realizar o cadastro agora, tente novamente mais tarde");
             }
        } catch (Exception $e) {
            throw new Exception("Não foi possível realizar o cadastro agora, tente novamente mais tarde");
        }
        
    }
}