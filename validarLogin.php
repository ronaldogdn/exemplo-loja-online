<?php
	require_once "funcoes.php"; 
	session_start();
	$alerta = "";
	$login = $_POST['login'];
	$senha = $_POST['senha'];

	$retorno = validarLogin($login,$senha);
	if(!empty($retorno))
	{
		$id = $retorno['id'];
		$cliente = buscarCliente($id);
		$_SESSION['cliente'] = $cliente;
		header("location: ../index.php");
	}
	else
	{
		$alerta = "inválidos";
		$_SESSION['alerta'] = $alerta;
		header("location: ../login.php");
	}

