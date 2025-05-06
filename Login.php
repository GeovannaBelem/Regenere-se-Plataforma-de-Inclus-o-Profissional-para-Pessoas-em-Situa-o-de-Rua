<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./CSS/Login.css">
    <link rel="shortcut icon" href="IMG/logo sem fundo.png" type="image/x-icon">
    <link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
</head>

<header>
    <div id="logo">
        <img id="ft_logo" src="./IMG/logo sem fundo.png" alt="logo regenere-se">
        <h2 id="nome_logo">REGENERE-SE</h2>
    </div>
    <h2><a id="home" href="PaginaInicial.html">Home</a></h2>
</header>


<body>
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>

    <div class="caixas">



        <div class="caixona">
            <div class="tituloecaixas">
              
                <div class="bemvindo">
                    <h1 id="bemvindo">Bem vindo!</h1>
                </div>
                <div class="inputs">
                    <form action="testeLogin2.php" method="POST">
                        <input type="text" id="ipt" name="email" placeholder="Digite seu e-mail">

                        <input type="password" name="senha" id="ipt" placeholder="Digite sua senha">
                        <input type="submit" value="Login" id="login">
                    </form>
                </div>
                   
                <div class="esqueceuasenha">
                    <a href="EsqueceuSenha.php">Esqueceu a senha?</a>
                    <p id="traco">|</p>
                    <a href="PagEscolha.php">Cadastre-se</a>

                    <?php
                    include_once('config.php');
                    include_once('testeLogin2.php');
                    if (!$alert) {
                        echo "<style>";
                            echo "#aviso{display:block;}";
                        echo "</style>";
                    }
                    ?>

                </div>
            </div>
        </div>

    </div>

</body>

<footer>
    <div id="funcoes">
        <a href="pag_inicial.html" id="nome_fc">HOME</a>
        <a href="PagEscolha.php" id="nome_fc">CADASTRE-SE</a>
        <a href="PaginaInicial.html #prt_3" id="nome_fc">SOBRE NÓS</a>
    </div>
    <img src="IMG/logo com nome.png" id="ft_f" alt="Logo Regenere-se">
    <h3 id="nome_fc">Copyright &copy;2023 projeto regenerese</h3>
</footer>
</html>