<div class="box-content">
    <h2><i class="fas fa-pencil-alt"></i>Editar Usuario</h2>

    <form action="" enctype="multipart/form-data" method="post">

        <?php
        if (isset($_POST['acao'])) {
            //Enviei o formulário


            $nome = $_POST['nome'];
            $senha = $_POST['password'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
            $usuario = new Usuario();
            if ($imagem['name'] != '') {
                //Existe upload de imagem

                if (Painel::imagemValida($imagem)) {
                    Painel::deleteFile($imagem_atual);
                    $imagem = Painel::uploadFile($imagem);
                    if ($usuario->atualizarUsuario($nome, $senha, $imagem)) {
                        $_SESSION['img'] = $imagem;
                        Painel::alert('sucesso', 'Atualização feita com Sucesso junto com a imagem!');
                    } else {
                        Painel::alert('erro', 'Ocorreu um erro ao atualizar junto com a imagem!');
                    }
                } else {
                    Painel::alert('erro', 'O formato da imagem não é valido!');
                }
            } else {
                $imagem = $imagem_atual;
                if ($usuario->atualizarUsuario($nome, $senha, $imagem)) {
                    Painel::alert('sucesso', 'Atualização feita com Sucesso!');
                } else {
                    Painel::alert('erro', 'Ocorreu um erro ao atualizar!');
                }
            }
        }
        ?>
        <div class="form-group">
            <label for="">Nome:</label>
            <input type="text" name="nome" required value="<?php echo $_SESSION['nome']; ?>">
        </div><!-- /div.formgroup -->
        <div class="form-group">
            <label for="">Senha:</label>
            <input type="password" name="password" required value="<?php echo $_SESSION['password']; ?>">
        </div><!-- /div.formgroup -->

        <div class=" form-group">
            <label for="">Imagem</label>
            <input type="file" name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img']; ?>">
        </div><!-- /div.formgroup -->

        <div class="form-group">

            <input type="submit" name="acao" value="Atualizar!">
        </div><!-- /div.formgroup -->
    </form>


</div><!-- div box content-->