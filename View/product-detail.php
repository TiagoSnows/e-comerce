<?php
require_once("../Controller/produtoController.php");
use EcommerceController\ProdutoController;
?>

<!DOCTYPE html>
<html lang="pt">
<head>
	<title id="titulo"></title>
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
<body class="animsition">
	

<!--===============================================================================================-->
</head>
<body>
    <!-- Header -->
	<header class="header-v4">
		<!-- Nav bar -->
		<?php include_once("Template/navbar.php"); ?>

		<!-- Modal Busca -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="../public/images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>


	<!-- breadcrumb -->
	<div class="container d-none d-lg-block">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="produtos.php" class="stext-109 cl8 hov-cl1 trans-04">
				Todos os Produtos
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				<?=$_GET['nomeproduto']?>
			</span>
		</div>
	</div>
		

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">

			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
							<div class="slick3 gallery-lb">
							<?php
								//Vou buscar os produtos na base de dados
								$produtos = new ProdutoController();
								try {
									$produtoRetornado = $produtos->buscarDetalhesProduto($_GET['nomeproduto'], $_GET['plataforma']);
									
								} catch (Exception $e) {
									//Se deu erro, eu imprimo um alert e mato o programa
									$erro = $e->getMessage();

									echo <<< ALERTA_ERRO
									<div class="alert alert-danger" role="alert">
										<h4 class="alert-heading">Desculpe, mas parece que houve um problema</h4>
										<p>
											$erro
										</p>
									</div>
ALERTA_ERRO;
									die();
								}
							?>
								<div class="item-slick3" data-thumb="<?= $produtoRetornado[0]['caminhoImagemProduto']?>">
									<div class="wrap-pic-w pos-relative">
										<img src="<?= $produtoRetornado[0]['caminhoImagemProduto']?>" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?= $produtoRetornado[0]['caminhoImagemProduto']?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h1 class="cl2 js-name-detail p-b-14">
							<?= $produtoRetornado[0]['nomeProduto']?>
						</h1>

						<h5 class="cl2 p-b-14">
							Valor: R$
							<span class="mtext-106 cl2 js-price-detail" id="valorProd">
								<?= number_format($produtoRetornado[0]['precoProduto'], 2, ',', '.') ?>
							</span>
						</h5>

						<h5 class="cl2 p-b-14">
							Quantidade em estoque: 
							<span class="mtext-106 js-stock-detail cl2">
								<?= $produtoRetornado[0]['qtdUnidades'] ?>
							</span>
						</h5>

						<h5 class="cl2 p-b-14">
							Universo: 
							<span class="mtext-106 js-platform-detail cl2">
								<?= $produtoRetornado[0]['nomePlataforma'] ?>
							</span>
							<input type="hidden" name="acronimoPlataforma" disabled value="<?= $produtoRetornado[0]['plataformaAcronimo']?>">
						</h5>
						
						<!--  -->
						<div class="p-t-33">
							<div class="size-204 flex-w flex-m respon6-next">
								
								<div class="wrap-num-product flex-w m-r-20 m-tb-10">
									<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" onclick="subtrair(<?= $produtoRetornado[0]['qtdUnidades'] ?>)">
										<i class="fs-16 zmdi zmdi-minus"></i>
									</div>

									<input class="mtext-104 cl3 txt-center num-product" type="number" 
									name="num-product" value="1" min="1" max="<?= $produtoRetornado[0]['qtdUnidades'] ?>">

									<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" onclick="somar(<?= $produtoRetornado[0]['qtdUnidades'] ?>)">
										<i class="fs-16 zmdi zmdi-plus"></i>
									</div>
								</div>
								<?php
									if(!empty($_SESSION)):
								?>
									<button onclick="pegarDadosEAdicionarCarrinho()" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
										Colocar no carrinho&nbsp;<i class="fa fa-cart-plus "></i>
									</button>
								<?php
									else:
								?>
									<a href="login.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
										Logue-se para adicionar ao carrinho
									</a>
								<?php
									endif;
								?>

							</div>
						</div>

						<div class="p-t-33">
							<p>
								<i class="fa fa-truck"></i> Frete grátis para todo o Brasil!
							</p>
							<hr/>
							<h5 class="cl2 js-name-detail p-b-14">
								Valor total: R$  
								<span class="mtext-106 cl2" id="Somatorio">
									<?= number_format($produtoRetornado[0]['precoProduto'], 2, ',', '.') ?>
								</span>
							</h5>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Produtos relacionados
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">

				<?php
					//Vou buscar os produtos na base de dados
					$produtos = new ProdutoController();
					try {
						$_POST['produtosRelacionados'] = true;
						$produtoRetornado = $produtos->buscarDetalhesProduto(null, $_GET['plataforma']);
					} catch (Exception $e) {
						//Se deu erro, eu imprimo um alert e mato o programa
						$erro = $e->getMessage();

						echo <<< ALERTA_ERRO
						<div class="alert alert-danger" role="alert">
							<h4 class="alert-heading">Desculpe, mas parece que houve um problema</h4>
							<p>
								$erro
							</p>
						</div>
ALERTA_ERRO;
					}
					
					$i = 0;
					$numeroDeIndicacao = 0;
					$qtdMaxDeIndicacoes = 4;

					//Trato as indicações para o usuário
					//Não exibo um produto que ele já está olhando e 
					//não percorro mais do que foi retornado
					while ($numeroDeIndicacao < $qtdMaxDeIndicacoes && $i < count($produtoRetornado)):
						
						//Se o produto vigente é o mesmo produto que está
						//sendo exibido na tela de detalhes, não coloco ele como indicações
						if($produtoRetornado[$i]['nomeProduto'] == $_GET['nomeproduto']
						&& $produtoRetornado[$i]['plataformaAcronimo'] == $_GET['plataforma'])
						{
							$i++;
							continue;
						}
						$numeroDeIndicacao++;
				?>
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						
						<div class="block2">
							<div class="block2-pic hov-img0">
								<a href="product-detail.php?nomeproduto=<?=$produtoRetornado[$i]['nomeProduto']?>&plataforma=<?= $produtoRetornado[$i]['plataformaAcronimo']?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<img src="<?=$produtoRetornado[$i]['caminhoImagemProduto'] ?>" alt="IMG-PRODUCT">
								</a>
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="product-detail.php?nomeproduto=<?=$produtoRetornado[$i]['nomeProduto']?>&plataforma=<?= $produtoRetornado[$i]['plataformaAcronimo']?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										<?=$produtoRetornado[$i]['nomeProduto'] ?>
									</a>

									<span class="stext-110 cl3">
										R$ <?= number_format($produtoRetornado[0]['precoProduto'], 2, ',', '.') ?>
									</span>
								</div>

							</div>
						</div>
					</div>

				<?php
					$i++;
					endwhile;
				?>
				</div>
			</div>
		</div>
	</section>
		

	<?php include_once("Template/rodape.php"); ?>

	<script src="../public/js/queryString.jquery.min.js"></script>
	<script src="../public/js/exibicaoValoresProdutoDetalhe.js"></script>
	<script src="../public/js/carrinhoAJax.js"></script>

	<script>  
    $(document).ready(function () {
		var queryString = $.currentQueryString();
		if(Object.keys(queryString).length !== 0) {
			produto = queryString.nomeproduto
			$(document).attr("title", produto.toUpperCase()+" - BRAZIL GAMING WORLD");
		}
		}); 
		
		function pegarDadosEAdicionarCarrinho(){
			var qtdSelecionado = parseInt($('.num-product').val(), 10)
			var nomeProduto = $('.js-name-detail').html().trimLeft().trimRight();
			// var plataforma = $('.js-platform-detail').html().trimLeft().trimRight();
			var plataformaAcronimo = $("input[name=acronimoPlataforma]").val();
			adicionarProduto(nomeProduto, qtdSelecionado, plataformaAcronimo);
		}
	</script>  
</body>
</html>
