<?php include('global_init.php'); ?>

<?php 
	// Inicializações
	header('Content-Type: application/json');
	$ret = array();
	// Create connection
	$conn = new mysqli($servername, $username, $password);

	$conn->select_db("aauav-nei");
	// no caso de não termos conseguido ligar à BD ou não conseguirmos utilizar o utf8 (necessário por causa do encoding do json)
	if($conn->connect_error || !$conn->set_charset("utf8")){
		header('HTTP/1.1 503 Service Temporarily Unavailable');
		header('Status: 503 Service Temporarily Unavailable');
		$ret["code"] = 503;
		$ret["msg"] = "Service Unavailable";
		echo json_encode($ret);
		exit();
	}

	$query_GetApontamentosByDisciplina="SELECT link_ficheiro, nome_recurso, autor FROM NEI_Disciplina_Apontamentos WHERE disciplina = ?";
	$query_GetDisciplinasByAnoBySemestre = "SELECT paco_code, nome FROM `NEI_Disciplina` WHERE ano= ? AND semestre= ?";
	//$query_GetDisciplinasByAno = "SELECT * FROM `NEI_Disciplina` WHERE ano= ?";
	//$query_GetDisciplinasBySemestre = "SELECT * FROM `NEI_Disciplina` WHERE semestre= ?";
?>
<?php
	// validação da sessão, para impedir acederem sem o login feito
	if(!(isset($_SESSION['valid'])) || !($_SESSION['valid'])) {
		$ret["code"] = 400;
		$ret["msg"] =  "INVALID REQUEST";
		header('HTTP/1.1 400 Bad Request');
		header('Status: 400 Bad Request');
		$conn->close();
		echo json_encode($ret);
		exit();
	}

	// caso mais simples, se apenas pedirem pela disciplina
	if(isset($_GET['disciplina_id'])){
		$stmt = $conn->prepare($query_GetApontamentosByDisciplina);
		if(!$stmt) {
			$ret["code"] = 503;
			header('HTTP/1.1 503 Service Temporarily Unavailable');
			header('Status: 503 Service Temporarily Unavailable');
			
			echo json_encode($ret);
			$conn->close();
			exit();
		}
		$stmt->bind_param('i',$_GET['disciplina_id']);
		$stmt->execute();
		$result = $stmt->get_result();
		$ret["code"] = 200;
		$ret["data"] = array();
		if ($result->num_rows > 0) {
			while( $row = $result->fetch_assoc()) {
				$ret["data"][ ] = array(
					"nome" => $row["nome_recurso"],
					"autor" => $row["autor"],
					"link" => $row["link_ficheiro"]
				);
			}
		}

	}
	// se pedirem pelo semestre e ano, vamos devolver a informação da disciplinas
	else{
		if(isset($_GET['ano']) && isset($_GET['semestre'])){
			$stmt = $conn->prepare($query_GetDisciplinasByAnoBySemestre);
			if(!$stmt) {
				$ret["code"] = 503;
				header('HTTP/1.1 503 Service Temporarily Unavailable');
				header('Status: 503 Service Temporarily Unavailable');
				echo json_encode($ret);
				$conn->close();
				exit();
			}

			$stmt->bind_param('ii', $_GET['ano'], $_GET['semestre']);
			$stmt->execute();
			$result = $stmt->get_result();
			$ret["code"] = 200;
			$ret["data"] = array();
			if ($result->num_rows > 0) {
				while ( $row = $result->fetch_assoc()) {
					$ret["data"][ ] = array(
						"id" => $row["paco_code"],
						"nome" => $row["nome"],
					);
				}
			}		
		}
		// TODO: Talvez no futuro separar. Mas de momento, desnecessário, por isso apenas devolvemos a mensagem de erro
		else {
			$ret["code"] = 400;
			$ret["msg"] =  "INVALID REQUEST";
			header('HTTP/1.1 400 Bad Request');
			header('Status: 400 Bad Request');
		}
	}
	$conn->close();
	echo json_encode($ret);
	exit();
?>