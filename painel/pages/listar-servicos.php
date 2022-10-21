<?php
if (isset($_GET['excluir'])) {
    $idExcluir = intval($_GET['excluir']);
    Painel::deletar('tb_site.servicos', $idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL . 'listar-servicos');
} else if (isset($_GET['order']) && isset($_GET['id'])) {
    Painel::orderItem('tb_site.servicos', $_GET['order'], $_GET['id']);
}
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; //pega o numero da pagina atual e retorna como a primeira
$porPagina = 4; //quantidade de registros que quer por pagina
$servicos = Painel::selectAll("tb_site.servicos", ($paginaAtual - 1) * $porPagina, $porPagina);

?>
<div class="box-content">
    <h2><i style="margin-right:8px" class="far fa-id-card"></i>Serviços Cadastrados</h2>
    <div class="wraper-table">
        <table>
            <tr>
                <td>Serviço</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
            </tr>
            <?php
            foreach ($servicos as $key => $value) {
            ?>
                <tr>
                    <td><?php echo $value['servico'] ?></td>
                    <td><a class="btn edit" href="<?php INCLUDE_PATH_PAINEL ?> editar-servico?id=<?php echo $value['id']; ?>"><i class="far fa-edit"></i>Editar</a></td>
                    <td><a actionBtn="delete" class="btn delete" href="<?php INCLUDE_PATH_PAINEL ?> listar-servicos?excluir=<?php echo $value['id'] ?>"><i class="fa fa-times"></i>Deletar</a></td>
                    <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
                    <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
                </tr>
            <?php } ?>
        </table>
    </div> <!-- div wrapper-table-->
    <div class="paginacao">
        <?php
        $totalPaginas = ceil(count(Painel::selectAll('tb_site.servicos')) / $porPagina); //ceil ele arredonda
        //contador para gerar as paginas
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $paginaAtual) {
                echo '<a class="page-selected" href="' . INCLUDE_PATH_PAINEL . 'listar-servicos?pagina=' . $i . '">' . $i . '</a>';
            } else
                echo '<a href="' . INCLUDE_PATH_PAINEL . 'listar-servicos?pagina=' . $i . '">' . $i . '</a>';
        }
        ?>
    </div><!-- /div paginacao -->
</div><!-- /.div box-content -->