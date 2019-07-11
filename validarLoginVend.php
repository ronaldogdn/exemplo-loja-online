<?php
	require_once "funcoes.php"; 
	session_start();
	$alerta = "";
	$login = $_POST['login'];
	$senha = $_POST['senha'];

	$retorno = validarLoginVend($login,$senha);
	if(!empty($retorno))
	{
		$id = $retorno['id'];
		$vend = buscarVendedor($id);
		$_SESSION['vendedores'] = $vend;
		header("location: ../cadastroVendedores.php");
	}
	else
	{
		$alerta = "inválidos";
		$_SESSION['alerta'] = $alerta;
		header("location: ../login.php");
	}

