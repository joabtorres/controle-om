<div id="section-container">
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2>Editar Avaliação Física</h2>
            <ol class="breadcrumb">
                <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer-alt"></i> Inicial</a></li>
                <li><a  href="<?php echo BASE_URL ?>/relatorio/aluno"><i class="fa fa-list-alt"></i> Aluno</a></li>
                <li><a href="<?php echo BASE_URL ?>/aluno/index/<?php echo!empty($aluno['cod']) ? $aluno['cod'] : '' ?>"><i class="fa fa-user"></i> <?php echo!empty($aluno['nome']) ? $aluno['nome'] : '' ?></a></li>
                <li class="active"><i class="fa fa-edit"></i> Editar Avaliação Física</li>
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
                <section class="panel panel-black">
                    <header class="panel-heading">
                        <h4 class="panel-title"><i class="fa fa-edit"></i> Avaliação Física</h4>
                    </header>
                    <article class="panel-body">
                        <div class="row">
                            <input type="hidden" name="nCodAluno" value="<?php echo!empty($formCad['cod_aluno']) ? $formCad['cod_aluno'] : $aluno['cod']; ?>"/>
                            <input type="hidden" name="nCodAvaliacao" value="<?php echo!empty($formCad['cod']) ? $formCad['cod'] : null; ?>"/>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <img src="<?php echo!empty($aluno['imagem']) ? BASE_URL . '/' . $aluno['imagem'] : BASE_URL . '/assets/imagens/foto_ilustrato3x4.png' ?>" class="img-responsive img-rounded img-center"/>
                                        <p class="text-center"><?php echo!empty($aluno['nome']) ? $aluno['nome'] : '' ?></p>
                                    </div>

                                    <div class="col-md-12 form-group <?php echo (isset($formCad_error['data']['class'])) ? $formCad_error['data']['class'] : ''; ?>">
                                        <label for='iDescricao' class="control-label">Data: * <?php echo (isset($formCad_error['data']['msg'])) ? '<small><span class = "glyphicon glyphicon-remove"></span> ' . $formCad_error['data']['msg'] . ' </small>' : ''; ?></label>
                                        <input type="text" id="iDescricao" name="nData" class="form-control date_serach input-data" value="<?php echo!empty($formCad['data']) ? $this->formatDateView($formCad['data']) : '' ?>"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12 form-group <?php echo (isset($formCad_error['peso']['class'])) ? $formCad_error['peso']['class'] : ''; ?>">
                                        <label for='ipeso' class="control-label">Peso: *  <?php echo (isset($formCad_error['peso']['msg'])) ? '<small><span class = "glyphicon glyphicon-remove"></span> ' . $formCad_error['peso']['msg'] . ' </small>' : ''; ?></label>
                                        <input type="text" id="ipeso" name="npeso" class="form-control input_peso_kg" placeholder="Exemplo: 100.50 kg" value="<?php echo!empty($formCad['peso']) ? $formCad['peso'] : '' ?>"/>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for='iabdomen'>Abdômen: </label>
                                        <input type="text" id="iabdomen" name="nabdomen" class="form-control input_medicao_cm" placeholder="Exemplo: 100 cm" value="<?php echo!empty($formCad['abdomen']) ? $formCad['abdomen'] : '' ?>"/>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for='iquadril'>Quadril: </label>
                                        <input type="text" id="iquadril" name="nquadril" class="form-control input_medicao_cm" placeholder="Exemplo: 80 cm" value="<?php echo!empty($formCad['quadril']) ? $formCad['quadril'] : '' ?>"/>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for='icintura'>Cintura: </label>
                                        <input type="text" id="icintura" name="ncintura" class="form-control input_medicao_cm" placeholder="Exemplo: 80 cm" value="<?php echo!empty($formCad['cintura']) ? $formCad['cintura'] : '' ?>"/>
                                    </div>
                                    <div class="col-md-12 form-group <?php echo (isset($formCad_error['femu']['class'])) ? $formCad_error['femu']['class'] : ''; ?>">
                                        <label for='icintura' class="control-label">Diametro do fêmur:* <?php echo (isset($formCad_error['femu']['msg'])) ? '<small><span class = "glyphicon glyphicon-remove"></span> ' . $formCad_error['femu']['msg'] . ' </small>' : ''; ?></label>
                                        <input type="text" id="icintura" name="nfemu" class="form-control input_medicao_cm" placeholder="Exemplo: 20 cm" value="<?php echo!empty($formCad['femu']) ? $formCad['femu'] : '' ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for='ibraco_direito'>Braço direito: </label>
                                        <input type="text" id="ibraco_direito" name="nbraco_direito" class="form-control input_medicao_cm" placeholder="Exemplo: 30 cm" value="<?php echo!empty($formCad['braco_direito']) ? $formCad['braco_direito'] : '' ?>"/>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for='ibraco_esquerdo'>Braço esquerdo: </label>
                                        <input type="text" id="ibraco_esquerdo" name="nbraco_esquerdo" class="form-control input_medicao_cm" placeholder="Exemplo: 30 cm" value="<?php echo!empty($formCad['braco_esquerdo']) ? $formCad['braco_esquerdo'] : '' ?>"/>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for='iantebraco_direito'>Antebraço direito: </label>
                                        <input type="text" id="iantebraco_direito" name="nantebraco_direito" class="form-control input_medicao_cm" placeholder="Exemplo: 10 cm" value="<?php echo!empty($formCad['antebraco_direito']) ? $formCad['antebraco_direito'] : '' ?>"/>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for='iantebraco_esquerdo'>Antebraço esquerdo: </label>
                                        <input type="text" id="iantebraco_esquerdo" name="nantebraco_esquerdo" class="form-control input_medicao_cm" placeholder="Exemplo: 10 cm" value="<?php echo!empty($formCad['antebraco_esquerdo']) ? $formCad['antebraco_esquerdo'] : '' ?>"/>
                                    </div>
                                    <div class="col-md-12 form-group <?php echo (isset($formCad_error['punho']['class'])) ? $formCad_error['punho']['class'] : ''; ?>">
                                        <label for='ipunho' class="control-label">Diametro do punho:* <?php echo (isset($formCad_error['punho']['msg'])) ? '<small><span class = "glyphicon glyphicon-remove"></span> ' . $formCad_error['punho']['msg'] . ' </small>' : ''; ?></label>
                                        <input type="text" id="ipunho" name="npunho" class="form-control input_medicao_cm" placeholder="Exemplo: 5 cm" value="<?php echo!empty($formCad['punho']) ? $formCad['punho'] : '' ?>"/>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">

                                    <div class="col-md-12 form-group">
                                        <label for='icoxa_direita' >Coxa direita: </label>
                                        <input type="text" id="icoxa_direita" name="ncoxa_direita" class="form-control input_medicao_cm" placeholder="Exemplo: 50 cm" value="<?php echo!empty($formCad['coxa_direita']) ? $formCad['coxa_direita'] : '' ?>"/>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for='icoxa_esqueda'>Coxa esqueda: </label>
                                        <input type="text" id="icoxa_esqueda" name="ncoxa_esqueda" class="form-control input_medicao_cm" placeholder="Exemplo: 50 cm" value="<?php echo!empty($formCad['coxa_esqueda']) ? $formCad['coxa_esqueda'] : '' ?>"/>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for='ipanturrilha_direita'>Panturrilha direita: </label>
                                        <input type="text" id="ipanturrilha_direita" name="npanturrilha_direita" class="form-control input_medicao_cm" placeholder="Exemplo: 30 cm" value="<?php echo!empty($formCad['panturrilha_direita']) ? $formCad['panturrilha_direita'] : '' ?>"/>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for='ipanturrilha_esquerda'>Panturrilha esquerda: </label>
                                        <input type="text" id="ipanturrilha_esquerda" name="npanturrilha_esquerda" class="form-control input_medicao_cm" placeholder="Exemplo: 30 cm" value="<?php echo!empty($formCad['panturrilha_esquerda']) ? $formCad['panturrilha_esquerda'] : '' ?>"/>
                                    </div>                                    

                                </div>
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