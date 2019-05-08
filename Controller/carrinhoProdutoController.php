<?php

namespace EcommerceController;

require_once("../Controller/produtoController.php");
require_once("../Model DB/CarrinhoProdutoModel.php");
use EcommerceController\ProdutoController;
use EcommerceModel\CarrinhoProdutoModel;

//outras Exceptions
use Exception;

if($_POST) {

    switch ($_POST['origem']) {
        case 'incluir':
            $carrinho = new CarrinhoProdutoController();
            $carrinho->incluirProduto();
            break;
        case 'pesquisar':
            $carrinho = new CarrinhoProdutoController();
            $carrinho->pesquisarCarrinho();
            break;
        default:
            
            break;
    }
}
                            
class CarrinhoProdutoController {

    public function incluirProduto() {
        $produtoController = new ProdutoController();
        $_POST['produtosRelacionados'] = true;
        
        try {
            $produto = $produtoController->buscarDetalhesProduto($_POST['nomeProduto'], $_POST['plataforma']);
            $_POST['produtosRelacionados'] = null;
        } catch (Exception $e) {
            echo 'false';
            return;
        }

        $carrinhoProdutoModel = new CarrinhoProdutoModel("../Model DB/DBconfig.ini");

        session_start();
        $carrinhoProdutoModel->setUsuarioId($_SESSION["usuarioId"]);
        $carrinhoProdutoModel->setProdutoId($produto[0]['produtoId']);
        try {
            $carrinhoProdutoModel->incluirProdutoCarrinho();
            echo 'true';
        } catch (Exception $e) {
            echo 'false';
        }
    }

    public function pesquisarCarrinho() {
        $carrinhoProdutoModel = new CarrinhoProdutoModel("../Model DB/DBconfig.ini");
        $carrinhoProdutoModel->setUsuarioId($_POST['usuarioId']);
        $carrinhoProdutoModel->setStatusCarrinho($_POST['statusCarrinho']);
        try {
            return $carrinhoProdutoModel->pesquisarCarrinho();
        } catch (Exception $th) {
            throw $th;
        }
        
    }

}