<?php
	session_start();
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
    <!-- jquery -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
  </head>

  <body>
    <!--  aqui vai o navbar-->
    <div class="container">
  	  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
  	  <a class="navbar-brand" href="index.php">HOME</a>
  	  <button class="navbar-toggler" type="button" data-toggle="collapse" 
  	    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
  	    aria-expanded="false" aria-label="Toggle navigation">
  		  <span class="navbar-toggler-icon"></span>
  	  </button>
  
  	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  		<ul class="navbar-nav mr-auto">
  		  <li class="nav-item active">
  			<a class="nav-link" href="#">Sobre <span class="sr-only">(current)</span></a>
  		  </li>
  		  <li class="nav-item">
  			<a class="nav-link" href="#">Contato</a>
  		  </li>
  		  <li class="nav-item dropdown">
  			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  			  Administrativo
  			</a>
  			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
  			  <a class="dropdown-item" href="cadastroProdutos.php">Cadastro de produtos</a>
  			  <a class="dropdown-item" href="cadastroVendedores.php">Cadastro de vendedores</a>
  			  <div class="dropdown-divider"></div>
  			  <a class="dropdown-item" href="visualizarPedidos.php">Visualiza pedidos</a>
  			</div>
  		  </li>
  		</ul>
  		<form class="form-inline my-2 my-lg-0">
  		   <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
  		   <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
  		</form>
  	  </div>
  	  </nav>
    </div>
    <!-- fim navbar-->
    
    <!-- aqui fica a parte da logo-->
    <div id="navegacao">
      <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
          <!--logomarca-->
          <div class="logo">
  				    <a href="index.php"><img src="imagens/logo.png" alt="Home Shoppe" /></a>
  		    </div>
  		  <h5 class="my-0 mr-md-auto font-weight-normal"></h5>
        <nav class="my-2 my-md-0 mr-md-3">
          <a class="p-2 text-dark" href="#">Ajuda</a>
          <a class="p-2 text-dark" href="cadastro.php">Registre-se</a>
        </nav>
        <a class="btn btn-outline-primary" href="login.php">Entrar</a>
      </div>
    </div>
    <!-- fim logo -->
    
    
    <main role="main">      
			<div class="container">
				<h2>Faça o login no sistema</h2>
        <form action="php/validarLogin.php" method="POST">
  			  <div class="form-group">
  				<label for="login">Login</label>
  				<input type="text" class="form-control" id="login" name="login" placeholder="Digite seu login"
  				required>
  			  </div>
  			  <div class="form-group">
  				<label for="senha">Senha</label>
  				<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha"
  				required>
  			  </div>			  
  			  <button type="submit" class="btn btn-primary">Enviar</button>
			 </form>
		    <div id="divAlerta" class="alert alert-dark" role="alert">
          Login ou senha inválidos!
        </div>
		<?php
    			if(!empty($_SESSION['alerta']))
    			{
    				echo("
    					<script>
    						$('#divAlerta').show();
    					</script>
						");
    				session_destroy();
				}else{
					echo("
    					<script>
							$('#divAlerta').hide();
    					</script>
						");
				}    			
		?>
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
    <script >
      if (!window.jQuery)
         alert("jquery não foi carregado");       
    </script>
  </body>
</html>
