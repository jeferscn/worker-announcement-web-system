<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
	<title>Login de usuário</title>
	<?php
	include('config.php');
	session_start(); // inicia a sessao	
	?>
</head>

<body>
	<header>
		<nav>
			<div>
				<a href="index.php"><img src="img/logo.svg" alt=""></a>
			</div>
			<div class="nav-links menu-dropdown">
				<button class="mainmenubtn">Menu</button>
				<div class="dropdown-child">
					<a href="index.php#como-funciona">Como funciona?</a>
					<a href="profissionais.php?botao=Gerar">Ver profissionais</a>
					<?php
					if (!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) {
						echo '<a href="cadastro.php">Cadastrar-se</a>';
					}
					?>
					<?php
					if (isset($_SESSION["id_usuario"]) || isset($_SESSION["nome_usuario"])) {
						echo '<a href="criar-anuncio.php">Criar anúncio</a>';
					}
					?>
					<?php
					if (isset($_SESSION["id_usuario"]) || isset($_SESSION["nome_usuario"])) {
						echo '<a href="meus-anuncios.php">Meus anúncios</a>';
					}
					?>
					<?php
					if (@$_SESSION["nivel_usuario"] == "ADM") {
						echo '<a href="criar-categoria.php">Criar categoria</a>';
					}
					?>
					<?php
					if (@$_SESSION["nivel_usuario"] == "ADM") {
						echo '<a href="anuncios-pendentes.php">Anúncios pendentes</a>';
					}
					?>
					<?php
					if (!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) {
						echo '<a href="login.php">Entrar</a>';
					}
					?>
					<?php
					if (isset($_SESSION["id_usuario"]) || isset($_SESSION["nome_usuario"])) {
						echo '<a href="logout.php">Sair</a>';
					}
					?>
				</div>
			</div>
		</nav>
	</header>
	<?php
	if (@$_REQUEST['botao'] == "Entrar") {
		$login = $_POST['login'];
		$senha = md5($_POST['senha']);

		$query = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha' ";
		$result = mysqli_query($con, $query);
		while ($coluna = mysqli_fetch_array($result)) {
			$_SESSION["id_usuario"] = $coluna["id_usuario"];
			$_SESSION["login_usuario"] = $coluna["login"];
			$_SESSION["nome_usuario"] = $coluna["nome"];
			$_SESSION["nivel_usuario"] = $coluna["nivel"];

			// caso queira direcionar para páginas diferentes

			$niv = $coluna['nivel'];
			if ($niv == "USER") {
				echo "<script>alert('Login efetuado com sucesso!');top.location.href='index.php';</script>";
				exit;
			}

			if ($niv == "ADM") {
				echo "<script>alert('Seja bem vindo administrador');top.location.href='index.php';</script>";
				exit;
			}
			// ----------------------------------------------
		}
	}
	?>

	<div class="corpo-conteudo">
		<form class="form" action="#" method="post" name="usuario">
			<table width="100%" align="center">
				<tr>
					<td class="title" colspan="3">Login de usuário</td>
				</tr>
				<tr>
					<td>Login:</td>
					<td colspan="2"><input type="text" name="login" required placeholder="Login" value="<?php echo @$_POST['login']; ?>"></td>
				</tr>
				<tr>
					<td>Senha:</td>
					<td colspan="2"><input type="password" name="senha" required placeholder="Senha" value="<?php echo @$_POST['idade']; ?>"></td>
				</tr>
				<tr>
					<td colspan="3" align="right">
						<input class="submit-button" type="submit" value="Entrar" name="botao">
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>

</html>