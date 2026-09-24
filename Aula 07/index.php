<?php

    //print("<h1>Testes de Mesa - Módulo Auth</h1><hr>") - Python syntax, não funciona no PHP!
    //console.log("<h1>Testes de Mesa - Módulo Auth</h1><hr>") - JavaScript syntax, não funciona no PHP!
    echo "<h1>Testes de Mesa - Módulo Auth</h1><hr>";
    // print_r("<h1>Testes de Mesa - Módulo Auth</h1><hr>");

    // 1. VARIÁVEIS E SEUS TIPOS
    echo "<h2>1. Variáveis e Seus Tipos</h2>";

    $nomeUsuario = "Maria Silva"; // String
    // const NOME_USUARIO = "Maria Silva"; // Constante (não muda durante a execução do script)
    // define("NOME_USUARIO", "Maria Silva"); // Outra forma de definir constante
    $idade = 28;                  // Integer (int)
    $altura = 1.65;               // Float
    $isAtivo = true;              // Boolean (bool)
    $permissoes = ["leitura", "escrita", "admin"]; // Array

    // var_dump já imprime o tipo e o valor da variável, útil para depuração
    echo "<pre>";
    var_dump($nomeUsuario);
    var_dump($isAtivo);
    var_dump($permissoes);
    echo "</pre>";


    // 2. OPERADORES RELACIONAIS E LÓGICOS
    echo "<h2>2. Operadores Relacionais e Lógicos</h2>";

    $senhaDigitada = "123456";
    $senhaBanco = "123456";
    $tentativasLogin = 3;

    $resultadoIgualdade = ($tentativasLogin == "3");  // Valor vs Valor = true
    $resultadoIdentidade = ($tentativasLogin === "3"); // Valor vs Valor + Tipo = false (int vs string) 

    echo "Tentativas == '3': " . ($resultadoIgualdade ? 'Sim' : 'Não') . "<br>";
    echo "Tentativas === '3': " . ($resultadoIdentidade ? 'Sim' : 'Não') . "<br>";

    // Operadores Lógicos (&&, ||, !)
    $emailValido = true;
    $senhaValida = false;

    if ($emailValido && $senhaValida) {
        echo "<p>Pode fazer login!</p>";
    } else {
        echo "<p>Credenciais inválidas.</p>";
    }


    // 3. ESTRUTURAS CONDICIONAIS
    echo "<h2>3. Estruturas Condicionais</h2>";

    $perfilUsuario = "admin";

    // If / Elseif / Else
    if ($perfilUsuario === "admin") {
        echo "Acesso total concedido.<br>";
    } else if ($perfilUsuario === "editor") {
        echo "Acesso de edição concedido.<br>";
    } else {
        echo "Acesso restrito (somente leitura).<br>";
    }

    // Switch / Case
    switch ($perfilUsuario) {
        case "admin":
            echo "Bem-vindo, Administrador<br>";
            break;
        case "editor":
            echo "Bem-vindo, Editor<br>";
            break;
        default:
            echo "Bem-vindo, Visitante<br>";
    }
    // Operador de Coalescência Nula (??) - Muito usado com $_POST!
    // Se $_POST['email'] não existir, ele assume "Email não informado".
    $emailPost = $_POST['email_digitado'] ?? "Email não informado";
    echo "E-mail recebido: " . $emailPost . "<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="email" name="email_digitado" id="email" placeholder="Digite seu e-mail">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>