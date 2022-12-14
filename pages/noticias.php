<?php
$url = explode('/', $_GET['url']);
if (!isset($url[2])) {
    $categoria = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`tb_site.categorias` WHERE slug=?");
    $categoria->execute(array(@$url[1]));
    $categoria = $categoria->fetch();

?>


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
                        <input type="text" name="parametro" placeholder="O que deseja procurar?">
                        <input type="submit" name="busca" value="Pesquisar!">
                    </form>
                </div> <!-- /.box-content-sidebar -->
                <div class="box-content-sidebar">
                    <h3> <i class="fa fa-list-ul"></i> Selecione a Categoria:</h3>
                    <form action="" method="post">

                        <select name="categoria" id="">
                            <option value="" selected="">Todas as Categorias </option>
                            <?php
                            $categorias = MySql::conectar()->prepare('SELECT * FROM `projeto_01`.`tb_site.categorias` ORDER BY id ASC');
                            $categorias->execute();
                            $categorias = $categorias->fetchAll();
                            foreach ($categorias as $key => $value) { ?>


                                <option <?php if ($value['slug'] == @$url[1]) echo 'selected'; ?> value="<?php echo $value['slug']; ?>">
                                    <?php echo $value['nome']; ?></option>
                            <?php } ?>

                        </select>
                    </form>
                </div> <!-- /.box-content-sidebar -->
                <div class="box-content-sidebar">
                    <h3> <i class="fa fa-user"></i> Conheça o Autor:</h3>
                    <div class="autor-box-portal">
                        <div class="box-img-autor">

                        </div> <!-- /.box-img-autor -->
                        <div class="texto-autor-portal text-center">
                            <?php
                            $autor = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`tb_site.config`");
                            $autor->execute();
                            $autor = $autor->fetch();
                            ?>
                            <h3><?php echo $autor['nome_autor']; ?></h3>
                            <p><?php echo $autor['descricao']; ?></p>
                        </div> <!-- /.texto-autor-portal -->
                        <img src="" alt="">
                    </div>
                    <!-- /.autor-box-portal -->
                </div> <!-- /.box-content-sidebar -->
            </div> <!-- /.sidebar -->
            <div class="conteudo-portal">
                <div class="header-conteudo-portal">
                    <?php

                    $porPagina = 10;
                    if (!isset($_POST['parametro'])) {
                        if (@$categoria['nome'] == '') {
                            echo '<h2>Visuzlizando todos os Posts</h2>';
                        } else {
                            echo '<h2>Visuzlizando Posts em ' . '<span>' . $categoria['nome'] . '</span></h2>';
                        }
                    } else {
                        echo '<h2> <i class ="fa fa-check"> </i> Busca realizada com sucesso</h2>';
                    }

                    $query = "SELECT * FROM `projeto_01`.`tb_site.noticias` ";
                    if (@$categoria['nome'] != '') {
                        $categoria['id'] = (int)$categoria['id'];
                        $query .= "WHERE categoria_id = $categoria[id]";
                    }
                    if (isset($_POST['parametro'])) {
                        if (strstr($query, 'WHERE') !== false) {

                            $busca = $_POST['parametro'];

                            $query .= " AND  titulo LIKE '%$busca%'";
                        } else {
                            $busca = $_POST['parametro'];
                            $query .= " WHERE  titulo LIKE '%$busca%'";
                        }
                    }
                    $query2 = "SELECT * FROM `projeto_01`.`tb_site.noticias`";
                    if (@$categoria['nome'] != '') {
                        $categoria['id'] = (int)$categoria['id'];
                        $query2 .= "WHERE categoria_id = $categoria[id]";
                    }
                    if (isset($_POST['parametro'])) {
                        if (strstr($query2, 'WHERE') !== false) {
                            $busca = $_POST['parametro'];
                            $query2 .= " AND  titulo LIKE '%$busca%'";
                        } else {
                            $busca = $_POST['parametro'];
                            $query2 .= " WHERE  titulo LIKE '%$busca%'";
                        }
                    }
                    $totalPaginas = MySql::conectar()->prepare($query);
                    $totalPaginas->execute();
                    $totalPaginas = ceil($totalPaginas->rowCount() / $porPagina);
                    if (!isset($_POST['parametro'])) {
                        if (isset($_GET['pagina'])) {
                            $pagina = (int)$_GET['pagina'];
                            if ($pagina > $totalPaginas)
                                $pagina = 1;
                            $queryPg = ($pagina - 1) * $porPagina;
                            $query .= " ORDER BY `order_id` ASC LIMIT $pagina,$porPagina";
                        } else {
                            $pagina = 1;
                            $query .= " ORDER BY `order_id` ASC LIMIT 0,$porPagina";
                        }
                    } else {
                        $query .= " ORDER BY `order_id` ASC";
                    }
                    $sql = MySql::conectar()->prepare($query);
                    $sql->execute();
                    $noticias = $sql->fetchAll();
                    ?>

                </div> <!-- /.header-conteudo-portal -->
                <?php
                foreach ($noticias as $key => $value) {
                    $sql = MySql::conectar()->prepare("SELECT `slug` FROM `projeto_01`.`tb_site.categorias` WHERE id=?");
                    $sql->execute(array($value['categoria_id']));
                    $categoriaNome = $sql->fetch()['slug'];

                ?>
                    <div class="box-single-conteudo">
                        <h2><?php echo date('d/m/Y', strtotime($value['data']))  . " - " . $value['titulo']; ?></h2>
                        <p> <?php echo substr(strip_tags($value['conteudo']), 0, 400) . ' ...'; ?></p>
                        <a href="<?php echo INCLUDE_PATH; ?>noticias/<?php echo $categoriaNome; ?>/<?php echo $value['slug']; ?>">Leia mais</a>
                    </div> <!-- /.box-single-conteudo -->
                <?php  } ?>
            </div> <!-- /.conteudo-portal -->

            <?php




            ?>
            <div class="paginator">
                <?php
                if (!isset($_POST['parametro'])) {
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        @$catStr = ($categoria['nome'] != '') ?  '/' . $categoria['slug'] : '';
                        if ($pagina == $i) {
                            echo '<a class="active-page" href="' . INCLUDE_PATH . 'noticias' . $catStr . '?pagina=' . $i . '">' . $i . '</a>';
                        } else {
                            echo '<a href="' . INCLUDE_PATH . 'noticias' . $catStr . '?pagina=' . $i . '">' . $i . '</a>';
                        }
                    }
                }
                ?>


            </div> <!-- /.paginator -->
            <div class="clear"></div> <!-- /.clear -->
        </div> <!-- /.center -->


    </section><!-- /.container-portal -->
<?php } else {
    include('noticia_single.php');
} ?>