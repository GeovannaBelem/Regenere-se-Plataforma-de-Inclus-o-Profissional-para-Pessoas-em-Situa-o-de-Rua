<?php
include_once('config.php');
include_once('Usuario.php');

$cnpj = $_GET['cnpj'];
$sql2 = "SELECT * FROM cadastroong WHERE cnpj = '$cnpj'";
$stmt2 = $conexao->prepare($sql2);
$stmt2->execute();
$dados2 = $stmt2->fetch();
try {
    $sql = "SELECT * FROM fotosong WHERE cnpj = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(1, $cnpj);
    $stmt->execute();

    $stmt->bindColumn('fotoUsuario', $imagem_blob, PDO::PARAM_LOB);
    $stmt->bindColumn('fotoONG1', $imagem1_blob, PDO::PARAM_LOB);
    $stmt->bindColumn('fotoONG2', $imagem2_blob, PDO::PARAM_LOB);
    $stmt->bindColumn('fotoONG3', $imagem3_blob, PDO::PARAM_LOB);

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
        $imagem1_base64 = base64_encode($imagem1_blob);
        $imagem2_base64 = base64_encode($imagem2_blob);
        $imagem3_base64 = base64_encode($imagem3_blob);
    } else {
        echo "Imagem não encontrada.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/PerfilONG_ong.css">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="shortcut icon" href="IMG/logo sem fundo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>ONG
        <?php echo $dados2['nomeAssociacao'] ?>
    </title>
</head>

<body>
    <header>
        <div id="logo">
            <img id="ft_logo" src="./IMG/logo sem fundo.png" alt="logo regenere-se">
            <h2 id="nome_logo">REGENERE-SE</h2>
        </div>
        <a id="home" href="PrincipalONG.php">Home</a>
        <a id="home" href="#">Notificação</a>
        <a id="home" href="#">Candidatos</a>
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

    <style>
        #loading-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
    </style>
    <div id="loading-container">
        <img src="./IMG/loading.gif" alt="Carregando...">
    </div>

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



    <div id="geral">
        <div id="logo_infos">
            <img id="ft_logoo" src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem_base64; ?>"
                alt="Foto da ONG">
            <div id="infos_gerais">
                <h1>
                    <?php echo $dados2['nomeAssociacao'] ?>
                </h1>
                <div id="infos">
                    <h3>Local:
                        <?php echo $dados2['rua'] ?>,
                        <?php echo $dados2['bairro'] ?>,
                        <?php echo $dados2['cidade'] ?> -
                        <?php echo $dados2['estado'] ?>
                    </h3>
                    <h3>Email:
                        <?php echo $dados2['email'] ?>
                    </h3>
                    <h3>Telefone:
                        <?php echo $dados2['telefone'] ?>
                    </h3>
                </div>
            </div>
        </div>

        <div id="sobreong">
            <h3>- SOBRE NÓS -</h3>
            <div id="carouselExampleFade" class="carousel slide carousel-fade">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div id="textosobrenos">
                            <h4>
                                <?php echo $dados2['descricao'] ?>
                            </h4>
                        </div>

                    </div>
                    <div class="carousel-item">
                        <img src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem1_base64; ?>"
                            class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem2_base64; ?>"
                            class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem3_base64; ?>"
                            class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <h2>- CANDIDATOS -</h2>
        <div class="perfiscandidatos">
            <?php
            $candidatos = "SELECT * FROM cadastrocandidatos where contratado = 'nao'";
            $st = $conexao->prepare($candidatos);
            $st->execute();

            $dados = $st->fetchAll();
            foreach ($dados as $dado) {

                $sql2 = "SELECT fotos FROM cadastrocandidatos WHERE id_cand = ?";
                $stmt2 = $conexao->prepare($sql2);
                $stmt2->bindParam(1, $dado['id_cand']);
                $stmt2->execute();

                $stmt2->bindColumn('fotos', $fotocand, PDO::PARAM_LOB);
                if ($stmt2->fetch(PDO::FETCH_BOUND)) {
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
                }
                echo '<a class="perfil" href="perfilcandidatos.php?id=' . $dado['id_cand'] . '">';

                echo '<p id="core">♡</p>';
                echo '<div class="infos">';
                echo '<div class="foto">';
                echo '<img id="imge" width="60%" src="data:' . $tipo_mime2 . ';base64,' . $imagem_base . '">';
                echo '</div>';
                echo '<div class="infor">';
                echo '<div class="nome">';
                echo '<p>' . $dado['nomecandidato'] . ' </p>';
                echo '</div>';
                echo '<div class="especificações">';
                echo '<p>' . $dado['areadeatuacao'] . '</p>';
                echo '</div>';
                echo '<div class="especificações">';
                echo '<p>' . $dado['faixaetaria'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="verde">';
                echo 'Ver mais';
                echo '</div>';

                echo '</a>';
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
            font-size: 16px;
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
            width: 95%;
            justify-content: center;
        }


        #core {
            font-size: 28px;
            color: #9D60FF;
            width: 90%;
            border-radius: 15px;
            text-align: right;
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

        .perfiscandidatos {
            display: flex;
            flex-wrap: wrap;
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
            width: 20%;
            box-sizing: border-box;
            margin-right: 4vh;
        }

        a {
            text-decoration: none;
            list-style: none;
            color: #4F4040;
        }
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
            <a href="pag_inicial.html #prt_3" id="nome_fc">SOBRE NÓS</a>
        </div>
        <img src="img/logo com nome.png" alt="Logo Regenere-se" id="ft_f">
        <h3 id="nome_c">Copyrid ©️2023 projeto regenerese</h3>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script>
        window.addEventListener('load', function () {
            document.getElementById('loading-container').style.display = 'none';
        });
    </script>
</body>

</html>