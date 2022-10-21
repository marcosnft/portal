<?php
if (isset($_GET['excluir'])) {
    $idExcluir = intval($_GET['excluir']);
    $selectImagem = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`tb_site.slides` WHERE id = ?");
    $selectImagem->execute(array($_GET['excluir']));
    $imagem = $selectImagem->fetch()['slide'];
    Painel::deleteFile($imagem);
    Painel::deletar('tb_site.slides', $idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL . 'listar-slides');
} else if (isset($_GET['order']) && isset($_GET['id'])) {
    Painel::orderItem('tb_site.slides', $_GET['order'], $_GET['id']);
}
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; //pega o numero da pagina atual e retorna como a primeira
$porPagina = 4; //quantidade de registros que quer por pagina
$slides = Painel::selectAll("tb_site.slides", ($paginaAtual - 1) * $porPagina, $porPagina);

?>
<div class="box-content">
    <h2><i style="margin-right:8px" class="far fa-id-card"></i>Slides Cadastrados</h2>
    <div class="wraper-table">
        <table>
            <tr>
                <td>Slide</td>
                <td>Imagem</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
            </tr>
            <?php
            foreach ($slides as $key => $value) {
            ?>
                <tr>
                    <td><?php echo $value['nome'] ?></td>
                    <td><img style="width:50px; height:50px;" src="<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $value['slide'];?>" alt=""></td>
                    <td><a class="btn edit" href="<?php INCLUDE_PATH_PAINEL ?> editar-slide?id=<?php echo $value['id']; ?>"><i class="far fa-edit"></i>Editar</a></td>
                    <td><a actionBtn="delete" class="btn delete" href="<?php INCLUDE_PATH_PAINEL ?> listar-slides?excluir=<?php echo $value['id'] ?>"><i class="fa fa-times"></i>Deletar</a></td>
                    <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
                    <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
                </tr>
            <?php } ?>
        </table>
    </div> <!-- div wrapper-table-->
    <div class="paginacao">
        <?php
        $totalPaginas = ceil(count(Painel::selectAll('tb_site.slides')) / $porPagina); //ceil ele arredonda
        //contador para gerar as paginas
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $paginaAtual) {
                echo '<a class="page-selected" href="' . INCLUDE_PATH_PAINEL . 'listar-slides?pagina=' . $i . '">' . $i . '</a>';
            } else
                echo '<a href="' . INCLUDE_PATH_PAINEL . 'listar-slides?pagina=' . $i . '">' . $i . '</a>';
        }
        ?>
    </div><!-- /div paginacao -->
</div><!-- /.div box-content -->