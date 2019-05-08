<?php

namespace EcommerceModel;

require_once("classePadrao/conexao/conexao.class.php");
require_once("classePadrao/IniFile.class.php");

use EcommerceConection\Conexao;
use EcommerceConection\IniFile;

//outras Exceptions
use Exception;

class UsuarioModel extends Conexao{
    private $usuarioId;
    private $nomeUsuario;
    private $email;
    private $senha;
    private $cpf;
    private $dataInclusao;
    private $indAtivo;

    /*Dados de endereço*/
    private $tipoEnderecoId;
    private $logradouro;
    private $numero;
    private $cep;
    private $bairro;
    private $cidade;

    private $parametros = array();
    
    
    /*Encapsulamento Get's e Set's*/
    public function getUsuarioId() {
        return $this->usuarioId;
    }

    public function getNomeUsuario() {
        return  $this->nomeUsuario;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getCPF() {
        return $this->cpf;
    }

    public function getIndAtivo() {
        return  $this->indAtivo;
    }
    
    private function getDataInclusao() {
        return $this->dataInclusao;
    }

    /*Dados do endereco*/
    public function getTipoEnderecoId() {
        return $this->tipoEnderecoId;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getBairro(){
        return $this->bairro;
    }

    public function getCidade(){
        return $this->cidade;
    }
    
    /************************/

    public function setUsuarioId($newUsuarioId) {
        $this->usuarioId = $newUsuarioId;
    }

    public function setNomeUsuario($newNomeUsuario) {
        $this->nomeUsuario = $newNomeUsuario;
    }

    public function setEmail($newEmail) {
        $this->email = $newEmail;
    }

    public function setSenha($newSenha) {
        $this->senha = $newSenha;
    }

    public function setCPF($newCPF) {
        $this->cpf = $newCPF;
    }

    public function setIndAtivo($newIndAtivo) {
        $this->indAtivo = $newIndAtivo;
    }
    
    public function setDataInclusao($newDataInclusao) {
        $this->dataInclusao = $newDataInclusao;
    }

    /*Dados do endereco*/
    public function setTipoEnderecoId($newTipoEnderecoId) {
        $this->tipoEnderecoId = $newTipoEnderecoId;
    }

    public function setLogradouro($newLogradouro) {
        $this->logradouro = $newLogradouro;
    }

    public function setNumero($newNumero) {
        $this->numero = $newNumero;
    }

    public function setCep($newCep) {
        $this->cep = $newCep;
    }

    public function setBairro($newBairro){
        $this->bairro = $newBairro;
    }

    public function setCidade($newCidade){
        $this->cidade = $newCidade;
    }


    public function __construct($iniConfigBD) {
        try{
           $this->_configDB = IniFile::readIniFile($iniConfigBD);
        }
        catch (Exception $e){   
            throw $e;
        }

        $this->selectProcedure = 'pr_login_sel';
        $this->updateProcedure = '';
        $this->insertProcedure = 'pr_usuario_ins';
        $this->deleteProcedure = '';
    }

    public function __destruct() {
        $this->_configDB = NULL;
        $this->selectProcedure = NULL;
        $this->updateProcedure = NULL;
        $this->insertProcedure = NULL;
        $this->deleteProcedure = NULL;
        $this->fecharConexao(); //na desconstrução do objeto, fecha-se a conexão com o BD
    }

    protected function setColunas() {
        $qtdParametros = 0;
        
        if( !is_null( $this->getUsuarioId()) and !empty( $this->getUsuarioId()) )
            $this->parametros[$qtdParametros++] = $this->getUsuarioId();
        
        if( !is_null( $this->getNomeUsuario()) and !empty( $this->getNomeUsuario()) )
            $this->parametros[$qtdParametros++] = $this->getNomeUsuario();
            
        if( !is_null($this->getEmail()) and !empty($this->getEmail()) )
            $this->parametros[$qtdParametros++] = $this->getEmail();
    
        if( !is_null($this->getSenha()) and !empty($this->getSenha()) )
            $this->parametros[$qtdParametros++] = $this->getSenha();
        
        if( !is_null( $this->getCPF()) and !empty( $this->getCPF()) )
            $this->parametros[$qtdParametros++] = $this->getCPF();
        
        /*Dados de endereço */
        if( !is_null( $this->getDataInclusao()) and !empty( $this->getDataInclusao()) )
            $this->parametros[$qtdParametros++] = $this->getDataInclusao();

        if( !is_null( $this->getIndAtivo()) and !empty( $this->getIndAtivo()) )
            $this->parametros[$qtdParametros++] = $this->getIndAtivo();

        if( !is_null( $this->getIndAtivo()) and !empty( $this->getIndAtivo()) )
            $this->parametros[$qtdParametros++] = $this->getIndAtivo();

        if( !is_null( $this->getTipoEnderecoId()) and !empty( $this->getTipoEnderecoId()) )
            $this->parametros[$qtdParametros++] = $this->getTipoEnderecoId();

        if( !is_null( $this->getLogradouro()) and !empty( $this->getLogradouro()) )
            $this->parametros[$qtdParametros++] = $this->getLogradouro();

        if( !is_null( $this->getNumero()) and !empty( $this->getNumero()) )
            $this->parametros[$qtdParametros++] = $this->getNumero();
        
        if( !is_null( $this->getCep()) and !empty( $this->getCep()) )
            $this->parametros[$qtdParametros++] = $this->getCep();
        
        if( !is_null( $this->getBairro()) and !empty( $this->getBairro()) )
            $this->parametros[$qtdParametros++] = $this->getBairro();

        if( !is_null( $this->getCidade()) and !empty( $this->getCidade()) )
            $this->parametros[$qtdParametros++] = $this->getCidade();
    }

    public function autenticarUsuario() {
        $this->setColunas();
        try
        {
            return $this->pesquisar($this->parametros);
        }
        catch(Exception $e)
        {
            throw new Exception("Usuario e/ou senha incorretos, tente novamente");
        }
    }

    public function cadastrarUsuario() {
        $this->setColunas();
        try
        {
            return $this->inserir($this->parametros);
        }
        catch(Exception $e)
        {
            throw new Exception("Não foi possível realizar o cadastro, tente novamente mais tarde");
        }
    }
}