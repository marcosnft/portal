<?php
$lala = "lala";
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

}

?>