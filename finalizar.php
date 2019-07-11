<?php
	require_once "php/funcoes.php";
	session_start();
	$cliente  = $_SESSION['cliente'];
	$carrinho = $_SESSION['carrinho'];
	if(empty($cliente)){
		echo"
			<script>
				alert('Faça login');
			</script>
		";
		header("location: carrinho.php");
	}
	if(empty($carrinho)){
		echo"
			<script>
				alert('O carrinho está vazio');
			</script>
		";
		header("location: index.php");
	}
	finalizarPedido($cliente, $carrinho);
	
	header("location: index.php");
	
	
	