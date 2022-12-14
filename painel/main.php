<?php
if (isset($_GET['loggout'])) {
    Painel::loggout();
}
$nomeEmpresa = "Projeto 01";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title> Painel de Controle </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>estilo/fontawesome.min.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>estilo/all.css">
    <script src="https://cdn.tiny.cloud/1/zu83q6qc3k50lft09am6z5q6xe72cv203o5z9yj5a0pix9ju/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>
    <title>Document</title>

</head>

<body>
    <div class="menu">
        <div class="menu-wraper">
            <div class="box-usuario">
                <?php
                if ($_SESSION['img'] == '') {

                ?>
                    <div class="avatar-usuario">
                        <i class="fas fa-user"> </i>
                    </div> <!-- div avatar-usuario-->
                <?php
                } else { ?>
                    <div class="imagem-usuario">
                        <a href="<?php echo INCLUDE_PATH_PAINEL ?>" main> <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>" /> </a>
                    </div> <!-- div avatar-usuario-->
                <?php }    ?>
                <div class="nome-usuario">
                    <a href="<?php echo INCLUDE_PATH_PAINEL ?>" main style="text-decoration:none">
                        <p> <?php echo $_SESSION['nome'] ?> </p>
                    </a>
                    <a href="<?php echo INCLUDE_PATH_PAINEL ?>" main style="text-decoration:none">
                        <p> <?php echo pegaCargo($_SESSION['cargo']); ?> </p>
                    </a>

                </div> <!-- div nome-usuario-->

            </div> <!-- div box-usuario-->
            <div class="items-menu">
                <h2>Cadastro</h2>
                
                <a <?php selecionadoMenu('cadastrar-depoimento'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimento"> Cadastrar Depoimento </a>
                <a <?php selecionadoMenu('cadastrar-servico'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-servico"> Cadastrar Servi??o </a>
                <a <?php selecionadoMenu('cadastrar-slide'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-slide"> Cadastrar Slides </a>
                <h2>Gest??o</h2>
                <a <?php selecionadoMenu('listar-depoimentos'); ?>href="<?php echo INCLUDE_PATH_PAINEL?>listar-depoimentos"> Listar Depoimentos </a>
                <a <?php selecionadoMenu('listar-servicos'); ?>href="<?php echo INCLUDE_PATH_PAINEL?>listar-servicos"> Listar Servi??os </a>
                <a <?php selecionadoMenu('listar-slides'); ?>href="<?php echo INCLUDE_PATH_PAINEL?>listar-slides"> Listar Slides </a>
                <h2>Administra????o do Painel</h2>
                <a <?php selecionadoMenu('editar-usuario');  ?>href="<?php echo INCLUDE_PATH_PAINEL?>editar-usuario"> Editar Usu??rios</a>
                <a <?php selecionadoMenu('adicionar-usuario');?> <?php verificaPermissaoMenu(2);?>href="<?php echo INCLUDE_PATH_PAINEL?>adicionar-usuario"> Adicionar Usu??rios </a>
                <h2>Configura????o Geral</h2>
                <a <?php selecionadoMenu('editar-site'); ?>href="<?php echo INCLUDE_PATH_PAINEL?>editar-site"> Editar Site </a>
                <h2>Gest??o de Not??cias</h2>
                <a <?php selecionadoMenu('cadastrar-categorias');  ?>href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-categorias">Cadastrar Categorias</a>
                <a <?php selecionadoMenu('gerenciar-categorias');  ?>href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-categorias">Gerenciar Categorias</a>
                <a <?php selecionadoMenu('cadastrar-noticias');  ?>href="<?php echo INCLUDE_PATH_PAINEL?>cadastrar-noticias">Cadastrar Not??cias</a>
                <a <?php selecionadoMenu('editar-noticia');  ?>href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-noticias">Gerenciar Not??cias</a>
            </div> <!-- div items-menu-->

        </div> <!-- div menu-wraper-->

    </div> <!-- div menu -->
    <header>

        <div class="center">
            <div class="menu-btn">
                <i class="fas fa-bars"> </i>
            </div>
          
            <div class="logout_btn_home">
            <a <?php if(@$_GET['url'] == ''){ ?> style="background: #60727a;padding: 15px" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>" main><i class="fas fa-home"></i><span>P??gina Inicial</span></a>
                <a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout"> <i class="fas fa-window-close"></i> <span>Sair</span></a>
            </div>
            <!--div logout-->
        </div> <!-- div center-->
        <div class="clear"> </div>
    </header>
    <div class="content">
        <?php Painel::carregarPagina(); ?>

    </div><!-- Div content -->
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.js"> </script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"> </script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery_mask.js"></script>
    
</body>

</html>