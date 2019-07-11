<?php
	session_start();
	
	if( !empty($_SESSION['cliente']) )
	{
		setcookie(session_name(),'',time()-42000);
		session_destroy();		
	}
	if( !empty($_SESSION['vendedores']) )
	{
		setcookie(session_name(),'',time()-42000);
		session_destroy();		
	}
	header("location: ../index.php");

