<?php

class Painel
{
   
   
    public static $cargos = [
        '0' => 'Normal',
        '1' => 'Sub Administrador',
        '2' => 'Administrador'
    ];

    public static function logado()
    {
        return isset($_SESSION['login']) ? true : false;
    }

    public static function loggout()
    {
        session_destroy();
        header('location: ' . INCLUDE_PATH_PAINEL);
        setcookie('lembrar', true, time() - 1, '/'); //não tem como destruir um cookie, para apagar precisa colocar a duração do tempo negativa
    }

    public static function carregarPagina() //VALIDAR PAGINAS DO PAINEL
    {
        if (isset($_GET['url'])) {

            $url = explode('/', $_GET['url']); /*explode divide a string de acordo com o delimitador, 
            transformando a string em array*/
            if (file_exists('pages/' . $url[0] . '.php')) {
                include('pages/' . $url[0] . '.php');
            } else {
                //Quando a página não existe!!
                header('location: ' . INCLUDE_PATH_PAINEL);
            }
        } else {
            include('pages/home.php');
        }
    }

    public static function listarUsuariosOnline()
    {
        self::limparUsuariosOnline();
        $sql = MySql::conectar()->prepare("SELECT * from `projeto_01`.`tb_admin.online`");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function limparUsuariosOnline()
    {

        $sql = Mysql::conectar()->exec("DELETE from `projeto_01`.`tb_admin.online` WHERE ultima_acao < NOW() - INTERVAL 2 MINUTE");
        //limpa a tabela dos usuarios online
    }

    public static function alert($tipo, $mensagem) //alert de confirmação de operação - atualizar
    {
        if ($tipo == "sucesso") {
            echo '<div class="box-alert sucesso"> <i class="fas fa-check"></i>' . $mensagem . '</div>';
        } else if ($tipo == 'erro') {
            echo '<div class="box-alert erro"><i class="fas fa-times"></i>' . $mensagem . '</div>';
        }
    }

    public static function imagemValida($imagem)
    {
        if (
            $imagem['type'] == 'image/jpeg' ||
            $imagem['type'] == 'image/jpg' ||
            $imagem['type'] == 'image/png'
        ) {

            $tamanho = intval($imagem['size'] / 1024);
            if ($tamanho < 300) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function uploadFile($file)
    {
        $formatoArquivo = explode('.', $file['name']);
        $imagemNome = uniqid() . '.' . $formatoArquivo[count($formatoArquivo) - 1];
        if (move_uploaded_file($file['tmp_name'], BASE_DIR_PAINEL . '/uploads/' . $imagemNome)) {
            return $imagemNome;
        } else {
            return false;
        }
    }

    public static function deleteFile($file)
    {
        @unlink('uploads/' . $file);
    }


    //Metódo dinamico para inserir no banco de dados de acordo com o formulário
    public static function insert($arr)
    {
        $certo = true;
        $nome_tabela = $arr['nome_tabela'];
        $query = "INSERT INTO `projeto_01`.`$nome_tabela` VALUES (null";
        foreach ($arr as $key => $value) {
            $nome = $key;
            $valor = $value;
            if ($nome == 'acao' || $nome == 'nome_tabela') {
                continue;
            }
            if ($value == '') {
                $certo = false;
                break;
            }
            $query .= ",?";
            $parametros[] = $value;
        }
       
        
        $query .= ")";
        if($certo == true){
            $sql = MySql::conectar()->prepare($query);
            $sql->execute($parametros);
            $lastId = MySql::conectar()->lastInsertId();
            $sql = MySql::conectar()->prepare("UPDATE `projeto_01`.`$nome_tabela` SET order_id = ? WHERE id = $lastId");
            $sql->execute(array($lastId));
        }
        return $certo;
    }

    public static function select($table,$query = '',$arr = ''){
        if($query != false){
            $sql = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`$table` WHERE $query");
            $sql->execute($arr);
        }else{
            $sql = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`$table`");
            $sql->execute();
        }
        return $sql->fetch();
    }

    public static function update($arr,$single = false){
        $certo = true;
        $first = false;
        $nome_tabela = $arr['nome_tabela'];
        $db = 'projeto_01';

        $query = "UPDATE `$db`.`$nome_tabela` SET ";
        foreach ($arr as $key => $value) {
            $nome = $key;
            $valor = $value;
            if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')
                continue;
            if($value == ''){
                $certo = false;
                break;
            }
            
            if($first == false){
                $first = true;
                $query.="$nome=?";
            }
            else{
                $query.=",$nome=?";
            }

            $parametros[] = $value;
        }

        if($certo == true){
            if($single == false){
                $parametros[] = $arr['id'];
                $sql = MySql::conectar()->prepare($query.' WHERE id=?');
                $sql->execute($parametros);
            }else{
                $sql = MySql::conectar()->prepare($query);
                $sql->execute($parametros);
            }
        }
        return $certo;
    }

    public static function selectAll($tabela,$start=null,$end=null){
        if($start ==null && $end == null)
            $sql = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`$tabela`");
          
         else
            $sql = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`$tabela` ORDER BY id DESC LIMIT $start,$end ");
         
        
        $sql->execute();
        
       
        return $sql->fetchAll();
    }
    public static function deletar($tabela,$id=false){
        if($id == false){
        $sql = MySql::conectar()->prepare("DELETE FROM `projeto_01`.`$tabela`");
            } else{
        $sql = MySql::conectar()->prepare ("DELETE FROM `projeto_01`.`$tabela` WHERE id = $id");
            }
    $sql->execute();
}

public static function redirect ($url){
    echo '<script>location.href="'.$url.'"</script>';
    die();
}

public static function generateSlug($str){
    $str = mb_strtolower($str);
    $str = mb_strtolower($str);
    $str = preg_replace('/(â|á|ã)/', 'a', $str);
    $str = preg_replace('/(ê|é)/', 'e', $str);
    $str = preg_replace('/(í|Í)/', 'i', $str);
    $str = preg_replace('/(ú)/', 'u', $str);
    $str = preg_replace('/(ó|ô|õ|Ô)/', 'o',$str);
    $str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
    $str = preg_replace('/( )/', '-',$str);
    $str = preg_replace('/ç/','c',$str);
    $str = preg_replace('/(-[-]{1,})/','-',$str);
    $str = preg_replace('/(,)/','-',$str);
    $str=strtolower($str);
    return $str;
}

public static function orderItem($tabela,$orderType,$idItem){
    if($orderType == 'up'){
        $infoItemAtual = Painel::select(`projeto_01`.$tabela,'id=?',array($idItem));
        $order_id = $infoItemAtual['order_id'];
        $itemBefore = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`$tabela` WHERE order_id < $order_id ORDER BY order_id DESC LIMIT 1");
        $itemBefore->execute();
        if($itemBefore->rowCount() == 0)
            return;
        $itemBefore = $itemBefore->fetch();
        Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
        Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));
    }else if($orderType == 'down'){
        $infoItemAtual = Painel::select(`projeto_01`.$tabela,'id=?',array($idItem));
        $order_id = $infoItemAtual['order_id'];
        $itemBefore = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`$tabela` WHERE order_id > $order_id ORDER BY order_id ASC LIMIT 1");
        $itemBefore->execute();
        if($itemBefore->rowCount() == 0)
            return;
        $itemBefore = $itemBefore->fetch();
        Painel::update(array('nome_tabela'=>$tabela,'id'=>$itemBefore['id'],'order_id'=>$infoItemAtual['order_id']));
        Painel::update(array('nome_tabela'=>$tabela,'id'=>$infoItemAtual['id'],'order_id'=>$itemBefore['order_id']));
    }
}
}
