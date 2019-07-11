<?php    
    require_once "php/funcoes.php"; 
	session_start();
	$cliente = $_SESSION['cliente'];
	if(empty($cliente))
	{
		header("location: login.php");
	}
	//cria a sessão do carrinho
	if(empty($_SESSION['carrinho'])){
		$_SESSION['carrinho'] = array();
	}
	
	if(!empty($_GET['id'])){
		$id = intval($_GET['id']);		
		$produto = buscarProduto($id);
		
		$repetido = false;
		//verifica se existe um item repetido 
		foreach($_SESSION['carrinho'] as $indice => $matriz){
			if($matriz['id'] == $id){
				$repetido = true;
			}
		}				
		if($repetido == false){
			array_push($_SESSION['carrinho'],$produto);			
		}
	}		
	
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="página para o projeto final da matéria de php">
    <meta name="author" content="Ronaldo Gomes do Nascimento, Antonio Carlos">
    <link rel="icon" href="favicon.ico">

    <title>Loja online - Meu carrinho de compras</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" 
	  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
	  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
	  crossorigin="anonymous">
	
    <link href="css/pricing.css" rel="stylesheet">
    <link href="css/album.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
    
  </head>

  <body>
    <!--  aqui vai o navbar-->
    <?php
		include_once "php/navbar.php";
	?>
    <!-- fim navbar-->
    
    <!-- aqui fica a parte da logo-->
		
      <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
          <!--logomarca-->
          <div class="logo">
  				<a href="index.php"><img src="imagens/logo.png" alt="Home Shoppe" /></a>
  		    </div>
  		  <h5 class="my-0 mr-md-auto font-weight-normal"></h5>
        <nav class="my-2 my-md-0 mr-md-3">
		  <a class="p-2 text-dark" href="#">Ajuda</a>		  
		  <?php
			if(!empty($_SESSION['cliente']))
			{
		  ?>			
			<a class="p-2 text-dark" href="minhaConta.php">Minha conta</a>
			<a class="btn btn-outline-primary" href="php/logout.php">Sair</a>
			
		  <?php
			}
			else
			{
		  ?>
          <a class="p-2 text-dark" href="cadastroUsuario.php">Registre-se</a>
        </nav>
			<a class="btn btn-outline-primary" href="login.php">Entrar</a>
		<?php
			}
		?>
      
	</div>
    
    <!-- fim logo -->
   			
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Meu carrinho</li>
			<li class="breadcrumb-item"><a href="finalizar.php">Finalizar carinho</a></li>
		  </ol>
		</nav>
      
    <main role="main"> 
		<div class="album py-5 bg-light">
			<div class="container">
			<?php
				$carrinho = $_SESSION['carrinho'];				
				if(!empty($id)){
					salvarPedido($cliente, $carrinho,$id);
				}
			?>			
			<br/>
				<div class="row">
				<?php					
					foreach($_SESSION['carrinho'] as $indice => $item) 
					{
				?>
					<div class="col-md-4">
						<div class="card mb-4 shadow-sm">
						<img class="card-img-top" src="<?=$item['url']?>" alt="<?=$item['nome']?>">
							<div class="card-body">
								<p class="card-text"><?=$item['nome']?></p>
								<p class="card-text">Quantidade:
										<?="&nbsp;" ?>
										<?php
											$retorno = verificaPedido($item['numero']);
											$qtd = $retorno['quantidade'];											
										?>
										<input type="text" size="3" name="quantidade" value="<?=$qtd?>" disabled >
								</p>
								<div class="d-flex justify-content-between align-items-center">
									<p class="card-text">R$ <?=$item['valor']?></p>
										<div class="btn-group">
											<a href="itemCarrinho.php?acao=retirar&numero=<?=$item['numero']?>&id=<?=$item['id']?>" class="btn btn-sm btn-outline-secondary">
											retirar
											</a>
											<a href="itemCarrinho.php?acao=somar&numero=<?=$item['numero']?>&id=<?=$item['id']?>" class="btn btn-sm btn-outline-secondary">
											+
											</a>
											<a href="itemCarrinho.php?acao=subtrair&numero=<?=$item['numero']?>&id=<?=$item['id']?>" class="btn btn-sm btn-outline-secondary">
											-
											</a>										
									</div>
								</div>								
							</div>
							
						</div>
					</div>
				<?php
				
					}					
				?>
			</div>
		</div>

    </main>
    <div class="container">
    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="https://getbootstrap.com.br/docs/4.1/assets/brand/bootstrap-solid.svg"
            alt="" width="24" height="24">
            <small class="d-block mb-3 text-muted">&copy; 2017-2018</small>
          </div>
          <div class="col-6 col-md">
            <h5>Informações</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Sobre nós</a></li>
              <li><a class="text-muted" href="#">Serviço ao cliente</a></li>
              <li><a class="text-muted" href="#">Busca Avançada</a></li>
              <li><a class="text-muted" href="#">Pedidos e Devoluções</a></li>
              <li><a class="text-muted" href="#">Contate-Nos</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Minha conta</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Entrar</a></li>
              <li><a class="text-muted" href="#">Carrinho</a></li>
              <li><a class="text-muted" href="#">Lista de desejos</a></li>
              <li><a class="text-muted" href="#">Rastreamento</a></li>
            </ul>
          </div>
          <div class="col-6 col-md">
            <h5>Sobre</h5>
            <ul class="list-unstyled text-small">
              <li><a class="text-muted" href="#">Contato</a></li>
              <li><a class="text-muted" href="#">Equipe</a></li>
              <li><a class="text-muted" href="#">Locais</a></li>
              <li><a class="text-muted" href="#">Privacidade</a></li>
              <li><a class="text-muted" href="#">Termos</a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>



    <!-- Bootstrap core JavaScript ==================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
	integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
	crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
	integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
	crossorigin="anonymous"></script>
	<script src="js/vendor/holder.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
