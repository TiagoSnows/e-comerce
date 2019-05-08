	function somar(qtdMaxProd) {
		var valorProduto = $('#valorProd').html().replace(',', '.')
		var qtdProdutoSelecionado = parseInt($('.num-product').val(), 10) + 1
		
		if(qtdProdutoSelecionado > qtdMaxProd) {
			$('#Somatorio').html("Número de produtos maior que o estoque")
			$('.js-addcart-detail').addClass('d-none')
		}else {
			$('.js-addcart-detail').removeClass('d-none')
			var valorFormatado = parseFloat(valorProduto * qtdProdutoSelecionado).toFixed(2).replace('.', ',')
			$('#Somatorio').html(valorFormatado)
		}
	} 

	function subtrair(qtdMaxProd){
		var valorProduto = $('#valorProd').html().replace(',', '.')
		var qtdProdutoSelecionado = parseInt($('.num-product').val(), 10) - 1
		
		if(qtdProdutoSelecionado <= 0) {
			$('.js-addcart-detail').addClass('d-none')
			$('#Somatorio').html("")
			return
		}else if(qtdProdutoSelecionado <= qtdMaxProd) {
			$('.js-addcart-detail').removeClass('d-none')
		}
		var valorFormatado = parseFloat(valorProduto * qtdProdutoSelecionado).toFixed(2).replace('.', ',')
		$('#Somatorio').html(valorFormatado)
		
	}