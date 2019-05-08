

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

DROP SCHEMA IF EXISTS  ECOMMERCE_WEB;

CREATE SCHEMA IF NOT EXISTS ECOMMERCE_WEB DEFAULT CHARACTER SET utf8 ;
USE ECOMMERCE_WEB ;

-- -----------------------------------------------------
-- Table Usuario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Usuario (
  `usuarioId` INT NOT NULL AUTO_INCREMENT,
  `nomeUsuario` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `senha` VARCHAR(32) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL UNIQUE,
  `dataInclusao` VARCHAR(45) NOT NULL,
  `indAtivo` CHAR(1) NULL,
  PRIMARY KEY (`usuarioId`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table TipoEndereco
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS TipoEndereco (
  `tipoEnderecoId` TINYINT NOT NULL,
  `tipoEndereco` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`tipoEnderecoId`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table Plataforma
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Plataforma (
  `plataformaId` TINYINT NOT NULL AUTO_INCREMENT,
  `acronimo` VARCHAR(8) NULL,
  `nomePlataforma` VARCHAR(45) NULL,
  PRIMARY KEY (`plataformaId`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table FormaPagamento
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS FormaPagamento (
  `formaPagamentoId` TINYINT NOT NULL AUTO_INCREMENT,
  `nomePagamento` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`formaPagamentoId`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table Produto
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Produto (
  `plataformaId` TINYINT NOT NULL,
  `produtoId` INT NOT NULL AUTO_INCREMENT,
  `nomeProduto` VARCHAR(60) NOT NULL,
  `qtdUnidades` SMALLINT NOT NULL,
  `precoProduto` DECIMAL(10, 2) NOT NULL,
  `caminhoImagemProduto` VARCHAR(400) NULL,
  PRIMARY KEY (`produtoId`),
  INDEX `fk_produto_plataforma_idx` (`plataformaId` ASC) ,
  CONSTRAINT `fk_produto_plataforma`
    FOREIGN KEY (`plataformaId`)
    REFERENCES `ECOMMERCE_WEB`.`plataforma` (`plataformaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table Carrinho
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS Carrinho (
  `usuarioId` INT NOT NULL,
  `carrinhoId` INT NOT NULL,
  `statusCarrinho` VARCHAR(45) NOT NULL,
  `dataCriacaoCarrinho` DATE NOT NULL,
  PRIMARY KEY (`usuarioId`, `carrinhoId`),
  INDEX `fk_carrinho_usuario1_idx` (`usuarioId` ASC) ,
  CONSTRAINT `fk_carrinho_usuario1`
    FOREIGN KEY (`usuarioId`)
    REFERENCES `ECOMMERCE_WEB`.`usuario` (`usuarioId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table ComprasFinalizadas
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS ComprasFinalizadas (
  `usuarioId` INT NOT NULL,
  `carrinhoId` INT NOT NULL,
  `formaPagamentoId` TINYINT NOT NULL,
  PRIMARY KEY (`usuarioId`, `carrinhoId`),
  INDEX `fk_historicoCompra_carrinho1_idx` (`usuarioId` ASC, `carrinhoId` ASC) ,
  INDEX `fk_comprasFinalizadas_formaPagamento1_idx` (`formaPagamentoId` ASC) ,
  CONSTRAINT `fk_historicoCompra_carrinho1`
    FOREIGN KEY (`usuarioId` , `carrinhoId`)
    REFERENCES `ECOMMERCE_WEB`.`carrinho` (`usuarioId` , `carrinhoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comprasFinalizadas_formaPagamento1`
    FOREIGN KEY (`formaPagamentoId`)
    REFERENCES `ECOMMERCE_WEB`.`formaPagamento` (`formaPagamentoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table CarrinhoProduto
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS CarrinhoProduto (
  `carrinhoProdutoId` INT NOT NULL AUTO_INCREMENT,
  `usuarioId` INT NOT NULL,
  `carrinhoId` INT NOT NULL,
  `produtoId` INT NOT NULL,
  `dataInclusao` DATE NOT NULL,
  `codRastreioProduto` VARCHAR(13) NULL,
  INDEX `fk_produto_has_carrinho_carrinho1_idx` (`carrinhoId` ASC, `usuarioId` ASC) ,
  PRIMARY KEY (`carrinhoProdutoId`),
  INDEX `fk_carrinhoProduto_produto1_idx` (`produtoId` ASC) ,
  CONSTRAINT `fk_produto_has_carrinho_carrinho1`
    FOREIGN KEY (`usuarioId`, `carrinhoId`)
    REFERENCES `ECOMMERCE_WEB`.`carrinho` (`usuarioId`, `carrinhoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrinhoProduto_produto1`
    FOREIGN KEY (`produtoId`)
    REFERENCES `ECOMMERCE_WEB`.`produto` (`produtoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `ECOMMERCE_WEB`.`enderecoEntrega`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS EnderecoEntrega (
  `enderecoId` INT NOT NULL AUTO_INCREMENT,
  `usuarioId` INT NOT NULL,
  `tipoEnderecoId` TINYINT NOT NULL,
  `logradouro` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  `cep` VARCHAR(45) NOT NULL,
  `bairro` VARCHAR(45) NOT NULL,
  `cidade` VARCHAR(45) NOT NULL,
  `enderecoVigente` CHAR(1) NOT NULL,
  PRIMARY KEY (`enderecoId`, `usuarioId`),
  INDEX `fk_enderecoEntrega_usuario1_idx` (`usuarioId` ASC) ,
  INDEX `fk_enderecoEntrega_tipoEndereco1_idx` (`tipoEnderecoId` ASC) ,
  CONSTRAINT `fk_enderecoEntrega_usuario1`
    FOREIGN KEY (`usuarioId`)
    REFERENCES `ECOMMERCE_WEB`.`usuario` (`usuarioId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_enderecoEntrega_tipoEndereco1`
    FOREIGN KEY (`tipoEnderecoId`)
    REFERENCES `ECOMMERCE_WEB`.`tipoEndereco` (`tipoEnderecoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



INSERT INTO tipoEndereco VALUES
('1','ALAMEDA'),
('2','AVENIDA'),
('3','BECO'),
('4','BLOCO'),
('5','CAMINHO'),
('6','ESTAÇÃO'),
('7','ESTRADA'),
('8','FAZENDA'),
('9','GALERIA'),
('10','LADEIRA'),
('11','LARGO'),
('12','PRAÇA'),
('13','PARQUE'),
('14','PRAIA'),
('15','QUADRA'),
('16','RODOVIA'),
('17','RUA'),
('18','SUPER QUADRA'),
('19','TRAVESSA'),
('20','VIADUTO');

INSERT INTO Plataforma VALUES
	(1, 'GOT' 	,'Game of Thrones'),
    (2, 'StW'	,'Star Wars'),
    (3, 'Mrv'	,'Marvel'),
    (4, 'SdA','Senhor dos Anéis'),
    (5, 'DC'	,'DC Commics'),
    (6, 'Anm'	,'Animes');
    
INSERT INTO produto (
						plataformaId,
                        nomeProduto,
                        qtdUnidades,
                        precoProduto,
                        caminhoImagemProduto
                    )
VALUES
	(1, 'Almofada GoT Stark', 5, 49.99, '../public/images/products/almofada-got-stark-01-800x800.jpg'),
    (1, 'Almofada GoT Lannister', 5, 49.90, '../public/images/products/almofada-lannister-01-800x800.jpg'),
    (3, 'Caneca Marvel Faces', 5, 39.90, '../public/images/products/caneca-marvel-faces-01-800x800.jpg'),
    (4, 'Livro Beren E Luthien', 5, 54.90, '../public/images/products/beren-e-luthien-01-800x800.jpg'),
    (3, 'Almofada Vingadores', 5, 99.90, '../public/images/products/almofada-vingadores-01-800x800.jpg'),
    (4, 'Livro A Queda de Gondolin', 5, 99.90, '../public/images/products/a-queda-de-gondolin-01-800x800.jpg'),
    (2, 'Camiseta Star Wars', 5, 99.90, '../public/images/products/camiseta_this_is_galaxy-01-800x800.jpg'),
    (2, 'Camiseta Darth Vader', 5, 99.90, '../public/images/products/camiseta-vader-skull-01-1-800x800'),
    (1, 'Caneca Targaryen', 5, 99.90, '../public/images/products/Caneca-800x800.jpg'),
    (3, 'Caneca Deadpool', 5, 99.90, '../public/images/products/caneca-deadpool-01-800x800.jpg'),
    (3, 'Caneca Hulk', 5, 99.90, '../public/images/products/caneca-mao-hulk-01-800x800.jpg'),
    (3, 'Caneca Punisher', 5, 99.90, '../public/images/products/caneca-punisher3d-01-800x800.png'),
    (2, 'Funko Darth Vader', 5, 99.90, '../public/images/products/funko-darth-vader-01-800x800.jpg'),
    (3, 'Garrafa Avengers', 5, 99.90, '../public/images/products/garrafa-avengers-02-800x800.jpg'),
    (1, 'Livro Guerra dos Tronos', 5, 99.90, '../public/images/products/guerra-dos-tronos-01-800x800.jpg'),
    (1, 'HQ Guerra dos Tronos', 5, 99.90, '../public/images/products/guerra-dos-tronos-hq-01-800x800.jpg'),
    (1, 'Porta Pipocas GoT', 5, 99.90, '../public/images/products/kit-porta-pipoca-got-01-800x800.jpg'),
    (2, 'Livro Herdeiro do Império', 5, 99.90, '../public/images/products/livro-herdeiro-imperio-800x800.jpg'),
    (2, 'Luminária Sociedade do Anél', 5, 99.90, '../public/images/products/luminaria-sociedade-01-800x800.jpg'),
    (2, 'Prateleira Sociedade do Anél', 5, 99.90, '../public/images/products/prateleira-sociedade_1-800x800.jpg'),
    (2, 'Livro Provação', 5, 99.90, '../public/images/products/PROVAÇÃO-800x800.jpg');