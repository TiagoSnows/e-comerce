<?php


error_reporting(0);

session_start();

require_once("../Controller/carrinhoProdutoController.php");
use EcommerceController\CarrinhoProdutoController;

$carrinhoPendente = new CarrinhoProdutoController();
$_POST['origem'] = 'pesquisar';
$_POST['usuarioId'] = $_SESSION["usuarioId"];
$_POST['statusCarrinho'] = 'Pendente';
try {
	$carrinhoProduto = $carrinhoPendente->pesquisarCarrinho();
	$qtdProdutos = count($carrinhoProduto);
} catch (Exception $th) {
	//throw $th;
}
?>

<nav>
	<!-- Header desktop -->
	<div class="container-menu-desktop">
		<!-- Topbar -->
		<div class="top-bar">
			<div class="content-topbar flex-sb-m h-full container">
				<div class="left-top-bar">
					Aqui é onde você encontra tudo para satisfazer sua nerdice!
				</div>

				<div class="right-top-bar flex-w h-full">
					<?php 
						
						// Valido se o usuário está logado ou não
						if(!empty($_SESSION)) {
							echo 
							'<a href="#" class="flex-c-m trans-04 p-lr-25">
								Bem vindo(a)&nbsp
								<strong>'. 
									$_SESSION["nomeUsuario"] .
								'</strong>
							</a>
							<a href="#" class="flex-c-m p-lr-10 trans-04">
								Minha Conta
							</a>';
						}else {
							echo 
							"<a href='login.php' class='flex-c-m trans-04 p-lr-25'>
								Login
							</a>
							
							<a href='cadastro.php' class='flex-c-m trans-04 p-lr-25'>
								Cadastre-se
							</a>";
						} 
					?>
					

					<a href="https://jovemnerd.com.br/" class="flex-c-m trans-04 p-lr-25">
						Noticias Nerds  
					</a>

					<?php
						if(!empty($_SESSION)) {
							echo <<<LOGOUT
							<form id="logout" action="../Controller/loginController.php" method="POST" style="margin-left:-10px;">
								<a href="#" class="flex-c-m trans-04 p-lr-25" onclick="document.getElementById('logout').submit();">Logout</a>
								<input type="hidden" name="origem" class="form-control" value="deslogar"/>
							</form>
LOGOUT;
						}

					?>
				</div>
			</div>
		</div>

		<div class="wrap-menu-desktop" id="login-menu">
			<nav class="limiter-menu-desktop container">
				
				<!-- Logo desktop -->		
				<a href="index.php" class="logo">
					<img src="../public/images/icons/logo-01.png" alt="IMG-LOGO">
				</a>

				<!-- Menu desktop -->
				<div class="menu-desktop">
					<ul class="main-menu">
						<li class="active-menu">
							<a href="index.php">Home</a>
						</li>

						<li class="label1" data-label1="HOT">
							<a href="produtos.php"> Todos os Produtos</a>
						</li>
						<?php
							if(!empty($_SESSION)) {
								echo "
								<li>
									<a href='carrinho.php'>Ver Carrinho</a>
								</li>";
							}
						?>
						<li>
							<a href="contato.php">Contato</a>
						</li>
					</ul>
				</div>	

				<!-- Icon header -->
				<div class="wrap-icon-header flex-w flex-r-m">	
					<?php
						
						if(!empty($_SESSION)) {
							echo "
							<div class='icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-cart' data-notify='0'>
								<span class='hov-cl1 badge badge-pill badge-light'>
									<i class='zmdi zmdi-shopping-cart'></i>
									<span id='produtosAdiconados'>$qtdProdutos</span>
								</span>
							</div>";
						}
					?>	
				</div>
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
						<i class="zmdi zmdi-search">
					</i>
				</div>
			</nav>
		</div>	
	</div>

	<!-- Header Mobile -->
	<div class="wrap-header-mobile">
		<!-- Logo para Mobile -->		
		<div class="logo-mobile">
			<a href="index.html"><img src="../public/images/icons/logo-01.png" alt="IMG-LOGO"></a>
		</div>

		<!-- Icon -->
		<div class="wrap-icon-header flex-w flex-r-m">	
				<?php
					if(!empty($_SESSION)) {
						echo "
						<div class='icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-cart' data-notify='0'>
							<span class='hov-cl1 badge badge-pill badge-light'>
								<i class='zmdi zmdi-shopping-cart'></i>
								<span id='produtosAdiconados'>$qtdProdutos</span>
							</span>
						</div>";
					}
				?>	
		</div>
		
	

		<!-- Botão de menu -->
		<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</div>
	</div>


	<!-- Menu para Mobile -->
	<div class="menu-mobile">
		<ul class="topbar-mobile">
			<li>
				<div class="left-top-bar">
					Aqui é onde você encontra tudo para satisfazer sua nerdice!
				</div>
			</li>

			<li>
				<div class="right-top-bar flex-w h-full">
				<?php 
						// Valido se o usuário está logado ou não
						if(!empty($_SESSION)) {
							echo 
							'<a href="#" class="flex-c-m trans-04 p-lr-25">
								Bem vindo(a)&nbsp
								<strong>'. 
									$_SESSION["nomeUsuario"] .
								'</strong>
							</a>
							<a href="#" class="flex-c-m p-lr-10 trans-04">
								Minha Conta
							</a>';
						}else {
							echo 
							"<a href='login.php' class='flex-c-m trans-04 p-lr-25'>
								Login
							</a>
							
							<a href='cadastro.php' class='flex-c-m trans-04 p-lr-25'>
								Cadastre-se
							</a>";
						} 
					?>

					
					<a href="https://jovemnerd.com.br/" class="flex-c-m trans-04 p-lr-25">
							Noticias Nerds  
					</a>

					<?php
						if(!empty($_SESSION)) {
							echo <<<LOGOUT
							<form id="logout" action="../Controller/loginController.php" method="POST">
								
								<a href="#" class="flex-c-m trans-04 p-lr-25" onclick="document.getElementById('logout').submit();">Logout</a>
								<input type="hidden" name="origem" class="form-control" value="deslogar"/>
							</form>
LOGOUT;
						}

					?>
				</div>
			</li>
		</ul>

		<ul class="main-menu-m">
			<li>
				<a href="index.php">Opa Nerd - A Melhor Loja Nerd do Brasil! </a>
				<span class="arrow-main-menu-m">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
				</span>
			</li>

			<li>
				<a href="produtos.php" class="label1 rs1" data-label1="HOT">Todos os Produtos</a>
			</li>

			<?php
				if(!empty($_SESSION)) {
					echo "
					<li>
						<a href='carrinho.php'>Ver Carrinho</a>
					</li>";
				}
			?>

			<li>
				<a href="contato.php">Contato</a>
			</li>
		</ul>
	</div>

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
				<input class="plh3" type="text" name="search" placeholder="O que busca ?...">
			</form>
		</div>
	</div>
