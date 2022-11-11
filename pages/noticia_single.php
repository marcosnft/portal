<?php 
$url = explode('/',$_GET['url']);
$verifica_categoria = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`tb_site.categorias` WHERE slug = ?");
$verifica_categoria->execute(array($url[1]));
if($verifica_categoria->rowCount() == 0){
Painel::redirect(INCLUDE_PATH.'noticias');
}
$categoria_info = $verifica_categoria->fetch();
$post = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`tb_site.noticias` WHERE slug = ? AND categoria_id = ?");
$post->execute(array($url[2],$categoria_info['id']));
if($post->rowCount() == 0){
    //Painel::redirect(INCLUDE_PATH.'noticias');
}
//NOTICIA EXISTE
$post = $post->fetch();
?>
<section class="noticia-single">
    
    <div class="center">
        <header>
            <h1> <i class="fa fa-calendar"></i> <?php echo $post['titulo']?></h1>
        </header>
        <article>
            <img src="<?php echo INCLUDE_PATH_PAINEL.'uploads/'.$post['capa'];?>" alt="">
        <p> <?php echo $post['conteudo']?>

            
        </article>
        <a href="<?php echo INCLUDE_PATH.'noticias';?>">Retonar página de notícias</a>
    </div> <!-- /.center -->
   
</section><!-- /.noticia-single -->
