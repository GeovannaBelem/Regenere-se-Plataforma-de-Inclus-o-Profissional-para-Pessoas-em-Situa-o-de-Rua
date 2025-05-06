<?php

session_start();

if (isset($_POST['submit'])) {


    if (isset($_SESSION['email_verificacao'])) {
        include_once('config.php');
        $senha = $_POST['senha'];
        $senhaDois = $_POST['senhaDois'];

        $email = $_SESSION['email_verificacao']; // Certifique-se de alterar conforme necessário

        // Verifica em qual tabela o email pertence
        $consultaEmpresa = $conexao->query("SELECT * FROM cadastroempresa WHERE email = '$email'");
        $consultaOng = $conexao->query("SELECT * FROM cadastroong WHERE email = '$email'");

        if ($consultaEmpresa->num_rows > 0) {
            // O email pertence à tabela cadastroempresa
            $queryAtualizar = "UPDATE cadastroempresa SET senha = '$senha' WHERE email = '$email'";
            $conexao->query($queryAtualizar);

            echo "Senha atualizada com sucesso para cadastroempresa.";
        } elseif ($consultaOng->num_rows > 0) {
            // O email pertence à tabela cadastroong
            $queryAtualizar = "UPDATE cadastroong SET senha = '$senha' WHERE email = '$email'";
            $conexao->query($queryAtualizar);
            echo "Senha atualizada com sucesso para cadastroong.";
            header("Refresh: 5; url=login.php");
            exit();
        } else {
            echo "Email não encontrado no banco de dados.";
            header("Refresh: 5; url=EsqueceuSenha.php");
            exit();
        }
        $conexao->close();
    } else {
        echo "Email não encontrado no banco de dados.";
        header("Refresh: 5; url=EsqueceuSenha.php");
        exit();
    }
}




?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regenere-se</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="./CSS/main.css">
    <link rel="stylesheet" href="./CSS/Cadastro.css">
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
                <div id="bola1"></div>
            </div>
        </div>
        <div id="caixona3">
            <form method="post" action="EsqueceuSenha3.php">
                <h3 id="tit_cc">Nova Senha:</h3>
                <div class="s">
                    <input name="senha" id="senha" type="password" class="inputs required" oninput="checkSenha()"
                        required>
                    <i class="bi bi-eye" id="b-senha" onclick="mostrarSenha()"></i>
                </div>


                <h3 id="tit_cc">Confirmar Nova Senha:</h3>
                <div class="s">
                    <input name="senhaDois" id="senha2" oninput="checarr()" type="password" class="inputs required">
                    <i class="bi bi-eye" id="b2-senha" onclick="mostrarSenha()"></i>
                </div>

                <div id="buttons">
                    <ul>
                        <li id="crct" class="tst"><i class="bi bi-check-circle"></i> Insira no mínimo 6
                            caracteres</li>
                        <li id="ltR" class="tst"><i class="bi bi-check-circle"></i> Letras
                            maiúscula(A-z)</li>
                        <li id="ltr" class="tst"><i class="bi bi-check-circle"></i> Letra minuscula(a-z)
                        </li>
                        <li id="num" class="tst"><i class="bi bi-check-circle"></i> Números(0-9)</li>
                        <li id="esp" class="tst"><i class="bi bi-check-circle"></i> Caracter
                            especial(&,%,@,...)</li>
                    </ul>
                    <div id="btns">
                        <h5 id="avisoo"></h5>
                        <input type="submit" value="Finalizar" name="submit" id="btn_cnt"
                            onclick="verificarsenha()"></input>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script src="./JS/Cadastro.js"></script>
</body>
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