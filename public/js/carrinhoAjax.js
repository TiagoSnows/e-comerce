function adicionarProduto(vNomeProduto, vQuantidade, vPlataforma){
    console.log(vQuantidade);
    console.log(vNomeProduto);
    console.log(vPlataforma);

    $.ajax({
        method: "POST",
        url: "../Controller/carrinhoProdutoController.php",
        data: { nomeProduto: vNomeProduto, 
                quantidade:  vQuantidade,
                plataforma: vPlataforma,
                origem:     'incluir'
             }
    })
    .done(function(msg){
        if(msg == 'true')
            window.location.href = "produtos.php?status=success&produto="+vNomeProduto; 
        else
        window.location.href = "produtos.php?status=error&produto="+vNomeProduto; 
    })
    .fail(function(){
        alert('Não deu para gravar')
    })
}