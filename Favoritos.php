<?php

include_once('config.php');
include_once('testeLogin2.php');

$nome = $_SESSION['nome'];
$cargo = $_SESSION['cargo'];
$cnpj = $_SESSION['cnpj'];
$nomeempresa = $_SESSION['nomeFantasia'];

try {
    $sql = "SELECT fotos FROM cadastroempresa WHERE cnpj = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(1, $cnpj);
    $stmt->execute();

    $stmt->bindColumn('fotos', $imagem_blob, PDO::PARAM_LOB);

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Regenere-se</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="IMG/logo sem fundo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/PrincipalEmpresa.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>



    <header id="header1">
        <div id="logo">
            <img id="ft_logo" src="./IMG/logo sem fundo.png" alt="logo regenere-se">
            <h2 id="nome_logo">REGENERE-SE</h2>
        </div>
        <a id="home" href="PrincipalEmpresa.php">Home</a>
        <a id="home" href="#">Notificação</a>
        <a id="home" href="Favoritos.php">Favoritos</a>
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

    <div id="hamburguer1">
        <a id="home2" href="PrincipalEmpresa.php">Home</a>
        <a id="home2" href="#">Notificação</a>
        <a id="home2" href="Favoritos.php">Favoritos</a>
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
                        <a id="nm2" href="PerfilUsuarioEmpresa.php">Meu Perfil</a>
                    </div>
                    <div id="favo2">
                        <span class="material-icons" style="color: #561FAD; font-size: 30px;">
                            favorite
                        </span>
                        <a id="nm2" href="Favoritos.php">Favoritos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="geral">



        <div id="menu_conf">
            <div class="menu_usuario">
                <div id="ret">
                    <label class="picture" tabindex="0">
                        <div class="max-width"></div>
                        <input type="file" accept="image/*" class="picture__input">
                        <img src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem_base64; ?>"
                            alt="Imagem da Empresa">
                        <span class="picture__image"></span>
                    </label>
                </div>
                <h3 id="nome_menu1">
                    <?php echo $nome ?>
                </h3>

                <div id="txt">
                    <div id="nome_menu"
                        style="border: none; padding:0; display: flex; flex-direction:column; justify-content: center;">
                        <a id="nm" href="MinhaInstituicao.php" style="font-size: 13px; margin-left:0;">
                            <?php echo $nomeempresa ?>
                        </a>
                        <h5>
                            <?php echo $cargo ?>
                        </h5>
                    </div>
                    <div id="nome_menu">
                        <img src="IMG/usuario.png">
                        <a id="nm" href="PerfilUsuarioEmpresa.php">Meu Perfil</a>
                    </div>
                    <div id="favo">
                        <span class="material-icons" style="color: #561FAD; font-size: 30px;">
                            favorite
                        </span>
                        <a id="nm" href="Favoritos.php">Favoritos</a>
                    </div>
                </div>
            </div>

        </div>

        <div id="filtro_geral">
            <div class="coisa1">
                <h2 id="tit_fil">Meus Favoritos</h2>
                <div id="btn_filtro">
                    <button id="btn_pess" onclick="mostrar_linha11()">Pessoas</button>
                    <button id="btn_ONG" onclick="mostrar_linha22()">ONGs</button>
                </div>
                <div id="linha_filtro">
                    <div id="ret1_linha"></div>
                    <div id="ret2_linha"></div>
                </div>
            </div>


            <div class="perfiscandidatos">

                <?php
                $sql2 = "SELECT id_cand FROM favoritoscand WHERE cnpjempresa = ?";
                $stmt2 = $conexao->prepare($sql2);
                $stmt2->bindParam(1, $cnpj);
                $stmt2->execute();
                $dados = $stmt2->fetchAll();


                    foreach ($dados as $dado) {

                        $candidatos = "SELECT * FROM cadastrocandidatos WHERE id_cand = ?";
                        $st = $conexao->prepare($candidatos);
                        $st->bindParam(1, $dado['id_cand']);
                        $st->execute();

                        $dados2 = $st->fetchAll();


                        foreach ($dados2 as $dado2) {
                            $sql222 = "SELECT fotos FROM cadastrocandidatos WHERE id_cand = ?";
                            $stmt21 = $conexao->prepare($sql222);
                            $stmt21->bindParam(1, $dado2['id_cand']);
                            $stmt21->execute();
                            $stmt21->bindColumn('fotos', $fotocand, PDO::PARAM_LOB);
                            if ($stmt21->fetch(PDO::FETCH_BOUND)) {
                                // Obtenha a extensão da imagem
                                $extensao2 = pathinfo(PATHINFO_EXTENSION);
                        
                                // Defina o tipo MIME com base na extensão
                                if ($extensao2 === 'png') {
                                    $tipo_mime2 = 'image/png';
                                } elseif ($extensao2 === 'jpeg' || $extensao2 === 'jpg') {
                                    $tipo_mime2 = 'image/jpeg';
                                } elseif ($extensao2 === 'gif') {
                                    $tipo_mime2 = 'image/gif';
                                } else {
                                    $tipo_mime2 = 'application/octet-stream'; // Tipo MIME padrão para outros tipos de arquivo
                                }
                        
                                $imagem_base = base64_encode($fotocand);
                        

                                echo '<a class="perfil" href="perfilcandidatos.php?id=' . $dado2['id_cand'] . '">';

                                echo '<p id="core">❤</p>';
                                echo '<div class="infos">';
                                echo '<div class="foto">';
                                echo '<img id="imge" width="60%" src="data:' . $tipo_mime2 . ';base64,' . $imagem_base . '">';
                                echo '</div>';
                                echo '<div class="infor">';
                                echo '<div class="nome">';
                                echo '<p>' . $dado2['nomecandidato'] . ' </p>';
                                echo '</div>';
                                echo '<div class="especificações">';
                                echo '<p>' . $dado2['areadeatuacao'] . '</p>';
                                echo '</div>';
                                echo '<div class="especificações">';
                                echo '<p>' . $dado2['faixaetaria'] . '</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="verde">';
                                echo 'Ver mais';
                                echo '</div>';

                                echo '</a>';
                            }
                        }
                    }
                
                ?>
            </div>

            <div class="perfisongs">

                <?php

                $sql2 = "SELECT cnpjong FROM favoritosong WHERE cnpjempresa = ?";
                $stmt2 = $conexao->prepare($sql2);
                $stmt2->bindParam(1, $cnpj);
                $stmt2->execute();
                $dados = $stmt2->fetchAll();

                foreach ($dados as $dado) {

                    $sql_cadastroong = "SELECT * FROM cadastroong WHERE cnpj = ?";
                    $stmt_cadastroong = $conexao->prepare($sql_cadastroong);
                    $stmt_cadastroong->bindParam(1, $dado['cnpjong']);
                    $stmt_cadastroong->execute();
                    $dados2 = $stmt_cadastroong->fetchAll();

                    foreach ($dados2 as $dado2) {

                        $sql22 = "SELECT fotoUsuario FROM fotosong WHERE cnpj = ?";
                        $stmt22 = $conexao->prepare($sql22);
                        $stmt22->bindParam(1, $dado2['cnpj']);
                        $stmt22->execute();
                        $stmt22->bindColumn('fotoUsuario', $fotocand2, PDO::PARAM_LOB);

                        if ($stmt22->fetch(PDO::FETCH_BOUND)) {
                            // Obtenha a extensão da imagem
                            $extensao22 = pathinfo(PATHINFO_EXTENSION);

                            // Defina o tipo MIME com base na extensão
                            if ($extensao22 === 'png') {
                                $tipo_mime22 = 'image/png';
                            } elseif ($extensao22 === 'jpeg' || $extensao22 === 'jpg') {
                                $tipo_mime22 = 'image/jpeg';
                            } elseif ($extensao22 === 'gif') {
                                $tipo_mime22 = 'image/gif';
                            } else {
                                $tipo_mime22 = 'application/octet-stream'; // Tipo MIME padrão para outros tipos de arquivo
                            }

                            $imagem_base2 = base64_encode($fotocand2);

                            echo '<a class="perfil" href="PerfilONG_empresa.php?cnpj=' . $dado2['cnpj'] . '">';

                            echo '<p id="core">❤</p>';
                            echo '<div class="infos">';
                            echo '<div class="foto">';
                            echo '<img id="imge" width="60%" src="data:' . ';base64,' . $imagem_base2 . '">';
                            echo '</div>';
                            echo '<div class="infor">';
                            echo '<div class="nome">';
                            echo '<p>' . $dado2['nomeAssociacao'] . ' </p>';
                            echo '</div>';
                            echo '<div class="especificações">';
                            echo '<p>' . $dado2['nomeResponsavel'] . '</p>';
                            echo '</div>';
                            echo '<div class="especificações">';
                            echo '<p>' . $dado2['cidade'] . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="verde">';
                            echo 'Ver mais';
                            echo '</div>';

                            echo '</a>';
                        }
                    }
                }
                ?>

            </div>
        </div>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Antonio:wght@100&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap');

            p {
                margin-top: 1px;
            }

            .especificações {
                font-size: 12px;

            }

            .infor {
                font-weight: 800;
                font-size: 14px;
                max-width: 100px;
                display: flex;
                flex-direction: column;
                align-content: center;
                justify-content: center;
                align-items: center;
                text-align: center;
                max-width: fit-content;

            }

            #imge {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 90%;
            }

            .perfiscandidatos {
                display: flex;
                flex-wrap: wrap;
            }

            #core {
                font-size: 25px;
                color: #9D60FF;
                margin-left: 25vh;
            }

            .infos {
                margin-top: 1vh;
                height: 75%;
                width: 100%;
                display: flex;
                flex-direction: column;
                align-content: center;
                justify-content: center;
                align-items: center;
            }

            .nome {
                font-weight: 900;
                font-size: 16px;
            }

            .foto {
                display: flex;
                border: 2px solid #B1FFCE;
                margin-bottom: 1vh;
                width: 14vh;
                height: 14vh;
                align-items: center;
                justify-content: center;
                border-radius: 90%;
            }

            .perfisongs {
                display: none;
            }

            .verde {
                position: relative;
                display: flex;
                margin-top: 12%;
                background-color: #B1FFCE;
                font-weight: bold;
                height: 10vh;
                font-size: 15px;
                width: 100%;
                border-radius: 0px 0px 15px 15px;
                align-items: center;
                justify-content: center;
                border-top: 1px solid #9D60FF;
            }

            .perfil {

                font-family: 'roboto', sans-serif;
                border-radius: 15px;
                margin-top: 5vh;
                display: flex;
                align-content: center;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                border: 1px solid #9D60FF;
                width: 25%;
                box-sizing: border-box;
                margin-right: 2vh;
            }
        </style>


    </div>

    </div>


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
</body>

<script>
    window.addEventListener('load', function () {
        document.getElementById('loading-container').style.display = 'none';
    });
</script>
<script src="JS/PrincipalEmpresa.js"></script>

</html>