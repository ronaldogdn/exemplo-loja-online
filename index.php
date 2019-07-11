<?php    
    require_once "php/funcoes.php"; 
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="página para o projeto final da matéria de php">
    <meta name="author" content="Ronaldo Gomes do Nascimento, Antonio Carlos">
    <link rel="icon" href="favicon.ico">

    <title>Loja online</title>

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
	<?php
		include_once "php/navbarLogo.php";
    ?>
    <!-- fim logo -->
    
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Ofertas</h1>
      <p class="lead">As melhores ofertas estão na home shoppe.</p>
    </div>

    <main role="main">      
		<div class="album py-5 bg-light">
			<div class="container">
				<div class="row">
			  
				<?php

					$produtos = listarProdutos();
					foreach ($produtos as $produto) 
					{
				?>
					<div class="col-md-4">
						<div class="card mb-4 shadow-sm">
						<img class="card-img-top" src="<?=$produto['url']?>" alt="<?=$produto['nome']?>">
							<div class="card-body">
							<p class="card-text"><?=$produto['descricao_curta']?></p>
							<p class="card-text">R$ <?=$produto['valor']?></p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
										<a href="detalhes.php?id=<?=$produto['id']?>"
											class="btn btn-sm btn-outline-secondary">detalhes
										</a>
										<a href="carrinho.php?id=<?=$produto['id']?>"
											class="btn btn-sm btn-outline-secondary">adicionar ao carrinho
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
		</div>

    </main>
    <?php
		include_once "php/footer.php";
	
	?>


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
