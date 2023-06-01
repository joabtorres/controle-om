<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/gif" href="<?php echo BASE_URL ?>/assets/imagens/icon.png" sizes="32x32" />
        <meta property="ogg:title" content="<?php echo NAME_PROJECT; ?>">
        <meta property="ogg:description" content="<?php echo NAME_PROJECT; ?>">
        <title> <?php echo NAME_PROJECT; ?> </title>
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/relatorio_1.css" media=”print” >
    </head>

    <body>
        <table style="width:100%; ">	    
            <tr>
                <td align="left">
                    <img src="<?php echo BASE_URL . '/assets/imagens/ifpa.png'; ?>" alt="Logo" style="width: 80px;"/>

                </td>
                <td align="left">
                    <h4 class="text-center text-upercase" style="margin: 0;"> <?php echo $cidade['nome_siglas'] ?> <?php echo $cidade['nome_completo'] ?> </h4>
                    <p class="text-center">                    
                        <small>
                            <?php echo $cidade['endereco'] ?> - CEP: <?php echo $cidade['cep'] ?><br/>
                            <?php echo $cidade['telefone'] ?> | <?php echo $cidade['email'] ?><br/>
                            CNPJ <?php echo $cidade['cnpj'] ?>
                        </small>
                    </p>
                </td>
                <td align="right">
                    <img src="<?php echo BASE_URL . '/assets/imagens/logo.png'; ?>" alt="Logo" style="width: 140px;"/>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="3">
                    <p><?php echo NAME_PROJECT ?></p><br/>
                    <h4>Ficha do Aluno</h4>
                </td>
            </tr>
        </table>

        <table class="table">
            <tr>
                <th colspan="4"><h4 class="text-destaque">Dados Pessoais</h4></th>
            </tr>
            <tr>
                <td rowspan="5"><img src="<?php echo!empty($aluno['imagem']) ? BASE_URL . '/' . $aluno['imagem'] : BASE_URL . '/assets/imagens/foto_ilustrato3x4.png' ?>" width="100px"/></td>
            </tr>
            <tr>
                <td><span class="text-destaque">Nome:</span><br> <?php echo!empty($aluno['nome']) ? $aluno['nome'] : '' ?></td>
                <td colspan="2"><span class="text-destaque" >Turma:</span> <br><?php echo!empty($aluno['turma']) ? $aluno['turma'] . ' - Curso: ' . $aluno['curso'] : '' ?></td>
            </tr>
            <tr>
                <td><span class="text-destaque">Data de Nascimento:</span> <br><?php echo!empty($aluno['nascimento']) ? $this->formatDateView($aluno['nascimento']) : '' ?></td>
                <td><span class="text-destaque">Idade:</span> <br><?php echo!empty($aluno['nascimento']) ? $this->calcularIdade($aluno['nascimento']) : '' ?></td>
                <td><span class="text-destaque">Gênero:</span> <br><?php echo!empty($aluno['genero']) ? $aluno['genero'] : '' ?></td>
            </tr>
            <tr>
                <td><span class="text-destaque">Altura:</span> <br><?php echo!empty($aluno['altura']) ? $aluno['altura'] : '' ?></td>
                <td><span class="text-destaque">Cor/Raça:</span> <br><?php echo!empty($aluno['cor']) ? $aluno['cor'] : '' ?></td>                                      
                <td><span class="text-destaque">Pressão:</span> <br><?php echo!empty($aluno['pressao']) ? $aluno['pressao'] : '' ?></td>
            </tr>
            <tr>
                <td><span class="text-destaque">Frequência cardiaca em repouso:</span> <?php echo!empty($aluno['frequencia_cardiaca']) ? $this->removeZeroEsquerda($aluno['frequencia_cardiaca']) : '' ?></td>                                      
                <td><span class="text-destaque">Glicose:</span><br> <?php echo!empty($aluno['glicose']) ? $this->removeZeroEsquerda($aluno['glicose']) : '' ?></td>
            </tr>
        </table>

        <table class="table">
            <tr>
                <th colspan="4"><h4 class="text-destaque">Questões</h4></th>
            </tr>

            <tr>
                <td><span class="text-destaque">Fumante:</span> <br><?php echo!empty($aluno['fumante']) ? $aluno['fumante'] : '' ?></td>
                <td><span class="text-destaque">Alergia:</span> <br><?php echo!empty($aluno['alergia']) ? !empty($aluno['alergia'] == "Sim") ? $aluno['alergia'] . ', ' . $aluno['qual_alergia'] : $aluno['alergia'] : '' ?></td>
                <td ><span class="text-destaque">Doenças anteriores:</span> <br><?php echo!empty($aluno['doenca']) ? !empty($aluno['doenca'] == "Sim") ? $aluno['doenca'] . ', ' . $aluno['qual_doenca'] : $aluno['doenca'] : '' ?></td>
            </tr>
            <tr>
            </tr>
            <tr>
                <td><span class="text-destaque">Histórico de doenças na fámilia:</span> <br><?php echo!empty($aluno['doenca_na_familia']) ? !empty($aluno['doenca_na_familia'] == "Sim") ? $aluno['doenca_na_familia'] . ', ' . $aluno['qual_doenca_na_familia'] : $aluno['doenca_na_familia'] : '' ?></td>
                <td><span class="text-destaque">Lesão:</span> <br><?php echo!empty($aluno['lesao']) ? !empty($aluno['lesao'] == "Sim") ? $aluno['lesao'] . ', ' . $aluno['qual_lesao'] : $aluno['lesao'] : '' ?></td>
                <td><span class="text-destaque">Uso de medicamento(s):</span> <br><?php echo!empty($aluno['medicamento']) ? !empty($aluno['medicamento'] == "Sim") ? $aluno['medicamento'] . ', ' . $aluno['qual_medicamento'] : $aluno['medicamento'] : '' ?></td>
            </tr>
            <tr>
                <td><span class="text-destaque">Numéro de refeições diárias:</span> <br><?php echo!empty($aluno['refeicoes']) ? $aluno['refeicoes'] : '' ?></td>
                <td><span class="text-destaque">Consome de bebidas alcoólicas:</span> <br><?php echo!empty($aluno['bebidas']) ? $aluno['bebidas'] : '' ?></td>
                <td><span class="text-destaque">Atividade física praticada:</span> <br><?php echo!empty($aluno['atividade_fisica']) ? !empty($aluno['atividade_fisica'] == "Sim") ? $aluno['atividade_fisica'] . ', ' . $aluno['qual_atividade_fisica'] : $aluno['atividade_fisica'] : '' ?></td>                                      
            </tr>
            <tr>
                <td><span class="text-destaque">Intensidade de Atividade Física:</span><br> <?php echo!empty($aluno['intensidade_fisica']) ? $aluno['intensidade_fisica'] : '' ?></td>
                <td><span class="text-destaque">Suplemento:</span> <br> <?php echo!empty($aluno['suplemento']) ? !empty($aluno['suplemento'] == "Sim") ? $aluno['suplemento'] . ', ' . $aluno['qual_suplemento'] : $aluno['suplemento'] : '' ?></td>                                      
                <td><span class="text-destaque"> Objetivo:</span><br>  <?php echo!empty($aluno['objetivo']) ? $aluno['objetivo'] : '' ?></td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <th colspan="2"><h4 class="text-destaque">Avaliação Física</h4></th>
            </tr>
            <?php
            if (isset($aluno['avaliacao_fisica']) && !empty($aluno['avaliacao_fisica'])):
                foreach ($aluno['avaliacao_fisica'] as $index):
                    ?>
                    <tr>
                        <td colspan="2">
                            <table class="table table-sub">
                                <tr>
                                    <th colspan="4"><h4 class="text-destaque">Avaliação Física - <?php echo!empty($index['data']) ? $this->formatDateView($index['data']) : '' ?></h4></th>
                                </tr>
                                <tr>
                                    <td><span class="text-destaque">Peso:</span> <br> <?php echo!empty($index['peso']) ? $this->removeZeroEsquerda($index['peso']) : '' ?></td>
                                    <td><span class="text-destaque">Abdômen:</span><br>  <?php echo!empty($index['abdomen']) ? $this->removeZeroEsquerda($index['abdomen']) : '' ?></td>
                                    <td><span class="text-destaque">Quadril:</span><br>  <?php echo!empty($index['quadril']) ? $this->removeZeroEsquerda($index['quadril']) : '' ?></td>
                                    <td><span class="text-destaque">Cintura:</span> <br> <?php echo!empty($index['cintura']) ? $this->removeZeroEsquerda($index['cintura']) : '' ?></td>
                                </tr>
                                <tr>
                                    <td><span class="text-destaque">Braço direito:</span> <br> <?php echo!empty($index['braco_direito']) ? $this->removeZeroEsquerda($index['braco_direito']) : '' ?></td>
                                    <td><span class="text-destaque">Braço esquerdo:</span> <br> <?php echo!empty($index['braco_esquerdo']) ? $this->removeZeroEsquerda($index['braco_esquerdo']) : '' ?></td>
                                    <td><span class="text-destaque">Antebraço direito:</span> <br> <?php echo!empty($index['antebraco_direito']) ? $this->removeZeroEsquerda($index['antebraco_direito']) : '' ?></td>
                                    <td><span class="text-destaque">Antebraço esquerdo:</span> <br> <?php echo!empty($index['antebraco_esquerdo']) ? $this->removeZeroEsquerda($index['antebraco_esquerdo']) : '' ?></td>
                                </tr>
                                <tr>
                                    <td><span class="text-destaque">Coxa direita:</span> <br> <?php echo!empty($index['coxa_direita']) ? $this->removeZeroEsquerda($index['coxa_direita']) : '' ?></td>
                                    <td><span class="text-destaque">Coxa esqueda:</span> <br> <?php echo!empty($index['coxa_esqueda']) ? $this->removeZeroEsquerda($index['coxa_esqueda']) : '' ?></td>      
                                    <td><span class="text-destaque">Panturrilha direita:</span> <br> <?php echo!empty($index['panturrilha_direita']) ? $this->removeZeroEsquerda($index['panturrilha_direita']) : '' ?></td>      
                                    <td><span class="text-destaque">Panturrilha esquerda:</span> <br> <?php echo!empty($index['panturrilha_esquerda']) ? $this->removeZeroEsquerda($index['panturrilha_esquerda']) : '' ?></td>      

                                </tr>
                                <tr>
                                    <td><span class="text-destaque">IMC:</span> <br> <?php echo!empty($index['imc']) ? $index['imc'] : '' ?></td>
                                    <td><span class="text-destaque">Déficit calórico:</span> <br> <?php echo!empty($index['deficit_calorico']) ? $index['deficit_calorico'] . " Kcal" : '' ?></td>
                                    <td colspan="2"><span class="text-destaque">Taxa de metabolismo basal (TMB):</span> <br>  <?php echo!empty($index['tmb']) ? $index['tmb'] . " Kcal" : '' ?></td>
                                </tr>
                                <tr>
                                    <td><span class="text-destaque">Massa residual: </span> <br> <?php echo!empty($index['massa_residual']) ? $index['massa_residual'] . " kg" : '' ?></td>
                                    <td><span class="text-destaque">Massa óssea:</span> <br> <?php echo!empty($index['massa_ossea']) ? $index['massa_ossea'] . " kg" : '' ?></td>
                                    <td><span class="text-destaque">Massa muscular:</span><br>  <?php echo!empty($index['massa_muscular']) ? $index['massa_muscular'] . " kg" : '' ?></td>
                                    <td><span class="text-destaque">Massa gorda:</span> <br> <?php echo!empty($index['massa_gorda']) ? $index['massa_gorda'] . " kg" : '' ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
        </table>
        <table>
            <tr>
                <td align="right">Este documento foi gerado em <?php echo $this->formatDateView(date("Y-m-d")) . ' as ' . date("H:i:s", (time() - $this->ajustaHorario())) ?>.</td>
            </tr>
        </table>
    </body>

</html>

<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
$mpdf->WriteHTML($html);
$arquivo = 'ficha_do_servidor_' . md5(time()) . '.pdf';
$mpdf->Output($arquivo, 'I');
?>
