<?php  
	/*By Joao Artur*/
	if(count($argv)==2) {
		$conteudo = xml_parser_create();
		$cep=str_replace("-", "", $argv[1]);
		xml_parse_into_struct($conteudo, file_get_contents("http://cep.republicavirtual.com.br/web_cep.php?cep=$cep&format=query_string"), $valores, $conteudo1);
		
		$status = $valores[3]['value'];
		if ($status == "sucesso - cep não encontrado") {
			print("CEP nao encontrado.\n");
		} else {
			$uf = $valores[5]['value'];
			$cidade = $valores[7]['value'];
			$bairro = $valores[9]['value'];
			$tipo = $valores[11]['value'];
			$nome = $valores[13]['value'];
			print("Estado: $uf\nCidade: $cidade\nBairro: $bairro\n".ucfirst($tipo)." $nome\n");
		}		
	} else {
		print("Uso: php" . $_SERVER['SCRIPT_NAME'] . " cep");
	}
?>