<?php
	/**
	* In�cio da comunica��o com o servidor.
	* Introdu��o dos dados fornecidos pelo utilizador
	* e valida��o dos mesmos.
	* 
	* @author Tiago F. Cardoso e Rui Coelho
	*/
	
	ob_start();
	session_start();
	require_once('ti.php');
	$servername = "";
	$username = "";
	$password = "";
	
	/**
	 * Expira a sess�o passado 30 minutos.
	 */
	if (isset($_SESSION['timeout']) && (time() - $_SESSION['timeout'] > 1800)) {
		session_unset();
		session_destroy();
	}

	//  MUST BE REMOVED BEFORE PROD
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
?>