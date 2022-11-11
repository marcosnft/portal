<?php
$tabela = "tb_site.noticias";

?>
<div class="box-content">

    <h2><i class="fas fa-pencil-alt"></i>Cadastrar Notícia</h2>

    <form action="" enctype="multipart/form-data" method="post">

        <?php
        if (isset($_POST['acao'])) {
            //Enviei o formulário
            $categoria_id = $_POST['categoria_id'];
            $titulo = $_POST['titulo'];
            $conteudo = $_POST['conteudo'];
            $capa = $_FILES['capa'];


            if ($titulo == '' || $conteudo == '') {
                Painel::alert('erro', ' Campos vazios não são permitidos!');
            } else if ($capa['tmp_name'] == '') {
                Painel::alert('erro', ' Selecione uma imagem para a capa!');
            } else{
                if(Painel::imagemValida($capa)){
                    $verifica = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`$tabela` WHERE `titulo` = ? AND `categoria_id`=?");
                    $verifica->execute(array($titulo,$categoria_id));
                    if($verifica->rowCount()==0){
                    $imagem = Painel::uploadFile($capa);
                    $slug = Painel::generateSlug($titulo);
                    $arr = ['categoria_id'=>$categoria_id,'data'=>date('Y-m-d'),'titulo'=>$titulo,'conteudo'=>$conteudo,'capa'=>$imagem,
                    'slug'=>$slug,'order_id'=>0,'nome_tabela'=>'tb_site.noticias'];
                    if(Painel::insert($arr)){
                        Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-noticias');
                        //Painel::alert('sucesso',' O Cadastro da noticia foi feito com sucesso!');
                    }
                } else{
                    Painel::alert('erro',' Já existe uma notícia com esse nome');
                }
                } else{
                    Painel::alert('erro',' Selecione uma imagem válida!');
                }
            }
            if( isset($_GET['sucesso']) && !isset($_POST['acao'])){
                Painel::alert('sucesso',' O Cadastro da noticia foi feito com sucesso!');
            }
            //Podemos cadastrar
           
        }


        ?>
       <div class="form-group">
		<label>Categoria:</label>
		<select name="categoria_id">
			<?php
				$categorias = Painel::selectAll('tb_site.categorias');
				foreach ($categorias as $key => $value) {
			?>
			<option <?php if($value['id'] == @$_POST['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome']; ?></option>
			<?php } ?>
		</select>
		</div>
        <div class="form-group">
            <label for="">Título:</label>
            <input type="text" name="titulo" value="<?php recoverPost('titulo');?>">
        </div><!-- /div.formgroup -->
        <div class="form-group">
            <label for="">Conteúdo</label>
            <textarea name="conteudo" class="tinymce" id="" cols="30" rows="10" ><?php recoverPost('conteudo');?></textarea>
        </div>
        <div class=" form-group">
            <label for="">Capa</label>
            <input type="file" name="capa">

        </div><!-- /div.formgroup -->


        <div class="form-group">

            <input type="submit" name="acao" value="Cadastrar!">
        </div><!-- /div.formgroup -->
    </form>


</div><!-- div box content-->