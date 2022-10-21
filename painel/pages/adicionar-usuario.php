<?php
verificaPermissaoPagina(2);

?>
<div class="box-content">

    <h2><i class="fas fa-pencil-alt"></i>Adicionar Usuario</h2>

    <form action="" enctype="multipart/form-data" method="post">

        <?php
        if (isset($_POST['acao'])) {
            //Enviei o formulário
            $login = $_POST['login'];
            $nome = $_POST['nome'];
            $senha = $_POST['password'];
            $imagem = $_FILES['imagem'];
            $cargo = $_POST['cargo'];

            if ($login == '') {
                Painel::alert('erro', 'O login está vazio');
            } else if ($nome == '') {
                Painel::alert('erro', 'Preencha o nome!');
            } else if ($senha == '') {
                Painel::alert('erro', ' A senha não pode ser vazia!');
            } else if ($cargo == '') {
                Painel::alert('erro', 'O cargo deve estar selecionado!');
            } else if ($imagem['name'] == '') {
                Painel::alert('erro', 'A imagem deve estar selecionada!');
            } else {
                //Podemos cadastrar
                if ($cargo >= $_SESSION['cargo']) {
                    Painel::alert('erro', 'Você precisa selecionar um cargo menor que o seu!');
                } else if (Painel::imagemValida($imagem) == false) {
                    Painel::alert('erro', 'O formato não está correto!');
                }else if(Usuario::userExists($login)){
                    Painel::alert('erro','O login já existe, por favor selecione outro!');
                } 
                else {
                    $usuario = new Usuario();
                    $imagem = Painel::uploadFile($imagem);
                    $usuario->cadastrarUsuario($login,$senha,$imagem,$nome,$cargo);
                    Painel::alert('sucesso','O cadastro do usuário '.$login.' foi feito com sucesso!');
                }
            }
        }

        ?>
        <div class="form-group">
            <label for="">Login:</label>
            <input type="text" name="login">
        </div><!-- /div.formgroup -->
        <div class="form-group">
            <label for="">Nome:</label>
            <input type="text" name="nome">
        </div><!-- /div.formgroup -->
        <div class="form-group">
            <label for="">Senha:</label>
            <input type="password" name="password">
        </div><!-- /div.formgroup -->

        <div class=" form-group">
            <label for="">Cargo:</label>
            <select name="cargo" id="">
                <?php
                foreach (Painel::$cargos as $key => $value) {
                    if ($key < $_SESSION['cargo']) echo '<option value="' . $key . '">' . $value . '</option>';
                }
                ?>
            </select>

        </div><!-- /div.formgroup -->
        <div class=" form-group">
            <label for="">Imagem</label>
            <input type="file" name="imagem" >

        </div><!-- /div.formgroup -->


        <div class="form-group">

            <input type="submit" name="acao" value="Cadastrar!">
        </div><!-- /div.formgroup -->
    </form>


</div><!-- div box content-->