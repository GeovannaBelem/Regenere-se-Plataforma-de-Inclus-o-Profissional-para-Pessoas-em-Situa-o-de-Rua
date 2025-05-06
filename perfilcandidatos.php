<?php
include_once('config.php');
include_once('testeLogin2.php');
$id = $_GET['id'];
$sql = "SELECT * FROM cadastrocandidatos WHERE id_cand = " . "$id";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$dados = $stmt->fetch();
$cnpjong = $dados['cnpj_ong'];


$videoData = base64_encode($dados['videos']);

$sql3 = "SELECT fotos FROM cadastrocandidatos WHERE id_cand = " . "$id";
$stmt3 = $conexao->prepare($sql3);
$stmt3->execute();
$stmt3->bindColumn('fotos', $fotocand, PDO::PARAM_LOB);

if ($stmt3->fetch(PDO::FETCH_BOUND)) {
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
}
$imagem_base64 = base64_encode($fotocand);



$sql2 = "SELECT * FROM cadastroong WHERE cnpj = '$cnpjong'";
$stmt2 = $conexao->prepare($sql2);
$stmt2->execute();
$dados2 = $stmt2->fetch();
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/perfilcandidatos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="IMG/logo sem fundo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Perfil de Candidatos</title>
</head>

<body>

    <div id="storie_full">
        <div id="content">
            <div id="btn">
                <button id="btn_fechar" onclick="fechar()">X</button>
            </div>
            <video id="video" controls autoplay>
                <source id="video-source" data-video="<?php echo $videoData; ?>" type="video/mp4">
            </video>
        </div>
    </div>

    <header>
        <div id="logo">
            <img id="ft_logo" src="./IMG/logo sem fundo.png" alt="logo regenere-se">
            <h2 id="nome_logo">REGENERE-SE</h2>
        </div>
        <?php
            if ($_SESSION['razaoSocial'] == "nulo") {
                echo '<a id="home" href="PrincipalONG.php">Home</a>';
            }else{
                echo '<a id="home" href="PrincipalEmpresa.php">Home</a>';
            }
        ?>
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
    <header id="header2">
        <span class="material-symbols-outlined" onclick="hamburguer()">menu</span>
        <div id="logo">
            <img id="ft_logo" src="./IMG/logo sem fundo.png" alt="logo regenere-se">
            <h2 id="nome_logo">REGENERE-SE</h2>
        </div>

        <span class="material-symbols-outlined" onclick="hamburguer2()">account_circle</span>
    </header>

    <div id="hamburguer1">
        <?php
            if ($_SESSION['razaoSocial'] == "nulo") {
                echo '<a id="home2" href="PrincipalEmpresa.php">Home</a>';
            }else{
                echo '<a id="home2" href="PrincipalONG.php">Home</a>';
            }
        ?>
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

    <section id="geral">

        <div id="part1">
            <h1>
                <?php echo $dados['nomecandidato'] ?>
            </h1>
            <h3>
                <?php echo $dados['areadeatuacao'] ?>
            </h3>
            <h4 >
                <?php echo $dados['faixaetaria'] ?>
            </h4>
        </div>




        <div id="part2">
            <div id="storie_content" onclick="abrir()">
                <img src="data:<?php echo $tipo_mime; ?>;base64,<?php echo $imagem_base64; ?>" alt="Imagem da Empresa">
            </div>
            <img id="play" src="IMG/play.png" alt="play" onclick="abrir()">
        </div>

        <div id="infos">
            <h3>
                <?php echo $dados['areadeatuacao'] ?>
            </h3>
            <h4 id="idade">
                <?php echo $dados['faixaetaria'] ?>
            </h4>
        </div>

        <div id="part3">
            <?php echo '<h3><a href="PerfilONG_empresa.php?cnpj=' . $cnpjong . '">' . $dados2['nomeAssociacao'] . '</a></h3>' ?>

            <div id="contacts">
                <button id="btnfav"><span class="material-icons" style="color: #561FAD; font-size: 25px;">
                        favorite
                    </span>Meus favoritos</button>
                <select name="contato" id="btncontato">
                    <option value="">Contato</option>
                    <option value="">
                        <?php echo $dados2['telefone'] ?>
                    </option>
                    <option value="">
                        <?php echo $dados2['email'] ?>
                    </option>
                </select>
            </div>
            <?php
            // Verificando se um atributo da empresa é nulo para saber se é uma empresa ou uma ong logada
            if ($_SESSION['razaoSocial'] == "nulo") {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Verifica se o checkbox foi marcado no envio do formulário
                    $novoEstado = isset($_POST['contratado']) ? 'sim' : 'não';

                    // Atualiza o estado no banco de dados
                    $frase = "UPDATE cadastrocandidatos SET contratado = :novoEstado WHERE id_cand = :id";
                    $sentenca = $conexao->prepare($frase);
                    $sentenca->bindParam(':novoEstado', $novoEstado, PDO::PARAM_STR);
                    $sentenca->bindParam(':id', $id, PDO::PARAM_INT);
                    $sentenca->execute();
                }

                // Lê o estado atual do banco de dados
                $frase2 = "SELECT * FROM cadastrocandidatos WHERE id_cand = '$id'";
                $sentenca2 = $conexao->prepare($frase2);
                $sentenca2->execute();
                $contratado = $sentenca2->fetch(PDO::FETCH_ASSOC);

                echo '
        <form action="" id="formulario" method="post">
            <label id="label" for="contratado">Contratado</label>
            <input type="checkbox" name="contratado" id="contratado" ' . ($contratado['contratado'] == "sim" ? 'checked' : '') . '>
        </form>

        <script>
            // Adiciona um ouvinte de eventos para detectar mudanças no checkbox
            document.getElementById("contratado").addEventListener("change", function() {
                // Submete automaticamente o formulário quando o checkbox muda
                document.getElementById("formulario").submit();
            });
        </script>
    ';
            }
            ?>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap');

                #label {
                    font-family: 'roboto', sans-serif;
                    font-weight: 900;
                    color: #00BF63;
                }

                #contratado {
                    border-radius: 10px;
                }

                #formulario {
                    margin-top: 15px;
                }
            </style>
        </div>

    </section>

    <section id="OCE">
        <div class="txt" id="txt11">
            <h3>Objetivos Profissionais:</h3>
            <h4>
                <?php echo $dados['objetivos'] ?>
            </h4>
        </div>
        <div class="txt" id="txt22">
            <h3>Competências:</h3>
            <h4>
                <?php echo $dados['competencias'] ?>
            </h4>
        </div>
        <div class="txt" id="txt11">
            <h3>Experiências Profissionais:</h3>
            <h4>
                <?php echo $dados['experiencias'] ?>
            </h4>
        </div>
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
            <a href="PrincipalEmpresa.php #logo" id="nome_fc">HOME</a>
            <a href="PagEscolha.php" id="nome_fc">CADASTRE-SE</a>
            <a href="pag_inicial.html #prt_3" id="nome_fc">SOBRE NÓS</a>
        </div>
        <img src="img/logo com nome.png" alt="Logo Regenere-se" id="ft_f">
        <h3 id="nome_c">Copyrid ©️2023 projeto regenerese</h3>
    </footer>
    <script src="JS/perfilcandidatos.js"></script>
</body>
<script>
    function abrir() {
        document.getElementById('storie_full').style.display = 'flex';
        document.getElementById('part2').style.display = 'none';
        var videoSource = document.getElementById('video-source');
        var videoData = videoSource.getAttribute('data-video');
        videoSource.src = 'data:video/mp4;base64,' + videoData;
        var video = document.getElementById('video');
        video.load();
        video.play();
    }



    function fechar() {
        document.getElementById('storie_full').style.display = 'none';
        document.getElementById('part2').style.display = 'flex';
        var video = document.getElementById('video');
        video.pause();
    }
</script>
<script>
    window.addEventListener('load', function () {
        document.getElementById('loading-container').style.display = 'none';
    });
</script>

</html>