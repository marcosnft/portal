
<div class="box-content">

    <h2><i class="fas fa-pencil-alt"></i>Adicionar Depoimentos</h2>

    <form action="" enctype="multipart/form-data" method="post">

        <?php
        if (isset($_POST['acao'])) {
            /*
            $nome = $_POST['nome'];
            $depoimento = $_POST['depoimento'];
            if($nome == ''){
                Painel::alert('erro','Você deve inserir o nome!');
            } else if( $depoimento == ''){
                Painel::alert('erro','Você deve inserir o depoimento!');
            }*/ //Validação manual de campos vazios
            //Enviei o formulário
            if(Painel::insert($_POST)){
                Painel::alert('sucesso','O cadastro do depoimento foi feito com sucesso!');
            } else{ Painel::alert('erro','Campos vazios não são permitidos');}
            
            
        }

        ?>
         <div class="form-group">
            <label for="">Nome da pessoa:</label>
            <input type="text" name="nome">
               <div class="form-group">

        <div class="form-group">
            <label for="">Depoimento:</label>
            <textarea name="depoimento"></textarea>
        </div><!-- /div.formgroup -->
        <div class="form-group">
            <label for="">Data:</label>
            <input formato="data" type="text" name="data" id="">
        </div><!-- /div.formgroup -->
       <input type="hidden" name="nome_tabela" value="tb_site.depoimentos">
            <input type="submit" name="acao" value="Cadastrar!">
        </div><!-- /div.formgroup -->
    </form>


</div><!-- div box content-->