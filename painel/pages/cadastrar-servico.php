
<div class="box-content">

<h2><i class="fas fa-pencil-alt"></i>Adicionar Serviços</h2>

<form action="" enctype="multipart/form-data" method="post">

    <?php
    if (isset($_POST['acao'])) {
       
           
        if(Painel::insert($_POST)){
            
            Painel::alert('sucesso','O cadastro do Serviço foi feito com sucesso!');
        } else{ Painel::alert('erro','Campos vazios não são permitidos');}
        
        
    }

    ?>
        <div class="form-group">
        <label for="">Descreva o Serviço:</label>
        <textarea name="servico"></textarea>
    </div><!-- /div.formgroup -->
    
   <input type="hidden" name="order_id" value="0">
    <input type="hidden" name="nome_tabela" value="tb_site.servicos">
        <input type="submit" name="acao" value="Cadastrar!">
    </div><!-- /div.formgroup -->
</form>


</div><!-- div box content-->