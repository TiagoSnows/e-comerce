<?php

namespace EcommerceModel;

require_once("classePadrao/conexao/conexao.class.php");
require_once("classePadrao/IniFile.class.php");

use EcommerceConection\Conexao;
use EcommerceConection\IniFile;

//outras Exceptions
use Exception;

class CarrinhoProdutoModel extends Conexao{
    
    private $carrinhoProdutoId;
    private $usuarioId;
    private $carrinhoId;
    private $produtoId;
    private $dataInclusao;
    private $codRastreioProduto;
    private $qtdProduto;
    private $statusCarrinho;

    private $parametros = array();
    
    public function __construct($iniConfigBD) {
        try{
           $this->_configDB = IniFile::readIniFile($iniConfigBD);
        }
        catch (Exception $e){   
            throw $e;
        }

        $this->selectProcedure = 'pr_carrinhoProduto_sel';
        $this->updateProcedure = '';
        $this->insertProcedure = 'pr_carrinhoProduto_ins';
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

    /*Encapsulamento Get's e Set's*/
    public function getCarrinhoProdutoId() {
        return $this->carrinhoProdutoId;
    }

    public function getUsuarioId() {
        return $this->usuarioId;
    }

    public function getCarrinhoId() {
        return  $this->carrinhoId;
    }

    public function getProdutoId() {
        return  $this->produtoId;
    }

    public function getDataInclusao() {
        return  $this->dataInclusao;
    }

    public function getCodRastreioProduto() {
        return  $this->codRastreioProduto;
    }

    public function getQtdProduto() {
        return  $this->qtdProduto;
    }

    public function getStatusCarrinho() {
        return  $this->statusCarrinho;
    }
    
    /************************/

    public function setCarrinhoProdutoId($newCarrinhoProdutoId) {
        $this->carrinhoProdutoId = $newCarrinhoProdutoId;
    }

    public function setUsuarioId($newUsuarioId) {
        $this->usuarioId = $newUsuarioId;
    }

    public function setCarrinhoId($newcarrinhoId) {
        $this->carrinhoId = $newcarrinhoId;
    }

    public function setProdutoId($newprodutoId) {
        $this->produtoId = $newprodutoId;
    }

    public function setDataInclusao($newdataInclusao) {
       $this->dataInclusao = $newdataInclusao;
    }

    public function setCodRastreioProduto($newcodRastreioProduto) {
        $this->codRastreioProduto = $newcodRastreioProduto;
    }
    
    public function setQtdProduto($newQtdProduto) {
        $this->qtdProduto = $newQtdProduto;
    }

    public function setStatusCarrinho($newStatusCarrinho) {
        $this->statusCarrinho = $newStatusCarrinho;
    }

    protected function setColunas() {
        $qtdParametros = 0;
        
        if( !is_null( $this->getCarrinhoProdutoId()) and $this->getCarrinhoProdutoId() != -1)
            $this->parametros[$qtdParametros++] = $this->getCarrinhoProdutoId();

        if( !is_null( $this->getUsuarioId()) and $this->getUsuarioId() != -1)
            $this->parametros[$qtdParametros++] = $this->getUsuarioId();
        
        if( !is_null( $this->getCarrinhoId()) and $this->getCarrinhoId() != -1)
            $this->parametros[$qtdParametros++] = $this->getCarrinhoId();

        if( !is_null( $this->getProdutoId()) and $this->getProdutoId() != -1)
            $this->parametros[$qtdParametros++] = $this->getProdutoId();

        if( !is_null( $this->getDataInclusao()) and $this->getDataInclusao() != -1)
            $this->parametros[$qtdParametros++] = $this->getDataInclusao();

        if( !is_null( $this->getCodRastreioProduto()) and $this->getCodRastreioProduto() != -1)
            $this->parametros[$qtdParametros++] = $this->getCodRastreioProduto();
        
        if( !is_null( $this->getQtdProduto()) and $this->getQtdProduto() != -1)
            $this->parametros[$qtdParametros++] = $this->getQtdProduto();

        if( !is_null( $this->getStatusCarrinho()) and !empty($this->getStatusCarrinho()))
            $this->parametros[$qtdParametros++] = $this->getStatusCarrinho();
    }

    public function incluirProdutoCarrinho() {
        $this->setColunas();
        try
        {
           return $this->inserir($this->parametros);
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }

    public function pesquisarCarrinho() {
        $this->setColunas();
        try
        {
           return $this->pesquisar($this->parametros);
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }
}