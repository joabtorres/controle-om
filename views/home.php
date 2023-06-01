<div id="section-container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2>Inicial</h2>
            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-tachometer-alt"></i> Inicial</li>
            </ol>
        </div>
    </div>
    <!--FIM .ROW-->
    <div class="row">
        <div class="col-md-6">
            <section class=" panel panel-black">
                <header class="panel-heading">
                    <i class="fa fa-bolt fa-3x pull-left"></i>
                    <h4 class="panel-title font-bold">Produção</h4>
                    <div>Total de Registros</div>
                </header>
                <article class="panel-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div id="producao-dia" class="h1 font-bold no-margin">01</div>
                            <div class="no-margin h4">Dia</div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div id="producao-semanal" class="h1 font-bold no-margin">01</div>
                            <div class="no-margin h4">Semanal</div>
                        </div>
                    </div>
                </article>
            </section>
            <section class=" panel panel-black">
                <header class="panel-heading">
                    <i class="fa fa-chart-pie fa-3x pull-left"></i>
                    <h4 class="panel-title font-bold">Desvios/hora</h4>
                    <div>Em abertos</div>
                </header>
                <article class="panel-body">
                    <canvas id="grafico_aluno_genero" width="100%"></canvas>
                </article>
            </section>
        </div>
        <div class="col-md-6">
            <section class="panel panel-black">
                <header class="panel-heading">
                    <i class="fa fa-bolt  fa-3x pull-left"></i>
                    <div class="font-bold">Ordem de Manutenção</div>
                    <div>Lista de todas ordem de manutenção em aberto</div>
                </header>
                <article class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <tr>
                            <th width="50px">#</th>
                            <th>Manutenção</th>
                            <th>Status</th>
                            <th width="50px">Ação</th>
                        </tr>
                        <?php
                        if (!empty($alunos)) :
                            $qtd = 1;
                            foreach ($alunos as $index) :
                        ?>
                                <tr>
                                    <td><?php echo $qtd ?></td>
                                    <td><?php echo $index['turma'] . ' - ' . $index['curso'] ?></td>
                                    <td><?php echo $index['qtd'] ?></td>
                                </tr>
                        <?php
                                $qtd++;
                            endforeach;
                        endif;
                        ?>
                    </table>
                </article>
            </section>
        </div>
    </div>
</div>
<!-- /#section-container -->

<script src="<?php echo BASE_URL ?>/assets/js/Chart.min.js"></script>
<script src="<?php echo BASE_URL ?>/assets/js/graficos.js"></script>