<?php
/*Lembrar a senha e login para logar automaticamente*/
if(isset($_COOKIE['lembrar'])){
$user = $_COOKIE['user'];
$password = $_COOKIE['password'];
$sql = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`tb_admin.usuarios` WHERE user = ? AND 
password =?");
$sql->execute(array($user,$password));
if ($sql->rowCount() ==1 ){//verifica se encontrou uma linha com o login e senha passados
    $info= $sql->fetch();
    $_SESSION['login'] = true;
    $_SESSION['user'] = $user;
    $_SESSION['password'] = $password;
    $_SESSION['cargo'] = $info['cargo'];
    $_SESSION['nome'] = $info['nome'];
    $_SESSION ['img'] = $info['img'];
    
    header ('location: '.INCLUDE_PATH_PAINEL);
    die();}

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>estilo/all.css" >
    <title>Document</title>
    
</head>
<body>
    <div class='box-login'>
    <?php 
    if(isset($_POST['acao'])){
        $user=$_POST['user'];
        $password=$_POST['password'];
        $sql = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`tb_admin.usuarios` WHERE user = ? AND 
        password =?");
        $sql->execute(array($user,$password));
        if ($sql->rowCount() ==1 ){//verifica se encontrou uma linha com o login e senha passados
            $info= $sql->fetch();//pegar o resultado da consulta ao banco e colocar dentro de um array
            //Logamos com sucesso;
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['cargo'] = $info['cargo'];
            $_SESSION['nome'] = $info['nome'];
            $_SESSION ['img'] = $info['img'];
            if(isset($_POST['lembrar'])){
                setcookie('lembrar',true,time()+(60*60*24),'/');
                setcookie('user',$user,time()+(60*60*24),'/');//adiciona o usuario ao cookie de lembrar login
                setcookie('password',$password,time()+(60*60*24),'/');//adiciona a senha ao cookie lembrar senha
            }
            header ('location: '.INCLUDE_PATH_PAINEL);
            die();
        } else{
            echo '<div class="erro-box"> <i class="fa fa-times"></i> Usuário ou senha incorreta </div>';
        }


    }
    ?>
    <h2> Efetue o login: </h2>
    <form method="post">
    <input type="text" name="user" placeholder="Login..." required>
    <input type="password" name="password" placeholder="Senha..." required>
    <div class="form-group-login left">
    <input type="submit" name="acao" value="Logar!">
    </div><!-- /.div-form-group-login -->
       
    <div class="form-group-login right">
    <label for="">Lembrar-me</label>
    <input type="checkbox" name="lembrar" id="">
    </div><!-- /.div form-group-login -->
    <div class="clear"></div><!-- /.clear -->
    
    </form>
    </div><!--div box-login-->

   
    
</body>
</html>