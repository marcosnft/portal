<?php 
$usuariosOnline = Painel::listarUsuariosOnline(); 
$visitasUnicas = Site::contador();
$visitasHoje = Site::contadorHoje();
?>
<div class="box-content w100 left">
    <h2> <i class="fa fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA; ?></h2>
    <div class="box-metricas">
        <div class="box-metricas-single">
            <div class="box-metricas-wrapper">
                <h2> Usuários Online</h2>
                <p> <?php echo count($usuariosOnline) ?> </p>
            </div> <!-- /.box-metricas-wrapper -->
        </div><!-- /.box-metricas-single -->
        <div class="box-metricas-single">
            <div class="box-metricas-wrapper">
                <h2> Total de Visitas Únicas</h2>
                <p> <?php echo $visitasUnicas;?> </p>
            </div> <!-- /.box-metricas-wrapper -->
        </div><!-- /.box-metricas-single -->
        <div class="box-metricas-single">
            <div class="box-metricas-wrapper">
                <h2> Visitas Hoje</h2>
                <p>  <?php echo $visitasHoje; ?></p>
            </div> <!-- /.box-metricas-wrapper -->
        </div><!-- /.box-metricas-single -->


    </div> <!-- div box metricas-->
</div> <!-- div box-content-->
<div class="box-content w50 left">
    <h2><i class="fa fa-rocket" aria-hidden="true"></i>Usuários Online no Site</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>IP </span>
            </div><!-- /.div col-->
            <div class="col">
                <span>Última Ação </span>
            </div><!-- /.div col-->
            <div class="clear"></div> <!-- /.clear -->
        </div><!-- /.div row-->
        <?php
        foreach($usuariosOnline as $key =>$value){

         ?>
        <div class="row">
            <div class="col">
                <span><?php echo $value['ip'] ?> </span>
            </div><!-- /.div col-->
            <div class="col">
                <span><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao'])) //strtotime converte o formato de data?></span>
            </div><!-- /.div col-->
            <div class="clear"></div> <!-- /.clear -->
        </div><!-- /.div row-->
        <?php 
        } ?>
    </div><!-- /.div table-responsivo -->

</div><!-- div box-w100 left usuarios online-->

<div class="box-content w50 right">
    <h2><i class="fa fa-rocket" aria-hidden="true"></i>Usuários do Painel</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>Nome </span>
            </div><!-- /.div col-->
            <div class="col">
                <span>Cargo </span>
            </div><!-- /.div col-->
            <div class="clear"></div> <!-- /.clear -->
        </div><!-- /.div row-->
        <?php
        $usuariosPainel = MySql::conectar()->prepare("SELECT * FROM `projeto_01`.`tb_admin.usuarios`");
        $usuariosPainel->execute();
        $usuariosPainel = $usuariosPainel->fetchAll();
        foreach($usuariosPainel as $key =>$value){

         ?>
        <div class="row">
            <div class="col">
                <span><?php echo $value['user'] ?> </span>
            </div><!-- /.div col-->
            <div class="col">
                <span><?php echo pegaCargo($value['cargo']);?></span>
            </div><!-- /.div col-->
            <div class="clear"></div> <!-- /.clear -->
        </div><!-- /.div row-->
        <?php 
        } ?>
    </div><!-- /.div table-responsivo -->

</div><!-- div box-w100 left usuarios online-->

<div class="clear"></div> <!-- div class clear-->