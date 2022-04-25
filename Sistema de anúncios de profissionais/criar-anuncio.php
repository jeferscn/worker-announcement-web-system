<!DOCTYPE html>
<html lang="en" class="corpo-conteudo">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    <title>Criar anúncio</title>
    <?php
    include('config.php');
    include('verifica.php');
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
    $anuncio = @$_REQUEST['id_anuncio']; // Pega o ID se for passado por GET
    $categoria = @$_POST['categoria'];
    $id_usuario = @$_SESSION["id_usuario"];

    if (@$_REQUEST['id_anuncio'] and !@$_REQUEST['botao']) {
        $query = "SELECT * FROM anuncio WHERE id_anuncio='{$_REQUEST['id_anuncio']}'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        //echo "<br> $query";	
        foreach ($row as $key => $value) {
            $_POST[$key] = $value;
        }
    }

    if (@$_REQUEST['botao'] == "Gravar") {
        $verifica_descricao = "SELECT * FROM anuncio WHERE descricao='{$_REQUEST['descricao']}'";
        $result_verifica_registro = mysqli_query($con, $verifica_descricao);
        $status = "aguardando aprovação";

        if (!$_REQUEST['id_anuncio']) {
            if (mysqli_num_rows($result_verifica_registro) > 1) {
                echo "<script>alert('Este anúncio ja existe!');</script>";
                echo mysqli_error($con);
            } else {
                $insere = "INSERT into anuncio (descricao, categoria, preco, fk_id_usuario, telefone, status) VALUES ('{$_POST['descricao']}', '$categoria', '{$_POST['preco']}', '$id_usuario', '{$_POST['telefone']}', '$status')";
                $result_insere = mysqli_query($con, $insere);
                echo "<script>alert('Anúncio criado com sucesso!');top.location.href='criar-anuncio.php';</script>";
            }
        } else {
            $insere = "UPDATE anuncio SET 
                descricao = '{$_POST['descricao']}',
                categoria = '{$_POST['categoria']}',
                preco = '{$_POST['preco']}',
                telefone = '{$_POST['telefone']}',
                status = '$status'
                WHERE id_anuncio = '{$_REQUEST['id_anuncio']}'";
            $result_update = mysqli_query($con, $insere);
            if ($result_update) {
                echo "<script>alert('Anúncio atualizado com sucesso!');top.location.href='profissionais.php?botao=Gerar';</script>";
            } else {
                echo "<script>alert('Não foi possível atualizar!');top.location.href='criar-anuncio.php';</script>";
            }
        }
    }
    ?>
    <form class="form" action="criar-anuncio.php" method="post" name="usuario">
        <table width="100%" align="center">
            <tr>
                <td class="title" colspan="3">
                    <?php if (!@$_REQUEST['id_anuncio']) {
                        echo "Criar anúncio";
                    } else {
                        echo "Editar Anúncio";
                    } ?>
                </td>
            </tr>
            <tr>
                <td>Descricao:</td>
                <td colspan="2"><input type="text" name="descricao" maxlength="185" minlength="10" required placeholder="Descrição" value="<?php echo @$_POST['descricao']; ?>"></td>
            </tr>
            <tr>
                <td>Categoria:</td>
                <td colspan="2">
                    <select required name="categoria">
                        <option value="">Selecione uma opção</option>
                        <?php
                        $result_categorias = "SELECT * FROM categoria";
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
                <td>Preço:</td>
                <td colspan="2"><input type="text" name="preco" required placeholder="50.85" value="<?php echo @$_POST['preco'] ?>"></td>
            </tr>
            <tr>
                <td>Telefone:</td>
                <td colspan="2"><input type="text" name="telefone" maxlength="11" minlength="11" required placeholder="41999887766" value="<?php echo @$_POST['telefone'] ?>"></td>
            </tr>
            <tr>
                <td colspan="3" align="right">
                    <input class="submit-button" type="submit" value="Gravar" name="botao">
                    <input type="hidden" name="id_anuncio" value="<?php echo @$_REQUEST['id_anuncio'] ?>" />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>