<div id="section-container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2>Cadastrar Manutenção</h2>
            <ol class="breadcrumb">
                <li><a href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer-alt"></i> Inicial</a></li>
                <li class="active"><i class="fa fa-plus-square"></i> Cadastrar Manutenção</li>
            </ol>
        </div>
    </div>
    <!--FIM pagina-header-->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="alert <?php echo (isset($erro['class'])) ? $erro['class'] : 'alert-warning'; ?> " role="alert" id="alert-msg">
                <button class="close" data-hide="alert">&times;</button>
                <div id="resposta"><?php echo (isset($erro['msg'])) ? $erro['msg'] : '<i class="fa fa-info-circle" aria-hidden="true"></i> Recomenda-se que todos os campos sejam preenchidos corretamente.'; ?></div>
            </div>
        </div>
        <div class="col-md-12 clear">
            <form method="POST" enctype="multipart/form-data" autocomplete="off" id="formAluno">
                <input name="nId" type="hidden" value="<?= (!empty($formCad['id'])) ? $formCad['id'] : '' ?>">
                <!-- comment -->
                <section class="panel panel-black">
                    <header class="panel-heading">
                        <h4 class="panel-title"> <i class="fa fa-cogs pull-left"></i> Manutenção</h4>
                    </header>
                    <article class="panel-body">
                        <div class="row">
                            <div class="col-md-8 form-group <?php echo (isset($formCad_error['ordem_manutencao']['class'])) ? $formCad_error['ordem_manutencao']['class'] : ''; ?>">
                                <label for="iNumero" class="control-label">Número da Ordem de Manutenção:* <?php echo (isset($formCad_error['ordem_manutencao']['msg'])) ? '<small><span class = "glyphicon glyphicon-remove"></span> ' . $formCad_error['ordem_manutencao']['msg'] . ' </small>' : ''; ?></label>
                                <input type="text" id="iNumero" name="nNumero" placeholder="Exemplo: João da Silva Alves" class="form-control" value="<?php echo (!empty($formCad['manutencao'])) ? $formCad['manutencao'] : ''; ?>" />
                            </div>
                            <div class="col-md-4 form-group <?php echo (isset($formCad_error['status']['class'])) ? $formCad_error['status']['class'] : ''; ?>">
                                <label for="iStatus" class="control-label">Status:* <?php echo (isset($formCad_error['status']['msg'])) ? '<small><span class = "glyphicon glyphicon-remove"></span> ' . $formCad_error['status']['msg'] . ' </small>' : ''; ?></label><br />
                                <select id="iStatus" name="nStatus" class="form-control">
                                    <?php
                                    foreach ($status as $index) {
                                        if (isset($formCad['status_id']) && $index['id'] == $formCad['status_id']) {
                                            echo "<option value='{$index['id']}' selected='selected'>{$index['status']}</option>";
                                        } else {
                                            echo "<option value='{$index['id']}'>{$index['status']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group <?php echo (isset($formCad_error['celula']['class'])) ? $formCad_error['celula']['class'] : ''; ?>">
                                <label for="iCelula" class="control-label">Célula:* <?php echo (isset($formCad_error['celula']['msg'])) ? '<small><span class = "glyphicon glyphicon-remove"></span> ' . $formCad_error['celula']['msg'] . ' </small>' : ''; ?></label><br />
                                <select id="iCelula" name="nCelula" class="form-control">
                                    <?php
                                    foreach ($celula as $index) {
                                        if (isset($formCad['celula']) && $index['celula'] == $formCad['celula']) {
                                            echo "<option value='{$index['celula']}' selected='selected'>{$index['celula']}</option>";
                                        } else {
                                            echo "<option value='{$index['celula']}'>{$index['celula']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4 form-group <?php echo (isset($formCad_error['responsavel']['class'])) ? $formCad_error['responsavel']['class'] : ''; ?>">
                                <label for="iResponsavel" class="control-label">Responsável:* <?php echo (isset($formCad_error['responsavel']['msg'])) ? '<small><span class = "glyphicon glyphicon-remove"></span> ' . $formCad_error['responsavel']['msg'] . ' </small>' : ''; ?></label>
                                <input type="text" id="iResponsavel" name="nResponsavel" placeholder="Exemplo: João da Silva Alves" class="form-control" value="<?php echo (!empty($formCad['responsavel'])) ? $formCad['responsavel'] : ''; ?>" />
                            </div>
                            <div class="col-md-4 form-group <?php echo (isset($formCad_error['duracao']['class'])) ? $formCad_error['duracao']['class'] : ''; ?>">
                                <label for="iDuiracao" class="control-label">Duração:* <?php echo (isset($formCad_error['duracao']['msg'])) ? '<small><span class = "glyphicon glyphicon-remove"></span> ' . $formCad_error['duracao']['msg'] . ' </small>' : ''; ?></label>
                                <input type="text" id="iDuiracao" name="nDuracao" placeholder="Exemplo: 01:00:00" class="form-control input-hora" value="<?php echo (!empty($formCad['duracao'])) ? $formCad['duracao'] : ''; ?>" />
                            </div>
                        </div>
                    </article>
                </section> <!-- fim panel Cooperado-->

                <div class="row">
                    <div class="form-group col-xs-12">
                        <button type="submit" class="btn btn-success" name="nSalvar" value="Salvar"><i class="fa fa-check-circle" aria-hidden="true"></i> Salvar</button>
                        <a href="<?php echo BASE_URL ?>/home" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--fim row-->
</div>