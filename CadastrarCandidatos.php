<?php

if (isset($_POST['sub'])) {
  

    include_once('config.php');
    include_once('Usuario.php');
    include_once('testeLogin2.php');
    $cnpj_ong = $_SESSION['cnpj'];
    $estadoong = $_SESSION['estado'];
    $nome_candidato = $_POST['nome'];
    $area = $_POST['area'];
    $FE = $_POST['FE'];
    $objetivos = $_POST['objetivos'];
    $FA = $_POST['FA'];
    $GI = $_POST['GI'];
    $CP = $_POST['CP'];
    $EP = $_POST['EP'];
    $IA = $_POST['infosadicionais'];
    $foto_blob = file_get_contents($_FILES["Foto"]['tmp_name']);
    $video_blob = file_get_contents($_FILES["Video"]['tmp_name']);
    $imagem_extensoes_permitidas = array("image/jpeg", "image/png", "image/gif");
    try {
            $foto_blob = file_get_contents($_FILES["Foto"]["tmp_name"]);
            $stmt = $conexao->prepare("INSERT INTO cadastrocandidatos(nomecandidato,areadeatuacao,faixaetaria,objetivos,formacaoacademica,competencias,experiencias,info, cnpj_ong, GI, UF, fotos, videos) VALUES ('$nome_candidato ','$area','$FE','$objetivos','$FA','$CP','$EP','$IA', '$cnpj_ong', '$GI','$estadoong', ?, ?)");
            $stmt->bindParam(1, $foto_blob, PDO::PARAM_LOB); // Associa o valor como BLOB
            $stmt->bindParam(2,  $video_blob, PDO::PARAM_LOB); // Associa o valor como BLOB
            $stmt->execute();
    } catch (PDOException $e) {
        echo "ERRO: " . $e->getMessage();
        exit;
    }
    header('Location:PrincipalONG.php');
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regenere-se</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="IMG/logo sem fundo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="./CSS/CadastrarCandidados.css">
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
        <a id="btnlogout" href="#" onclick="logout()" style="font-family: 'antonio', sans-serif; color:#4F4040;">
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
                        <img src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem_base64; ?>" alt="Imagem da Empresa">
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

    <form action="CadastrarCandidatos.php" enctype="multipart/form-data" method="POST" id="geral">

        <section id="geral2">
            <div id="part1">
                <div id="foto">
                    <label class="picture" tabindex="0">
                        <div class="max-width"></div>
                        <input type="file" name="Foto" accept="image/*" class="picture__input">
                        <img id="imgPhoto" src="./IMG/logo_usuarioGRANDE.png">
                        <span class="picture__image"></span>
                    </label>
                </div>

                <div id="qust1">
                    <input type="text" name="nome" id="nome" placeholder="Nome do Candidato" class="nome" required>
                    <div id="area_faixa">
                        <select id="area" name="area" class="area" required>
                            <option value="">Área de Atuação</option>
                            <option value="Administração, negócios e serviços">Administração, negócios e serviços
                            </option>
                            <option value="Artes e Design">Artes e Design</option>
                            <option value="Ciências Biológicas e da Terra">Ciências Biológicas e da Terra</option>
                            <option value="Análise e Desenvolvimento de Sistemas">Análise e Desenvolvimento de Sistemas
                            </option>
                            <option value="Ciências Sociais e Humanas">Ciências Sociais e Humanas</option>
                            <option value="Comunicação e Informação">Comunicação e Informação</option>
                            <option value="Saúde e Bem-estar">Saúde e Bem-estar</option>
                        </select>

                        <select id="FE" name="FE" class="FE" required>
                            <option value="">Faixa Etária</option>
                            <option value="Jovem(18-24)">Jovem(18-24)</option>
                            <option value="Adulto(24-59)">Adulto(24-59)</option>
                            <option value="Idoso(60+)">Idoso(60+)</option>
                        </select>
                    </div>
                    <div id="form_group">
                        <img src="./IMG/camera_logo2.png">
                        <label for="arquivo">Adicionar video de candidato</label>
                        <input type="file" name="Video" class="form-control-file" id="arquivo" name="arquivo" accept="video/*">
                    </div>

                    <textarea style="resize: none" name="objetivos" id="objetivos" class="objetivos" name="objetivos" maxlength="1000" required placeholder="Objetivos Profissionais:"></textarea>
                    <select id="area" style="width: 100%;" name="GI">
                        <option value="GI">Grau de escolaridade</option>
                        <option value="Sem escolaridade">Sem escolaridade</option>
                        <option value="Ensino fundamental incompleto">Ensino fundamental incompleto</option>
                        <option value="Ensino fundamental completo">Ensino fundamental completo</option>
                        <option value="Ensino médio incompleto">Ensino médio incompleto</option>
                        <option  value="Ensino médio completo">Ensino médio completo</option>
                    </select>

                    <style>
                        option{
                        font-weight: bolder;
                        }
                    </style>


                
                </div>
            </div>

            <div id="part2">
                <div id="qust2">
                    <textarea style="resize: none" type="text" class="FA" name="FA" placeholder="Formação Acadêmica:" id="qs2" maxlength="500"></textarea>
                    <textarea style="resize: none" type="text" class="CP" name="CP" placeholder="Competências:" id="qs2" maxlength="500"></textarea>
                    <textarea style="resize: none" type="text" class="EP" name="EP" placeholder="Experiências Profissionais:" id="qs2" max-width="500"></textarea>
                </div>
                <textarea style="resize: none" name="infosadicionais" id="infosadicionais" maxlength="500" required placeholder="Informações adicionais:"></textarea>

                <input name="sub" type="submit" value="Finalizar" id="btn_cnt"></input>
            </div>

        </section>
    </form>


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
    <script src="JS/CadastrarCandidatos.js"></script>
</body>


</html>