<?php
$tabela = "tb_site.categorias";

?>
<div class="box-content">

    <h2><i class="fas fa-pencil-alt"></i>Cadastrar Categorias</h2>

    <form action="" enctype="multipart/form-data" method="post">

        <?php
        if (isset($_POST['acao'])) {
            //Enviei o formulário
        
			if(isset($_POST['acao'])){
				$nome = $_POST['nome'];
				if($nome == ''){
					Painel::alert('erro','O campo nome não pode ficar vázio!');
				}else{
					//Apenas cadastrar no banco de dados!
					$verificar = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`tb_site.categorias` WHERE nome = ?");
					$verificar->execute(array($_POST['nome']));
                    $info = $verificar->fetch();
					if($verificar->rowCount() == 0){
					$slug = Painel::generateSlug($nome);

					$arr = ['nome'=>$nome,'slug'=>$slug,'order_id'=>'0','nome_tabela'=>$tabela];
					Painel::insert($arr);
					Painel::alert('sucesso','O cadastro da categoria foi realizado com sucesso!');
					}else{
						Painel::alert("erro",'Já existe uma categoria com este nome!');
					}
				}
            }
				
        }

        ?>

        <div class="form-group">
            <label for="">Nome da Categoria:</label>
            <input type="text" name="nome">
        </div><!-- /div.formgroup -->




        <div class="form-group">

            <input type="submit" name="acao" value="Cadastrar!">
        </div><!-- /div.formgroup -->
    </form>


</div><!-- div box content-->