<?php

namespace EcommerceModel;

require_once("classePadrao/conexao/conexao.class.php");
require_once("classePadrao/IniFile.class.php");

use EcommerceConection\Conexao;
use EcommerceConection\IniFile;

//outras Exceptions
use Exception;

class ProdutoModel extends Conexao{
    private $plataformaId;
    private $plataformaAcronimo;
    private $produtoId;
    private $nomeProduto;
    private $qtdUnidades;
    private $precoProduto;
    private $precoProdutoUS;
    private $caminhoImagemProduto;

    private $parametros = array();
    
    public function __construct($iniConfigBD) {
        try{
           $this->_configDB = IniFile::readIniFile($iniConfigBD);
        }
        catch (Exception $e){   
            throw $e;
        }

        $this->selectProcedure = 'pr_produtoPorNome_sel';
        $this->updateProcedure = '';
        $this->insertProcedure = '';
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
    public function getPlataformaId() {
        return $this->plataformaId;
    }

    public function getPlataformaAcronimo() {
        return $this->plataformaAcronimo;
    }

    public function getProdutoId() {
        return  $this->produtoId;
    }

    public function getNomeProduto() {
        return  $this->nomeProduto;
    }

    public function getQtdUnidades() {
        return  $this->qtdUnidades;
    }

    public function getPrecoProduto() {
        return  $this->precoProduto;
    }

    public function getPrecoProdutoUS() {
        return  $this->precoProdutoUS;
    }

    public function getCaminhoImagemProduto() {
        return  $this->caminhoImagemProduto;
    }
    
    /************************/

    public function setPlataformaId($newPlataformaId) {
        $this->plataformaId = $newPlataformaId;
    }

    public function setPlataformaAcronimo($newPlataformaAcronimo) {
        $this->plataformaAcronimo = $newPlataformaAcronimo;
    }

    public function setProdutoId($newProdutoId) {
        $this->produtoId = $newProdutoId;
    }

    public function setNomeProduto($newNomeProduto) {
        $this->nomeProduto = $newNomeProduto;
    }

    public function setQtdUnidades($newQtdUnidades) {
        $this->qtdUnidades = $newQtdUnidades;
    }

    public function setPrecoProduto($newPrecoProduto) {
        $this->precoProduto = $newPrecoProduto;
    }

    public function setPrecoProdutoUS($newPrecoProdutoUS) {
        $this->precoProdutoUS = $newPrecoProdutoUS;
    }

    public function setCaminhoImagemProduto($newCaminhoImagemProduto) {
        $this->caminhoImagemProduto = $newCaminhoImagemProduto;
    }


    protected function setColunas() {
        $qtdParametros = 0;
        
        if( !is_null( $this->getPlataformaId()) and $this->getPlataformaId() != -1)
            $this->parametros[$qtdParametros++] = $this->getPlataformaId();
        
        if( !is_null( $this->getProdutoId()) and !empty( $this->getProdutoId()) )
            $this->parametros[$qtdParametros++] = $this->getProdutoId();
        
        if( !is_null( $this->getNomeProduto()) and !empty( $this->getNomeProduto()) )
            $this->parametros[$qtdParametros++] = $this->getNomeProduto();
        else
            $this->parametros[$qtdParametros++] = null;

        if( !is_null( $this->getPlataformaAcronimo()) and !empty($this->getPlataformaAcronimo()))
            $this->parametros[$qtdParametros++] = $this->getPlataformaAcronimo();
        else
            $this->parametros[$qtdParametros++] = null;

        if( !is_null( $this->getQtdUnidades()) and !empty( $this->getQtdUnidades()) )
            $this->parametros[$qtdParametros++] = $this->getQtdUnidades();
        
        if( !is_null( $this->getPrecoProduto()) and !empty( $this->getPrecoProduto()) )
            $this->parametros[$qtdParametros++] = $this->getPrecoProduto();
        
        if( !is_null( $this->getPrecoProdutoUS()) and !empty( $this->getPrecoProdutoUS()) )
            $this->parametros[$qtdParametros++] = $this->getPrecoProdutoUS();
        
        if( !is_null( $this->getCaminhoImagemProduto()) and !empty( $this->getCaminhoImagemProduto()) )
            $this->parametros[$qtdParametros++] = $this->getCaminhoImagemProduto();
    }

    public function pesquisarProdutos() {
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