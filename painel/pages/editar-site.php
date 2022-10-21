<?php
$site = Painel::select('tb_site.config', false);
?>
<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Confidurações do Site</h2>

    <form method="post" enctype="multipart/form-data">

        <?php
        if (isset($_POST['acao'])) {
            if (Painel::update($_POST, true)) {
                Painel::alert('sucesso', 'O Site foi editado com sucesso!');
                $site = Painel::select('tb_site.config', false);
            } else {
                Painel::alert('erro', 'Campos vázios não são permitidos.');
            }
        }
        ?>

        <div class="form-group">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?php echo $site['titulo']; ?>"></input>
        </div>
        <!--form-group-->


        <div class="form-group">
            <label>Nome Autor:</label>
            <input type="text" name="nome_autor" value="<?php echo $site['nome_autor']; ?>"></input>
        </div>
        <!--form-group-->

        <div class="form-group">
            <label>Descrição do Autor:</label>
            <textarea name="descricao"><?php echo $site['descricao']; ?></textarea>
        </div>
        <!--form-group-->
<?php for($i=1;$i<=3;$i++) {?>
    
        <div class="form-group">
            <label><?php echo $i;?>º Ícone do Font Awesome:</label>
            <input type="text" name="icone<?php echo $i;?>" value="<?php echo $site['icone'.$i]; ?>"></input>
        </div>
        <!--form-group-->

        <div class="form-group">
            <label>Descrição do Serviço:</label>
            <textarea name="descricao<?php echo $i;?>"><?php echo $site['descricao'.$i]; ?></textarea>
        </div>
        <!--form-group-->
<?php }?>
   
        <div class="form-group">

            <input type="hidden" name="nome_tabela" value="tb_site.config" />
            <input type="submit" name="acao" value="Atualizar!">
        </div>
        <!--form-group-->

    </form>



</div>
<!--box-content-->