<html>

<head>
  <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
  <title>Relat&oacute;rio de Clientes</title>
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
  <form class="form" name="fmrpesquisa" id="frmpesquisa" method="POST">
    <div class="row">
      <h3>Filtros</h3>
      <select name="parametro_categoria">
        <option value="">Selecionar categoria</option>
        <?php
        $result_categorias = "SELECT * FROM categoria";
        $result_verifica_categorias = mysqli_query($con, $result_categorias);
        while ($result_categorias = mysqli_fetch_assoc($result_verifica_categorias)) { ?>
          <option value="<?php echo $result_categorias['nome_categoria']; ?>">
            <?php echo $result_categorias['nome_categoria']; ?>
          </option>
        <?php
        }
        ?>
      </select>
      <div class="consulta-entre-preco">
        <p>De:</p>
        <input type="text" name="preco-inicial" placeholder="10.00" value="<?php echo @$_POST['preco-inicial'] ?>">
        <p>Até:</p>
        <input type="text" name="preco-final" placeholder="99.00" value="<?php echo @$_POST['preco-final'] ?>">
      </div>
      <div>
        <select name="parametro_preco" class="form-control">
          <option value="<?php echo @$_POST['parametro_preco'] ?>">Ordenar preço</option>
          <option value="menor">Menor preço</option>
          <option value="maior">Maior preço</option>
        </select>
      </div>
      <div class="col-sm-1">
        <input class="submit-button" type="submit" value="BUSCAR">
      </div>
    </div><br>
  </form>
  <section class="container">
    <div class="corpoanuncio">
      <?php
      $id_usuario = @$_SESSION["id_usuario"];

      $query = "SELECT * FROM anuncio WHERE status='anúncio ativo'";

      if (!empty($_REQUEST['parametro_categoria'])) {
        $query .= " AND categoria = '" . $_REQUEST['parametro_categoria'] . "'";
      }

      if (!empty($_REQUEST['preco-inicial']) && !empty($_REQUEST['preco-final'])) {
        $query .= " AND preco BETWEEN " . $_REQUEST['preco-inicial'] . " AND " . $_REQUEST['preco-final'];
      } elseif (!empty($_REQUEST['preco-inicial']) && empty($_REQUEST['preco-final'])) {
        $query .= " AND preco >= " . $_REQUEST['preco-inicial'];
      } elseif (empty($_REQUEST['preco-inicial']) && !empty($_REQUEST['preco-final'])) {
        $query .= " AND preco <= " . $_REQUEST['preco-final'];
      }

      //select * from anuncio where status='an├║ncio ativo' and preco < 11 ORDER by preco asc;

      if (!empty($_REQUEST['parametro_preco']) && $_REQUEST['parametro_preco'] == "menor") {
        $query .= " ORDER BY preco ASC";
      } elseif (!empty($_REQUEST['parametro_preco']) && $_REQUEST['parametro_preco'] == "maior") {
        $query .= " ORDER BY preco DESC";
      }
      $result = mysqli_query($con, $query);
      if (mysqli_num_rows($result) > 0) {
        while ($coluna = mysqli_fetch_array($result)) {

      ?>
          <div class="blocoanuncio">
            <div class="esquerda">
              <h3><?php echo $coluna['categoria']; ?></h3>
              <p><?php echo $coluna['descricao']; ?></p>
            </div>
            <div class="direita">
              <h2>$ <?php echo $coluna['preco']; ?></h2>
              <p>Contato:<br> <?php echo $coluna['telefone']; ?></p>
            </div>
          </div>
      <?php
        }
      } // fim while
      else {
        echo "<h3>Não há anúncios a serem exibidos, faça uma nova pesquisa!</h3>";
      }
      ?>
    </div>
  </section>
</body>