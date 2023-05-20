<?php
include('conexao.php');

if(count($_POST)>0){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['nascimento'];
    $erro = false;
    if(empty($nome)){
        $erro = "Preencha o nome.";
    }
    else if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erro = "Preencha o email.";
    } 
  

        if(!empty($nascimento)){
            $pedacos = explode('/', $nascimento);
                if(count($pedacos) == 3){  
                    $nascimento = implode('-', array_reverse($pedacos));
                } else{
                    $erro = "A Data de Nascimento deve ter o padrão dia/mes/ano.";
                }
        }
        if(!empty($telefone)){
            function limparTexto($str){
                return preg_replace("/[^0-9]/", "", $str);
            }
            $telefone = limparTexto($telefone);
            
            if(strlen($telefone)!= 11){
                $erro = "Telefone inválido. O Telefone deve ser preenchido no padrão (22) 98888-8888";
            }
        }


    if($erro){
        echo "<b><p>ERRO: $erro</p></b>";
    } else{
        $sql_code = "INSERT INTO clientes(nome, email, telefone,nascimento, data) 
        VALUES ('$nome', '$email', '$telefone', '$nascimento', NOW())";
       $deucerto =  $mysqli -> query($sql_code) or die($mysqli -> error);
        if($deucerto){
            echo "<b><p>Cliente criado com sucesso.</p></b>";
            unset($_POST);
        } 
    }

}

?>
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
    <form method="POST" action="">
        <p>
            <label>Nome </label>
            <input name="nome" value="<?php if(isset($_POST['nome'])) echo $_POST['nome'];?>" type="text">
        <br>
        </p>
        <p>
            <label>Email </label>
            <input name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" type="text">
        <br>
        </p>
        <p>
            <label>Telefone </label>
            <input placeholder="(22) 9999-9999" value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone'];?>" name="telefone" type="text">
        <br>
        </p>
        <p>
            <label>Data de Nascimento </label>
            <input name="nascimento" value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento'];?>" type="text">
        <br>
        </p>
        <p>
            <button type="submit">Salvar </button>
        </p>
    </form>
</body>
</html>