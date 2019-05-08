<?php

namespace EcommerceModel;

require("classePadrao/conexao/conexao.class.php");
require("classePadrao/IniFile.class.php");

use EcommerceConection\Conexao;
use EcommerceConection\IniFile;

//outras Exceptions
use Exception;

class TipoEnderecoModel extends Conexao{
    private $tipoEnderecoId;
    private $tipoEndereco;

    private $parametros = array();
    
    /*Encapsulamento Get's e Set's*/
    public function getTipoEnderecoId() {
        return $this->tipoEnderecoId;
    }

    public function getTipoEndereco() {
        return  $this->tipoEndereco;
    }
    
    /************************/

    public function setTipoEnderecoId($newTipoEnderecoId) {
        $this->tipoEnderecoId = $newTipoEnderecoId;
    }

    public function setTipoEndereco($newTipoEndereco) {
        $this->tipoEndereco = $newTipoEndereco;
    }




    public function __construct($iniConfigBD) {
        try{
           $this->_configDB = IniFile::readIniFile($iniConfigBD);
        }
        catch (Exception $e){   
            throw $e;
        }

        $this->selectProcedure = 'pr_tipoEndereco_sel';
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

    protected function setColunas() {
        $qtdParametros = 0;
        
        if( !is_null( $this->getTipoEnderecoId()) and $this->getTipoEnderecoId() != -1)
            $this->parametros[$qtdParametros++] = $this->getTipoEnderecoId();
        else
            $this->parametros[$qtdParametros++] = null;
        
        if( !is_null( $this->getTipoEndereco()) and !empty( $this->getTipoEndereco()) )
            $this->parametros[$qtdParametros++] = $this->getTipoEndereco();
        else
            $this->parametros[$qtdParametros++] = null;
    }

    public function buscarTipoEnderecos() {
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