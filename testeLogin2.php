<?php

$alert = False;
if(isset($_POST['email'])&& !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha']))
{
    //acessa o sistema
    require 'config.php';
    require 'Usuario.php';

    $u = new Usuario();

    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if($u -> login($email, $senha) == true){
    
        if(isset($_SESSION['email']) && isset($_SESSION['senha'])){
            header('Location:PrincipalEmpresa.php');
            $alert = True;
        }else{
            header('Location:Login.php');
        }
    
    }else if($u -> login2($email, $senha) == true){
        
        if(isset($_SESSION['email']) && isset($_SESSION['senha'])){
            header('Location:PrincipalONG.php');
            $alert = True;
        }else{
            header('Location:Login.php');
        }
    
    }else{//não acessa o sistema
        
        header('Location:Login.php');
        $alert = True;
    }


}

?>