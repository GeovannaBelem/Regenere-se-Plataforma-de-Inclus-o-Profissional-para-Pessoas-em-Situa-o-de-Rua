<?php

include_once('config.php');
include_once('testeLogin2.php');

$nome = $_SESSION['nome'];
$nomeA = $_SESSION['nomeAssociacao'];
$cnpj = $_SESSION['cnpj'];
$cargo = $_SESSION['cargo'];
$link = $_SESSION['link'];
$cidade = $_SESSION['cidade'];
$bairro = $_SESSION['bairro'];
$rua = $_SESSION['rua'];
$estado = $_SESSION['estado'];
$complemento = $_SESSION['complemento'];
$cep = $_SESSION['cep'];
$telefone = $_SESSION['telefone'];
$descricao = $_SESSION['descricao'];
$email = $_SESSION['email'];

try {
    $sql = "SELECT fotoUsuario FROM fotosong WHERE cnpj = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(1, $cnpj);
    $stmt->execute();

    $stmt->bindColumn('fotoUsuario', $imagem_blob, PDO::PARAM_LOB);

    if ($stmt->fetch(PDO::FETCH_BOUND)) {
        // Obtenha a extensão da imagem
        $extensao = pathinfo(PATHINFO_EXTENSION);

        // Defina o tipo MIME com base na extensão
        if ($extensao === 'png') {
            $tipo_mime = 'image/png';
        } elseif ($extensao === 'jpeg' || $extensao === 'jpg') {
            $tipo_mime = 'image/jpeg';
        } elseif ($extensao === 'gif') {
            $tipo_mime = 'image/gif';
        } else {
            $tipo_mime = 'application/octet-stream'; // Tipo MIME padrão para outros tipos de arquivo
        }

        $imagem_base64 = base64_encode($imagem_blob);
    } else {
        echo "Imagem não encontrada.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

if (isset($_POST['sub'])) {

    $cidade2 = $_POST['cidade'];
    $bairro2 = $_POST['bairro'];
    $rua2 = $_POST['rua'];
    $estado2 = $_POST['estado'];
    $complemento2 = $_POST['complemento'];
    $cep2 = $_POST['cep'];
    $celular2 = $_POST['celular'];
    $nome2 = $_POST['nome'];
    $cargo2 = $_POST['cargo'];
    $emai2l = $_POST['email'];

    $atributos = array("cidade", "bairro", "rua", "estado", "complemento", "cep", "telefone", "nome", "cargo", "email");
    $novovalor = array($cidade2, $bairro2, $rua2, $estado2, $complemento2, $cep2, $celular2, $nome2, $cargo2, $emai2l);
    include_once('config.php');

    for ($i = 0; $i < count($atributos); $i++) {
        $atualizar = $conexao->prepare("UPDATE cadastroempresa SET $atributos[$i] = '$novovalor[$i]' WHERE cnpj= '$cnpj'");

        if ($atualizar->execute()) {
            echo "Atualizado com sucesso";
        } else {
            echo "Não atualizou";
        }
    }
    $_SESSION['nome'] = $nome2;
    $_SESSION['cargo'] = $cargo2;
    $_SESSION['cidade'] = $cidade2;
    $_SESSION['bairro'] = $bairro2;
    $_SESSION['rua'] = $rua2;
    $_SESSION['estado'] = $estado2;
    $_SESSION['complemento'] = $complemento2;
    $_SESSION['cep'] = $cep2;
    $_SESSION['telefone'] = $celular2;
    $_SESSION['email'] = $emai2l;
    header('Location:PerfilUsuarioONG.php');

}

if (isset($_POST['subExcluir'])) {
    include_once('config.php');
    $atualizar = $conexao->prepare("DELETE FROM cadastroong  WHERE cnpj= '$cnpj'");
    $atualizar->execute();
    $atualizar = $conexao->prepare("DELETE FROM fotosong  WHERE cnpj= '$cnpj'");
    $atualizar->execute();
    header('Location: Login.php');
}

if (!isset($_SESSION['nome'])) {
    header('Location: Login.php');
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/PerfilUsuarioEmpresa.css">
    <link rel="shortcut icon" href="IMG/logo sem fundo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Perfil Usuário</title>
</head>

<body>
    <header id="header1">
        <div id="logo">
            <img id="ft_logo" src="./IMG/logo sem fundo.png" alt="logo regenere-se">
            <h2 id="nome_logo">REGENERE-SE</h2>
        </div>
        <a id="home" href="PrincipalONG.php">Home</a>
        <a id="home" href="#">Notificação</a>

        <a id="home" href="#">Favoritos</a>
        <a onclick="logout()" href="#" style="font-family: 'antonio', sans-serif; color:#4F4040;">
            <span class="material-icons" style="font-size: 30px;">
                logout
            </span>
        </a>
        <script>
            function logout() {
                $.ajax({
                    type: "POST",
                    url: "logout.php",
                    success: function (response) {
                        window.location.href = 'Login.php';
                    }
                });
            }
            $(document).ready(function () {
                $("#btnlogout").click(function () {
                    logout();
                })
            });
        </script>
    </header>

    <header id="header2">
        <span class="material-symbols-outlined" onclick="hamburguer()">menu</span>
        <div id="logo">
            <img id="ft_logo" src="./IMG/logo sem fundo.png" alt="logo regenere-se">
            <h2 id="nome_logo">REGENERE-SE</h2>
        </div>

        <span class="material-symbols-outlined" onclick="hamburguer2()">account_circle</span>
    </header>


    <script>
        function logout() {
            $.ajax({
                type: "POST",
                url: "logout.php",
                success: function (response) {
                    window.location.href = 'Login.php';
                }
            });
        }
        $(document).ready(function () {
            $("#btnlogout").click(function () {
                logout();
            })
        });
    </script>
    </header>
    <div id="hamburguer1">
        <a id="home2" href="PrincipalONG.php">Home</a>
        <a id="home2" href="#">Notificação</a>
        <a id="home2" href="#">Favoritos</a>
    </div>

    <div id="hamburguer2">
        <div id="menu_conf2">
            <div class="menu_usuario2">
                <div id="ret2">
                    <label class="picture" tabindex="0">
                        <div class="max-width2"></div>
                        <input type="file" accept="image/*" class="picture__input2">
                        <img src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem_base64; ?>"
                            alt="Imagem da Empresa">
                        <span class="picture__image"></span>
                    </label>
                </div>
                <h3 id="nome_menu12">
                    <?php echo $nome ?>
                </h3>
                <h5>
                    <?php echo $cargo ?>
                </h5>
                <div id="txt2">
                    <div id="nome_menu2">
                        <img src="IMG/escritorio.png">
                        <a id="nm2" href="MinhaInstituicao.php">Minha Instituição</a>
                    </div>

                    <div id="nome_menu2">
                        <img src="IMG/usuario.png">
                        <a id="nm2" href="PerfilUsuarioONG.php">Meu Perfil</a>
                    </div>

                    <div id="favo2">
                        <span class="material-icons" style="color: #561FAD; font-size: 30px;">
                            favorite
                        </span>
                        <a id="nm2" href="#">Favoritos</a>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div id="geral">
        <div id="geral1">
            <div id="foto">
                <label class="picture" tabindex="0" style="background-color: white;">
                    <div class="max-width"></div>
                    <img src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem_base64; ?>"
                        alt="Imagem da Empresa">
                    <span class="picture__image"></span>
                </label>
            </div>
            <div id="infos_geral1">
                <h2>
                    <?php echo $nome ?>
                </h2>
                <h3>
                    <?php echo $cargo ?>
                </h3>
                <h4 id="descricao">
                    <?php echo $descricao ?>
                </h4>
                <form action="PerfilUsuarioONG.php" method="POST">
                    <input type="submit" id="subExcluir" name="subExcluir" value="Excluir conta">
                </form>
            </div>
        </div>

        <h4 id="repphp4">
            <?php echo $descricao ?>
        </h4>
        <div id="geral2">
            <div id="escolha">
                <div id="btn_filtro" style="justify-content: left; margin-left: 5%;">
                    <button id="btn_pess">Dados Gerais</button>
                </div>
                <div id="linha_filtro" style="justify-content: left;">
                    <div id="ret1_linha" style="margin-left: 5%; width: 17%;"></div>
                </div>
            </div>

            <div id="dadosGerais" style="display:block; margin-left: 5%">
                <div id="duplaDG">
                    <div id="nome">
                        <h3>Nome Completo:</h3>
                        <h4>
                            <?php echo $nome ?>
                        </h4>
                    </div>
                    <div id="email">
                        <h3>E-mail:</h3>
                        <h4>
                            <?php echo $email ?>
                        </h4>
                    </div>
                    <div id="cargo">
                        <h3>Cargo:</h3>
                        <h4>
                            <?php echo $cargo ?>
                        </h4>
                    </div>
                </div>
                <div id="duplaDG">
                    <div id="celular">
                        <h3>Celular:</h3>
                        <h4>
                            <?php echo $telefone ?>
                        </h4>
                    </div>
                    <div id="CEP">
                        <h3>CEP:</h3>
                        <h4>
                            <?php echo $cep ?>
                        </h4>
                    </div>
                    <div id="bairro">
                        <h3>Bairro:</h3>
                        <h4>
                            <?php echo $bairro ?>
                        </h4>
                    </div>
                </div>
                <div id="duplaDG">
                    <div id="rua">
                        <h3>Rua:</h3>
                        <h4>
                            <?php echo $rua ?>
                        </h4>
                    </div>
                    <div id="cidade">
                        <h3>Cidade:</h3>
                        <h4>
                            <?php echo $cidade ?>
                        </h4>
                    </div>
                    <div id="estado">
                        <h3>Estado:</h3>
                        <h4>
                            <?php echo $estado ?>
                        </h4>
                    </div>
                </div>
                <div id="complemento">
                    <h3>Complemento:</h3>
                    <h4>
                        <?php echo $complemento ?>
                    </h4>
                </div>

                <div id="btnEditar" onclick="editar()">
                    <button onclick="editar()"><img src="./IMG/editar.png">Editar Perfil</button>
                </div>
            </div>
        </div>
        <form action="PerfilUsuarioONG.php" method="POST" id="Editar">
            <div id="btn_filtro">
                <button id="btn_pess">Editar informações</button>
            </div>
            <div id="linha_filtro">
                <div id="ret1_linha"></div>
            </div>

            <form action="PerfilUsuarioONG.php" method="post">
                <div id="Editar1">
                    <div id="duplaDG">
                        <div id="nome">
                            <h3>Nome Completo:</h3>
                            <input type="text" name="nome" value="<?php echo $nome ?>" required>

                        </div>
                        <div id="email">
                            <h3>E-mail:</h3>
                            <input type="text" name="email" value="<?php echo $email ?>" required>

                        </div>
                        <div id="cargo">
                            <h3>Cargo:</h3>
                            <input type="text" name="cargo" value="<?php echo $cargo ?>" required>

                        </div>
                    </div>
                    <div id="duplaDG">
                        <div id="celular">
                            <h3>Celular:</h3>
                            <input type="text" name="celular" value="<?php echo $telefone ?>" required>
                        </div>
                        <div id="CEP">
                            <h3>CEP:</h3>
                            <input type="text" name="cep" value="<?php echo $cep ?>" required>

                        </div>
                        <div id="bairro">
                            <h3>Bairro:</h3>
                            <input type="text" name="bairro" value="<?php echo $bairro ?>" required>

                        </div>
                    </div>
                    <div id="duplaDG">
                        <div id="rua">
                            <h3>Rua:</h3>
                            <input type="text" name="rua" value="<?php echo $rua ?>" required>

                        </div>
                        <div id="cidade">
                            <h3>Cidade:</h3>
                            <input type="text" name="cidade" value="<?php echo $cidade ?>" required>

                        </div>
                        <div id=" estado">
                            <h3>Estado:</h3>
                            <input type="text" name="estado" value="<?php echo $estado ?>" required>

                        </div>
                    </div>
                    <div id="complemento">
                        <h3>Complemento:</h3>
                        <input type="text" name="complemento" value="<?php echo $complemento ?>" required>
                    </div>

                    <div id="btnEditar">
                        <input name="sub" id="sub" type="submit" value="Salvar">
                    </div>
                </div>
            </form>
    </div>

    <footer>
        <div id="funcoes">
            <a href="pag_inicial.html" id="nome_fc">HOME</a>
            <a href="PagEscolha.php" id="nome_fc">CADASTRE-SE</a>
            <a href="PaginaInicial.html #prt_3" id="nome_fc">SOBRE NÓS</a>
        </div>
        <img src="img/logo com nome.png" alt="Logo Regenere-se" id="ft_f">
        <h3 id="nome_c">Copyright ©2023 projeto regenerese</h3>
    </footer>

    <div id="funcoes1">
        <div id=imgrep>
            <img src="img/logo com nome.png" alt="Logo Regenere-se" id="ft_f2">
        </div>
        <div id="funcoes2">
            <a href="pag_inicial.html" id="nome_fc2">HOME</a>
            <a href="PagEscolha.php" id="nome_fc2" class="link1">CADASTRE-SE</a>
            <a href="pag_inicial.html #prt_3" id="nome_fc2">SOBRE NÓS</a>
        </div>
        <h3 id="nome_c22">Copyright ©2023 projeto regenerese</h3>

    </div>
    </div>
    <script>
    window.addEventListener('load', function () {
        document.getElementById('loading-container').style.display = 'none';
    });
</script>
    <script src="./js/PerfilUsuarioEmpresa.js"></script>
    
</body>

</html>