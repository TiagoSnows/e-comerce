
USE ECOMMERCE_WEB;

DROP PROCEDURE IF EXISTS pr_carrinhoProduto_ins;

DELIMITER |
	CREATE PROCEDURE pr_carrinhoProduto_ins(	vUsuarioId 	INT,
												vProdutoId	INT
											)
		BEGIN
			DECLARE vCarrinhoId INT;            
	
                    IF EXISTS (	SELECT * 
								FROM Carrinho 
                                WHERE usuarioId = vUsuarioId 
                                AND statusCarrinho != 'Finalizado') 
						THEN 
							SELECT carrinhoId
                            INTO vCarrinhoId
							FROM Carrinho 
							WHERE usuarioId = vUsuarioId 
							AND statusCarrinho != 'Finalizado';
								
                    ELSE
							SELECT IFNULL(MAX(carrinhoId), 0)+1 
							INTO vCarrinhoId
							FROM Carrinho
                            WHERE usuarioId = vUsuarioId;
							
							INSERT INTO Carrinho (	usuarioId,
													carrinhoId,
													statusCarrinho,
													dataCriacaoCarrinho
												)
							VALUES				(	vUsuarioId,
													vCarrinhoId,
													'Pendente',
													CURDATE()
												);         
					END IF;
					
                    SET @aux = SUBSTRING(RAND(), 1, 13); 
                    
					INSERT INTO CarrinhoProduto (	usuarioId,
													carrinhoId,
													produtoId,
													dataInclusao,
                                                    codRastreioProduto
												)
					VALUES(
							vUsuarioId,
							vCarrinhoId,
							vProdutoId,
							CURDATE(),
							@aux);
        END;
|
DELIMITER ;

-- SET SQL_SAFE_UPDATES = 0;
-- UPDATE Carrinho SET statusCarrinho = 'Finalizado';
-- call pr_carrinhoProduto_ins(1, 1);
-- select * from CarrinhoProduto;
										