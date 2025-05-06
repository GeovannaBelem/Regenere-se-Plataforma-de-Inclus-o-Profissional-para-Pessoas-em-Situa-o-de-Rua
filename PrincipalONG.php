<?php
include_once('config.php');
include_once('testeLogin2.php');

$nome = $_SESSION['nome'];
$cargo = $_SESSION['cargo'];
$nomeAs = $_SESSION['nomeAssociacao'];
$cnpj = $_SESSION['cnpj'];
$descricao = $_SESSION['descricao'];


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

if (!isset($_SESSION['nome'])) {
    header('Location: Login.php');
}



if (isset($_POST['favoritocand'])) {
    $id = $_POST['id_cads'];
    $search = $conexao->prepare("SELECT * FROM favoritoscand WHERE id_cand = :id_cand");
    $search->bindParam(':id_cand', $id, PDO::PARAM_INT);
    $search->execute();

    if (($search->fetchColumn()) > 0) {
        $stmt1 = $conexao->prepare("DELETE FROM favoritoscand WHERE id_cand = $id");
        $stmt1->execute();
    } else {
        $stmt = $conexao->prepare("INSERT INTO favoritoscand(cnpj, id_cand) values ('$cnpj', '$id')");
        $stmt->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Regenere-se</title>
    <link rel="shortcut icon" href="IMG/logo sem fundo.png" type="image/x-icon">
    <link rel="stylesheet" href="./CSS/PrincipalONG.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

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
</script>

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

    <header>
        <div id="logo">
            <img id="ft_logo" src="./IMG/logo sem fundo.png" alt="logo regenere-se">
            <h2 id="nome_logo">REGENERE-SE</h2>
        </div>
        <a id="home" href="#">Home</a>
        <a id="home" href="#">Notificação</a>
        <a id="home" href="perfilONG_ong.php #titcands">Candidatos</a>
        <a onclick="logout()" href="#" style="font-family: 'antonio', sans-serif; color:#4F4040;">
            <span class="material-icons" style="font-size: 30px;">
                logout
            </span>
        </a>
    </header>

    <div class="geral">


        <div id="menu_conf">
            <div class="menu_usuario">
                <div id="ret">
                    <div id="ft_logo_ong2">
                        <label class="picture" tabindex="0">
                            <div class="max-width"></div>
                            <input type="file" placeholder="Logo da ONG" accept="image/*" class="picture__input"><img src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem_base64; ?>" alt="">
                            <span class="picture__image"></span>
                        </label>
                    </div>
                </div>
                <h3 id="nome_menu1">
                    <?php echo $nome ?>
                </h3>
                <h5>
                    <?php echo $cargo ?>
                </h5>
                <div id="txt">
                    <div id="nome_menu">
                        <img src="IMG/escritorio.png">
                        <a id="nm" href="perfilONG_ong.php">Minha Instituição</a>
                    </div>
                    <div id="nome_menu">
                        <img src="IMG/usuario.png">
                        <a id="nm" href="PerfilUsuarioONG.php">Meu Perfil</a>
                    </div>
                    <div id="favo">
                        <img src="IMG/candidato.png">
                        <a id="nm" href="perfilONG_ong.php #titcands">Meus candidatos</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="filtro_geral">

            <div id="menuperfilONG">
                <div id="ft_logo_ong">
                    <label class="picture" tabindex="0">
                        <div class="max-width"></div>
                        <input type="file" placeholder="Logo da ONG" accept="image/*" class="picture__input"><img src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem_base64; ?>" alt="">
                        <span class="picture__image"></span>
                    </label>
                </div>
                <div id="btns">
                    <h1 id="tit_logoONG">
                        <?php echo $nomeAs ?>
                    </h1>

                    <h4 id="desc">
                        <?php echo $descricao ?>
                    </h4>

                </div>

                



            </div>



            <h2 id="tit_fil">Filtrar</h2>
            <div id="btn_filtro">
                <button id="btn_pess" onclick="mostrar_linha1()">Disponíveis</button>
                <button id="btn_ONG" onclick="mostrar_linha2()">Contratados</button>
            </div>
            <div id="linha_filtro">
                <div id="ret1_linha"></div>
                <div id="ret2_linha"></div>
            </div>
            <div id="filtros">

                <select id="FE" name="FE">
                    <option value="">Faixa Etária</option>
                    <option value="Jovem">Jovem(18-24)</option>
                    <option value="Adulto">Adulto(24-59)</option>
                    <option value="Idoso">Idoso(60+)</option>
                </select>

                <select id="GI" name="GI">
                    <option value="">Grau de escolaridade</option>
                    <option value="N1">Nível 1</option>
                    <option value="N2">Nível 2</option>
                    <option value="N3">Nível 3</option>
                    <option value="N4">Nível 4</option>
                    <option value="N5">Nível 5</option>
                </select>

            </div>
            <div class="perfiscandidatos">
                <?php

                $candidatos = "SELECT * FROM cadastrocandidatos WHERE contratado = 'não' and cnpj_ong = '$cnpj';";

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


            <div class="perfiscontratado">

                <?php
                 $ongs = "SELECT * FROM cadastrocandidatos  WHERE contratado = 'sim' and cnpj_ong = '$cnpj';";
                 $st2 = $conexao->prepare($ongs);
                 $st2->execute();
                 $dados2 = $st2->fetchAll();
                 foreach ($dados2 as $dado2) {

                     $sql22 = "SELECT fotos FROM cadastrocandidatos WHERE id_cand = ?";
                     $stmt22 = $conexao->prepare($sql22);
                     $stmt22->bindParam(1, $dado2['id_cand']);
                     $stmt22->execute();

                     $stmt22->bindColumn('fotos', $fotocand2, PDO::PARAM_LOB);
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
                     }

                     $imagem_base2 = base64_encode($fotocand2);
                     
                    echo '<a class="perfil" href="perfilcandidatos.php?id=' . $dado2['id_cand'] . '">';

                    echo '<p id="core">♡</p>';
                    echo '<div class="infos">';
                    echo '<div class="foto">';
                    echo '<img id="imge" width="60%" src="data:' . $tipo_mime22 . ';base64,' . $imagem_base2 . '">';
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

            .perfiscontratado {
                display: none;
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



    <footer>
        <div id="funcoes">
            <a href="PrincipalONG.php #logo" id="nome_fc">HOME</a>
            <a href="PagEscolha.php" id="nome_fc">CADASTRE-SE</a>
            <a href="PaginaInicial.html #prt_3" id="nome_fc">SOBRE NÓS</a>
        </div>
        <img src="img/logo com nome.png" alt="Logo Regenere-se" id="ft_f">
        <h3 id="nome_c">Copyright ©2023 projeto regenerese</h3>
    </footer>
    
<script>
    window.addEventListener('load', function() {
        document.getElementById('loading-container').style.display = 'none';
    });
</script>
    <script src="JS/PrincipalONG.js"></script>
</body>

</html>