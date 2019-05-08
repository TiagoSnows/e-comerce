USE ECOMMERCE_WEB;

DROP PROCEDURE IF EXISTS pr_tipoEndereco_sel;

DELIMITER |

CREATE PROCEDURE pr_tipoEndereco_sel 
(
	vTipoEnderecoId  TINYINT,
    vTipoEndereco	VARCHAR(45)
)
BEGIN     

	SELECT tipoEnderecoId, tipoendereco as tipoEndereco
    FROM tipoendereco
    WHERE 	tipoEnderecoId 	= ifnull(vTipoEnderecoId, tipoEnderecoId)
    AND 	tipoEndereco 	= ifnull(vTipoEndereco, tipoEndereco);
END;
|
DELIMITER ;


-- CALL pr_tipoEndereco_sel(null, null);
