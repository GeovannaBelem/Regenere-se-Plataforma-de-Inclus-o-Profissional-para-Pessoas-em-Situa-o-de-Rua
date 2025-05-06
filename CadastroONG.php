<?php
$mensagem = "ㅤ";
$mensagemPDF = "ㅤ";
$mensagemFT1 = "ㅤ";
$mensagemFT2 = "ㅤ";
$mensagemFT3 = "ㅤ";
$mensagemFT4 = "ㅤ";
if (isset($_POST['submit'])) {
    /*print_r($_POST['razsoci']);
    print_r($_POST['nomefan']);
    print_r($_POST['cnpj']);
    print_r($_POST['cnae']);*/

    include_once('config.php');

    $nomeassoc = $_POST['nomeassoc'];
    $nomeresp = $_POST['nomeresp'];
    $cnpj = $_POST['cnpj'];
    $cnae = $_POST['cnae'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $estado = $_POST['estado'];
    $complemento = $_POST['compl'];
    $cep = $_POST['cep'];
    $link = $_POST['link'];
    $telefone = $_POST['telefone'];
    $descricao = $_POST['Mensagem'];
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaDois = $_POST['senhaDois'];


    $search = $conexao->prepare("SELECT * FROM cadastroong WHERE cnpj = '$cnpj'");
    $search->execute();
    if (($search->fetchColumn()) > 0) {
        $mensagem = '
        
        <style>
        .msg {
           display: block
         }
        </style>
    ';
    } else {
        $mensagem = "ㅤ";
        $mensagem2 = "ㅤ";
        $mensagemPDF = "ㅤ";
        $mensagemFT1 = "ㅤ";
        $mensagemFT2 = "ㅤ";
        $mensagemFT3 = "ㅤ";
        $mensagemFT4 = "ㅤ";
        $pdf_blob = null;
        $foto1_blob = null;
        $foto2_blob = null;
        $foto3_blob = null;
        $foto4_blob = null;
        if ((!empty($_FILES["pdf"]["tmp_name"]))) {
            if ((!empty($_FILES["foto1"]["tmp_name"]))) {
                if ((!empty($_FILES["foto2"]["tmp_name"]))) {
                    if ((!empty($_FILES["foto3"]["tmp_name"]))) {
                        if ((!empty($_FILES["foto4"]["tmp_name"]))) {
                            $pdf_blob = file_get_contents($_FILES["pdf"]["tmp_name"]);
                            $stmt = $conexao->prepare("INSERT INTO cadastroong(nomeAssociacao, nomeResponsavel, cnpj,estatuto, cnae, cidade, bairro, rua, estado, complemento, cep, link, telefone, descricao, nome, cargo, email, senha, senhaDois) VALUES (:nomeassoc, :nomeresp, :cnpj,:pdf, :cnae, :cidade, :bairro, :rua, :estado, :complemento, :cep, :link, :telefone, :descricao, :nome, :cargo, :email, :senha, :senhaDois)");


                            // Associe os parâmetros aos valores
                            $stmt->bindParam(':nomeassoc', $nomeassoc);
                            $stmt->bindParam(':nomeresp', $nomeresp);
                            $stmt->bindParam(':pdf', $pdf_blob, PDO::PARAM_LOB);
                            $stmt->bindParam(':cnpj', $cnpj);
                            $stmt->bindParam(':cnae', $cnae);
                            $stmt->bindParam(':cidade', $cidade);
                            $stmt->bindParam(':bairro', $bairro);
                            $stmt->bindParam(':rua', $rua);
                            $stmt->bindParam(':estado', $estado);
                            $stmt->bindParam(':complemento', $complemento);
                            $stmt->bindParam(':cep', $cep);
                            $stmt->bindParam(':link', $link);
                            $stmt->bindParam(':telefone', $telefone);
                            $stmt->bindParam(':descricao', $descricao);
                            $stmt->bindParam(':nome', $nome);
                            $stmt->bindParam(':cargo', $cargo);
                            $stmt->bindParam(':email', $email);
                            $stmt->bindParam(':senha', $senha);
                            $stmt->bindParam(':senhaDois', $senhaDois);

                            // Agora, execute a consulta
                            $stmt->execute();

                            $foto1_blob = file_get_contents($_FILES["foto1"]["tmp_name"]);
                            $foto2_blob = file_get_contents($_FILES["foto2"]["tmp_name"]);
                            $foto3_blob = file_get_contents($_FILES["foto3"]["tmp_name"]);
                            $foto4_blob = file_get_contents($_FILES["foto4"]["tmp_name"]);
                            $stmtfoto = $conexao->prepare("INSERT INTO fotosong(cnpj,fotoUsuario, fotoONG1, fotoONG2,fotoONG3) VALUES ( ?, ?, ?, ?, ?)");

                            // Associe os parâmetros aos valores
                            $stmtfoto->bindParam(1, $cnpj);
                            $stmtfoto->bindParam(2, $foto1_blob, PDO::PARAM_LOB); // Use PDO::PARAM_LOB para campos BLOB
                            $stmtfoto->bindParam(3, $foto2_blob, PDO::PARAM_LOB);
                            $stmtfoto->bindParam(4, $foto3_blob, PDO::PARAM_LOB);
                            $stmtfoto->bindParam(5, $foto3_blob, PDO::PARAM_LOB);

                            // Agora, execute a consulta
                            $stmtfoto->execute();

                            header('Location:login.php');

                        } else {
                            $mensagemPDF = '
                <style>
                    .msg2 {
                        display: block
                    }
                </style>
            ';
                        }
                    } else {
                        $mensagemFT4 = '
                    <style>
                        .msg6 {
                            display: block
                        }
                    </style>
                ';
                    }
                } else {
                    $mensagemFT3 = '
                <style>
                    .msg5 {
                        display: block
                    }
                </style>
            ';
                }
            } else {
                $mensagemFT2 = '
                <style>
                    .msg4 {
                        display: block
                    }
                </style>
            ';
            }

        } else {
            $mensagemFT1 = '
            <style>
                .msg3 {
                    display: block
                }
            </style>
        ';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Regenere-se</title>
    <link rel="stylesheet" href="./CSS/Cadastro.css">
    <link rel="shortcut icon" href="IMG/logo sem fundo.png" type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,300,0,0" />
</head>

<header>
    <div id="logo">
        <img id="ft_logo" src="./IMG/logo sem fundo.png" alt="logo regenere-se">
        <h2 id="nome_logo">REGENERE-SE</h2>
    </div>
    <h2><a id="home" href="PaginaInicial.html">Home</a></h2>
</header>

<body>
    <div class="tudo">
        <div id="tit">
            <h1>Criar nova conta</h1>
            <div id="sub_tit">
                <h3>Já possui uma conta? </h3>
                <h3 id="login"><a href="./Login.php"> Login</a></h3>
            </div>
        </div>

        <center class="msg">
            <div class="msg">
                <h5>Erro ao cadastrar: CNPJ já está no banco</h5>
            </div>
        </center>
        <?php echo $mensagem; ?>
        <center class="msg2">
            <div class="msg2">
                <h5>Erro ao cadastrar: Selecione um arquivo em PDF</h5>
            </div>
        </center>
        <?php echo $mensagemPDF; ?>
        <center class="msg3">
            <div class="msg3">
                <h5>Erro ao cadastrar: Selecione uma imagem .png, .jpg ou .jpeg (Foto de perfil)</h5>
            </div>
        </center>
        <?php echo $mensagemFT1; ?>
        <center class="msg4">
            <div class="msg4">
                <h5>Erro ao cadastrar: Selecione uma imagem com .png, .jpg ou .jpeg (Imagem 1)</h5>
            </div>
        </center>
        <?php echo $mensagemFT2; ?>
        <center class="msg5">
            <div class="msg5">
                <h5>Erro ao cadastrar: Selecione uma imagem com .png, .jpg ou .jpeg (Imagem 2)</h5>
            </div>
        </center>
        <?php echo $mensagemFT3; ?>
        <center class="msg6">
            <div class="msg6">
                <h5>Erro ao cadastrar: Selecione uma imagem com .png, .jpg ou .jpeg (Imagem 3)</h5>
            </div>
        </center>
        <?php echo $mensagemFT4; ?>



        <div class="a">
            <div id="linhas">
                <div id="linha_r"></div>
            </div>
        </div>
        <div class="caixas">
            <section class="caminho">
                <section class="bolas">

                    <div id="cam">
                        <div id="cam1">
                            <div id="cir1"></div>
                            <hr id="l1">
                        </div>
                        <h4 id="tt1">Sobre a ONG</h4>
                    </div>


                    <div id="cam">
                        <div id="cam2">
                            <div id="cir2"></div>
                            <hr id="l2">
                        </div>
                        <h4>Endereço</h4>
                    </div>


                    <div id="cam">
                        <div id="cam3">
                            <div id="cir3"></div>
                            <hr id="l3">
                        </div>
                        <h4>Criar perfil</h4>
                    </div>

                    <div id="cam">
                        <div id="cam4">
                            <div id="cir4"></div>
                        </div>
                        <h4>Administrador</h4>
                    </div>

                </section>
            </section>

            <section class="slider-wrapper">

                <button class="slide-arrow" id="slide-arrow-prev">
                    &#8249;
                </button>
                <button class="slide-arrow" id="slide-arrow-next">
                    &#8250;
                </button>
                <hr id="hr1">
                <form action="CadastroONG.php" method="POST" enctype="multipart/form-data" id="cadastro">


                    <ul class="slides-container" id="slides-container">
                        <li class="slide">
                            <div class="coisas">
                                <div class="doisipt1">
                                    <div class="inptt">
                                        <h3 id="tit_cc">Nome da associação:</h3>
                                        <input type="text" name="nomeassoc" id="ipt1" required>

                                    </div>
                                    <div class="inptt">
                                        <h3 id="tit_cc">Nome do responsável:</h3>
                                        <input id="ipt1" name="nomeresp" type="text" required>

                                    </div>
                                </div>
                                <div class="doisipt2">
                                    <div class="inptt">
                                        <h3 id="tit_cc">Estatuto Social:</h3>
                                        <div id="form_group1">
                                            <span class="material-symbols-outlined"
                                                style="color: #333; font-size: 30px;">
                                                upload
                                            </span>
                                            <input type="file" name="pdf" accept=".pdf" id="arquivo">
                                        </div>
                                    </div>

                                    <div class="inptt">
                                        <h3 id="tit_cc">CNPJ:</h3>
                                        <input id="ipt2" name="cnpj" class="cnae" type="text" require>
                                    </div>
                                    <div class="inptt">
                                        <h3 id="tit_cc">CNAE:</h3>
                                        <input id="ipt2" name="cnae" class="cnae" type="text" require>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="slide">
                            <div class="coisas2">

                                <div id="cad2">
                                    <div id="cid">
                                        <h3 id="tit_cd">Cidade:</h3>
                                        <input type="text" name="cidade" id="cidade" class="ipt3" required>
                                    </div>
                                    <div id="cnpj">
                                        <h3 id="tit_cd">Bairro:</h3>
                                        <input id="bairro" name="bairro" type="text" class="ipt3" required>
                                    </div>
                                </div>
                                <div id="cad2">
                                    <div id="cnae">
                                        <h3 id="tit_cc">Rua:</h3>
                                        <input id="rua" name="rua" type="text" class="ipt3" required>
                                    </div>
                                    <div id="est">
                                        <h3 id="tit_cc">Estado:</h3>
                                        <input id="estado" name="estado" type="text" class="ipt3" required>
                                    </div>
                                </div>
                                <div id="cad2">
                                    <div id="est">
                                        <h3 id="tit_cc">Complemento:</h3>
                                        <input id="btn_p" name="compl" type="text" class="ipt3">
                                    </div>
                                    <div id="est">
                                        <h3 id="tit_cc">CEP:</h3>
                                        <input id="cep" name="cep" type="text" class="ipt3" required>
                                    </div>
                                </div>


                            </div>
                        </li>
                        <li class="slide">
                            <div id="form">

                                <div id="foto">
                                    <label class="picture" tabindex="0">
                                        <div class="max-width"></div>
                                        <input type="file" name="foto1" accept=".jpg, .jpeg, .png"
                                            class="picture__input"><img id="imgPhoto"
                                            src="data:image/png;base64,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">
                                        <span class="picture__image"></span>
                                    </label>
                                    <h4>Adicionar foto de perfil</h3>
                                </div>
                                <div id="lT">
                                    <label for="arquivo">Adicionar foto da ONG (IMG 1)</label>
                                    <div id="form_group">
                                        <span class="material-symbols-outlined" style="color: #333; font-size: 30px;">
                                            upload
                                        </span>

                                        <input type="file" name="foto2" class="inp" accept=".jpg, .jpeg, .png"
                                            id="arquivo">
                                    </div>
                                    <label for="arquivo">Adicionar foto da ONG(IMG 2)</label>
                                    <div id="form_group">
                                        <span class="material-symbols-outlined" style="color: #333; font-size: 30px;">
                                            upload
                                        </span>

                                        <input type="file" name="foto3" class="inp" accept=".jpg, .jpeg, .png"
                                            id="arquivo">
                                    </div>
                                    <label for="arquivo">Adicionar foto da ONG (IMG 3)</label>
                                    <div id="form_group">
                                        <span class="material-symbols-outlined" style="color: #333; font-size: 30px;">
                                            upload
                                        </span>

                                        <input type="file" name="foto4" class="inp" accept=".jpg, .jpeg, .png"
                                            id="arquivo">
                                    </div>

                                </div>
                            </div>


                            <div class="desc2">
                                <div id="link_tel">
                                    <input name="link" type="text" placeholder="Adicionar link" id="link" required>
                                    <input name="telefone" id="ad_tel" type="text" maxlength="16"
                                        placeholder="Adicionar telefone" required>
                                </div>
                                <textarea name="Mensagem" id="descricao" maxlength="250" required
                                    placeholder="Sobre a ONG:"></textarea>
                            </div>
                        </li>
                        <li class="slide">
                            <div class="coisas3">
                                <div class="f-control">
                                    <h3 id="tit_cd">Nome completo:</h3>
                                    <input name="nome" type="text" id="name" class="inputs required"
                                        oninput="nameValida()">
                                </div>

                                <div id="cad2">
                                    <div id="cnpj" class="form-control">
                                        <h3 id="tit_ccc">Cargo:</h3>
                                        <input name="cargo" id="cargo" type="text" class="inputs required">
                                    </div>
                                    <div id="cnae" class="form-control">
                                        <h3 id="tit_ccc">E-mail:</h3>
                                        <input name="email" id="email" type="email" class="inputs required">
                                    </div>
                                </div>

                                <div id="cad2">
                                    <div id="cnpj" class="form-control">
                                        <h3 id="tit_cc">Senha:</h3>
                                        <div class="s">
                                            <input name="senha" id="senha" type="password" class="inputs required"
                                                oninput="checkSenha()" required>
                                            <i class="bi bi-eye" id="b-senha" onclick="mostrarSenha()"></i>
                                        </div>
                                    </div>
                                    <div id="cnae" class="form-control">
                                        <h3 id="tit_cc">Confirmar senha:</h3>
                                        <div class="s">
                                            <input name="senhaDois" id="senha2" type="password" class="inputs required"
                                                oninput="checarr()">
                                            <i class="bi bi-eye" id="b2-senha" onclick="mostrarSenha()"></i>
                                        </div>
                                    </div>
                                </div>
                                <br>
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
                                            onclick="verificar(), verificarsenha()"></input>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </form>

                <script>
const input = document.getElementById("cnpj");


input.addEventListener('keypress', () => {
    let inputLength = input.value.length

    if (inputLength == 2 || inputLength == 7) {
        input.value += '.'
    }else if (inputLength == 11) {
        input.value += '/'
    }else if (inputLength == 16) {
        input.value += '-'}
})


const tel = document.getElementById("ad_tel");


tel.addEventListener('keypress', () => {
    let inputLength2 = tel.value.length

    if (inputLength2 == 0) {
        tel.value += '('
    }else if (inputLength2 == 3) {
        tel.value += ')'
    }else if (inputLength2 == 9) {
        tel.value += '-'}
})

</script>
                <script src="./JS/Cadastro.js"></script>
            </section>


        </div>
    </div>
    <form action="CadastroONG.php" enctype="multipart/form-data" method="POST" class="caixa-geral">
        <div class="container">
            <div class="carregamento">
                <div id="linhascell2"></div>
                <div id="linhascell"></div>
            </div>
            <div id="caixa-questionario">
                <div id="tag">
                    <h4 id="tagT">Sobre a ONG</h4>
                </div>
                <form id="formcell">
                    <div id="pagina1">
                        <label for="">Nome da Associação:</label>
                        <input type="text" name="nomeassoc">
                        <label for="">Nome do responsável:</label>
                        <input type="text" name="nomeresp">
                        <label for="">Estatuto Social</label>
                        <input type="text" name="pdf" accept=".pdf" id="arquivo">
                        <label for="">CNPJ:</label>
                        <input type="text" name="cnpj">
                        <label for="">CNAE:</label>
                        <input type="text" name="cnae">
                        <div class="button-cell">
                            <button id="continuar2" onclick="continuarPag2()">Continuar</button>
                        </div>
                    </div>

                    <div id="pagina2">
                        <div id="subpag2">
                            <label for="">Bairro:</label>
                            <input type="text" name="bairro">
                            <label for="">Cidade:</label>
                            <input type="text" name="cidade">
                        </div>
                        <div id="sub-uf-numero">
                            <div id="subuf">
                                <label for="">Rua:</label>
                                <input type="text" name="rua">
                            </div>
                            <div id="subnumero">
                                <label for="">Estado:</label>
                                <input type="text" name="estado">
                            </div>
                        </div>
                        <div id="subnumero1">
                            <label>Complemento:</label>
                            <input name="compl" type="text">
                        </div>
                        <div id="subcep">
                            <label for="">CEP:</label>
                            <input type="text" id="cep" name="cep">
                        </div>
                        <div class="button-cell2">
                            <button id="Voltar" onclick="pag2()">Voltar</button>
                            <button id="continuar3" onclick="continuarPag3ong()">Continuar</button>
                        </div>
                    </div>

                    <div id="pagina3">
                        <div id="foto">
                            <label class="picture" tabindex="0">
                                <div class="max-width"></div>
                                <input type="file" name="foto1" accept=".jpg, .jpeg, .png" class="picture__input"><img
                                    id="imgPhoto"
                                    src="data:image/png;base64,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">
                                <span class="picture__image"></span>
                            </label>
                        </div>
                        <div id="lT">
                            <label for="arquivo">Adicionar foto da ONG (IMG 1)</label>
                            <div id="form_group">
                                <span class="material-symbols-outlined" style="color: #333; font-size: 30px;">
                                    upload
                                </span>

                                <input type="file" name="foto2" class="inp" accept=".jpg, .jpeg, .png" id="arquivo">
                            </div>
                            <label for="arquivo">Adicionar foto da ONG(IMG 2)</label>
                            <div id="form_group">
                                <span class="material-symbols-outlined" style="color: #333; font-size: 30px;">
                                    upload
                                </span>

                                <input type="file" name="foto3" class="inp" accept=".jpg, .jpeg, .png" id="arquivo">
                            </div>
                            <label for="arquivo">Adicionar foto da ONG (IMG 3)</label>
                            <div id="form_group">
                                <span class="material-symbols-outlined" style="color: #333; font-size: 30px;">
                                    upload
                                </span>

                                <input type="file" name="foto4" class="inp" accept=".jpg, .jpeg, .png" id="arquivo">
                            </div>

                        </div>
                        <div class="button-cell2">
                            <button id="Voltar" onclick="pag2()">Voltar</button>
                            <button id="continuar3" onclick="continuarPag4()">Continuar</button>
                        </div>
                    </div>

                    <div id="pagina4">
                        <div id="subpag4">
                            <label for="">Nome Completo:</label>
                            <input type="text">
                            <label for="">Cargo:</label>
                            <input type="text" name="cargo">
                            <label for="">E-mail:</label>
                            <input type="email" name="email">
                            <div id="cnpj" class="form-control">
                                <label>Senha:</label>
                                <div class="s">
                                    <input name="senha" id="senha" type="password" class="inputs required"
                                        oninput="checkSenha()" required>
                                    <i class="bi bi-eye" id="b-senha" onclick="mostrarSenha()"></i>
                                </div>
                            </div>
                            <div id="cnae" class="form-control">
                                <label>Confirmar senha:</label>
                                <div class="s">
                                    <input name="senhaDois" id="senha2" type="password" class="inputs required"
                                        oninput="checarr()">
                                    <i class="bi bi-eye" id="b2-senha" onclick="mostrarSenha()"></i>
                                </div>
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
                                        onclick="verificar(), verificarsenha()"></input>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </form>
</body>

<style>
    label {
        width: 88%;
    }

    #pagina1 input {
        width: 88%;
    }

    #form_group {
        border: 1px solid #333;
        height: 38px;
    }

    #pagina4 {
        flex-direction: column;
    }

    #cnae {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

</style>

<footer>
    <div id="funcoes">
        <a href="pag_inicial.html" id="nome_fc">HOME</a>
        <a href="PagEscolha.php" id="nome_fc">CADASTRE-SE</a>
        <a href="PaginaInicial.html #b1" id="nome_fc">SOBRE NÓS</a>
    </div>
    <img id="ft_f" src="./IMG/logo com nome.png">
    <h3 id="nome_c">Copyright &copy;2023 projeto regenerese</h3>
</footer>

</html>