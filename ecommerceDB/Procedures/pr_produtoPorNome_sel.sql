USE ECOMMERCE_WEB;

DROP PROCEDURE IF EXISTS pr_produtoPorNome_sel;

DELIMITER |
CREATE PROCEDURE pr_produtoPorNome_sel	(	vNomeProduto VARCHAR(45), vPlataformaAcronimo VARCHAR(5))
	BEGIN
		SELECT prod.*, 
        plat.acronimo as plataformaAcronimo,
		plat.nomePlataforma
        FROM Produto prod
        JOIN plataforma plat on (prod.plataformaId = plat.plataformaId)
        WHERE prod.nomeProduto LIKE ifnull(CONCAT('%',vNomeProduto,'%'), prod.nomeProduto)
        AND	  plat.acronimo =  ifnull(vPlataformaAcronimo, plat.acronimo)
        ORDER BY nomeProduto;
    END ;
|
DELIMITER ;

-- CALL pr_produtoPorNome_sel(null, null);
        
-- select * from plataforma
