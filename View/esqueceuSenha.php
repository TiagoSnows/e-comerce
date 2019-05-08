<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"  rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html lang="pt">
<head>
	<title>RECUPERAR SENHA - Alo Nerd</title>
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
	  
  <!--CSS personalizado styles-->
  <link rel="stylesheet" type="text/css" href="../public/css/style-login.css" >
<!--===============================================================================================-->
</head>
<body>
    <!-- Header -->
	<header>

	<!-- Nav bar -->
	<?php include_once("Template/navbar.php"); ?>
	</header>

	<!--Form login -->
	<div class="container">
		<div class="d-flex justify-content-center h-100">
			<div class="card">
				<div class="card-header">
					<h3>Esqueceu a senha?</h3>
				</div>
				<div class="card-body">
					
					<form action="../Controller/loginController.php" class="esqSenha" method="POST" style=" padding-top: 50px; text-align: -webkit-center;"> 
						<div class="input-group form-group">
							<input type="hidden" name="origem" class="form-control" value="nova_senha">
						</div>

						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-envelope"></i></i></span>
							</div>
							<input type="email" name="email" class="form-control" placeholder="E-mail: abcd@dominio.com">
							
            </div>
                        
            <div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-address-card-o"></i></span>
							</div>
							<input type="text" name="cpf[required]" class="form-control cpf" id="cpf" placeholder="CPF: 000.000.000-00" required>
						</div>

						<div class="form-group col-6">
							<input type="submit" value="Recuperar senha" class="btn login_btn btn-block">
						</div>

					</form>
					
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-center links">
						Não tem conta? <a href="cadastro.php"> Cadastre-se!</a>
					</div>
				</div>
			</div>
		</div>
    </div>

    <script src="../public/js/validacoes.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script src="../public/js/mascaras.js"></script>
</body>
</html>