<?php
$tabela = 'tb_site.slides';
if (isset($_GET['id'])){
    $id = (int) $_GET['id'];
    $slide = Painel::select('tb_site.slides','id=?',array($id));
}else{
    Painel::alert('erro', 'voce precisa passar o parametro ID!');
    die();
}


?>
<div class="box-content">
    <h2><i class="fas fa-pencil-alt"></i>Editar Slide</h2>

    <form action="" enctype="multipart/form-data" method="post">

        <?php
        if (isset($_POST['acao'])) {
            //Enviei o formulário


            $nome = $_POST['nome'];
           
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
            
            if ($imagem['name'] != '') {
                //Existe upload de imagem

                if (Painel::imagemValida($imagem)) {
                    Painel::deleteFile($imagem_atual);
                    $imagem = Painel::uploadFile($imagem);
                    $arr = ['nome' => $nome,'slide' => $imagem, 'id'=>$id, 'nome_tabela' => $tabela];
                    Painel::update($arr);
                    $slide = Painel::select('tb_site.slides','id=?',array($id));
                    Painel::alert('sucesso', 'O slide foi editado junto com a imagem!');
                    
                } else {
                    Painel::alert('erro', 'O formato da imagem não é valido!');
                }
            } else {
                $imagem = $imagem_atual;
                $arr = ['nome' => $nome,'slide' => $imagem, 'id'=>$id, 'nome_tabela' => $tabela];
                Painel::update($arr);
                $slide = Painel::select('tb_site.slides','id=?',array($id));
                Painel::alert('sucesso', 'O slide foi editado com sucesso!');
                
            }
        }
        ?>
        <div class="form-group">
            <label for="">Nome:</label>
            <input type="text" name="nome" required value="<?php echo $slide['nome']; ?>">
        </div><!-- /div.formgroup -->
        

        <div class=" form-group">
            <label for="">Imagem</label>
            <input type="file" name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $slide['slide']; ?>">
        </div><!-- /div.formgroup -->

        <div class="form-group">

            <input type="submit" name="acao" value="Atualizar!">
        </div><!-- /div.formgroup -->
    </form>


</div><!-- div box content-->