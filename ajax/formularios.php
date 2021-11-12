<?php
	include('../config.php');
	$data = [];
	$assunto = 'Nova mensagem do site!';
		$corpo = '';
		foreach ($_POST as $Key => $value) {
			$corpo.=ucfirst($key).": ".$value;
			$corpo.="<hr>";
		}
		$info = array('assunto'=>$assunto,'corpo'=>$corpo);
		$mail = new Email();
		$mail->addAdress();
		$mail->formatarEmail($info);
		if($mail->enviarEmail()){
			$data['sucesso'] = true;
		}else{
 			$data['erro'] = true;
		}

		die(json_encode($data));

		//<?php
			// if(isset($_POST['acao']) && $_POST['idenfitador'] == 'form_home'){
			// 	//Enviei o formulário.
			// 	if($_POST[email] !=''){
			// 		$email = $_POST['email'];
			// 		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			// 			//Tudo certo, é um email,
			// 			//Só enviar.
			// 			$mail = new Email();
			// 			$mail->addAdress();
			// 			$corpo = "E-mail cadastrado na home do site:<hr>$email";
			// 			$info = array('assunto'=>'Um novo e-mail cadastrado no site!','corpo'=>$corpo);
			// 			//$info = ['assunto'=>'Um novo e-mail cadastrado no site!','corpo'=>$email]; ou pode ser assim.
			// 			$mail->formatarEmail($info);
			// 			if($mail->enviarEmail()){
			// 				echo '<script>alert("Enviado com sucesso!")</script>';
			// 			}else{
			// 				echo '<script>alert("Algo deu errado.")</script>';
			// 			}

			// 		}else{
			// 			echo '<script>("Não é um e-mail válido")</script>';
			// 		}
			// 	}else{
			// 		echo '<script>("Campos vázios não são permitidos")</script>';
			// 	}
			//}else if(isset($_POST['acao']) && $_POST['idenfitador'] == 'form_home'){
					/*$nome = $_POST[''];
					$email = $_POST[''];
					$mensagem = $_POST[''];
					$telefone = $_POST[''];
					$assunto = 'Nova mensagem do site!';
					$corpo = '';
					foreach ($_POST as $Key => $value) {
						$corpo.=ucfirst($key).": ".$value;
						$corpo.="<hr>";
					}
					$info = array('assunto'=>$assunto,'corpo'=>$corpo);
					$mail = new Email();
					$mail->addAdress();
					$mail->formatarEmail($info);
					if($mail->enviarEmail()){
						echo '<script>("Não é um e-mail válido")</script>';
					}else{
 						echo '<script>("Campos vázios não são permitidos")</script>';
					}
			}
		?> -->*/
?>