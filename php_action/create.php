<?php
//Sessão
session_start();
//Conexão
require_once 'db_connect.php';
function clear($input) {
    global $connect;
    //SQL Injection tratamento
    $var = mysqli_escape_string($connect,$input);
    //XSS tratamento
    $var = htmlspecialchars($var);
    return $var;
}

if(isset($_POST['btn-cadastrar'])){
    $nome = clear($_POST['nome']);
    $sobrenome = clear($_POST['sobrenome']);
    $email = clear($_POST['email']);
    $idade = clear($_POST['idade']);
    
    $sql = "INSERT INTO clientes (nome,sobrenome,email,idade) VALUES ('$nome','$sobrenome','$email','$idade')";
    
    if(mysqli_query($connect,$sql)){
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('location: ../index.php');
    }else{
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
        header('location: ../index.php');
    }
}

?>