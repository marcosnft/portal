<?php
$tabela = 'tb_site.noticias';
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $noticia = Painel::select('tb_site.noticias', 'id=?', array($id));
} else {
    Painel::alert('erro', 'voce precisa passar o parametro ID!');
    die();
}


?>
<div class="box-content">
    <h2><i class="fas fa-pencil-alt"></i>Editar Notícia</h2>

    <form action="" enctype="multipart/form-data" method="post">

        <?php
        if (isset($_POST['acao'])) {
            //Enviei o formulário


            $titulo = $_POST['titulo'];
            $categoria_id = $_POST['categoria_id'];
            $conteudo = $_POST['conteudo'];
            $capa = $_FILES['capa'];
            $capa_atual = $_POST['capa_atual'];
            $verifica = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`$tabela` WHERE titulo = ? AND categoria_id=? AND id!=?");
            $verifica->execute(array($titulo,$_POST['categoria_id'], $id));
            if ($verifica->rowCount() == 0) {


                if ($capa['name'] != '') {
                    //Existe upload de capa

                    if (Painel::imagemValida($capa)) {
                        Painel::deleteFile($capa_atual);
                        $capa = Painel::uploadFile($capa);
                        $slug = Painel::generateSlug($titulo);
                        $arr = ['categoria_id' => $categoria_id, 'titulo' => $titulo, 'data'=>date('Y-m-d'), 'capa' => $capa, 'slug' => $slug, 'conteudo' => $conteudo, 'id' => $id, 'nome_tabela' => $tabela];
                        Painel::update($arr);
                        $noticia = Painel::select('tb_site.noticias', 'id=?', array($id));
                        Painel::alert('sucesso', 'A notícia foi editada junto com a capa!');
                        sleep(3);
                        Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-noticias');
                    } else {
                        Painel::alert('erro', 'O formato da capa não é valido!');
                    }
                } else {
                    $capa = $capa_atual;
                    $slug = Painel::generateSlug($titulo);
                    $arr = ['categoria_id' => $categoria_id, 'titulo' => $titulo, 'capa' => $capa, 'slug' => $slug, 'conteudo' => $conteudo, 'id' => $id, 'nome_tabela' => $tabela];
                    Painel::update($arr);
                    $noticia = Painel::select('tb_site.noticias', 'id=?', array($id));
                    Painel::alert('sucesso', 'A noticia foi atualizada com sucesso!');
                    sleep(3);
                        Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-noticias');
                }
            } else {
                Painel::alert('erro', 'Já existe uma noticia com este nome');
            }
        }
        ?>

        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria_id">
                <?php
                $categorias = Painel::selectAll('tb_site.categorias');
                foreach ($categorias as $key => $value) {
                ?>
                    <option <?php if ($value['id'] == $noticia['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Título:</label>
            <input type="text" name="titulo" required value="<?php echo $noticia['titulo']; ?>">
        </div><!-- /div.formgroup -->

        <div class="form-group">
            <label for="">Conteúdo:</label>
            <textarea name="conteudo" id="" cols="30" rows="10"><?php echo $noticia['conteudo']; ?></textarea>
        </div><!-- /div.formgroup -->

        <div class=" form-group">
            <label for="">Capa:</label>
            <input type="file" name="capa">
            <input type="hidden" name="capa_atual" value="<?php echo $noticia['capa']; ?>">
        </div><!-- /div.formgroup -->

        <div class="form-group">

            <input type="submit" name="acao" value="Atualizar!">
        </div><!-- /div.formgroup -->


</div><!-- div box content-->