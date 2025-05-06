<?php
include_once('config.php');
include_once('Usuario.php');

$nomeA = $_SESSION['nomeAssociacao'];
$cnpj = $_SESSION['cnpj'];
$cargo = $_SESSION['cargo'];
$email = $_SESSION['email'];
$rua = $_SESSION['rua'];
$bairro = $_SESSION['bairro'];
$cidade = $_SESSION['cidade'];
$estado = $_SESSION['estado'];
$telefone = $_SESSION['telefone'];
$descricao = $_SESSION['descricao'];
$complemento = $_SESSION['complemento'];
$cep = $_SESSION['cep'];

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

if (isset($_POST['sub'])) {

    $cidade2 = $_POST['cidade'];
    $bairro2 = $_POST['bairro'];
    $rua2 = $_POST['rua'];
    $estado2 = $_POST['estado'];
    $complemento2 = $_POST['complemento'];
    $cep2 = $_POST['cep'];
    $celular2 = $_POST['celular'];
    $nome2 = $_POST['nome'];
    $emai2l = $_POST['email'];

    $atributos = array("cidade", "bairro", "rua", "estado", "complemento", "cep", "telefone", "nomeAssociacao", "email");
    $novovalor = array($cidade2, $bairro2, $rua2, $estado2, $complemento2, $cep2, $celular2, $nome2, $emai2l);
    include_once('config.php');

    for ($i = 0; $i < count($atributos); $i++) {
        $atualizar = $conexao->prepare("UPDATE cadastroong SET $atributos[$i] = '$novovalor[$i]' WHERE cnpj= '$cnpj'");

        if ($atualizar->execute()) {
            echo "Atualizado com sucesso";
        } else {
            echo "Não atualizou";
        }
    }
    $_SESSION['nomeAssociacao'] = $nome2;
    $_SESSION['cidade'] = $cidade2;
    $_SESSION['bairro'] = $bairro2;
    $_SESSION['rua'] = $rua2;
    $_SESSION['estado'] = $estado2;
    $_SESSION['complemento'] = $complemento2;
    $_SESSION['cep'] = $cep2;
    $_SESSION['telefone'] = $celular2;
    $_SESSION['email'] = $emai2l;
    header('Location:perfilONG_ong.php');
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/perfilONG_ong.css">
    <link rel="shortcut icon" href="IMG/logo sem fundo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>ONG
        <?php echo $nomeA ?>
    </title>
</head>

<body>
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

    <div id="conteiner_editar">
        <div id="editar_infos">
            <form action="perfilONG_ong.php" method="post" id="inputs">
                <button>X</button>
                <div class="dupla_input1">
                    <div class="dupla">
                        <h3>Nome ONG:</h3>
                        <input type="text" name="nome" value="<?php echo $nomeA ?>" >
                    </div>
                    <div class="dupla">
                        <h3>E-mail:</h3>
                        <input type="text" name="email" value="<?php echo $email ?>" >
                    </div>
                </div>
                <div class="dupla_input1">
                    <div class="dupla">
                        <h3>Celular:</h3>
                        <input type="text" name="celular" value="<?php echo $telefone ?>" >
                    </div>
                    <div class="dupla">
                        <h3>CEP:</h3>
                        <input type="text" name="cep" value="<?php echo $cep ?>" >
                    </div>
                </div>
                <div class="dupla_input">
                    <div class="dupla">
                        <h3>Bairro:</h3>
                        <input type="text" name="bairro" value="<?php echo $bairro ?>" >
                    </div>
                    <div class="dupla">
                        <h3>Rua:</h3>
                        <input type="text" name="rua" value="<?php echo $rua ?>" >
                    </div>
                </div>
                <div class="dupla_input">
                    <div class="dupla">
                        <h3>Cidade:</h3>
                        <input type="text" name="cidade" value="<?php echo $cidade ?>" >
                    </div>
                    <div class="dupla">
                        <h3>Estado:</h3>
                        <input type="text" name="estado" value="<?php echo $estado ?>" >
                    </div>
                </div>
                <div id="comp_inp">
                    <h3>Complemento:</h3>
                    <input type="text" name="complemento" value="<?php echo $complemento ?>" >
                </div>

                <div id="btnEditar">
                    <input name="sub" id="sub" type="submit" value="Salvar">
                </div>
            </form>
        </div>
    </div>


    <div id="conteiner_editar2">
        <div id="editar_infos">
            <form action="perfilONG_ong.php" method="post" id="inputs">
                <button>X</button>
                <div id="comp_inp">
                    <h3>Descrição:</h3>
                    <input type="text" name="descricao" value="<?php echo $descricao ?>" >
                </div>
                <h3>Foto ONG 1:</h3>
                <div id="foto">
                    <label class="picture" tabindex="0">
                        <div class="max-width"></div>
                        <input type="file" name="Foto1" accept="image/*" class="picture__input">
                    </label>
                </div>
                <h3>Foto ONG 2:</h3>
                <div id="foto">
                    <label class="picture" tabindex="0">
                        <div class="max-width"></div>
                        <input type="file" name="Foto2" accept="image/*" class="picture__input">
                    </label>
                </div>
                <h3>Foto ONG 3:</h3>
                <div id="foto">
                    <label class="picture" tabindex="0">
                        <div class="max-width"></div>
                        <input type="file" name="Foto3" accept="image/*" class="picture__input">
                    </label>
                </div>
                <div id="btnEditar">
                    <input name="sub2" id="sub" type="submit" value="Salvar">
                </div>
            </form>
        </div>
    </div>
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
                    success: function(response) {
                        window.location.href = 'Login.php';
                    }
                });
            }
            $(document).ready(function() {
                $("#btnlogout").click(function() {
                    logout();
                })
            });
        </script>
    </header>


    <div id="geral">
        <div id="logo_infos">
            <img id="ft_logoo" src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem_base64; ?>" alt="Foto da ONG">
            <div id="infos_gerais">
                <h1>
                    <?php echo $nomeA ?>
                </h1>
                <div id="infos">
                    <h3>Local:
                        <?php echo $rua ?>,
                        <?php echo $bairro ?>,
                        <?php echo $cidade ?> -
                        <?php echo $estado ?>, 
                        <?php echo $complemento ?>
                    </h3>
                    <h3>Email:
                        <?php echo $email ?>
                    </h3>
                    <h3>Telefone:
                        <?php echo $telefone ?>
                    </h3>
                    <button id="button_editar" onclick="editar()"><img id="editar_ft" src="img/editar.png">Editar
                        Informações</button>
                </div>
            </div>
        </div>

        <div id="sobreong">
            <h3 id="tit_sobrenos">- SOBRE NÓS -</h3>
            <div id="carouselExampleFade" class="carousel slide carousel-fade">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div id="textosobrenos">
                            <h4>
                                <?php echo $descricao ?>
                            </h4>
                        </div>

                    </div>
                    <div class="carousel-item">
                        <img src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem1_base64; ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem2_base64; ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem3_base64; ?>" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div id="ed_foto_conteiner">
                <button type="submit" name="edit_fts" id="button_editar2" onclick="editarFT()"><img id="editar_ft" src="img/editar.png">Editar Fotos</button>
            </div>
        </div>

        <h2 id="titcands">- CANDIDATOS -</h2>
        <div class="perfiscandidatos">
            <?php
            $candidatos = "SELECT * FROM cadastrocandidatos where cnpj_ong = '$cnpj' and contratado = 'nao'";
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
        <div id="btn_cand">
            <button><a href="CadastrarCandidatos.php">+ Adicionar Candidatos</a></button>
        </div>
    </div>



    <!-- mudança -->
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

        .verde2 {
            position: relative;
            display: flex;
            margin-top: 12%;
            background-color: #B1FFCE;
            font-weight: bold;
            height: 30px;
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
            background-color: white;
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

        .perfil2 {
            flex: 0 0 auto;
            font-family: 'roboto', sans-serif;
            border-radius: 15px;
            background-color: white;
            margin-top: 5vh;
            display: flex;
            align-content: center;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border: 1px solid #9D60FF;
            height: 300px;
            width: 200px;
            box-sizing: border-box;
            margin-right: 4vh;

        }

        a {
            text-decoration: none;
            list-style: none;
            color: #4F4040;
        }

        #contratados_1 {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding-bottom: 5%;
        }

        p {
            margin: 0;
        }

         #contratados_1::-webkit-scrollbar {
            width: 12px;
        }

         #contratados_1::-webkit-scrollbar-thumb {
            background-color: #7BFFAC;
            border-radius: 10px;
        }

         #contratados_1::-webkit-scrollbar-track {
            background-color: #f2f2f2;
        }
    </style>

    <section class="prt_2">
        <div class="prt2_1">
            <div id="forma2"></div>
        </div>
        <div id="contratados">
            <h2>- CONTRATADOS -</h2>
            <div id="contratados_1">
                <?php
                $candidatos = "SELECT * FROM cadastrocandidatos where contratado = 'sim' and cnpj_ong = '$cnpj';";
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
                    echo '<a class="perfil2" href="perfilcandidatos.php?id=' . $dado['id_cand'] . '">';

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
                    echo '<div class="verde2">';
                    echo 'Ver mais';
                    echo '</div>';

                    echo '</a>';
                }

                ?>
                    <!-- mudança -->
            </div>
        </div>
        <div class="prt2_2">
            <div id="forma1"></div>
        </div>
    </section>

    <footer>
        <div id="funcoes">
            <a href="pag_inicial.html" id="nome_fc">HOME</a>
            <a href="PagEscolha.php" id="nome_fc">CADASTRE-SE</a>
            <a href="PaginaInicial.html #prt_3" id="nome_fc">SOBRE NÓS</a>
        </div>
        <img src="img/logo com nome.png" alt="Logo Regenere-se" id="ft_f">
        <h3 id="nome_c">Copyright © 2023 projeto regenerese</h3>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        window.addEventListener('load', function() {
            document.getElementById('loading-container').style.display = 'none';
        });
    </script>
    <script src="js/perfilONG_ong.js"></script>
</body>

</html>