<div id="section-container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2> Ordem de Manutenção</h2>
            <ol class="breadcrumb">
                <li><a href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer-alt"></i> Inicial</a></li>
                <li class="active"><i class="fa fa-list-alt"></i> Relatório de Ordem de Manutenção</li>
            </ol>
        </div>
    </div>
    <!--FIM pagina-header-->
    <div class="row">
        <div class="col-md-12 clear">
            <form method="POST" autocomplete="off">
                <section class="panel panel-success">
                    <header class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <h4 class="panel-title"><i class="fa fa-search pull-left"></i> Painel de Busca <i class="fa fa-eye pull-right"></i></h4>
                        </a>
                    </header>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <article class="panel-body">
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for='iCelula'>Célula: </label>
                                    <select id="iCelula" name="nCelula" class="form-control">
                                        <?php
                                        if (isset($celula) && !empty($celula)) {
                                            echo '<option value="" selected="selected">Todas</option>';
                                            foreach ($celula as $index) {
                                                echo "<option value='{$index['celula']}'>{$index['celula']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for='iStatus'>Status: </label>
                                    <select id="iStatus" name="nStatus" class="form-control">
                                        <?php
                                        if (isset($status) && !empty($status)) {
                                            echo '<option value="" selected="selected">Todas</option>';
                                            foreach ($status as $index) {
                                                echo "<option value='{$index['id']}'>{$index['status']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for='iPor'>Por: </label>
                                    <select id="iPor" name="nPor" class="form-control">
                                        <option value="" selected='selected'>Todos</option>
                                        <option value="manuntecao">Número de Ordem de Manutenção </option>
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for='iBuscar'>Buscar: </label>
                                    <input type="text" id="iBuscar" name="nBuscar" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="submit" name="nBuscarBT" value="BuscarBT" class="btn btn-warning"><i class="fa fa-search pull-left"></i> Buscar</button>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>
            </form>
        </div>
    </div>
    <?php
    if (isset($manutencao) && is_array($manutencao)) {
        if ($modo_exebicao == 1) {
    ?>
            <div class="row">
                <!--modelos de resultado-->
                <div class="col-md-12">
                    <section class="panel panel-black">
                        <header class="panel-heading">
                            <h4 class="panel-title">Resultados Encontrados</h4>
                        </header>
                        <article class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="text-right">Total: <?php echo count($manutencao) > 1 ? count($manutencao) . ' registros encontrados' : count($manutencao) . ' registro encontrado' ?>.</h4>
                                </div>
                            </div>
                        </article>
                        <article class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <tr>
                                    <th>#</th>
                                    <th>Número</th>
                                    <th>Celula</th>
                                    <th>Duração</th>
                                    <th>Status</th>
                                    <?php if ($this->checkUser() >= 2) : ?>
                                        <th>Ação</th>
                                    <?php endif; ?>
                                </tr>

                                <?php
                                $qtd = 1;
                                foreach ($manutencao as $indice) :
                                ?>
                                    <tr>
                                        <td width="40px"><?php echo $qtd; ?></td>
                                        <td><?= !empty($indice['manutencao']) ? $indice['manutencao'] : '' ?></td>
                                        <td><?= !empty($indice['celula']) ? $indice['celula'] : '' ?></td>
                                        <td><?= !empty($indice['duracao']) ? $indice['duracao'] : '' ?></td>
                                        <td><?= !empty($indice['status']) ? "<span class='{$indice['class_color']} p-4'>{$indice['status']}</span>" : '' ?></td>
                                        <td width="120px" class=" text-center">
                                            <a class="btn btn-success btn-xs" href="<?php echo BASE_URL . '/manutencao/index/' . $indice['id']; ?>" title="Visualizar"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-primary btn-xs" href="<?php echo BASE_URL . '/editar/manutencao/' . $indice['id']; ?>" title="Editar"><i class="fa fa-pencil-alt"></i></a>
                                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_cooperado_<?php echo $indice['id']; ?>" title="Excluir"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php
                                    ++$qtd;
                                endforeach;
                                ?>
                            </table>
                        </article>
                    </section>
                </div>
                <!--fim modelos de resultado-->
            </div>
        <?php } else { ?>
            <!--modo de exibição em bloco-->
            <?php
            $qtd = 1;
            $row = 1;
            foreach ($manutencao as $indice) :
                echo ($row == 1) ? ' <div class="row">' : '';
            ?>
                <div class="col-md-4">
                    <div class=" thumbnail">
                        <a href="<?php echo BASE_URL . '/aluno/index/' . $indice['id'] ?>">
                            <img src="<?php echo !empty($indice['imagem']) ? BASE_URL . '/' . $indice['imagem'] : BASE_URL . '/assets/imagens/foto_ilustrato3x4.png' ?>" alt="SGL - Usuáio" class="img-responsive img-rounded" />
                        </a>
                        <p class="text-center text-uppercase font-bold"><?php echo !empty($indice['nome']) ? $indice['nome'] : '' ?></p>
                        <p class="text-center">Turma: <?php echo !empty($indice['turma']) ? $indice['turma'] : '' ?> - <?php echo !empty($indice['curso']) ? $indice['curso'] : '' ?></p>
                        <p class="text-center">Idade: <?php echo !empty($indice['nascimento']) ? $this->calcularIdade($indice['nascimento']) : '' ?></p>
                        <div class="caption text-center">
                            <?php if ($this->checkUser() >= 2) { ?>
                                <a href="<?php echo BASE_URL . '/editar/aluno/' . $indice['id'] ?>" class="btn btn-primary btn-block btn-sm" title="Editar"><i class="fa fa-pencil-alt"></i> Editar</a>
                                <?php if ($this->checkUser() >= 3) { ?>
                                    <button type="button" class="btn btn-danger btn-block btn-sm" data-toggle="modal" data-target="#modal_aluno_<?php echo $indice['id']; ?>" title="Excluir"> <i class="fa fa-trash"></i> Excluir</button>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
                echo ($row == 3) ? '</div>' : '';
                if ($row >= 3) {
                    $row = 1;
                } else {
                    $row++;
                }
                ++$qtd;
            endforeach;
            ?>
            <!--fim modo de exibição em bloco-->
    <?php
        }
    } else {
        echo '<div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        Desculpe, não foi possível localizar nenhum registro !
                    </div>
                </div>
            </div>';
    }
    ?>
</div>


<?php
if (isset($manutencao) && is_array($manutencao)) :
    foreach ($manutencao as $indice) :
?>
        <!--MODAL - ESTRUTURA BÁSICA-->
        <section class="modal fade" id="modal_cooperado_<?php echo $indice['id'] ?>" tabindex="-1" role="dialog">
            <article class="modal-dialog modal-md" role="document">
                <section class="modal-content">
                    <header class="modal-header bg-primary">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4>Deseja remover este registro?</h4>
                    </header>
                    <article class="modal-body">
                        <ul class="list-unstyled">
                            <li><b>Número da Ordem de Manutenção: </b> <?php echo !empty($indice['manutencao']) ? str_pad($indice['manutencao'], 3, '0', STR_PAD_LEFT) : '' ?>;</li>
                            <li><b>Stattus: </b> <?= !empty($indice['status']) ? "<span class='{$indice['class_color']} p-4'>{$indice['status']}</span>" : '' ?>;</li>
                            <li><b>Célula:</b> <?php echo !empty($indice['celula']) ? $indice['celula'] : '' ?>;</li>
                            <li><b>Responsável:</b> <?php echo !empty($indice['responsavel']) ? $indice['responsavel'] : '' ?>.</li>
                            <li><b>Duração:</b> <?php echo !empty($indice['duracao']) ? $indice['duracao'] : '' ?>.</li>
                        </ul>
                        <p class="text-justify text-danger"><span class="font-bold">OBS : </span> Se você remove o cooperado, será removido todos os respectivos dados como, por exemplo, endereço, contato e históricos.</p>
                    </article>
                    <footer class="modal-footer">
                        <a class="btn btn-danger pull-left" href="<?php echo BASE_URL . '/excluir/aluno/' . $indice['id'] ?>"> <i class="fa fa-trash"></i> Excluir</a>
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
                    </footer>
                </section>
            </article>
        </section>
<?php
    endforeach;
endif;
?>