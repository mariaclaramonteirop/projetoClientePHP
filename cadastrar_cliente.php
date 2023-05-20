<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
</head>
<body>
    <a href="/clientes.php">Voltar para a lista</a>
    <form action="POST">
        <p>
            <label>Nome </label>
            <input name="nome" type="text">
        <br>
        </p>
        <p>
            <label>Email </label>
            <input name="email" type="text">
        <br>
        </p>
        <p>
            <label>Telefone </label>
            <input name="telefone" type="text">
        <br>
        </p>
        <p>
            <label>Data de Nascimento </label>
            <input name="nascimento" type="date">
        <br>
        </p>
        <p>
            <button type="submit">Salvar </button>
        </p>
    </form>
</body>
</html>