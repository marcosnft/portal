<?php
$tabela = "tb_site.slides";

?>
<div class="box-content">

    <h2><i class="fas fa-pencil-alt"></i>Cadastrar Slides</h2>

    <form action="" enctype="multipart/form-data" method="post">

        <?php
        if (isset($_POST['acao'])) {
            //Enviei o formulário
            $nome = $_POST['nome'];
            $imagem = $_FILES['imagem'];


            if ($nome == '') {
                Painel::alert('erro', 'Preencha o nome!');
            } else {
                //Podemos cadastrar
                if (Painel::imagemValida($imagem) == false) {
                    Painel::alert('erro', 'O formato não está correto!');
                } else {
                    //Wideimage para manipular e redimensionar automaticamente imagens via uploads
                    include('../classes/lib/WideImage.php');
                    $imagem = Painel::uploadFile($imagem);
                    WideImage::load('uploads/'.$imagem)->resize(100)->saveToFile('uploads/'.$imagem);
                    $arr = ['nome' => $nome,'slide' => $imagem, 'order_id' => '0', 'nome_tabela' => $tabela];
                    Painel::insert($arr);
                    Painel::alert('sucesso', 'O cadastro do slide foi realizado com sucesso!');
                }
            }
        }

        ?>

        <div class="form-group">
            <label for="">Nome do Slide:</label>
            <input type="text" name="nome">
        </div><!-- /div.formgroup -->

        <div class=" form-group">
            <label for="">Imagem</label>
            <input type="file" name="imagem">

        </div><!-- /div.formgroup -->


        <div class="form-group">
            
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!-- /div.formgroup -->
    </form>


</div><!-- div box content-->