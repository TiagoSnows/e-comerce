USE ECOMMERCE_WEB;

DROP PROCEDURE IF EXISTS pr_produtos_ins;

DELIMITER |
	CREATE PROCEDURE pr_produto_ins(	vPlataformaId 			TINYINT,
										vNomeProduto 			VARCHAR(80),
										vQtdUnidades			INT,
                                        vPrecoProduto			DECIMAL(10,2),
                                        vCaminhoImagemProduto	VARCHAR(400)
									)
		BEGIN
			INSERT INTO Produto 	(	plataformaId,
										nomeProduto,
										qtdUnidades,
										precoProduto,
										caminhoImagemProduto)
			VALUES					(	vPlataformaId, 		
										vNomeProduto, 		
										vQtdUnidades,		
										vPrecoProduto,		
                                        vCaminhoImagemProduto);                               
		END;
|           
DELIMITER ; 