</nav>

<!-- Carrinho -->
<div class="wrap-header-cart js-panel-cart">
	<div class="s-full js-hide-cart"></div>

	<div class="header-cart flex-col-l p-l-65 p-r-25">
		<div class="header-cart-title flex-w flex-sb-m p-b-8">
			
			<span class="mtext-103 cl2">
				Seu carrinho <i class="fa fa-shopping-cart"></i>
			</span>

			<!-- Fechar carrinho -->
			<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
				<i class="zmdi zmdi-close"></i>
			</div>
		</div>
		
		<div class="header-cart-content flex-w js-pscroll">

			<!-- Lista de produtos -->
			<ul class="header-cart-wrapitem w-full">

				<?php
					for ($i=0; $i < $qtdProdutos; $i++): 		
				?>
				<!-- Produto do carrinho -->
				<li class="header-cart-item flex-w flex-t m-b-12">
					<div class="header-cart-item-img">
						<img src="<?= $carrinhoProduto[$i]['CaminhoimagemProduto']?>" alt="IMG">
					</div>

					<div class="header-cart-item-txt p-t-8">
						<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
							<?= $carrinhoProduto[$i]['nomeProduto']?>
						</a>

						<span class="header-cart-item-info">
							<?= $carrinhoProduto[$i]['qtdProduto']?> x R$ <?= number_format($carrinhoProduto[$i]['precoProduto'], 2, ',', '.')?>
						</span>
					</div>
				</li>

				<?php
					$precoTotal += $carrinhoProduto[$i]['totalRS'];
					endfor;
				?>
			</ul>
			
			<!-- Footer do carrinho -->
			<div class="w-full">

				<!-- Valor total -->
				<div class="header-cart-total w-full p-tb-40">
					Total: <?= number_format($precoTotal, 2, ',', '.') ?>
				</div>

				<div class="header-cart-buttons flex-w w-full">

					<!-- Visualizar o carrinho -->
					<a href="carrinho.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn2 p-lr-15 trans-04 m-r-8 m-b-10">
						Visualizar carrinho
					</a>

					<!-- Visualizar a compra -->
					<a href="carrinho.php" class="flex-c-m stext-101 cl0 size-107 bg1 bor2 hov-btn2 p-lr-15 trans-04 m-b-10">
						Finalizar a compra
					</a>
				</div>
			</div>

		</div>
	</div>
</div>