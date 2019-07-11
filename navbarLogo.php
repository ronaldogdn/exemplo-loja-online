<?php
	session_start();
?>
<div id="navegacao">
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
</div>