<div id="section-container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2>Cadastrar Desvio</h2>
            <ol class="breadcrumb">
                <li><a href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer-alt"></i> Inicial</a></li>
                <li><a href="<?php echo BASE_URL ?>/relatorio/manutencao"><i class="fa fa-list-alt"></i> Relatório de Ordem de Manutenção</a></li>
                <li><a href="<?php echo BASE_URL ?>/manutencao/index/<?php echo !empty($manutencao['id']) ? $manutencao['id'] : '' ?>"><i class="fas fa-cogs"></i> <?php echo !empty($manutencao['id']) ? "Nº: " . str_pad($manutencao['id'], 4, '0', STR_PAD_LEFT) : '' ?></a></li>
                <li class="active"><i class="fa fa-plus-square"></i> Cadastrar Desvio</li>
            </ol>
        </div>
    </div>
    <!--FIM pagina-header-->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="alert <?php echo (isset($erro['class'])) ? $erro['class'] : 'alert-warning'; ?> " role="alert" id="alert-msg">
                <button class="close" data-hide="alert">&times;</button>
                <div id="resposta"><?php echo (isset($erro['msg'])) ? $erro['msg'] : '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha os campos corretamente.'; ?></div>
            </div>
        </div>
        <div class="col-md-12 clear">
            <form autocomplete="off" method="POST" id="myFormFinanca">
                <input name="nId" type="hidden" value="<?= (!empty($manutencao['id'])) ? $manutencao['id'] : '' ?>">
                <section class="panel panel-black">
                    <header class="panel-heading">
                        <h4 class="panel-title"><i class="fa fa-plus-square pull-left"></i>Desvio</h4>
                    </header>
                    <article class="panel-body">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="iNumero" class="control-label">Número da Ordem de Manutenção:* </label>
                                <input type="text" id="iNumero" name="nNumero" placeholder="Exemplo: João da Silva Alves" class="form-control" value="<?php echo (!empty($manutencao['manutencao'])) ? $manutencao['manutencao'] : ''; ?>" disabled='disabled' />
                            </div>
                            <div class="col-md-12 form-group">
                                <?php
                                if (!empty($formCad['ordem'])) {
                                    $arrayType = ['Início do desvio', 'Fim do desvio'];
                                    for ($i = 0; $i < count($arrayType); $i++) {
                                        if (!empty($formCad['ordem']) && $formCad['ordem'] == $arrayType[$i]) {
                                            echo "<label><input type='radio' name='nOrdem' value='{$arrayType[$i]}' checked/> {$arrayType[$i]}</label>";
                                        } else {
                                            echo "<label><input type='radio' name='nOrdem' value='{$arrayType[$i]}'/> {$arrayType[$i]}</label>";
                                        }
                                    }
                                } else {
                                    echo '<label><input type="radio" name="nOrdem" value="Início do desvio" checked/> Início do desvio</label> ';
                                    echo '<label><input type="radio" name="nOrdem" value="Fim do desvio"/> Fim do desvio</label>';
                                }
                                ?>
                            </div>
                            <div class="col-md-6 form-group <?php echo (isset($formCad_error['tipo']['class'])) ? $formCad_error['tipo']['class'] : ''; ?>">
                                <label for="iTipo" class="control-label">Tipo de Desvio:* <?php echo (isset($formCad_error['tipo']['msg'])) ? '<small><span class = "glyphicon glyphicon-remove"></span> ' . $formCad_error['tipo']['msg'] . ' </small>' : ''; ?></label><br />
                                <select id="iTipo" name="nTipo" class="form-control">
                                    <?php
                                    foreach ($tipo as $index) {
                                        if (isset($formCad['tipo']) && $index['tipo'] == $formCad['tipo']) {
                                            echo "<option value='{$index['tipo']}' selected='selected'>{$index['tipo']}</option>";
                                        } else {
                                            echo "<option value='{$index['tipo']}'>{$index['tipo']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group <?php echo (isset($formCad_error['duracao']['class'])) ? $formCad_error['duracao']['class'] : ''; ?>">
                                <label for="iDuiracao" class="control-label">Duração:* <?php echo (isset($formCad_error['duracao']['msg'])) ? '<small><span class = "glyphicon glyphicon-remove"></span> ' . $formCad_error['duracao']['msg'] . ' </small>' : ''; ?></label>
                                <input type="text" id="iDuiracao" name="nDuracao" placeholder="Exemplo: 01:00:00" class="form-control input-hora" value="<?php echo (!empty($formCad['duracao'])) ? $formCad['duracao'] : ''; ?>" />
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="iDesricao" class="control-label">Descrição: </label>
                                <textarea id="iDesricao" name="nDescricao" class="form-control"><?php echo (!empty($formCad['descricao'])) ? $formCad['descricao'] : ''; ?></textarea>
                            </div>
                        </div>
                    </article>
                </section>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <button type="submit" class="btn btn-success" name="nSalvar" value="Salvar"><i class="fa fa-check-circle" aria-hidden="true"></i> Salvar</button>
                        <a href="<?php echo BASE_URL ?>/home" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>