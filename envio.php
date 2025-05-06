<?php
/*Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST['enviar'])){
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'projeto.regenerese@gmail.com';                     //SMTP username
    $mail->Password   = 'ujsajfleopyiekpt';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


    include_once('EsqueceuSenha.php');
    $email = $_POST['email'];
    

    //Recipients
    $mail->setFrom('projeto.regenerese@gmail.com', 'Regenere-se');
    $mail->addAddress($email, 'Regenere-se');     //Add a recipient
    $mail->addReplyTo('projeto.regenerese@gmail.com', 'Regenere-se');
  
    $codigo = sprintf("%04d",rand(0,9999));
    $codigo2 = "aaaaaaaaa";

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Redefinir senha - REGENERESE ';
    $mail->Body = "
    <h3>Olá,</h3>
    <p style='margin-top: 1.5%'>Se você deseja redefinir sua senha na nossa plataforma Regenere-se,
    digite o código de verificação fornecido abaixo:</p>
    <h1 id='codigo' style='margin-top: 2.5%; color: green;'>$codigo</h1>";
    
    $mail->send();
    echo 'Código enviado com sucesso';
} catch (Exception $e) {
    echo "Erro ao enviar o código para o email fornecido: {$mail->ErrorInfo}";
}
}else{
    echo "Erro ao enviar";
}*/
?>
<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

session_start();

// Função para gerar um código aleatório
function gerarCodigo() {
    return sprintf("%04d", rand(0, 9999));
}

if (isset($_POST['enviar'])) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // Enable verbose debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'projeto.regenerese@gmail.com'; // SMTP username
        $mail->Password   = 'ujsajfleopyiekpt'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port       = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        include_once('EsqueceuSenha.php');
        $email = $_POST['email'];

        // Recipients
        $mail->setFrom('projeto.regenerese@gmail.com', 'Regenere-se');
        $mail->addAddress($email, 'Regenere-se'); // Add a recipient
        $mail->addReplyTo('projeto.regenerese@gmail.com', 'Regenere-se');

        // Gerar e armazenar o código na sessão para posterior verificação
        $codigoGerado = gerarCodigo();
        $_SESSION["codigo_verificacao"] = $codigoGerado;

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Redefinir senha - REGENERESE ';
        $mail->Body = "
        <h3>Olá,</h3>
        <p style='margin-top: 1.5%'>Se você deseja redefinir sua senha na plataforma Regenere-se,
        digite o código de verificação fornecido abaixo:</p>
        <h1 id='codigo' style='margin-top: 2.5%; color: green;'>$codigoGerado</h1>";

        $mail->send();
        echo '<script>window.location.href = "EsqueceuSenha2.php";</script>';
    } catch (Exception $e) {
        echo "Erro ao enviar o código para o email fornecido: {$mail->ErrorInfo}";
    }
} else if (isset($_POST["verificar_codigo"])) {
    // Obtém o código inserido pelo usuário
    $codigoUsuario = $_POST['codigo1'] . $_POST['codigo2'] . $_POST['codigo3'] . $_POST['codigo4'];

    if (isset($_SESSION["codigo_verificacao"])) {
    // Obtém o código armazenado na sessão
    $codigoArmazenado = $_SESSION["codigo_verificacao"];

    // Verifica se os códigos são iguais
    if ($codigoUsuario == $codigoArmazenado) {
        header("Location: EsqueceuSenha3.php?email=".urlencode($email));
        exit();
    } else {
        echo "Código incorreto. Tente novamente.";

        // Redireciona para a página EsqueceuSenha.php
        header("Refresh: 5; url=EsqueceuSenha.php");
        exit();
    }

    // Limpa a variável de sessão após a verificação
    unset($_SESSION["codigo_verificacao"]);
}} else {
    echo "Erro ao enviar";
}
?>
