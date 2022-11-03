<?php
$url = explode('/', $_GET['url']);
if (!isset($url[2])) { ?>



    <section class="header-noticias">
        <div class="center">
            <h2><i class="fa fa-bell" aria-hidden="true"></i></h2>
            <h2>Acompanhe as últimas notícias.</h2>
        </div>
        <!-- /.center -->
    </section>

    <section class="container-portal">
        <div class="center">
            <div class="sidebar">
                <div class="box-content-sidebar">
                    <h3> <i class="fa fa-search"></i> Realizar uma Busca:</h3>
                    <form action="" method="post">
                        <input type="text" name="busca" placeholder="O que deseja procurar?">
                        <input type="submit" name="acao" value="Pesquisar!">
                    </form>
                </div> <!-- /.box-content-sidebar -->
                <div class="box-content-sidebar">
                    <h3> <i class="fa fa-list-ul"></i> Selecione a Categoria:</h3>
                    <form action="" method="post">
                        <select name="categoria" id="">
                            <option value="esportes">Esportes</option>
                            <option value="esportes">Geral</option>
                        </select>
                    </form>
                </div> <!-- /.box-content-sidebar -->
                <div class="box-content-sidebar">
                    <h3> <i class="fa fa-user"></i> Conheça o Autor:</h3>
                    <div class="autor-box-portal">
                        <div class="box-img-autor">

                        </div> <!-- /.box-img-autor -->
                        <div class="texto-autor-portal text-center">
                            <h3>Marcos</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus expedita amet sint nihil provident illo, hic non, sunt rem tempore dignissimos deleniti saepe numquam consequuntur. Odio voluptatibus ut similique hic?</p>

                        </div> <!-- /.texto-autor-portal -->
                        <img src="" alt="">
                    </div>
                    <!-- /.autor-box-portal -->
                </div> <!-- /.box-content-sidebar -->
            </div> <!-- /.sidebar -->
            <div class="conteudo-portal">
                <div class="header-conteudo-portal">
                    <!-- <h2>Visualizando todos os Posts</h2>-->
                    <h2>Visuzlizando Posts em <span>Esportes</span></h2>
                </div> <!-- /.header-conteudo-portal -->
                <?php
                for ($i = 0; $i < 5; $i++) { ?>
                    <div class="box-single-conteudo">
                        <h2>19/09/2012 - Conheça os leitos</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus nihil sunt sapiente accusantium laborum quos adipisci omnis suscipit! Reiciendis voluptatem expedita molestiae ut iure omnis aut error unde cum saepe.</p>
                        <a href="<?php echo INCLUDE_PATH; ?>noticias/esportes/nome_do_post">Leia mais</a>
                    </div> <!-- /.box-single-conteudo -->
                <?php  } ?>
            </div> <!-- /.conteudo-portal -->
            <div class="paginator">
                <a class="active-page" href="">1</a>
                <a href="">1</a>
                <a href="">1</a>
                <a href="">1</a>
            </div> <!-- /.paginator -->
            <div class="clear"></div> <!-- /.clear -->
        </div> <!-- /.center -->


    </section><!-- /.container-portal -->
<?php } else {
    include('noticia_single.php');
}?>