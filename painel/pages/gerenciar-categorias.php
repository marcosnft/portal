<?php
if (isset($_GET['excluir'])) {
	$idExcluir = intval($_GET['excluir']);
	Painel::deletar('tb_site.categorias', $idExcluir);
	$noticias = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`tb_site.noticias` WHERE `categoria_id` = ?");
	$noticias->execute(array($idExcluir));
	$noticias = $noticias->fetchAll();
	foreach ($noticias as $key =>$value){
		$imgDelete = $value['capa'];
		Painel::deleteFile($imgDelete);
	}
	$noticias = MySql::conectar()->prepare("DELETE FROM `projeto_01`.`tb_site.noticias` WHERE `categoria_id` = ?");
	$noticias->execute(array($idExcluir));
	Painel::redirect(INCLUDE_PATH_PAINEL . 'gerenciar-categorias');
} else if (isset($_GET['order']) && isset($_GET['id'])) {
	Painel::orderItem(`projeto_01`.'tb_site.categorias', $_GET['order'], $_GET['id']);
}
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; //pega o numero da pagina atual e retorna como a primeira
$porPagina = 4; //quantidade de registros que quer por pagina
$categorias = Painel::selectAll("tb_site.categorias", ($paginaAtual - 1) * $porPagina, $porPagina);

?>
<div class="box-content">
	<h2><i style="margin-right:8px" class="far fa-id-card"></i>Categorias Cadastradas</h2>
	<div class="wraper-table">
		<table>
			<tr>
				<td>Categoria</td>
				
				<td>#</td>
				<td>#</td>
				<td>#</td>
				<td>#</td>
			</tr>
			<?php
			foreach ($categorias as $key => $value) {
			?>
				<tr>
					<td><?php echo $value['nome'] ?></td>
					<td><a class="btn edit" href="<?php INCLUDE_PATH_PAINEL ?> editar-categoria?id=<?php echo $value['id']; ?>"><i class="far fa-edit"></i>Editar</a></td>
					<td><a actionBtn="delete" class="btn delete" href="<?php INCLUDE_PATH_PAINEL ?> gerenciar-categorias?excluir=<?php echo $value['id'] ?>"><i class="fa fa-times"></i>Deletar</a></td>
					<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
					<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
				</tr>
			<?php } ?>
		</table>
	</div> <!-- div wrapper-table-->
	<div class="paginacao">
		<?php
		$totalPaginas = ceil(count(Painel::selectAll(`projeto_01`.'tb_site.categorias')) / $porPagina); //ceil ele arredonda
		//contador para gerar as paginas
		for ($i = 1; $i <= $totalPaginas; $i++) {
			if ($i == $paginaAtual) {
				echo '<a class="page-selected" href="' . INCLUDE_PATH_PAINEL . 'gerenciar-categoriass?pagina=' . $i . '">' . $i . '</a>';
			} else
				echo '<a href="' . INCLUDE_PATH_PAINEL . 'gerenciar-categorias?pagina=' . $i . '">' . $i . '</a>';
		}
		?>
	</div><!-- /div paginacao -->
</div><!-- /.div box-content -->