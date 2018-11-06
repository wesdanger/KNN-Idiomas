	<?php
	include("../conexao.php");
	mysqli_set_charset($conexao, "utf-8");
	date_default_timezone_set('America/Sao_Paulo');
	?>
<!DOCTYPE html>
<html>
	<head>
		<title>Inserção de Alunos</title>
		<meta charset="UTf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<style type="text/css">
		body{
			text-align: justify;
		}
		table{
			border:1px solid;
			padding: 5px;
		}
		td{
			border: 1px solid lightgray;
			font-size: 1em;
			padding: 5px
		}
		button{
			padding: 5px
		}
	</style>
	<script>
		function formatar(mascara, documento){
			var i = documento.value.length;
			var saida = mascara.substring(0,1);
			var texto = mascara.substring(i)

			if (texto.substring(0,1) != saida){
				documento.value += texto.substring(0,1);
			}

		}
	</script>
	<body>
			<a href="adm_func.php"><button>Voltar</button></a>
			<h1>Inserindo um aluno:</h1>
		<form name="aluno" action="" id="nha" method="POST">
			Nome:
			<input type="text" name="nome" placeholder="Insira o nome completo" required>
			Data de nascimento:
			<input type="date" name="data" required>
			CPF:
			<input type="text" name="cpf" placeholder="Insira um CPF válido" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" required><br>
			RG:
			<input type="text" name="rg" placeholder="Insira um RG válido" maxlength="10" OnKeyPress="formatar('##.###.###', this)" required>
			Telefone:
			<input type="text" name="tel" maxlength="13" placeholder="xx-xxxxx-xxxx" OnKeyPress="formatar('##-#####-####', this)" required><br>
			Nome do responável:
			<input type="text"  name="nomeResp" placeholder="Insira o nome do responável caso aluno seja menor de idade">
			Telefone do responsável:
			<input type="text" name="telResp" maxlength="13" placeholder="xx-xxxxx-xxxx" OnKeyPress="formatar('##-#####-####', this)"><br>
			Rua:
			<input type="text" name="rua" placeholder="Informe a rua" required>
			Numero:	
			<input type="text" name="nmr">
			Bairro:	
			<input type="text" name="bairro" placeholder="Insira o bairro" required> <br>
			Cidade:
			<input type="text" name="cidade" placeholder="Informe a cidade" required>
			UF:
			<input type="text" name="estado" maxlength="2" placeholder="Informe o estado" required>
			CEP:
			<input type="text" name="cep" maxlength="9" placeholder="Informe o CEP" OnKeyPress="formatar('#####-###', this)" required>
			E-mail:
			<input type="text" name="email" placeholder="Informe o e-mail"><br>
			Alergia alimentar:
			<input type="text" name="alergiaalimentar" placeholder="Informe as doenças">
			Remédio:
			<input type="text" name="remedio" placeholder="Informe os remédios"><br>
			Alergia:
			<input type="text" name="alergia" placeholder="Informe as alergias">
			<hr>
			<h4>Informações do Login:</h4>
			Nome de usuário:
			<input type="text" name="login" placeholder="Insira o nome de usuário desejado"><br>
			Senha:
			<input type="password" name="senha" maxlength="16" placeholder="Insira a senha desejado"><br><br>
			<input type="submit" name="inserir" value="INSERIR">
			<input type="reset" name="limpar" value="LIMPAR">
		</form>
	</body>
</html>
<?php
	//Pega os "name" do formulário acima e coloca nas variáveis através do método POST.
	if(isset($_POST['inserir'])){
		$nome = $_POST['nome'];
		$datanasc = $_POST['data'];
		$cpf = $_POST['cpf'];
		$rg = $_POST['rg'];
		$contato = $_POST['tel'];
		$nomeresp = $_POST['nomeResp'];
		$contatoresp = $_POST['telResp'];
		$rua = $_POST['rua'];
		$nmr = $_POST['nmr'];
		$login = $_POST['login'];
		$senha = $_POST['senha'];
		$priv = "usr";
		$bairro = $_POST['bairro'];
		$uf = $_POST['estado'];
		$cep = $_POST['cep'];
		$email = $_POST['email'];
		$alergiaalimentar = $_POST['alergiaalimentar'];
		$remedio = $_POST['remedio'];
		$alergia = $_POST['alergia'];
		$cidade = $_POST['cidade'];

		//Faz a inserção dos dados digitados pelo usuário no formulário acima na tabela "aluno" contida no BD.
		$aluno = mysqli_query($conexao,"INSERT INTO aluno(nome, cpf, rg, datanascimento, telefonealuno, nomeresponsavel, telefoneresponsavel, rua, numero, bairro, cidade, estado, cep, email, alergiaalimentar, remedio, alergia) VALUES ('$nome','$cpf', '$rg', '$datanasc', '$contato', '$nomeresp', '$contatoresp', '$rua', '$nmr', '$bairro', '$cidade', '$uf', '$cep', '$email','$alergiaalimentar','$remedio','$alergia')");

		//Cria um login para o aluno inserido acima.
		$login = mysqli_query($conexao,"INSERT INTO login(usuario, senha, privilegio, al) VALUES ('$login', '$senha', '$priv', '$cpf')");
		if(!$aluno){
			header("location:inserir_al.php?false");
			echo "Erro ao realizar cadastro. Tente outra vez.";
			exit;
		}else{
			header("location:inserir_al.php?true");
			echo "Cadastro concluído com sucesso!";
		}
	}
?>