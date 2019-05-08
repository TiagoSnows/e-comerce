USE ECOMMERCE_WEB;

DROP PROCEDURE IF EXISTS pr_login_sel;

DELIMITER |
	CREATE PROCEDURE pr_login_sel	(
									IN vEmail 			VARCHAR(100),
									IN vSenha 			VARCHAR(32)
									)
		BEGIN
				IF EXISTS 	(
								SELECT email
								FROM Usuario
								WHERE 	email = vEmail AND
										senha = vSenha
							)
					THEN        
						SELECT usuarioId, email, nomeUsuario
                        from Usuario
                        WHERE 	email = vEmail 
                        AND		senha = vSenha;
				ELSE
                    SIGNAL SQLSTATE '45000'
					SET MESSAGE_TEXT = 'Usuario e/ou senha incorretos, tente novamente';
				END IF;
		END;     
|
DELIMITER ;

-- USE ECOMMERCE_WEB;
-- SELECT * FROM Usuario;
-- call pr_login_sel('leaogad2briel@gmail.com','111');
