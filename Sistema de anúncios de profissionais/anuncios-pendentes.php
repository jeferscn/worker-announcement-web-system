<html>

<head>
  <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
  <title>Anúncios pendentes</title>
  <?php
  include('config.php');
  include('verifica.php');
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
    <!--TODO: fazer um if para retornar uma mensagem caso o select esteja vazio -->
    <?php $query = "SELECT * FROM anuncio WHERE status = 'aguardando aprovação'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
    ?>
      <tr bgcolor="#DDDDD">
        <th width="5%">ID</th>
        <th width="30%">Descrição</th>
        <th width="15%">Categoria</th>
        <th width="12%">Preço</th>
        <th width="12%">Status do anúncio</th>
        <th width="12%">Aprovar | Excluir</th>
      </tr>

    <?php
    } else {
    ?>
      <tr>
        <th style="display: flex;align-items: center; justify-content: center;">
          <h2>Não há anúncios pendentes no momento. =]</h2>
        </th>
      </tr>
    <?php
    }
    ?>

    <?php
    $anuncio_aprovar = @$_REQUEST['id_anuncio_aprovar']; // Pega o ID se for passado por GET
    $id_anuncio_excluir = @$_REQUEST['id_anuncio_excluir']; // Pega o ID se for passado por GET

    if (!empty($anuncio_aprovar)) {
      $query_aprovar = "UPDATE anuncio SET status = 'anúncio ativo' WHERE id_anuncio = '$anuncio_aprovar'";
      $result_excluir = mysqli_query($con, $query_aprovar);
      header("Location: anuncios-pendentes.php");
    } elseif (!empty($id_anuncio_excluir)) {
      $query_excluir = "DELETE FROM anuncio WHERE id_anuncio='$id_anuncio_excluir'";
      $result_excluir = mysqli_query($con, $query_excluir);
      header("Location: anuncios-pendentes.php");
    }

    while ($coluna = mysqli_fetch_array($result)) {
    ?>
      <tr>
        <th width="5%"><p><?php echo $coluna['id_anuncio']; ?></p></th>
        <th width="30%"><p><?php echo $coluna['descricao']; ?></p></th>
        <th width="15%"><p><?php echo $coluna['categoria']; ?></p></th>
        <th width="12%"><p>$ <?php echo $coluna['preco']; ?></p></th>
        <th width="12%"><p><?php echo $coluna['status']; ?></p></th>
        <th width="5%">
          <a class="cor-link" href="anuncios-pendentes.php?pag=anuncio&id_anuncio_aprovar=<?php echo $coluna['id_anuncio']; ?>"><img style="height: 25px;" src="img/aprove.svg" alt=""></a>
          <a class="cor-link" href="anuncios-pendentes.php?pag=anuncio&id_anuncio_excluir=<?php echo $coluna['id_anuncio']; ?>"><img style="height: 25px;" src="img/delete.svg" alt=""></a>
        </th>
      </tr>
    <?php
    } // fim while
    ?>
  </table>
</body>