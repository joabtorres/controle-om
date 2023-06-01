<div id="section-container">
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2 class="text-uppercase"><?php echo!empty($aluno['aluno']['nome']) ? $aluno['aluno']['nome'] : '' ?></h2>
            <ol class="breadcrumb">
                <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer-alt"></i> Inicial</a></li>
                <li><a  href="<?php echo BASE_URL ?>/relatorio/aluno"><i class="fa fa-list-alt"></i> Alunos</a></li>
                <li class="active text-uppercase"><i class="fa fa-user"></i> <?php echo!empty($aluno['aluno']['nome']) ? $aluno['aluno']['nome'] : '' ?></li>
            </ol>
        </div>

        <!--FIM pagina-header-->
        <div class="col-md-12 clear">
            <p class="text-right">
                <a class="btn btn-success btn-xs" href="<?php echo BASE_URL . '/aluno/pdf/' . $aluno['aluno']['cod']; ?>" title="Imprimir" target="_blank"><i class="fa fa-print"></i> Imprimir</a> 
                <a class="btn btn-primary btn-xs" href="<?php echo BASE_URL . '/editar/aluno/' . $aluno['aluno']['cod']; ?>" title="Editar"><i class="fa fa-pencil-alt"></i> Editar</a> 
            </p>
        </div>

        <div class="col-md-12">

            <section class="panel panel-black">
                <header class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-user pull-left"></i> Dados Pessoais</h4>
                </header>
                <article class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="<?php echo!empty($aluno['aluno']['imagem']) ? BASE_URL . '/' . $aluno['aluno']['imagem'] : BASE_URL . '/assets/imagens/foto_ilustrato3x4.png' ?>" class="img-responsive img-rounded img-center"/>
                        </div>
                        <div class="col-md-10">
                            <!--inicio row-->
                            <div class="row">
                                <div class="col-md-4">
                                    <p><span class="text-destaque">Nome:</span> <?php echo!empty($aluno['aluno']['nome']) ? $aluno['aluno']['nome'] : '' ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><span class="text-destaque">Turma:</span> <?php echo!empty($aluno['aluno']['turma']) ? $aluno['aluno']['turma'] . ' - Curso: ' . $aluno['aluno']['curso'] : '' ?></p>
                                </div>
                            </div>
                            <!--fim row-->
                            <!--inicio row-->
                            <div class="row">
                                <div class="col-sm-6 col-md-3 ">
                                    <p><span class="text-destaque">Data de Nascimento:</span> <?php echo!empty($aluno['aluno']['nascimento']) ? $this->formatDateView($aluno['aluno']['nascimento']) : '' ?></p>
                                </div>
                                <div class="col-sm-6 col-md-3 ">
                                    <p><span class="text-destaque">Idade:</span> <?php echo!empty($aluno['aluno']['nascimento']) ? $this->calcularIdade($aluno['aluno']['nascimento']) : '' ?></p>
                                </div>
                                <div class="col-sm-6 col-md-3 ">
                                    <p><span class="text-destaque">Gênero:</span> <?php echo!empty($aluno['aluno']['genero']) ? $aluno['aluno']['genero'] : '' ?></p>
                                </div>
                                <div class="col-sm-6 col-md-3 ">
                                    <p><span class="text-destaque">Altura:</span> <?php echo!empty($aluno['aluno']['altura']) ? $aluno['aluno']['altura'] : '' ?></p>
                                </div>
                            </div>
                            <!--fim row-->
                            <!--inicio row-->
                            <div class="row">                                
                                <div class="col-sm-6 col-md-3 ">
                                    <p><span class="text-destaque">Cor/Raça:</span> <?php echo!empty($aluno['aluno']['cor']) ? $aluno['aluno']['cor'] : '' ?></p>
                                </div>
                                <div class="col-sm-6 col-md-3 ">
                                    <p><span class="text-destaque">Pressão:</span> <?php echo!empty($aluno['aluno']['pressao']) ? $aluno['aluno']['pressao'] : '' ?></p>
                                </div>
                                <div class="col-sm-6 col-md-3 ">
                                    <p><span class="text-destaque">Frequência cardiaca em repouso:</span> <?php echo!empty($aluno['aluno']['frequencia_cardiaca']) ? $this->removeZeroEsquerda($aluno['aluno']['frequencia_cardiaca']) : '' ?></p>
                                </div>                          

                                <div class="col-sm-6 col-md-3 ">
                                    <p><span class="text-destaque">Glicose:</span> <?php echo!empty($aluno['aluno']['glicose']) ? $this->removeZeroEsquerda($aluno['aluno']['glicose']) : '' ?></p>
                                </div>

                            </div>
                            <!--fim row-->
                        </div>
                    </div>
                </article>
            </section>
        </div>
        <!--fim col-md-12 clea-->
        <div class="col-md-12">
            <section class="panel panel-black">
                <header class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-list-ol pull-left"></i> Questões</h4>
                </header>
                <article class="panel-body">
                    <!--inicio row-->
                    <div class="row">
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Fumante:</span> <?php echo!empty($aluno['aluno']['fumante']) ? $aluno['aluno']['fumante'] : '' ?></p>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Alergia:</span> <?php echo!empty($aluno['aluno']['alergia']) ? !empty($aluno['aluno']['alergia'] == "Sim") ? $aluno['aluno']['alergia'] . ', ' . $aluno['aluno']['qual_alergia'] : $aluno['aluno']['alergia'] : '' ?></p>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Doenças anteriores:</span> <?php echo!empty($aluno['aluno']['doenca']) ? !empty($aluno['aluno']['doenca'] == "Sim") ? $aluno['aluno']['doenca'] . ', ' . $aluno['aluno']['qual_doenca'] : $aluno['aluno']['doenca'] : '' ?></p>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Histórico de doenças na fámilia:</span> <?php echo!empty($aluno['aluno']['doenca_na_familia']) ? !empty($aluno['aluno']['doenca_na_familia'] == "Sim") ? $aluno['aluno']['doenca_na_familia'] . ', ' . $aluno['aluno']['qual_doenca_na_familia'] : $aluno['aluno']['doenca_na_familia'] : '' ?></p>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Lesão:</span> <?php echo!empty($aluno['aluno']['lesao']) ? !empty($aluno['aluno']['lesao'] == "Sim") ? $aluno['aluno']['lesao'] . ', ' . $aluno['aluno']['qual_lesao'] : $aluno['aluno']['lesao'] : '' ?></p>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Uso de medicamento(s):</span> <?php echo!empty($aluno['aluno']['medicamento']) ? !empty($aluno['aluno']['medicamento'] == "Sim") ? $aluno['aluno']['medicamento'] . ', ' . $aluno['aluno']['qual_medicamento'] : $aluno['aluno']['medicamento'] : '' ?></p>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Numéro de refeições diárias:</span> <?php echo!empty($aluno['aluno']['refeicoes']) ? $aluno['aluno']['refeicoes'] : '' ?></p>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Consome de bebidas alcoólicas:</span> <?php echo!empty($aluno['aluno']['bebidas']) ? $aluno['aluno']['bebidas'] : '' ?></p>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Atividade física praticada:</span> <?php echo!empty($aluno['aluno']['atividade_fisica']) ? !empty($aluno['aluno']['atividade_fisica'] == "Sim") ? $aluno['aluno']['atividade_fisica'] . ', ' . $aluno['aluno']['qual_atividade_fisica'] : $aluno['aluno']['atividade_fisica'] : '' ?></p>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Intensidade de Atividade Física:</span> <?php echo!empty($aluno['aluno']['intensidade_fisica']) ? $aluno['aluno']['intensidade_fisica'] : '' ?></p>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Suplemento:</span> <?php echo!empty($aluno['aluno']['suplemento']) ? !empty($aluno['aluno']['suplemento'] == "Sim") ? $aluno['aluno']['suplemento'] . ', ' . $aluno['aluno']['qual_suplemento'] : $aluno['aluno']['suplemento'] : '' ?></p>
                        </div>
                        <div class="col-sm-6 col-md-3 ">
                            <p><span class="text-destaque">Objetivo:</span> <?php echo!empty($aluno['aluno']['objetivo']) ? $aluno['aluno']['objetivo'] : '' ?></p>
                        </div>
                    </div>
                    <!--fim row-->
                </article>
            </section>
        </div>
        <!--fim col-md-12 clea-->

        <div class="col-md-12 clear">
            <section class="panel panel-black">
                <header class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-calendar-alt  pull-left"></i> Avaliação Física</h4>
                </header>
                <article class="panel-body">
                    <span class="pull-right"><a href="<?php echo BASE_URL . '/cadastrar/avaliacao_fisica/' . $aluno['aluno']['cod'] ?>" class="btn btn-sm btn-warning" title="Adicionar Mensalidade"><i class="fa fa-plus-circle"></i> Adicionar</a></span>
                    <br><br>
                    <div class="row">
                        <div class="panel-group" id="accordion">
                            <?php
                            if (isset($aluno['avaliacao_fisica']) && !empty($aluno['avaliacao_fisica'])):
                                foreach ($aluno['avaliacao_fisica'] as $index):
                                    ?>
                                    <div class="col-md-12 clear">
                                        <section class="panel panel-black">
                                            <header class="panel-heading">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#panel-apresentacao-<?php echo!empty($index['cod']) ? $index['cod'] : '' ?>">
                                                    <h4 class="panel-title"><i class="fa fa-calendar-alt  pull-left"></i> Avaliação Física - <?php echo!empty($index['data']) ? $this->formatDateView($index['data']) : '' ?></h4>
                                                </a>
                                            </header>
                                            <div id="panel-apresentacao-<?php echo!empty($index['cod']) ? $index['cod'] : '' ?>" class="panel-collapse collapse ">
                                                <div class="col-md-12 clear">
                                                    <p class="text-right margin-5">
                                                        <a class="btn btn-primary btn-xs" href="<?php echo BASE_URL . '/editar/avaliacao_fisica/' . $index['cod']; ?>" title="Editar"><i class="fa fa-pencil-alt"></i></a> 
                                                        <button type="button"  class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_avaliacao_<?php echo $index['cod']; ?>" title="Excluir"><i class="fa fa-trash"></i></button>
                                                    </p>
                                                </div>
                                                <article class="panel-body">
                                                    <!--inicio row-->
                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Peso:</span> <?php echo!empty($index['peso']) ? $this->removeZeroEsquerda($index['peso']) : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Abdômen:</span> <?php echo!empty($index['abdomen']) ? $this->removeZeroEsquerda($index['abdomen']) : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Quadril:</span> <?php echo!empty($index['quadril']) ? $this->removeZeroEsquerda($index['quadril']) : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Cintura:</span> <?php echo!empty($index['cintura']) ? $this->removeZeroEsquerda($index['cintura']) : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Braço direito:</span> <?php echo!empty($index['braco_direito']) ? $this->removeZeroEsquerda($index['braco_direito']) : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Braço esquerdo:</span> <?php echo!empty($index['braco_esquerdo']) ? $this->removeZeroEsquerda($index['braco_esquerdo']) : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Antebraço direito:</span> <?php echo!empty($index['antebraco_direito']) ? $this->removeZeroEsquerda($index['antebraco_direito']) : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Antebraço esquerdo:</span> <?php echo!empty($index['antebraco_esquerdo']) ? $this->removeZeroEsquerda($index['antebraco_esquerdo']) : '' ?></p>
                                                        </div>

                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Coxa direita:</span> <?php echo!empty($index['coxa_direita']) ? $this->removeZeroEsquerda($index['coxa_direita']) : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Coxa esqueda:</span> <?php echo!empty($index['coxa_esqueda']) ? $this->removeZeroEsquerda($index['coxa_esqueda']) : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Panturrilha direita:</span> <?php echo!empty($index['panturrilha_direita']) ? $this->removeZeroEsquerda($index['panturrilha_direita']) : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Panturrilha esquerda:</span> <?php echo!empty($index['panturrilha_esquerda']) ? $this->removeZeroEsquerda($index['panturrilha_esquerda']) : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">IMC:</span> <?php echo!empty($index['imc']) ? $index['imc'] : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Déficit calórico:</span> <?php echo!empty($index['deficit_calorico']) ? $index['deficit_calorico'] . " Kcal" : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Taxa de metabolismo basal (TMB):</span> <?php echo!empty($index['tmb']) ? $index['tmb'] . " Kcal" : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Massa residual: </span> <?php echo!empty($index['massa_residual']) ? $index['massa_residual'] . " kg" : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Massa óssea:</span> <?php echo!empty($index['massa_ossea']) ? $index['massa_ossea'] . " kg" : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Massa muscular:</span> <?php echo!empty($index['massa_muscular']) ? $index['massa_muscular'] . " kg" : '' ?></p>
                                                        </div>
                                                        <div class="col-sm-6 col-md-3 ">
                                                            <p><span class="text-destaque">Massa gorda:</span> <?php echo!empty($index['massa_gorda']) ? $index['massa_gorda'] . " kg" : '' ?></p>
                                                        </div>
                                                    </div>
                                                    <!--fim row-->
                                                </article>
                                            </div>
                                        </section>
                                    </div>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </div><!--<div class="panel-group" id="accordion">-->
                    </div> <!--  <div class="row"> -->
                </article>
            </section>
        </div>
    </div>
