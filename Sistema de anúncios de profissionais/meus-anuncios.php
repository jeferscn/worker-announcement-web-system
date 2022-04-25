<html>

<head>
  <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
  <title>Relat&oacute;rio de Clientes</title>
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

  <table class="tabela-relatorio" width="95%" border="1" align="center">
    <?php
    $id_usuario = @$_SESSION["id_usuario"];
    $query = "SELECT * FROM anuncio WHERE anuncio.fk_id_usuario = '$id_usuario'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
    ?>
      <tr bgcolor="#DDDDD">
        <th width="5%">ID</th>
        <th width="30%">Descrição</th>
        <th width="15%">Categoria</th>
        <th width="12%">Preço</th>
        <th width="12%">Telefone</th>
        <th width="12%">Status do anúncio</th>
        <th width="12%">Editar | Excluir</th>
      </tr>
    <?php
    } else {
    ?>
      <tr>
        <th style="display: flex;align-items: center; justify-content: center;">
          <h2>Você ainda não possui anúncios. =|</h2>
        </th>
      </tr>
    <?php
    }
    ?>
    <?php
    $id_anuncio_excluir = @$_REQUEST['id_anuncio_excluir']; // Pega o ID se for passado por GET
    if (!empty($id_anuncio_excluir)) {
      $query_excluir = "DELETE FROM anuncio WHERE id_anuncio='$id_anuncio_excluir'";
      $result_excluir = mysqli_query($con, $query_excluir);
      header("Location: meus-anuncios.php");
    }

    $query = "SELECT * FROM anuncio WHERE anuncio.fk_id_usuario = '$id_usuario'";
    if (!empty($_REQUEST['parametro_categoria'])) {
      $query .= " AND categoria = '" . $_REQUEST['parametro_categoria'] . "'";
    }

    if (!empty($_REQUEST['parametro_preco']) && $_REQUEST['parametro_preco'] == "menor") {
      $query .= " ORDER BY preco ASC";
    } elseif (!empty($_REQUEST['parametro_preco']) && $_REQUEST['parametro_preco'] == "maior") {
      $query .= " ORDER BY preco DESC";
    }
    $result = mysqli_query($con, $query);

    while ($coluna = mysqli_fetch_array($result)) {
      
    ?>
      <tr>
        <th width="5%"><p><?php echo $coluna['id_anuncio']; ?></p></th>
        <th width="30%"><p><?php echo substr($coluna['descricao'], 0, 100)?></p></th>
        <th width="15%"><p><?php echo substr( $coluna['categoria'], 0, 20); ?></p></th>
        <th width="12%"><p>$ <?php echo $coluna['preco']; ?></p></th>
        <th width="12%"><p><?php echo $coluna['telefone']; ?></p></th>
        <th width="12%"><p><?php echo $coluna['status']; ?></p></th>
        <td class="tabela-relatorio-padding">
          <a class="cor-link" href="criar-anuncio.php?pag=anuncio&id_anuncio=<?php echo $coluna['id_anuncio']; ?>"><img style="height: 25px;" src="img/edit.svg" alt=""></a>
          <a class="cor-link" href="meus-anuncios.php?pag=anuncio&id_anuncio_excluir=<?php echo $coluna['id_anuncio']; ?>"><img style="height: 25px;" src="img/delete.svg" alt=""></a>
        </td>

      </tr>

    <?php
    
    } // fim while
    ?>

  </table>
</body>