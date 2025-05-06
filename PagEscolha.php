<?php

if(isset($_POST['submit'])){
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="IMG/logo sem fundo.png" type="image/x-icon">
    <link rel="stylesheet" href="./CSS/PagEscolha.css">

    <title>Cadastro Regenere-se</title>
</head>

<header>
    <div id="logo">
        <img id="ft_logo" src="./IMG/logo sem fundo.png" alt="logo regenere-se">
        <h2 id="nome_logo">REGENERE-SE</h2>
    </div>
    <h2><a id="home" href="PaginaInicial.html">Home</a></h2>
</header>

<div id="tit">
    <h3>Vamos começar?</h3>
    <h1>Selecione o tipo de usuário</h1>
    <div id="l1"></div>
</div>

<section id="escolhas">
    <section id="esc">
        <section id="quadrado">
        <a href="CadastroONG.php"><button id="tit_ong"><img id="ft_ong" src="./IMG/semtitulo.png">
                Organização Não Governamental</img></button></a>
        </section>
        <section id="quadrado">
            <a href="CadastroEmpresa.php"><button id="tit_empresa"><img id="ft_empresa" src="./IMG/semtitulo (2).png">
                Empresa</img></button></a>
                
        </section>
    </section>
</section>

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
            <a href="pag_inicial.html" id="nome_fc">HOME</a>
            <a href="PagEscolha.php" id="nome_fc">CADASTRE-SE</a>
            <a href="pag_inicial.html #prt_3" id="nome_fc">SOBRE NÓS</a>
        </div>
        <img src="img/logo com nome.png" alt="Logo Regenere-se" id="ft_f">
        <h3 id="nome_c">Copyrid ©️2023 projeto regenerese</h3>
    </footer>