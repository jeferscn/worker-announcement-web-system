<!DOCTYPE html>
<html lang="en" class="corpo-conteudo">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    <title>Criar categoria</title>
    <?php include('config.php');
    session_start();
    if (@$_SESSION["nivel_usuario"] != "ADM") echo "<script>alert('Você não é Administrador!');top.location.href='index.php';</script>";
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
    <div class="corpo-conteudo">
        <?php
        $anuncio = @$_REQUEST['id_anuncio']; // Pega o ID se for passado por GET

        if (@$_REQUEST['id_anuncio'] and !@$_REQUEST['botao']) {
            $query = "
		SELECT * FROM anuncio WHERE id_anuncio='{$_REQUEST['id_anuncio']}'
	";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            //echo "<br> $query";	
            foreach ($row as $key => $value) {
                $_POST[$key] = $value;
            }
        }

        if (@$_REQUEST['botao'] == "Gravar") {
            $verifica_categoria = "SELECT * FROM categoria WHERE nome_categoria='{$_REQUEST['categoria']}'";
            $result_verifica_registro = mysqli_query($con, $verifica_categoria);

            if (!$_REQUEST['id_categoria']) {
                if (mysqli_num_rows($result_verifica_registro) > 0) {
                    echo "<script>alert('Esta categoria já existe!');</script>";
                    echo mysqli_error($con);
                } else {
                    $insere = "INSERT into categoria (nome_categoria) VALUES ('{$_POST['categoria']}')";
                    $result_insere = mysqli_query($con, $insere);
                    echo "<script>alert('Categoria criado com sucesso!');top.location.href='criar-categoria.php';</script>";
                }
            } else {
                $insere = "UPDATE categoria SET 
                nome_categoria = '{$_POST['categoria']}'
                WHERE id_categoria = '{$_REQUEST['id_categoria']}'";
                $result_update = mysqli_query($con, $insere);
                if ($result_update) {
                    echo "<script>alert('Categoria atualizado com sucesso!');top.location.href='criar-categoria.php';</script>";
                } else {
                    echo "<script>alert('Não foi possível atualizar!');top.location.href='criar-categoria.php';</script>";
                }
            }
        }
        if (@$_REQUEST['botao'] == "Excluir") {
            $selected_categoria = $_POST['selected_categoria'];

            if (!empty($selected_categoria)) {
                $query_excluir = "DELETE FROM categoria WHERE nome_categoria='$selected_categoria'";
                $result_update = mysqli_query($con, $query_excluir);
                if ($result_update) {
                    echo "<script>alert('Categoria excluída com sucesso!');top.location.href='criar-categoria.php';</script>";
                } else {
                    echo "<script>alert('Não foi possível excluir!');top.location.href='criar-categoria.php';</script>";
                }
            }else{
                echo "<script>alert('Você precisa selecionar uma categoria!');</script>";
            }
        }
        ?>
        <form class="form" action="criar-categoria.php" method="POST" name="categoria">
            <table width="100%" align="center">
                <tr>
                    <td class="title" colspan="3">
                        <?php if (!@$_REQUEST['id_categoria']) {
                            echo "Criar categoria";
                        } else {
                            echo "Editar Anúncio";
                        } ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <input type="text" name="categoria" placeholder="Categoria" value="<?php echo @$_POST['categoria']; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">
                        <input class="submit-button" type="submit" value="Gravar" name="botao">
                        <input type="hidden" name="id_categoria" value="<?php echo @$_REQUEST['id_categoria'] ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p align="center">Excluir categorias</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <select name="selected_categoria">
                            <option value="">Selecionar categoria</option>
                            <?php
                            $result_categorias = "SELECT * FROM categoria ORDER BY nome_categoria";
                            $result_verifica_categorias = mysqli_query($con, $result_categorias);
                            while ($result_categorias = mysqli_fetch_assoc($result_verifica_categorias)) { ?>
                                <option value="<?php echo $result_categorias['nome_categoria']; ?>">
                                    <?php echo $result_categorias['nome_categoria'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        <input class="botao-categoria-excluir" type="submit" value="Excluir" name="botao">
                        <input type="hidden" name="id_categoria" value="<?php echo @$_REQUEST['id_categoria'] ?>" />
                    </td>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>