</div>


<?php
if (isset($aluno['avaliacao_fisica']) && !empty($aluno['avaliacao_fisica'])):
    foreach ($aluno['avaliacao_fisica'] as $index):
        ?>
        <!--MODAL - ESTRUTURA BÁSICA-->
        <section class="modal fade" id="modal_avaliacao_<?php echo $index['cod'] ?>" tabindex="-1" role="dialog">
            <article class="modal-dialog modal-md" role="document">
                <section class="modal-content">
                    <header class="modal-header bg-primary">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 >Deseja remover este registro?</h4>
                    </header>
                    <article class="modal-body">
                        <ul class="list-unstyled">
                            <li><b>Código: </b> <?php echo!empty($index['cod']) ? $index['cod'] : '' ?>;</li>
                            <li><b>Data: <?php echo!empty($index['data']) ? $this->formatDateView($index['data']) : '' ?>;</li>
                        </ul>
                        <p class="text-justify text-danger"><span class="font-bold">OBS : </span> Se você remove este registro, o mesmo deixará de existir no sistema.</p>
                    </article>
                    <footer class="modal-footer">
                        <a class="btn btn-danger pull-left" href="<?php echo BASE_URL . '/excluir/avaliacao_fisica/' . $index['cod_aluno'].'/'. $index['cod'] ?>"> <i class="fa fa-trash"></i> Excluir</a> 
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
                    </footer>
                </section>
            </article>
        </section>
        <?php
    endforeach;
endif;
?>
