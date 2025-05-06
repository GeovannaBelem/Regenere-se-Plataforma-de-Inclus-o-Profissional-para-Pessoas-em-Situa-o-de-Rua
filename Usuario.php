<?php

class Usuario
{

     public function login($email, $senha)
    {
        global $conexao;

        $sql = "SELECT * FROM cadastroempresa WHERE email = :email and senha = :senha";
        $sql = $conexao->prepare($sql);
        $sql->bindValue("email", $email);
        $sql->bindValue("senha", $senha);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dado = $sql->fetch();
            $ong = false;
            $empresa = true;
            $_SESSION['email'] = $dado['email'];
            $_SESSION['cnpj'] = $dado['cnpj'];
            $_SESSION['senha'] = $dado['senha'];
            $_SESSION['nome'] = $dado['nome'];
            $_SESSION['cargo'] = $dado['cargo'];
            $_SESSION['link'] = $dado['link'];
            $_SESSION['cidade'] = $dado['cidade'];
            $_SESSION['bairro'] = $dado['bairro'];
            $_SESSION['rua'] = $dado['rua'];
            $_SESSION['estado'] = $dado['estado'];
            $_SESSION['complemento'] = $dado['complemento'];
            $_SESSION['cep'] = $dado['cep'];
            $_SESSION['telefone'] = $dado['telefone'];
            $_SESSION['descricao'] = $dado['descricao'];
            //MUDANÇA
            $_SESSION['razaoSocial'] = $dado['razaoSocial'];
            $_SESSION['nomeFantasia'] = $dado['nomeFantasia'];
            //MUDANÇA
            return true;
        } else {
            return false;
        }
    }

    public function login2($email, $senha)
    {
        global $conexao;

        $sql = "SELECT * FROM cadastroong WHERE email = :email and senha = :senha";

        $sql = $conexao->prepare($sql);
        $sql->bindValue("email", $email);
        $sql->bindValue("senha", $senha);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dado = $sql->fetch();
            $ong = true;
            $empresa = false;
            $_SESSION['email'] = $dado['email'];
            $_SESSION['senha'] = $dado['senha'];
            $_SESSION['nome'] = $dado['nome'];
            $_SESSION['cargo'] = $dado['cargo'];
            $_SESSION['cnpj'] = $dado['cnpj'];
            $_SESSION['nomeAssociacao'] = $dado['nomeAssociacao'];
            $_SESSION['link'] = $dado['link'];
            $_SESSION['cidade'] = $dado['cidade'];
            $_SESSION['bairro'] = $dado['bairro'];
            $_SESSION['rua'] = $dado['rua'];
            $_SESSION['estado'] = $dado['estado'];
            $_SESSION['complemento'] = $dado['complemento'];
            $_SESSION['cep'] = $dado['cep'];
            $_SESSION['telefone'] = $dado['telefone'];
            $_SESSION['descricao'] = $dado['descricao'];   
            //MUDANÇA   
            $_SESSION['razaoSocial'] = "nulo";
            //MUDANÇA
            return true;
        } else {
            return false;
        }
    }
}
