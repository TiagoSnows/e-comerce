USE ECOMMERCE_WEB;

DROP PROCEDURE IF EXISTS pr_usuario_ins;

DELIMITER |

CREATE PROCEDURE pr_usuario_ins 
(
	nomeUsuario		VARCHAR(45),
	email			VARCHAR(100),
	senha			VARCHAR(32),
	cpf				VARCHAR(11),
    
	tipoEnderecoId  TINYINT,
    logradouro		VARCHAR(45),
    numero			VARCHAR(45),
    cep				VARCHAR(8),
    bairro			VARCHAR(45),
    cidade			VARCHAR(45)
)
BEGIN     

	if 	isnull(nomeUsuario) 		or
		isnull(email)				or
        isnull(senha)				or
        isnull(cpf)					or
        isnull(tipoEnderecoId)		or
        isnull(logradouro)			or
        isnull(numero)				or
        isnull(cep)					or
        isnull(bairro)				or
        isnull(cidade)
        
    THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Os campos para cadastros não podem ser nulos';
	end if;

	INSERT INTO Usuario 
	(
		nomeUsuario,
		email,
		senha,
		cpf,
		dataInclusao,
		indAtivo
	) 
	VALUES (
		nomeUsuario,	
		email,		
		senha,		
		cpf,			
		CURDATE(),
		'S'
	);
    
    INSERT INTO enderecoentrega
    (
		usuarioId,
		tipoEnderecoId,
		logradouro,
		numero,
		cep,
		bairro,
        cidade,
        enderecoVigente
	) 
    VALUES
    (
		(select usuarioId from Usuario where email = email and senha = senha),
        tipoEnderecoId 	,
		logradouro		,
        numero			,
		cep				,
		bairro			,
		cidade			,
        'S'
    );
END;
|
DELIMITER ;

-- CALL pr_usuario_ins(
-- 	'teste aaa'						,
-- 	'teste@teste.com.br'			,
-- 	'aa1bf4646de67fd9086cf6c79007026c'	,
-- 	'64381878019'						,
-- 	14  									,
-- 	'Alameda teste'						,
-- 	'12'								,
-- 	'0632055'							,
-- 	'Vila das flores'						,
-- 	'Carapicuíba'			    
-- );
    
	
    

