DELIMITER |

CREATE PROCEDURE `pr_carrinhoProduto_sel`(	vUsuarioId 	INT,
 												vStatusCarrinho	VARCHAR(45)
 											)
 BEGIN
		SELECT car.carrinhoId, 
			car.statusCarrinho, 
			cp.produtoId ,
            pr.nomeProduto,
			count(cp.produtoId) as qtdProduto,
            pr.precoProduto,
            pr.precoProduto * count(cp.produtoId) as totalRS,
            pr.CaminhoimagemProduto,
            cp.usuarioId
		FROM carrinho 			car 
        JOIN CarrinhoProduto 	cp on (car.carrinhoId = cp.carrinhoId)
        JOIN produto			pr on (cp.produtoId = pr.produtoId)
        WHERE 	car.usuarioId 	   = vUsuarioId
        AND		car.statusCarrinho = vStatusCarrinho
        GROUP BY (cp.produtoId);

END;
|

DELIMITER ;

-- call pr_carrinhoProduto_sel(1, 'Pendente');