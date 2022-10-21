<?php 
if (isset($_GET['excluir'])){
    $idExcluir = intval($_GET['excluir']);
    Painel::deletar('tb_site.depoimentos',$idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL.'listar-depoimentos');
}
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; //pega o numero da pagina a tual e retorna como a primeira
$porPagina = 2; //quantidade de registros que quer por pagina
$depoimentos = Painel::selectAll("tb_site.depoimentos",($paginaAtual - 1) *$porPagina,$porPagina);

 ?>
<div class="box-content">
    <h2><i style="margin-right:8px" class="far fa-id-card"></i>Depoimentos Cadastrados</h2>
<div class="wraper-table">
    <table >
        <tr>
            <td>Nome</td>
            <td>Data</td>
            <td>#</td>
            <td>#</td>
        </tr>
<?php
        foreach ($depoimentos as $key => $value){     
        ?>
        <tr>
            <td><?php echo $value['nome']?></td>
            <td><?php echo $value['data'] ?></td>
            <td><a class="btn edit" href=""><i class="far fa-edit"></i>Editar</a></td>
            <td><a actionBtn="delete" class="btn delete" href="<?php INCLUDE_PATH_PAINEL ?> listar-depoimentos?excluir=<?php echo $value['id']?>"><i class="fa fa-times"></i>Deletar</a></td>
        </tr>
        <?php }?>
        </table>
        </div> <!-- div wrapper-table-->
<div class="paginacao">
   <?php
   $totalPaginas = ceil(count(Painel::selectAll('tb_site.depoimentos')) / $porPagina); //ceil ele arredonda
//contador para gerar as paginas
   for($i = 1;$i <=$totalPaginas; $i++){
    if($i == $paginaAtual){
        echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-depoimentos?pagina='.$i.'">'.$i.'</a>';
    } else
    echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-depoimentos?pagina='.$i.'">'.$i.'</a>';
    
}
   ?>
</div><!-- /div paginacao -->
</div><!-- /.div box-content -->