<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$autoload = function($class){
    if($class == 'Email'){
        require 'classes/phpmailer/PHPMailerAutoload.php';
    }
include('classes/'.$class.'.php');
};

spl_autoload_register($autoload);

define('INCLUDE_PATH' , 'http://localhost/portal/'); //diretorio raiz do sistema
define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'painel/'); //diretorio estatico para o painel

//Conectar com o Banco de Dados
define ('DATABASE', 'projeto_01');
define ('USER','root');
define ('HOST','localhost');
define ('PASSWORD','');


//Constantes Painel de Controle

define ('NOME_EMPRESA', 'Projeto 01');
define ('BASE_DIR_PAINEL',__DIR__.'/painel');




//Funções

function pegaCargo($indice){
    return Painel::$cargos[$indice];
    
}

function selecionadoMenu ($par){
    $url = explode('/',@$_GET['url'])[0];
    if($url ==$par){
        echo 'class="menu-active"';
    }
}
function verificaPermissaoMenu ($permissao){
    if($_SESSION['cargo']>= $permissao){
        return;
    }else{
            echo 'style="display:none;"';
        }
    }

    function verificaPermissaoPagina ($permissao){
        if($_SESSION['cargo']>= $permissao){
            return;
        }else{
                include('painel/pages/permissao_negada.php');
                die();
            }
    }

    function recoverPost($post){
        if (isset($_POST[$post])){
            echo $_POST[$post];
        }
    }

?>