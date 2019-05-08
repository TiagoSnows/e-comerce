<?php
require_once("../Controller/produtoController.php");
use EcommerceController\ProdutoController;

define('VALOR_DOLAR_EUA', 3.941);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
	<title>PRODUTOS - Alo Nerd</title>
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

	<!-- Produto -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">

		<?php
				//Vou buscar os produtos na base de dados
				$produtos = new ProdutoController();
				try {
					$produtosRetornado = $produtos->buscarProdutos();
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

			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						Todos os Jogos
					</button>

					<?php
						$ArrayAux = Array();
						foreach ($produtosRetornado as $produto):
							if (!in_array($produto['plataformaAcronimo'], $ArrayAux)) { 
								$ArrayAux[] = $produto['plataformaAcronimo'];
							}else {
								continue;
							}
					?>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".<?= $produto['plataformaAcronimo']?>">
						<?= strtoupper($produto['plataformaAcronimo'])?>
					</button>

					<?php
						endforeach;
						$ArrayAux = null;
					?>
				</div>

				<div class="flex-w flex-c-m m-tb-10">

					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Buscar
					</div>
				</div>
				
				<!-- Busca Produto -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Qual jogo procura?">
					</div>	
				</div>
			</div>

			<div class="row isotope-grid">
				<?php
					
					foreach ($produtosRetornado as $produto):
				?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?= $produto['plataformaAcronimo']?>">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<a href="product-detail.php?nomeproduto=<?=$produto['nomeProduto']?>&plataforma=<?= $produto['plataformaAcronimo']?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								<img 
								src="<?= !is_null($produto['caminhoImagemProduto']) ?
								$produto['caminhoImagemProduto'] : '../public/images/jogoAnonimo.jpg'?>" 
								alt="IMG-PRODUCT">
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.php?nomeproduto=<?=$produto['nomeProduto']?>&plataforma=<?= $produto['plataformaAcronimo']?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?= $produto['nomeProduto']?>
								</a>

								<span class="stext-105 cl3">
									R$<?= number_format($produto['precoProduto'], 2, ',', '.') ?>
								</span>
								<span class="stext-105 cl3">
									USD $<?= number_format($produto['precoProduto'] / VALOR_DOLAR_EUA, 2, ',', '.') ?>
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="../public/images/icons/icon-heart-01.png" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="../public/images/icons/icon-heart-02.png" alt="ICON">
								</a>
							</div>
						</div>
						
					</div>
				</div>
				<?php		
					endforeach;
				?>

			
		</div>
		<!-- Load more -->
		<div class="flex-c-m flex-w w-full p-t-45 mb-5">
			<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
				Carregar mais
			</a>
		</div>
	</div>
		

<?php include_once("Template/rodape.php"); ?>
<script src="../public/js/queryString.jquery.min.js"></script>
<script>
    $(document).ready(function () {
			var queryString = $.currentQueryString();
			if(Object.keys(queryString).length !== 0)
			{
				if(queryString['status'] == 'success')
					swal(queryString['produto'], "foi adicionado ao carrinho !", "success")
				else
					swal(queryString['produto'], "não foi adicionado ao carrinho ! Algum erro ocorreu", "error")
			}
    });  
	
</script>