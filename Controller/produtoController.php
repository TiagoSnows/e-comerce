<?php

namespace EcommerceController;

require_once("../Model DB/produtoModel.php");
use EcommerceModel\ProdutoModel;

//outras Exceptions
use Exception;
                            
class ProdutoController{

    public function buscarProdutos($nomeProduto = '') {
        $produtoModel = new ProdutoModel("../Model DB/DBconfig.ini");
        $produtoModel->setNomeProduto($nomeProduto);
        try {
            return $produtoModel->pesquisarProdutos();
        } catch (Exception $e) {
            throw new Exception("Não foi possível buscar os produtos, tente novamente mais tarde");
        }
    }

    public function buscarDetalhesProduto($nomeProduto, $plataformaAcronimo) {
        $produtoModel = new ProdutoModel("../Model DB/DBconfig.ini");
        $produtoModel->setNomeProduto($nomeProduto);
        $produtoModel->setPlataformaAcronimo($plataformaAcronimo);
        
        try {
            $produtos = $produtoModel->pesquisarProdutos();
            if(count($produtos) > 1 && !isset($_POST['produtosRelacionados']))
                throw new Exception("Não foi possível realizar a busca, tente novamente mais tarde.");
            else
                return $produtos;

        } catch (Exception $e) {
            throw new Exception("Não foi possível encontrar o produto, tente novamente mais tarde ou pesquise um outro produto.");
        }
    }

}