<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    <title>Cadastrar-se</title>
    <?php include('config.php');
    session_start();
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
                    <a href="profissionais.php?botao=Gerar">Ver profissionais</a><?php
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

    if (@$_REQUEST['botao'] == "Gravar") {

        $senha = md5(@$_POST['senha']);
        $nivel = "USER";
        $login_existente;

        $verifica_registro = "SELECT * FROM usuario WHERE login='{$_REQUEST['login']}'";
        $result_verifica_registro = mysqli_query($con, $verifica_registro);

        if (mysqli_num_rows($result_verifica_registro) > 0) {
            $login_existente = "Este login já existe, tente outra opção!";
            echo mysqli_error($con);
        } else {
            $insere = "INSERT into usuario (nome, login, senha, nivel) VALUES ('{$_POST['nome']}', '{$_POST['login']}', '$senha', '$nivel')";
            $result_insere = mysqli_query($con, $insere);
            echo "<script>alert('Cadastro efetuado com sucesso!');top.location.href='login.php';</script>";
        }
    }
    ?>
    <form class="form" action="cadastro.php" method="post" name="usuario">
        <table width="100%" align="center">
            <tr>
                <td class="title" colspan="3">Cadastrar-se</td>
            </tr>
            <tr>
                <td>Nome:</td>
                <td colspan="2"><input type="text" name="nome" required placeholder="Nome" value="<?php echo @$_POST['nome']; ?>"></td>
            </tr>
            <td>Login:</td>
            <td colspan="2"><input type="text" name="login" maxlength="30" minlength="3" required placeholder="Login" value="<?php echo @$_POST['login']; ?>"></td>
            </tr>
            <tr>
                <td>Senha:</td>
                <td colspan="2"><input type="password" name="senha" maxlength="30" minlength="3" required placeholder="Senha" value="<?php echo @$_POST['senha']; ?>"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <p align="center">
                        <script>
                            document.write("<?php echo "$login_existente" ?>")
                        </script>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="right">
                    <input class="submit-button" type="submit" value="Gravar" name="botao">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>