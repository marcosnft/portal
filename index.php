<?php include('config.php'); ?>
<?php Site::updateUsuarioOnline(); ?>
<?php Site::contador(); ?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>estilo/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>estilo/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="projeto,desenvolvimento,web">
    <meta name="description" content="Meu Projeto 1">
    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>favicon.ico" type="image/x-icon">

    <title>Projeto 01</title>
</head>

<base base="<?php echo INCLUDE_PATH; ?>" />

<body>
    <?php
    $url = isset($_GET['url']) ? $_GET['url'] : 'home';
    switch ($url) {
        case 'Sobre':
            echo '<target target="Sobre" />';
            break;
        case 'Servicos':
            echo '<target target="Servicos" />';
            break;
    }

    ?>
    <? //php new Email ();
    ?>
    <header>
        <div class="center">
            <div class="logo left"> <a href="/">Logomarca</a> </div>
            <nav class="desktop right">
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>Sobre">Sobre</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>Servicos">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
                    <li><a realtime="Contato" href="<?php echo INCLUDE_PATH; ?>Contato">Contato</a></li>
                    <li><a realtime="depoimentos-2" href="<?php echo INCLUDE_PATH; ?>Contato">Depoimentos-2</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>Painel">Painel</a></li>
                </ul>
            </nav>
            <nav class="mobile right">
                <div class="botao-menu-mobile">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </div>
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>Sobre">Sobre</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>Servicos">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>noticias">Notícias</a></li>
                    <li><a realtime="Contato" href="<?php echo INCLUDE_PATH; ?>Contato">Contato</a></li>
                    <li><a realtime="depoimentos-2" href="<?php echo INCLUDE_PATH; ?>Contato">Depoimentos-2</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>Painel">Painel</a></li>
                </ul>
            </nav>
            <div class="clear"></div>
        </div><!-- Banner Principal-->

    </header>
    <div class="container-principal">
        <?php
        $url = isset($_GET['url']) ? $_GET['url'] : 'home';
        if (file_exists('pages/' . $url . '.php')) {
            include('pages/' . $url . '.php');
        } else {
            if ($url != 'Sobre' && $url != 'Servicos') {
                $urlPar = explode('/', $url)[0];
                if ($urlPar != 'noticias') {
                    $pagina404 = true;
                    include('pages/404.php');
                } else {
                    include('pages/noticias.php');
                }
            } else {

                include('pages/home.php');
            }
        }

        ?>
    </div> <!-- Container principal-->
    <footer <?php if (isset($pagina404) && $pagina404 == true)  echo 'class="fixed"'; ?>>
        <div class="center">
            <p style="color:white;">Todos os direitos reservados</p>
        </div>
    </footer>
    <script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
    <script src='https://maps.google.com/maps/api/js?key=AIzaSyCcvyLb1jXDkbrtIiE39vsKF3GpQfp5yQ4&#038;ver=4.9.15'></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/map.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/script.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/animacao.js"></script>
    <?php if ($url == 'home' || $url == '') {
    ?>
        <script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>
    <?php } ?>
    <?php 

    if(is_array($url) && strstr($url[0], 'noticias') !== false) {
    ?>
        <script>
           
                $('select').change(function(){
                    location.href=include_path+"noticias/"+$(this).val();
                })
            
        </script>
    <?php } ?>
    <?php if ($url == 'Contato') {
    ?>


    <?php } ?>

    <script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"> </script>
</body>

</html>