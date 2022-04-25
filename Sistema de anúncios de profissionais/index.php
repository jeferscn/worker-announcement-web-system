<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    <title>Início</title>
    <?php
    session_start();
    ?>
</head>

<body>
    <!--
        
    1-
    Criar um sistema de venda de serviços (tipo get ninjas)
    O administrador cadastra as categorias e libera os anúncios que os demais usuários criarem (tendo a possibilidade de excluir se necessário)
    O usuário pode fazer um cadastro comum e pode fazer novos posts e gerenciar (editar) seus anúncios
    O usuário sem cadastro pode apenas visualizar
    Permitir o uso de filtros por preço e categoria para qualquer usuário
    Usar uma tabela auxiliar para popular um combobox (pesquisa)


    2 - Arrumar o sistema e eu vou tirar a media dos 2 dias
    Montar a documentação do sistema:
    - UC casos de uso
    - DER (entidade e relacionamento banco de dados)

    -->


    <header>
        <nav>
            <div>
                <a href="index.php"><img src="img/logo.svg" alt=""></a>
            </div>
            <div style="margin-right: 100px;">

                <?php
                if (isset($_SESSION["id_usuario"]) || isset($_SESSION["nome_usuario"])) {
                    echo "Olá " . $_SESSION['nome_usuario'] . ", bem vindo(a)!";
                }
                ?>

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
    <section id="primeiro-bloco">
        <div class="primeiro-container-esquerda">
            <h2>Bem vindo ao GetWorker!</h2>
            <p>Aqui conectamos quem precisa, <br> com quem sabe fazer!</p>
            <p class="como-funciona-p">Como funciona?</p>
            <a href="#como-funciona"><img src="img/arrow-down.svg" alt=""></a>
        </div>
        <div class="primeiro-container-direita">
            <img src="img/working-home.svg" alt="">
        </div>
    </section>

    <section id="como-funciona">
        <div class="bloco-como-funciona">
            <div class="segundo-container-esquerda">
                <img src="img/working-home.svg" alt="">
            </div>
            <div class="segundo-container-direita">
                <h2>Você precisa de uma solução, mas não sabe onde encontrar um profissional de confiança?</h2>
                <p>Nós temos o profissional adequado para a sua necessidade!</p>
                <p>Basta efetuar seu cadastro, procurar o profissional que mais lhe agrada em nossa lista de profissionais, e contratá-lo!</p>
                <p>Simples assim com a GetWorker! =]</p>
                <br>
                <a href="profissionais.php?botao=Gerar">
                    <div class="ver-profissionais">VER PROFISSIONAIS
                        <img src="img/arrow-down.svg" alt="">
                    </div>
                </a>
            </div>
        </div>
    </section>
</body>

</html>