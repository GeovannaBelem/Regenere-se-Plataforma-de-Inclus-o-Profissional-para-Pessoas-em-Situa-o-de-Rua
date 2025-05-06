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
        } else if ($extensao === 'jpeg' || $extensao === 'jpg') {
            $tipo_mime = 'image/jpeg';
        } else if ($extensao === 'gif') {
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

    <div id="filtrar">
        <div id="filtrar_menor">
            <button onclick="fechar()">X</button>

            <h2 id="tit_fil">Filtros</h2>

            <form action="PrincipalEmpresa.php" id="filtrodesk" method="post">

                    <div id="filtros_mobile">

                        <select id="UF" name="UF">
                            <option value="UF">UF</option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <option value="AM">AM</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MS">MS</option>
                            <option value="MT">MT</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>


                        <select id="FE" name="FE">
                            <option value="FE">Faixa Etária</option>
                            <option value="Jovem(18-24)">Jovem(18-24)</option>
                            <option value="Adulto(24-59)">Adulto(24-59)</option>
                            <option value="Idoso(60+)">Idoso(60+)</option>
                        </select>

                        <select id="GI" name="GI">
                            <option value="GI">Grau de escolaridade</option>
                            <option value="Sem escolaridade">Sem escolaridade</option>
                            <option value="Ensino fundamental incompleto">Ensino fundamental incompleto</option>
                            <option value="Ensino fundamental completo">Ensino fundamental completo</option>
                            <option value="Ensino médio incompleto">Ensino médio incompleto</option>
                            <option value="Ensino médio completo">Ensino médio completo</option>
                        </select>

                        <select id="CD" name="CD">
                            <option value="">Cidade</option>
                            <option value="N1">Nível 1</option>
                            <option value="N2">Nível 2</option>
                            <option value="N3">Nível 3</option>
                            <option value="N4">Nível 4</option>
                            <option value="N5">Nível 5</option>
                        </select>

                        <input type="submit" name="aplicar" id="aplicar" value="Aplicar">



                    </div>
                </form>
        </div>
    </div>


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
                <div id="txt2">
                    <div id="nome_menu2">
                        <img src="IMG/escritorio.png">
                        <a id="nm2" href="MinhaInstituicao.php">
                            <?php echo $nomeempresa ?>
                        </a>
                        <h5>
                            <?php echo $cargo ?>
                        </h5>
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
                <h2 id="tit_fil">Filtrar</h2>
                <div id="btn_filtro">
                    <button id="btn_pess" onclick="mostrar_linha1()">Pessoas</button>
                    <button id="btn_ONG" onclick="mostrar_linha2()">ONGs</button>
                </div>
                <div id="linha_filtro">
                    <div id="ret1_linha"></div>
                    <div id="ret2_linha"></div>
                </div>
                <div id="pesq_fav">
                    <div id="divBusca">
                        <input type="search" id="txtBusca" placeholder="Pesquisar"></input>
                        <button type="submit" onclick="searchData()"><span class="material-symbols-outlined">
                                search
                            </span></button>
                    </div>
                    <button id="btnfav"> <span class="material-icons" style="color: #561FAD; font-size: 30px;">
                            favorite
                        </span><a href="Favoritos.php">Meus favoritos</a></button>
                </div>
                <div id="filtros_mobile">
                    <button class="apl_mob" id="aplicar" onclick="filtrar()">Filtros</button>
                    <button id="btnfav" class="btnfav_mob"> <span class="material-icons"
                            style="color: #561FAD; font-size: 30px;">
                            favorite
                        </span><a href="Favoritos.php">Meus favoritos</a></button>

                </div>
                <form action="PrincipalEmpresa.php" id="filtrodesk" method="post">

                    <div id="filtros">

                        <select id="UF" name="UF">
                            <option value="UF">UF</option>
                            <option value="AC">AC</option>
                            <option value="AL">AL</option>
                            <option value="AP">AP</option>
                            <option value="AM">AM</option>
                            <option value="BA">BA</option>
                            <option value="CE">CE</option>
                            <option value="DF">DF</option>
                            <option value="ES">ES</option>
                            <option value="GO">GO</option>
                            <option value="MA">MA</option>
                            <option value="MS">MS</option>
                            <option value="MT">MT</option>
                            <option value="MG">MG</option>
                            <option value="PA">PA</option>
                            <option value="PB">PB</option>
                            <option value="PR">PR</option>
                            <option value="PE">PE</option>
                            <option value="PI">PI</option>
                            <option value="RJ">RJ</option>
                            <option value="RN">RN</option>
                            <option value="RS">RS</option>
                            <option value="RO">RO</option>
                            <option value="RR">RR</option>
                            <option value="SC">SC</option>
                            <option value="SP">SP</option>
                            <option value="SE">SE</option>
                            <option value="TO">TO</option>
                        </select>


                        <select id="FE" name="FE">
                            <option value="FE">Faixa Etária</option>
                            <option value="Jovem(18-24)">Jovem(18-24)</option>
                            <option value="Adulto(24-59)">Adulto(24-59)</option>
                            <option value="Idoso(60+)">Idoso(60+)</option>
                        </select>

                        <select id="GI" name="GI">
                            <option value="GI">Grau de escolaridade</option>
                            <option value="Sem escolaridade">Sem escolaridade</option>
                            <option value="Ensino fundamental incompleto">Ensino fundamental incompleto</option>
                            <option value="Ensino fundamental completo">Ensino fundamental completo</option>
                            <option value="Ensino médio incompleto">Ensino médio incompleto</option>
                            <option value="Ensino médio completo">Ensino médio completo</option>
                        </select>

                        <select id="CD" name="CD">
                            <option value="">Cidade</option>
                            <option value="N1">Nível 1</option>
                            <option value="N2">Nível 2</option>
                            <option value="N3">Nível 3</option>
                            <option value="N4">Nível 4</option>
                            <option value="N5">Nível 5</option>
                        </select>

                        <input type="submit" name="aplicar" id="aplicar" value="Aplicar">



                    </div>
                </form>
            </div>







            <div class="perfiscandidatos">


                <?php

                if (!isset($_SESSION['nome'])) {
                    header('Location: Login.php');
                }

                if (!empty($_GET['search'])) {
                    $data = $_GET['search'];
                    $candidatos = "SELECT * FROM cadastrocandidatos WHERE nomecandidato like '%$data%' or areadeatuacao like '%$data%';";

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
                        echo '<img id="imge" width="60%" src="data:' . ';base64,' . $imagem_base . '">';
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
                } else {

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $filtro = "SELECT * FROM cadastrocandidatos WHERE 1=1"; // Inicializa a consulta com um predicado verdadeiro
                
                        // Verifica se cada campo do formulário foi preenchido e adiciona ao filtro
                        if (!empty($_POST['UF']) && $_POST['UF'] !== 'UF') {

                            $ufSelecionado = $_POST['UF'];
                            $filtro .= " AND UF = '$ufSelecionado'";
                        }

                        if (!empty($_POST['FE']) && $_POST['FE'] !== 'FE') {
                            $faixaEtariaSelecionada = $_POST['FE'];
                            $filtro .= " AND faixaetaria = '$faixaEtariaSelecionada'";
                        }

                        if (!empty($_POST['GI']) && $_POST['GI'] !== 'GI') {
                            $grauEscolaridadeSelecionado = $_POST['GI'];
                            $filtro .= " AND GE = '$grauEscolaridadeSelecionado'";
                        }
                    } else {
                        $filtro = "select * from cadastrocandidatos;";
                    }


                    $st = $conexao->prepare($filtro);
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
                        echo '<img id="imge" width="60%" src="data:' . ';base64,' . $imagem_base . '">';
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
                }

                ?>
            </div>


            <div class="perfisongs">

                <?php

                if (!empty($_GET['search'])) {
                    $data = $_GET['search'];
                    $ongs = "SELECT * FROM cadastroong where nomeAssociacao like '%$data%' or nomeResponsavel like '%$data%' or cnpj like '%$data%' or cidade like '%$data%' or complemento like '%$data%' or telefone like '%$data%';";
                    $st2 = $conexao->prepare($ongs);
                    $st2->execute();
                    $dados2 = $st2->fetchAll();
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

                            echo '<p id="core">♡</p>';
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
                } else {
                    $ongs = "SELECT * FROM cadastroong";
                    $st2 = $conexao->prepare($ongs);
                    $st2->execute();
                    $dados2 = $st2->fetchAll();
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
                        }

                        $imagem_base2 = base64_encode($fotocand2);

                        echo '<a class="perfil" href="PerfilONG_empresa.php?cnpj=' . $dado2['cnpj'] . '">';

                        echo '<p id="core">♡</p>';
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

                ?>

            </div>


            <style>
                @import url('https://fonts.googleapis.com/css2?family=Antonio:wght@100&display=swap');
                @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap');
                @import url('https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap');
                @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap');

                .perfil {
                    box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
                }

                .menu_usuario {
                    box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
                }

                #aplicar {
                    width: 20%;
                    height: 26px;
                    font-weight: 200;
                    background-color: #00BF63;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 10px;
                    cursor: pointer;
                }

                #filtros select {
                    margin-left: 8px;
                }

                #filtros input {
                    margin-left: 8px;

                }

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

                .perfisongs {
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
            <a href="PrincipalEmpresa.php #logo" id="nome_fc">HOME</a>
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