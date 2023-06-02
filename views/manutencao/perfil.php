<div id="section-container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2 class="text-uppercase"><?php echo !empty($manutencao['nome']) ? $manutencao['nome'] : '' ?></h2>
            <ol class="breadcrumb">
                <li><a href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer-alt"></i> Inicial</a></li>
                <li><a href="<?php echo BASE_URL ?>/relatorio/manutencao"><i class="fa fa-list-alt"></i> Relatório de Ordem de Manutenção</a></li>
                <li class="active"><i class="fas fa-cogs"></i> <?php echo !empty($manutencao['id']) ? "Nº: " . str_pad($manutencao['id'], 4, '0', STR_PAD_LEFT) : '' ?></li>
            </ol>
        </div>

        <!--FIM pagina-header-->
        <div class="col-md-12 clear">
            <p class="text-right">
                <a class="btn btn-success btn-xs" href="<?php echo BASE_URL . '/manutencao/pdf/' . $manutencao['id']; ?>" title="Imprimir" target="_blank"><i class="fa fa-print"></i> Imprimir</a>
                <a class="btn btn-primary btn-xs" href="<?php echo BASE_URL . '/editar/manutencao/' . $manutencao['id']; ?>" title="Editar"><i class="fa fa-pencil-alt"></i> Editar</a>
            </p>
        </div>

        <div class="col-md-12">

            <section class="panel panel-black">
                <header class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-cogs"></i> Manutenção</h4>
                </header>
                <article class="panel-body">
                    <!--inicio row-->
                    <div class="row">
                        <div class="col-md-8">
                            <p><span class="text-destaque">Número da Ordem de Manutenção:</span> <?= (!empty($manutencao['manutencao'])) ? $manutencao['manutencao'] : '' ?></p>
                        </div>
                    </div>
                    <!--fim row-->
                    <!--inicio row-->
                    <div class="row">
                        <div class="col-md-3">
                            <p><span class="text-destaque">Stattus:</span> <?= (!empty($manutencao['status'])) ? "<span class='p-2 {$manutencao['class_color']}'>{$manutencao['status']}</span>" : '' ?></p>
                        </div>
                        <div class="col-md-3 ">
                            <p><span class="text-destaque">Célula:</span> <?= (!empty($manutencao['celula'])) ? $manutencao['celula'] : '' ?></p>
                        </div>
                        <div class="col-md-3 ">
                            <p><span class="text-destaque"> Responsável:</span> <?= (!empty($manutencao['responsavel'])) ? $manutencao['responsavel'] : '' ?></p>
                        </div>
                        <div class="col-md-3 ">
                            <p><span class="text-destaque">Duração:</span> <?= (!empty($manutencao['duracao'])) ? $manutencao['duracao'] : '' ?></p>
                        </div>
                    </div>
                    <!--fim row-->
                    <!--inicio row-->
                    <div class="row">
                        <div class="col-md-6">
                            <p><span class="text-destaque">Data de Cadastro:</span> <?= (!empty($manutencao['created_manutencao'])) ? $this->viewDateComplet($manutencao['created_manutencao']) : '' ?></p>
                        </div>
                        <?php if (!empty($manutencao['updated_manutencao'])) : ?>
                            <div class="col-md-6">
                                <p><span class="text-destaque">Data da Alteração:</span> <?= (!empty($manutencao['updated_manutencao'])) ? $this->viewDateComplet($manutencao['updated_manutencao']) : '' ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!--fim row-->
                </article>
            </section>
        </div>

        <div class="col-md-12 clear">
            <section class="panel panel-black">
                <header class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-calendar-alt  pull-left"></i> Desvio</h4>
                </header>
                <article class="panel-body">
                    <span class="pull-right"><a href="<?php echo BASE_URL . '/cadastrar/desvio/' . $manutencao['id'] ?>" class="btn btn-sm btn-warning" title="Adicionar"><i class="fa fa-plus-circle"></i> Adicionar</a></span>
                    <?php
                    if (isset($manutencao['desvio']) && !empty($manutencao['desvio'])) :
                    ?>
                        <br>
                        <br>
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <tr>
                                <th>#</th>
                                <th>Ordem</th>
                                <th>Tipo</th>
                                <th>Duração</th>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Ação</th>
                            </tr>

                            <?php
                            $qtd = 1;
                            foreach ($manutencao['desvio'] as $index) :
                            ?>
                                <tr>
                                    <td width="40px"><?php echo $qtd; ?></td>
                                    <td>
                                        <?= !empty($index['ordem']) ? $index['ordem'] : '' ?>
                                    </td>
                                    <td><?= !empty($index['tipo']) ? $index['tipo'] : '' ?></td>
                                    <td><?= !empty($index['duracao']) ? $index['duracao'] : '' ?></td>
                                    <td>
                                        <?php if (!empty($index['created_desvio'])) : ?>
                                            Cadastro: <?= (!empty($index['created_desvio'])) ? $this->viewDateComplet($index['created_desvio']) : '' ?>
                                        <?php endif; ?>
                                        <?php if (!empty($index['updated_desvio'])) : ?>
                                            <br />
                                            Alteração: <?= (!empty($index['updated_desvio'])) ? $this->viewDateComplet($index['updated_desvio']) : '' ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= !empty($index['descricao']) ? $index['descricao'] : '' ?></td>
                                    <td width="120px" class=" text-center">
                                        <a class="btn btn-primary btn-xs" href="<?php echo BASE_URL . '/editar/manutencao/' . $index['id']; ?>" title="Editar"><i class="fa fa-pencil-alt"></i></a>
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_desvio_<?php echo $index['id']; ?>" title="Excluir"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php
                                ++$qtd;
                            endforeach;
                            ?>
                        </table>
                    <?php
                    endif;
                    ?>
                </article>
            </section>
        </div>
    </div>
</div>


<?php
if (isset($manutencao['avaliacao_fisica']) && !empty($manutencao['avaliacao_fisica'])) :
    foreach ($manutencao['avaliacao_fisica'] as $index) :
?>
        <!--MODAL - ESTRUTURA BÁSICA-->
        <section class="modal fade" id="modal_desvio_<?php echo $index['id'] ?>" tabindex="-1" role="dialog">
            <article class="modal-dialog modal-md" role="document">
                <section class="modal-content">
                    <header class="modal-header bg-primary">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4>Deseja remover este registro?</h4>
                    </header>
                    <article class="modal-body">
                        <ul class="list-unstyled">
                            <li><b>Código: </b> <?php echo !empty($index['id']) ? $index['id'] : '' ?>;</li>
                            <li><b>Data: <?php echo !empty($index['data']) ? $this->formatDateView($index['data']) : '' ?>;</li>
                        </ul>
                        <p class="text-justify text-danger"><span class="font-bold">OBS : </span> Se você remove este registro, o mesmo deixará de existir no sistema.</p>
                    </article>
                    <footer class="modal-footer">
                        <a class="btn btn-danger pull-left" href="<?php echo BASE_URL . '/excluir/avaliacao_fisica/' . $index['id_manutencao'] . '/' . $index['id'] ?>"> <i class="fa fa-trash"></i> Excluir</a>
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
                    </footer>
                </section>
            </article>
        </section>
<?php
    endforeach;
endif;
?>