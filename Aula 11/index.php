<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="assets/img/logo_icone.ico" type="image/x-icon">
</head>
<body>
    <form action="enviarForm.php" method="post">
        <label for="usuario">Usuario: </label>
        <input type="text" name="usuario" id="usuario">

        <label for="senha">Senha: </label>
        <input type="password" name="senha" id="senha">

        <button type="submit">Enviar</button>
    </form>
</body>
</html>