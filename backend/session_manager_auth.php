<?php
session_start();

if ($_POST["operation"] == 'addAtividade') {
	$atividadeToAdd = $_POST["novaAtividade"];

	$nome = $_SESSION["login"];
	$url = "data/" . $nome . ".json";
	$json = file_get_contents($url);
	$data = json_decode($json);

	array_push($data->atividades, $atividadeToAdd);

	$atividadesJSON = json_encode($data->atividades);
	$_SESSION["atividades"] = $atividadesJSON;

	$url = "data/" . $nome . ".json";
	$arquivo = $url;
	$json = json_encode($data);
	$file = fopen(__DIR__ . '/' . $arquivo, 'w');
	fwrite($file, $json);
	fclose($file);
	echo '{ "resultado" : "adicionado" }';
} else if ($_POST["operation"] == 'deleteAtividade') {
	$nome = $_SESSION["login"];
	$url = "data/" . $nome . ".json";
	$json = file_get_contents($url);
	$data = json_decode($json);

	$posicao = intval($_POST["index"]);
	$new_atividades = [];
	$i = 0;
	for ($i = 0; $i < count($data->atividades); $i++) {
		if ($data->atividades[$i]->index != $posicao) {
			array_push($new_atividades, $data->atividades[$i]);
		}
	}
	$data->atividades = $new_atividades;

	$atividadesJSON = json_encode($data->atividades);
	$_SESSION["atividades"] = $atividadesJSON;
	$nome = $_SESSION["login"];
	$url = "data/" . $nome . ".json";
	$arquivo = $url;
	$json = json_encode($data);
	$file = fopen(__DIR__ . '/' . $arquivo, 'w');
	fwrite($file, $json);
	fclose($file);
	echo '{ "resultado" : "deletado" }';
} else if ($_POST["operation"] == 'editAtividade') {

	$atividadeEditada = $_POST["atividade"];
	$novaData = $_POST["newDate"];
	$id = intval($_POST["index"]);

	$nome = $_SESSION["login"];
	$url = "data/" . $nome . ".json";
	$json = file_get_contents($url);
	$data = json_decode($json);

	for ($i = 0; $i < count($data->atividades); $i++) {
		if ($data->atividades[$i]->index == $id) {
			$data->atividades[$i]->atividade = $atividadeEditada;
			$data->atividades[$i]->date = $novaData;
		}
	}

	$atividadesJSON = json_encode($data->atividades);
	$_SESSION["atividades"] = $atividadesJSON;
	$nome = $_SESSION["login"];
	$url = "data/" . $nome . ".json";
	$arquivo = $url;
	$json = json_encode($data);
	$file = fopen(__DIR__ . '/' . $arquivo, 'w');
	fwrite($file, $json);
	fclose($file);

	echo '{ "resultado" : "editado" }';
} else if ($_POST["operation"] == 'markDoneAtividade') {

	$newStatus = $_POST["status"];
	$id = intval($_POST["index"]);

	$nome = $_SESSION["login"];
	$url = "data/" . $nome . ".json";
	$json = file_get_contents($url);
	$data = json_decode($json);

	for ($i = 0; $i < count($data->atividades); $i++) {
		if ($data->atividades[$i]->index == $id) {
			$data->atividades[$i]->status = $newStatus;
		}
	}

	$atividadesJSON = json_encode($data->atividades);
	$_SESSION["atividades"] = $atividadesJSON;
	$nome = $_SESSION["login"];
	$url = "data/" . $nome . ".json";
	$arquivo = $url;
	$json = json_encode($data);
	$file = fopen(__DIR__ . '/' . $arquivo, 'w');
	fwrite($file, $json);
	fclose($file);
	echo '{ "resultado" : "concluida" }';
} else if ($_POST["operation"] == 'load') {
	if (isset($_SESSION["login"])) {
		$login = $_SESSION["login"];

		$path = "data/";

		$users = array();
		$types = array('json');
		$dir = new DirectoryIterator($path);
		foreach ($dir as $fileInfo) {
			$ext = strtolower($fileInfo->getExtension());
			if (in_array($ext, $types)) {
				$user = $fileInfo->getFilename();
				array_push($users, $user);
			}
		}

		if (in_array($login . '.json', $users)) {
			for ($i = 0; $i < count($users); $i++) {

				if ($users[$i] == $login . '.json') {

					$url = "data/" . $login . ".json";
					$json = file_get_contents($url);
					$data = json_decode($json);

					$nomeJSON = $data->nome;
					$loginJSON = $data->login;
					$senhaJSON = $data->senha;
					$atividadesJSON = json_encode($data->atividades);

					if ($login == $loginJSON) {

						$_SESSION["nome"] = $nomeJSON;
						$_SESSION["login"] = $loginJSON;
						$_SESSION["atividades"] = $atividadesJSON;

						echo '{ "nome" : "' . $_SESSION["nome"] .
							'", "login" : "' . $_SESSION["login"] .
							'", "status" : "logado"
								 , "atividades" : ' . $_SESSION["atividades"] . '
								, "arquivo": "' . $users[$i] . '" }';

						break;
					} else {
						echo '{ "nome" : "undefined" }';
					}
				}
			}
		} else {
			echo '{ "nome" : "undefined" }';
		}
	} else {
		echo '{ "nome" : "undefined" }';
	}
} else if ($_POST["operation"] == 'login') {
	if (!(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))) {
		echo '{ "status" : "nao_logado" }';
		header('HTTP/1.0 401 Unauthorized');
	} else {
		$login = $_SERVER["PHP_AUTH_USER"];
		$senha = $_SERVER['PHP_AUTH_PW'];

		$path = "data/";

		if (!(empty($login))) {
			$users = array();
			$types = array('json');
			$dir = new DirectoryIterator($path);

			foreach ($dir as $fileInfo) {
				$ext = strtolower($fileInfo->getExtension());
				if (in_array($ext, $types)) {
					$user = $fileInfo->getFilename();
					array_push($users, $user);
				}
				if (count($users) == 0) {
					$newUser = array(
						"nome" => $login,
						"login" => $login,
						"senha"  => $senha,
						"atividades" => []
					);
					array_push($users, $newUser);
				}
			}
			for ($i = 0; $i < count($users); $i++) {
				if ($users[$i] == $login . ".json") {
					$url = "data/" . $login . ".json";
					$json = file_get_contents($url);
					$data = json_decode($json);
					$nomeJSON = $data->nome;
					$loginJSON = $data->login;
					$senhaJSON = $data->senha;
					$atividadesJSON = json_encode($data->atividades);

					if ($login == $loginJSON && $senha == $senhaJSON) {
						$_SESSION["nome"] = $nomeJSON;
						$_SESSION["login"] = $loginJSON;
						$_SESSION["atividades"] = $atividadesJSON;

						echo '{ "nome" : "' . $_SESSION["nome"] .
							'", "login" : "' . $_SESSION["login"] .
							'", "status" : "logado"
									 , "atividades" : ' . $_SESSION["atividades"] . '
									, "arquivo": "' . $users[$i] . '" }';
						break;
					} else {
						echo '{ "status" : "nao_logado" }';
						header('HTTP/1.0 401 Unauthorized');
					}
				} else if (!(in_array($login . '.json', $users))) {

					$newUser = array(
						"nome" => $login,
						"login" => $login,
						"senha"  => $senha,
						"atividades" => []
					);
					$url = "data/" . $login . ".json";
					$json = json_encode($newUser);
					file_put_contents($url, $json);
					array_push($users, $login . '.json');
				}
			}
		} else {
			echo  '{ "status" : "usuario vazio" }';
		}
	}
} else if ($_POST["operation"] == 'logout') {

	session_destroy();
	echo '{ "nome" : "undefined" }';
} else {

	echo '{ "invalid_operation" : "' . $_POST["operation"] . '" }';
}
