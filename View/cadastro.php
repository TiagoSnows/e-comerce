<?php
require("../Controller/tipoEnderecoController.php");
use EcommerceController\TipoEnderecoController;
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<title>CADASTRE-SE - Alo Nerd</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="alternate" type="text/html" title="Página Inicial" hreflang="pt" href="/pt/ecomerce/index.html" />
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../public/images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../public/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../public/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../public/fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../public/css/util.css">
	<link rel="stylesheet" type="text/css" href="../public/css/main.css">
    
<!--===============================================================================================-->

</head>
<body>
    <!-- Header -->
	<header>

	<!-- Nav bar -->
	<?php include_once("Template/navbar.php"); ?>
	</header>

   
    <div class="container mt-5 pt-5 pb-5" >
        <h3>Cadastro de cliente</h3>
        <!--- dados do cadastro -->

        <hr>
        <form class="needs-validation" novalidate id="cadastroUsuario" action="../Controller/cadastroController.php" method="POST">
            <div class="input-group form-group">
                <input type="hidden" name="origem" class="form-control" value="cadastrar">
            </div>

            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="primeiroNome">Nome</label>
                    <input type="text" name="primeiroNome[required]" class="form-control" id="primeiroNome" placeholder="Seu primeiro nome" required>
                    
                    <div class="invalid-feedback">
                        Por favor, preenche o seu nome
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="sobrenome">Sobrenome</label>
                    <input type="text" name="sobreNome[required]" class="form-control" id="sobrenome" placeholder="Seu sobrenome" required>
                    
                    <div class="invalid-feedback">
                        Por favor, preenche o seu sobrenome
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf[required]" class="form-control cpf" id="cpf" placeholder="000.000.000-00" required>
                    <div class="invalid-feedback">
                        Por favor, preencha o seu CPF
                    </div>
                   
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="email">E-mail</label>
                    <input type="email" name="email[required]" class="form-control" id="email" placeholder="Ex: joaozinho@seudominio.com.br" required maxlength="100">
                    <div class="invalid-feedback">
                        Por favor, preencha seu e-mail
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha[required]" class="form-control" id="senha" placeholder="Digite aqui a sua senha" required>
                    <div class="invalid-feedback">
                        Por favor, informe uma senha
                    </div>
                </div>
            </div>

            <h5 class="mt-5">Cadastro do endereço</h5>
        <!--- dados do cadastro -->

            <hr>
            <div class="form-row">
                <div class="col-md-2 mb-2">
                    <label for="cep">Cep</label>
                    <input type="text" name="cep[required]" class="form-control" id="cep" placeholder="Digite o seu CEP" required maxlength="9">
                    <div class="invalid-feedback">
                        Por favor, informe o CEP
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="tipoLogradouro">Tipo do logradouro</label>
                    <select class="custom-select" id="tipoLogradouro" name="tipoLogradouro[required]">
                        <option selected value="-1">Selecione...</option>
                        <?php
                            
                        $tipoEndereco = new TipoEnderecoController();
                        try {
                                $tipoEnderecos = $tipoEndereco->getTiposEnderecos();
                                foreach ($tipoEnderecos as $tipoLogradouros):
                        ?>  
                                    <option value="<?php echo $tipoLogradouros['tipoEnderecoId'] ?>">
                                        <?php echo $tipoLogradouros['tipoEndereco'] ?>
                                    </option>
                        <?php
                                endforeach;
                            } catch (Exceptio $th){
                                echo '<option value="-2">Não foi possível carregar a coleção</option>';
                            }
   
                        ?>
                    </select>
                </div>
                
                <div class="col-md-3 mb-3">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" name="logradouro[required]" class="form-control" id="logradouro" placeholder="Digite o seu logradouro" required maxlength="45">
                    <div class="invalid-feedback">
                        Por favor, informe o logradouro
                    </div>
                </div>

                <div class="col-md-2 mb-2">
                    <label for="numero">Número</label>
                    <input type="text" name="numero[required]" class="form-control" id="numero" placeholder="Digite o número" required maxlength="6">
                    <div class="invalid-feedback">
                        Por favor, informe o logradouro
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3 mb-3">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro[required]" class="form-control" id="bairro" placeholder="Digite o bairro" required maxlength="45">
                    <div class="invalid-feedback">
                        Por favor, informe o bairro
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade[required]" class="form-control" id="cidade" placeholder="Digite a cidade" required maxlength="45">
                    <div class="invalid-feedback">
                        Por favor, informe a cidade
                    </div>
                </div>
            </div>

            <div class="form-group pl-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="condicoesSite" required>
                    <label class="form-check-label" for="condicoesSite">
                        Aceito os termos e condições do e-commerce
                    </label>
                    <div class="invalid-feedback">
                        Para se cadastrar você deve concordar com os termos e condições do e-commerce
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm-8">    
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-success btn-block"> <i class="glyphicon glyphicon-ok"></i> Gravar </button>   
                    </div>
                </div> 
            </div>  
  
        </form>
    </div>

    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
    </script>

    <?php include("Template/rodape.php"); ?>
    
    <script src="../public/js/validacoes.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script src="../public/js/mascaras.js"></script>


    <script>
    $('#cadastroUsuario').on('submit', function() {
        if(!validarCPF($('#cpf').val()))
            alert("CPF inválido, digite um cpf válido para continuar");
     });
    </script>