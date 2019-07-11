<?php    
    require_once "php/funcoes.php"; 
	session_start();
	
	$cliente = $_SESSION['cliente'];
	if(empty($cliente)){
		header("location: index.php");
	}
	$id = $cliente['id'];
	
	if(!empty($_POST))
	{    
		$senhaValida = validarNovaSenha($_POST['id'],$_POST['senhaAntiga']);
		if(empty($senhaValida)){
			echo("
				<script>
					alert('senha antiga inválida');
				</script>
			");
		}
		else{
			salvarClienteSenhaNova($_POST);	
			header("location: minhaConta.php");
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
    <!--  aqui vai o navbar-->
    <?php
		include_once "php/navbar.php";
	?>
    <!-- fim navbar-->
    
    <!-- fim navbar-->    
    <!-- aqui fica a parte da logo-->
    <div id="navegacao"></div>
    <!-- fim logo -->
        
    <main role="main">      
		<div class="container">
			<h2 class="my-0 mr-md-auto font-weight-normal">Cadastro de clientes</h2>
            <form action="trocarSenha.php" method="POST" id="formulario">
				<input type="hidden" name="id"  value="<?=$id?>"/>
				<div class="form-group">
                  <label for="login">Login</label>
                  <input type="text" class="form-control" name="login" id="login" required
                  placeholder="digite seu login ou digite um novo login" >
                </div>
				<div class="form-group">
                  <label for="senhaAntiga">Senha antiga</label>
                  <input type="password" class="form-control" name="senhaAntiga" id="senhaAntiga" required
				  placeholder="digite sua senha antiga" >
                </div>
				<div class="form-group">
                  <label for="senha">Nova senha</label>
                  <input type="password" class="form-control" name="senha" id="senha" required
				  placeholder="digite a nova senha" >
                </div>
				<div class="form-group">
                  <label for="confirma_senha">Confirma a senha</label>
                  <input type="password" class="form-control" name="confirma_senha" id="confirma_senha" required
				  placeholder="digite novamente a nova senha" >
                </div>	
                <button type="submit" class="btn btn-primary">Salvar</button>								
            </form>
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
	<script type="text/javascript" src="js/jquery.mask.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>

	
	<script>
		var password = document.getElementById("senha"), 
		    confirm_password = document.getElementById("confirma_senha");
        function validatePassword()
		{
			if(password.value != confirm_password.value) 
			{
				confirm_password.setCustomValidity("Senhas estão diferentes!");
			} 
			else
			{
				confirm_password.setCustomValidity('');
			}
		}
           password.onchange = validatePassword;
           confirm_password.onkeyup = validatePassword;
	</script>
		
	
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
