<?php

namespace EcommerceController;

require("../Model DB/tipoEnderecoModel.php");
use EcommerceModel\TipoEnderecoModel;

//outras Exceptions
use Exception;

class TipoEnderecoController{

    public function getTiposEnderecos($tipoEnderecoId = -1, $tipoEndereco = ''){
        
        $tipoEnderecoModel = new TipoEnderecoModel("../Model DB/DBconfig.ini");
        $tipoEnderecoModel->setTipoEnderecoId($tipoEnderecoId);
        $tipoEnderecoModel->setTipoEndereco($tipoEndereco);

        try {
            return $tipoEnderecoModel->buscarTipoEnderecos();
        } catch (Exception $e) {
            throw $e;
        }
        
    }

}