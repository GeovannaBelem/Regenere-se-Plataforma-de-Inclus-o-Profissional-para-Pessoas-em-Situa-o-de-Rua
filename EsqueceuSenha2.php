
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regenere-se</title>
    <link rel="stylesheet" href="./CSS/main.css">
    <link rel="stylesheet" href="./CSS/EsqueceuSenha.css">
    <link rel="shortcut icon" href="IMG/logo sem fundo.png" type="image/x-icon">
</head>

<header>
    <div id="logo">
        <img id="ft_logo" src="./IMG/logo sem fundo.png" alt="logo regenere-se">
        <h2 id="nome_logo">REGENERE-SE</h2>
    </div>
    <h2><a id="home" href="PaginaInicial.html">Home</a></h2>
</header>

<body>
    <div class="caixas">
        <div class="caixa">
            <div class="text2">
                <h1 id="titulo">Esqueceu a senha?</h1>
            </div>
            <div class="bolas">
                <div id="bola1"></div>
                <div id="bola1"></div>
                <div id="bola2"></div>
            </div>
        </div>

        <div class="caixona2">
            <div class="text">
                <p id="text">
                    Um email, com um código de verificação de 4 dígitos foi enviado para <span id="emaill"></span>
                </p>
            </div>
            <form id="codigos" action="envio.php" method="post">
                <div id="codigoconc">
                    <input class="codigo" name="codigo1" type="text" required maxlength="1">
                    <input class="codigo" name="codigo2" type="text" required maxlength="1">
                    <input class="codigo" name="codigo3" type="text" required maxlength="1">
                    <input class="codigo" name="codigo4" type="text" required maxlength="1">
                </div>
                <input type="submit" id="btn_veri" name="verificar_codigo" value="Verificar Código">
            </form>
            <div class="jatemconta">
            <span>Já tem uma conta?</span>
                <p>|</p>
                <a href="PagEscolha.php">Cadastre-se</a>
            </div>
        </div>


    </div>
    </div>
    </div>
</body>

<style>

</style>

<footer>
    <div id="funcoes1">
        <div id="imgrep">
            <img src="img/logo com nome.png" alt="Logo Regenere-se" id="ft_f2">
        </div>
        <div id="funcoes2">
            <a href="pag_inicial.html" id="nome_fc2">HOME</a>
            <a href="PagEscolha.php" id="nome_fc2" class="link1">CADASTRE-SE</a>
            <a href="pag_inicial.html #prt_3" id="nome_fc2">SOBRE NÓS</a>
        </div>
        <h3 id="nome_c22">Copyrid ©️2023 projeto regenerese</h3>
    </div>
    </div>
    <div id="funcoes">
        <a href="PrincipalEmpresa.php #logo" id="nome_fc">HOME</a>
        <a href="PagEscolha.php" id="nome_fc">CADASTRE-SE</a>
        <a href="pag_inicial.html #b1" id="nome_fc">SOBRE NÓS</a>
    </div>
    <img src="img/logo com nome.png" alt="Logo Regenere-se" id="ft_f">
    <h3 id="nome_c">Copyrid ©️2023 projeto regenerese</h3>
</footer>

</html>