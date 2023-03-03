<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastrocss.css">
    <script type="text/javascript" src="script/cadastroscp.js"></script>
</head>

<?php
	// Verificar se o formulário foi enviado corretamente
	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cadastrar'])) {
		// Obter os dados do formulário
		$nome = $_GET['nome'];
		$email = $_GET['email'];
		$senha = $_GET['senha'];

		// Verificar se o email já está cadastrado
		$host = "localhost";
		$user = "root";
		$password = "";
		$dbname = "rpgeducation";

		$conn = new mysqli($host, $user, $password, $dbname);

		if ($conn->connect_error) {
			die("Falha ao conectar ao banco de dados:" . $conn->connect_error);
		}

		$sql = "SELECT * FROM clientes WHERE email='$email'";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "Esse email já está cadastrado.";
			exit;
		}

		// Enviar a consulta SQL para inserir os dados
		$sql = "INSERT INTO clientes (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

		if ($conn->query($sql) === TRUE) {
			echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login.php';</script>";
		} else {
			echo "Erro ao realizar o cadastro: " . $conn->error;
		}

		// Fechar a conexão com o banco de dados
		$conn->close();
	}
?>

<body style="background-image: url(img/rpgwall.png);">
	<div class="container">
		<form method="get" action="cadastro.php" onsubmit="return validateForm()">
			<h2 style="color:white;">Cadastro</h2>
			<div class="inputBox">
				<input type="text" name="nome" id="nome" required>
				<label>Nome</label>
			</div>
			<div class="inputBox">
				<input type="email" name="email" id="email" required>
				<label>Email</label>
			</div>
			<div class="inputBox">
				<input type="password" name="senha" id="senha" required>
				<label>Senha</label>
			</div>
			<div class="inputBox">
				<input type="password" name="confirmarSenha" id="confirmarSenha" required>
				<label>Confirmar senha</label>
			</div>
			<input type="submit" name="cadastrar" value="Cadastrar">
            <button onclick="window.location.href='index.html'" style="margin-top: 10px;">Voltar</button>
		</form>
	</div>
	<script type="text/javascript" src="script.js"></script>
</body>
</html>