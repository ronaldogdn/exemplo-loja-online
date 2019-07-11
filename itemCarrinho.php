<?php
	session_start();
	require_once "php/funcoes.php";
	
	if(!empty($_GET)){
		$id = $_GET['id'];
		$numero = $_GET['numero'];
		if($_GET['acao'] == 'retirar'){			
			retiraPedido($numero);
			foreach($_SESSION['carrinho'] as $indice => $item) 
			{
				if($item['id'] == $id){
					unset($_SESSION['carrinho'][$indice]);
				}
			}
			header("location: carrinho.php");
		}
		
		$retorno = verificaPedido($numero);
		$qtd     = $retorno['quantidade'];
		$retorno = verificaValor($id);
		$valor   = number_format($retorno['valor'],2,',','');
		
		if($_GET['acao'] == 'somar'){
			soma($valor,$qtd,$numero);
		}
		else if($_GET['acao'] == 'subtrair'){
			subtrair($valor,$qtd,$numero);
		}
		header("location: carrinho.php");
	}

