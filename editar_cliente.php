<?php
include('conexao.php');
 $id = intval($_GET['id']);


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
            $sql_code = "UPDATE clientes SET 
            nome = '$nome', 
            email = '$email', 
            telefone = '$telefone',
            nascimento = '$nascimento' 
            WHERE id = '$id'";

            $deucerto =  $mysqli -> query($sql_code) or die($mysqli -> error);

                if($deucerto){
                    echo "<b><p>Cliente criado com sucesso.</p></b>";
                    unset($_POST);
                } 
        }

}


$sql_clientes = "SELECT * FROM clientes  WHERE id='$id'";
$query_cliente = $mysqli->query($sql_clientes) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>
<body>
    <a href="./clientes.php">Voltar para a lista</a>
    <form method="POST" action="">
        <p>
            <label>Nome </label>
            <input name="nome" value="<?php echo $cliente['nome'];?>" type="text">
        <br>
        </p>
        <p>
            <label>Email </label>
            <input name="email" value="<?php  echo $cliente['email'];?>" type="text">
        <br>
        </p>
        <p>
            <label>Telefone </label>
            <input placeholder="(22) 9999-9999" value="<?php  if(!empty($cliente['telefone']))echo formatar_telefone($cliente['telefone']);?>" name="telefone" type="text">
        <br>
        </p>
        <p>
            <label>Data de Nascimento </label>
            <input name="nascimento" value="<?php if(!empty($cliente['nascimento'])) echo formatar_data($cliente['nascimento']);?>" type="text">
        <br>
        </p>
        <p>
            <button type="submit">Salvar Cliente</button> 
        </p>
    </form>
</body>
</html>