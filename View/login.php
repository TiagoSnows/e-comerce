<?php 
session_start();
if (!empty($_SESSION)) {
	header("location:../View");
}

?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"  rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html lang="pt">
<head>
	<title>LOGIN - Alo Nerd</title>
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
	<script src="../public/js/queryString.jquery.min.js"></script>
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
					<h3>Entrar</h3>
				</div>
				<div class="card-body">
					
					<form action="../Controller/loginController.php" method="POST">
					
						<div class="input-group form-group">
							<input type="hidden" name="origem" class="form-control" value="logar">
						</div>

						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-envelope"></i></span>
							</div>
							<input type="text" name="email" class="form-control" placeholder="Digite seu e-mail" required>
							
						</div>

						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-lock"></i></span>
							</div>
							<input type="password" name="senha" class="form-control" placeholder="Digite sua senha">
						</div>

						<div class="row align-items-center remember">
							<input type="checkbox" name="lembrar">Lembrar-me
						</div>

						<div class="form-group">
							<input type="submit" value="Login" class="btn float-right login_btn">
						</div>

					</form>
				</div>

				<div class="card-footer">
					<div class="d-flex justify-content-center links">
						Não tem conta? <a href="cadastro.php" style="color:#FF8C00"> Cadastre-se!</a>
					</div>
					<div class="d-flex justify-content-center">
						<a href="esqueceuSenha.php" style="color:#FF8C00">Esqueci minha senha</a>
					</div>
				</div>

				<div class="row mt-5">
					<div class="col-12">
						<div class="alert alert-danger d-none" role="alert">
							<h5 class="alert-heading">Desculpe, um erro ocorreu</h5>
							<span id="msg-error"></span>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>


	<script>  
    $(document).ready(function () {
			var queryString = $.currentQueryString();
			if(Object.keys(queryString).length !== 0)
			{
				$('.alert-danger').removeClass("d-none");
				$('#msg-error').html(queryString.error);
			}
    });  
	</script>  

</body>
</html>