<?php	
	define("DSN","mysql");
	define("SERVIDOR","localhost");
	define("USUARIO","root");
	define("SENHA","");
	define("BANCODEDADOS","projetofinal");

	function conectar() {    
		try {
			$conn = new PDO(DSN.':host='.SERVIDOR.';dbname='.
			BANCODEDADOS, USUARIO, SENHA,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			return $conn;
		} catch (PDOException $e) {
			echo ''.$e->getMessage();
		}
	}

	
    function salvarVendedores($vendedor)
	{
        $conn = conectar(); 
		$stmt = $conn->prepare
						(
						'INSERT INTO vendedores (nome, cpf, dtNascimento, id_estado, id_cidade, idade,
												 matricula, setor, login, senha) 
						VALUES(:nome, :cpf, :dtNascimento, :id_estado, :id_cidade, :idade, :matricula, :setor,
							   :login, :senha)'
						);					  
		$stmt->bindParam(':nome',$vendedor['nome']);
		$stmt->bindParam(':cpf',$vendedor['cpf']);
		$stmt->bindParam(':dtNascimento',$vendedor['dtNascimento']);
		$stmt->bindParam(':id_estado',$vendedor['estado']);
		$stmt->bindParam(':id_cidade',$vendedor['cidade']);
		$stmt->bindParam(':idade',$vendedor['idade']);		
		$stmt->bindParam(':matricula',$vendedor['matricula']);
		$stmt->bindParam(':setor',$vendedor['setor']);
		$stmt->bindParam(':login',$vendedor['login']);
		$stmt->bindParam(':senha',$vendedor['senha']);
		if ($stmt->execute()) {
			return "Cliente inserido com sucesso!";
		} else {
			print_r($stmt->errorInfo());
			return "erro! ";
		}	
    }
	function validarLoginVend($login,$senha)
	{
		$conn = conectar();		
		$stmt = $conn->prepare("select id from vendedores 
								where login = :login and senha = :senha"
							  );
		$stmt->bindParam(":login",$login);	  
		$stmt->bindParam(":senha",$senha);	  
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	function buscarVendedor($id)
	{
		$conn = conectar();    
		$stmt = $conn->prepare("select id, nome, cpf,idade,dtNascimento,id_estado, id_cidade, matricula, setor
								from vendedores 
								where id = :id"
							   );
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}  
	
	
	
	function salvarClientes($cliente)
	{   
		$conn = conectar(); 
		$stmt = $conn->prepare
						(
						'INSERT INTO cliente (nome, cpf, dtNascimento, id_estado, id_cidade, idade,  login, senha) 
						VALUES(:nome, :cpf, :dtNascimento, :id_estado, :id_cidade, :idade, :login, :senha)'
						);					  
		$stmt->bindParam(':nome',$cliente['nome']);
		$stmt->bindParam(':cpf',$cliente['cpf']);
		$stmt->bindParam(':dtNascimento',$cliente['dtNascimento']);
		$stmt->bindParam(':id_estado',$cliente['estado']);
		$stmt->bindParam(':id_cidade',$cliente['cidade']);
		$stmt->bindParam(':idade',$cliente['idade']);		
		$stmt->bindParam(':login',$cliente['login']);
		$stmt->bindParam(':senha',$cliente['senha']);
		if ($stmt->execute()) {
			return "Cliente inserido com sucesso!";
		} else {
			print_r($stmt->errorInfo());
			return "erro! ";
		}
    }	
    //funcao para retornar os clientes
    function listarClientes()
	{
		$conn = conectar();    
		$stmt = $conn->prepare("select id, nome from cliente order by id");
		$stmt->execute();
		$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $retorno;

    }
	function listarPaises()
	{
		$conn = conectar();		
		$stmt = $conn->prepare("select id, nome, sigla from pais order by nome");
		$stmt->execute();
		$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $retorno;
	}
	//
	function buscarCliente($id)
	{
		$conn = conectar();    
		$stmt = $conn->prepare("select id, nome, cpf,idade,dtNascimento,id_estado, id_cidade
								from cliente 
								where id = :id"
							   );
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	function excluirCliente($id)
	{
		$conn = conectar();    
		$stmt = $conn->prepare("DELETE FROM cliente 
								WHERE id = :id"
							   );
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);

	}	
	function editarCliente($cliente)
	{
		$conn = conectar();    
		$stmt = $conn->prepare(
								'UPDATE cliente 
								  set nome = :nome, cpf = :cpf, id_estado = :id_estado, id_cidade = :id_cidade, idade = :idade, dtNascimento = :dtNascimento
								where id = :id'
							  );
		$stmt->bindParam(':nome',$cliente['nome']);
		$stmt->bindParam(':cpf',$cliente['cpf']);
		$stmt->bindParam(':id',$cliente['id']);
		$stmt->bindParam(':id_estado',$cliente['estado']);
		$stmt->bindParam(':id_cidade',$cliente['cidade']);
		$stmt->bindParam(':idade',$cliente['idade']);
		$stmt->bindParam(':dtNascimento',$cliente['dtNascimento']);
		if ($stmt->execute()) {
			return "Cliente alterado com sucesso!";
		} else {
			print_r($stmt->errorInfo());			
			return "erro! ";
		}
	}
	function validarLogin($login,$senha)
	{
		$conn = conectar();		
		$stmt = $conn->prepare("select id from cliente 
								where login = :login and senha = :senha"
							  );
		$stmt->bindParam(":login",$login);	  
		$stmt->bindParam(":senha",$senha);	  
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	function validarNovaSenha($id,$senha)
	{
		$conn = conectar();    
		$stmt = $conn->prepare("select id, senha 
								from cliente 
								where id = :id and senha = :senha"
							   );
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':senha',$senha);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	function finalizarPedido($cliente, $carrinho) 
	{
		$conn = conectar();  
		$conn->beginTransaction();
		$quantidade = 0;
		
		$id_pedido = $conn->lastInsertId(); 
		
		foreach ($carrinho as $produto)
		{			
			$stmt = $conn->prepare("select quantidade, valor_total 
								   from pedido
								   where numero = :numero"
								  );
			$stmt->bindParam(':numero',$produto['numero']);			
			$stmt->execute();
			
			$quantidade = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$stmt = $conn->prepare("insert into item_pedido (ID_PRODUTO,ID_PEDIDO,VALOR_UNITARIO,
				QUANTIDADE,VALOR_TOTAL) values (:id_produto,:id_pedido,:valor_unitario, :quantidade, :valor_total)");
				
			$stmt->bindParam(':id_produto',$produto['id']);
			$stmt->bindParam(':id_pedido', $id_pedido);
			$stmt->bindParam(':valor_unitario', $produto['valor']);
			$stmt->bindParam(':quantidade', $quantidade['quantidade']);
			$stmt->bindParam(':valor_total', $quantidade['valor_total']);
			$stmt->execute();
		}
		$conn->commit();
	}
	
	function verificaPedido($numero)
	{
		$conn = conectar();    
		$stmt = $conn->prepare("select quantidade
								from pedido
								where numero = :numero "
							   );
		$stmt->bindParam(':numero',$numero);			
		$stmt->execute();
		$erro = $stmt->fetch(PDO::FETCH_ASSOC); 
		return $erro;
	}
	function verificaValor($id)
	{
		$conn = conectar();    
		$stmt = $conn->prepare("select valor 
								from produto
								where id = :id "
							   );
		$stmt->bindParam(':id',$id);			
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	function salvarPedido($cliente, $carrinho,$id) 
	{
		$quantidade = 1;
		$conn = conectar();
		$aux = false;
		foreach($carrinho as $indice => $produto)
		{
			if($produto['id'] == $id)
			{
				$aux = true;
			}
		}
		if($aux == false){
			return false;
		}
		$stmt = $conn->prepare("INSERT INTO pedido(ID_CLIENTE, NUMERO, QUANTIDADE, VALOR_TOTAL, DT_COMPRA) 
									   values (:id_cliente,:numero, :quantidade,:valor_total,now() )
									   ");
		$stmt->bindParam(':id_cliente',$cliente['id']);
		$stmt->bindParam(':numero',$produto['numero']);
		$stmt->bindParam(':quantidade',$quantidade);
		$stmt->bindParam(':valor_total',$produto['valor']);	
		$stmt->execute();
	}

	function salvarProduto($produto)
	{   
		$conn = conectar(); 
		$stmt = $conn->prepare
						(
						'INSERT INTO produto (nome, descricao_curta, descricao, valor, url, numero) 
						VALUES(:nome, :descricao_curta, :descricao, :valor, :url, :numero)'
						);
					  
		$stmt->bindParam(':nome',$produto['nome']);
		$stmt->bindParam(':descricao_curta',$produto['descricao_curta']);
		$stmt->bindParam(':descricao',$produto['descricao']);
		$stmt->bindParam(':valor',$produto['valor']);
		$stmt->bindParam(':url',$produto['url']);
		$stmt->bindParam(':numero',$produto['numero']);
		if ($stmt->execute()) {
			return "Produto inserido com sucesso!";
		} else {
			$erro = $stmt->errorInfo();			
			return $erro;
		}
    }
	
	function listarProdutos()
	{
		$conn = conectar();    
		$stmt = $conn->prepare("select id, nome, descricao, descricao_curta, valor, url, numero
								from produto
								order by id"
							  );
		$stmt->execute();
		$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $retorno;

    }
	function buscarProduto($id)
	{
		$conn = conectar();    
		$stmt = $conn->prepare("select id, nome, descricao_curta, descricao, valor, url, numero 
								from produto 
								where id = :id"
							   );
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	function listarEstado()
	{
		$conn = conectar();		
		$stmt = $conn->prepare("select id, nome, sigla from estado order by nome");
		$stmt->execute();
		$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $retorno;
	}
	
	function listarCidade()
	{
		$conn = conectar();		
		$stmt = $conn->prepare("select id, nome, sigla from cidade order by nome");
		$stmt->execute();
		$retorno = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $retorno;
	}
	function salvarClienteSenhaNova($cliente)
	{
		$conn = conectar();    
		$stmt = $conn->prepare(
								'UPDATE cliente 
								  set login = :login, senha = :senha
								where id = :id'
							  );
		$stmt->bindParam(':id',$cliente['id']);
		$stmt->bindParam(':login',$cliente['login']);
		$stmt->bindParam(':senha',$cliente['senha']);
		if ($stmt->execute()) {
			return "Cliente alterado com sucesso!";
		} else {
			print_r($stmt->errorInfo());
			return "erro! ";
		}
	}
	
	function soma($valor,$qtd,$numero)
	{
		$qtd += 1;
		$total = $valor * $qtd;
		$conn = conectar();    
		$stmt = $conn->prepare(
								'UPDATE pedido 
								  set quantidade = :quantidade, valor_total = :total
								where numero = :numero'
							  );
		$stmt->bindParam(':numero',$numero);
		$stmt->bindParam(':quantidade',$qtd);
		$stmt->bindParam(':total',$total);
		if ($stmt->execute()) {
			return "Cliente alterado com sucesso!";
		} else {
			print_r($stmt->errorInfo());
			return "erro! ";
		}
	}
	function subtrair($valor,$qtd,$numero)
	{
		if($qtd <= 1){
			$qtd = 1;
		}else{
			$qtd -= 1;
		}
		$total = $valor * $qtd;
		$conn = conectar();    
		$stmt = $conn->prepare(
								'UPDATE pedido 
								  set quantidade = :quantidade, valor_total = :total
								where numero = :numero'
							  );
		$stmt->bindParam(':numero',$numero);
		$stmt->bindParam(':quantidade',$qtd);
		$stmt->bindParam(':total',$total);
		if ($stmt->execute()) {
			return "Cliente alterado com sucesso!";
		} else {
			print_r($stmt->errorInfo());
			return "erro! ";
		}
	}
	
	function retiraPedido($numero)
	{
		$conn = conectar();    
		$stmt = $conn->prepare("DELETE FROM pedido
								where numero = :numero"
						   );
		$stmt->bindParam(':numero',$numero);
		$stmt->execute();
		if ($stmt->execute())
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);			
		}
	}
	function somaTotal($carrinho)	
	{
		$soma = 0;
		foreach($carrinho as $indice => $item)
		{
			$id = $item['id'];
			$result = aux($id);
			$soma += $result['total'];
		}
		
		return $soma;
		
	}
	
	
	
	
	
	
	
	
	
	
	