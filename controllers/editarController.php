<?php

/**
 * A classe 'editarController' é responsável para fazer o gerenciamento na edição  de cooperados, historico, carteirinha, mensalidade, lucro, despesa, investimento e usuario
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe editarController
 */
class EditarController extends controller
{

    /**
     * Está função pertence a uma action do controle MVC, ela é chama a função cooperado();
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index($cod_cooperado)
    {
        $this->manutencao($cod_cooperado);
    }

    public function manutencao($cod)
    {
        if ($this->checkUser() >= 2) {
            $viewName = "manutencao/editar";
            $dados = array();
            $crudModel = new crud_db();
            $dados['celula'] = $crudModel->read("SELECT * FROM celula");
            $dados['status'] = $crudModel->read("SELECT * FROM manutencao_status");
            $dados['formCad'] = $crudModel->read_specific("SELECT * FROM manutencao WHERE id=:id", array('id' => filter_var($cod, FILTER_SANITIZE_SPECIAL_CHARS)));
            if (!is_array($dados['formCad']) && empty($dados['formCad'])) {
                $url = BASE_URL . '/home';
                header("Location: " . $url);
            }
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                $arrayCad = array();
                $arrayCad['id'] = $_POST['nId'];
                if (!empty($_POST['nNumero']) && isset($_POST['nNumero'])) {
                    $arrayCad['manutencao'] = $_POST['nNumero'];
                } else {
                    $dados['formCad_error']['ordem_manutencao']['msg'] = 'Informe a ordem de manutenção ';
                    $dados['formCad_error']['ordem_manutencao']['class'] = 'has-error';
                }
                if (!empty($_POST['nCelula']) && isset($_POST['nCelula'])) {
                    $arrayCad['celula'] = $_POST['nCelula'];
                } else {
                    $dados['formCad_error']['celula']['msg'] = 'Informe o curso ';
                    $dados['formCad_error']['celula']['class'] = 'has-error';
                }
                if (!empty($_POST['nStatus']) && isset($_POST['nStatus'])) {
                    $arrayCad['status_id'] = $_POST['nStatus'];
                } else {
                    $dados['formCad_error']['status']['msg'] = 'Informe o status ';
                    $dados['formCad_error']['status']['class'] = 'has-error';
                }
                if (!empty($_POST['nResponsavel']) && isset($_POST['nResponsavel'])) {
                    $arrayCad['responsavel'] = $_POST['nResponsavel'];
                } else {
                    $dados['formCad_error']['responsavel']['msg'] = 'Informe o responsável ';
                    $dados['formCad_error']['responsavel']['class'] = 'has-error';
                }
                if (!empty($_POST['nDuracao']) && isset($_POST['nDuracao'])) {
                    $arrayCad['duracao'] = $_POST['nDuracao'];
                } else {
                    $dados['formCad_error']['duracao']['msg'] = 'Informe a duração ';
                    $dados['formCad_error']['duracao']['class'] = 'has-error';
                }

                $dados['formCad'] = $arrayCad;
                if (isset($dados['formCad_error']) && !empty($dados['formCad_error'])) {
                    $dados['erro'] = array('class' => 'alert-danger', 'msg' => ' <span class = "glyphicon glyphicon-remove"></span> Preenchar os campos obrigatórios.');
                } else {
                    $_POST = array();
                    $dados['formCad'] = array();
                    $resultCad = $crudModel->update("UPDATE manutencao SET manutencao=:manutencao, celula=:celula, responsavel=:responsavel, duracao=:duracao, status_id=:status_id WHERE id=:id", $arrayCad);
                    if ($resultCad) {
                        $_SESSION['cad_acao'] = true;
                        $url = BASE_URL . '/editar/manutencao/' . $cod;
                        header("Location: " . $url);
                    }
                }
            } else if (isset($_SESSION['cad_acao']) && !empty($_SESSION['cad_acao'])) {
                $_SESSION['cad_acao'] = false;
                $dados['erro'] = array('class' => 'alert-success', 'msg' => "<span class = 'glyphicon glyphicon-ok'></span> Alteração realizada com sucesso!");
            }
            $this->loadTemplate($viewName, $dados);
        } else {
            $url = BASE_URL . '/home';
            header("Location: " . $url);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de edição no cooperado  e valida os campus preenchidos via formulário.
     * @param int $cod _cooperado- código do cooperado registrada no banco
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function avaliacao_fisica($cod)
    {
        if ($this->checkUser() >= 2) {
            $viewName = "aluno/avaliacao_fisica/editar";
            $dados = array();
            $crudModel = new crud_db();
            $avaliacao = $crudModel->read_specific("SELECT * FROM avaliacao_fisica WHERE cod=:cod", array('cod' => $cod));
            if (!is_array($avaliacao) && empty($avaliacao)) {
                $url = BASE_URL . '/home';
                header("Location: " . $url);
            }
            $aluno = $crudModel->read_specific("SELECT a.*, t.turma, t.curso FROM aluno as a INNER JOIN turma as t WHERE t.cod=a.cod_turma AND a.cod=:cod", array('cod' => $avaliacao['cod_aluno']));
            $dados['aluno'] = $aluno;
            $dados['formCad'] = $avaliacao;
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                $arrayCad = array();
                //npeso
                $arrayCad['cod'] = $cod; //cod
                $arrayCad['cod_aluno'] = isset($_POST['nCodAluno']) ? $_POST['nCodAluno'] : ''; //cod aluno
                if (!empty($_POST['nData']) && isset($_POST['nData'])) { //data
                    $arrayCad['data'] = $this->formatDateBD($_POST['nData']);
                } else {
                    $dados['formCad_error']['data']['msg'] = 'Informe a data';

                    $dados['formCad_error']['data']['class'] = 'has-error';
                }
                if (!empty($_POST['npeso']) && isset($_POST['npeso'])) { //peso
                    $arrayCad['peso'] = addslashes($_POST['npeso']);
                } else {
                    $dados['formCad_error']['peso']['msg'] = 'Informe o peso';

                    $dados['formCad_error']['peso']['class'] = 'has-error';
                }
                $arrayCad['braco_direito'] = isset($_POST['nbraco_direito']) ? $_POST['nbraco_direito'] : ''; //braco_direito
                $arrayCad['braco_esquerdo'] = isset($_POST['nbraco_esquerdo']) ? $_POST['nbraco_esquerdo'] : ''; //braco_esquerdo
                $arrayCad['antebraco_esquerdo'] = isset($_POST['nantebraco_esquerdo']) ? $_POST['nantebraco_esquerdo'] : ''; //antebraco_direito
                $arrayCad['antebraco_direito'] = isset($_POST['nantebraco_direito']) ? $_POST['nantebraco_direito'] : ''; //antebraco_direito
                $arrayCad['abdomen'] = isset($_POST['nabdomen']) ? $_POST['nabdomen'] : ''; //abdomen
                $arrayCad['quadril'] = isset($_POST['nquadril']) ? $_POST['nquadril'] : ''; //nquadril
                $arrayCad['cintura'] = isset($_POST['ncintura']) ? $_POST['ncintura'] : ''; //cintura

                if (!empty($_POST['nfemu']) && isset($_POST['nfemu'])) { //femu
                    $arrayCad['femu'] = addslashes($_POST['nfemu']);
                } else {
                    $dados['formCad_error']['femu']['msg'] = 'Informe diametro do fêmur';

                    $dados['formCad_error']['femu']['class'] = 'has-error';
                }
                if (!empty($_POST['npunho']) && isset($_POST['npunho'])) { //punho
                    $arrayCad['punho'] = addslashes($_POST['npunho']);
                } else {
                    $dados['formCad_error']['punho']['msg'] = 'Informe diametro do punho';

                    $dados['formCad_error']['punho']['class'] = 'has-error';
                }
                $arrayCad['coxa_direita'] = isset($_POST['ncoxa_direita']) ? $_POST['ncoxa_direita'] : ''; //cintura
                $arrayCad['coxa_esqueda'] = isset($_POST['ncoxa_esqueda']) ? $_POST['ncoxa_esqueda'] : ''; //cintura
                $arrayCad['panturrilha_direita'] = isset($_POST['npanturrilha_direita']) ? $_POST['npanturrilha_direita'] : ''; //cintura
                $arrayCad['panturrilha_esquerda'] = isset($_POST['npanturrilha_esquerda']) ? $_POST['npanturrilha_esquerda'] : ''; //cintura


                $dados['formCad'] = $arrayCad;
                if (isset($dados['formCad_error']) && !empty($dados['formCad_error'])) {
                    $dados['erro'] = array('class' => 'alert-danger', 'msg' => ' <span class = "glyphicon glyphicon-remove"></span> Preenchar os campos obrigatórios.');
                } else {
                    //calculos == 
                    $arrayCad['imc'] = $this->calcularIMC($arrayCad['peso'], $aluno['altura']);
                    $percentual_gordura_corporal = $this->percentualDeGorduraCorporal($arrayCad['imc'], $this->calcularIdade($aluno['nascimento']), $aluno['genero']);
                    $arrayCad['deficit_calorico'] = $this->calcularDeficitCalorico($aluno['genero'], $this->calcularIdade($aluno['nascimento']), $arrayCad['peso']);
                    $arrayCad['tmb'] = $this->calcularTaxaMetabolicaBasal($aluno['genero'], $arrayCad['peso'], $aluno['altura'], $this->calcularIdade($aluno['nascimento']));
                    $arrayCad['massa_residual'] = $this->calcularMassaResidual($arrayCad['peso'], $aluno['genero']);
                    $arrayCad['massa_magra'] = $this->calcularMassaMagra($arrayCad['peso'], $percentual_gordura_corporal);
                    $arrayCad['massa_gorda'] = $this->calcularMassaGorda($arrayCad['peso'], $percentual_gordura_corporal);
                    $arrayCad['massa_ossea'] = $this->calcularMassaOssea($aluno['altura'], $arrayCad['punho'], $arrayCad['femu']);
                    $arrayCad['massa_muscular'] = $this->calcularMassaMuscular($arrayCad['peso'], $arrayCad['massa_gorda'], $arrayCad['massa_ossea'], $arrayCad['massa_residual']);

                    $resultado = $crudModel->create('UPDATE avaliacao_fisica SET cod_aluno=:cod_aluno, data=:data, peso=:peso, braco_direito=:braco_direito, braco_esquerdo=:braco_esquerdo, antebraco_direito=:antebraco_direito, antebraco_esquerdo=:antebraco_esquerdo, abdomen=:abdomen, quadril=:quadril, cintura=:cintura, femu=:femu, punho=:punho, coxa_direita=:coxa_direita, coxa_esqueda=:coxa_esqueda, panturrilha_direita=:panturrilha_direita, panturrilha_esquerda=:panturrilha_esquerda, imc=:imc, deficit_calorico=:deficit_calorico, tmb=:tmb, massa_residual=:massa_residual, massa_ossea=:massa_ossea, massa_muscular=:massa_muscular, massa_magra=:massa_magra, massa_gorda=:massa_gorda WHERE cod=:cod', $arrayCad);
                    if ($resultado) {
                        $_SESSION['tipo_acao'] = true;
                        $url = BASE_URL . '/editar/avaliacao_fisica/' . $cod;
                        header("Location: " . $url);
                    }
                }
            } else if (isset($_SESSION['tipo_acao']) && !empty($_SESSION['tipo_acao'])) {
                $_SESSION['tipo_acao'] = false;
                $dados['erro'] = array('class' => 'alert-success', 'msg' => "<span class = 'glyphicon glyphicon-ok'></span> Alteração realizada com sucesso!");
            }
            $this->loadTemplate($viewName, $dados);
        } else {
            $url = BASE_URL . '/home';
            header("Location: " . $url);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de editar uma turma e valida os campus preenchidos via formulário.
     * @param int $cod - código do lucro registrada no banco
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function turma($cod)
    {
        if ($this->checkUser() >= 2 && intval($cod) > 0) {
            $viewName = "turma/editar";
            $dados = array();
            $crudModel = new crud_db();
            $result_db = $crudModel->read('SELECT * FROM turma WHERE cod=:cod', array('cod' => $cod));
            $dados['cadForm'] = array(
                'cod' => $result_db[0]['cod'],
                'cod_instituicao' => $result_db[0]['cod_instituicao'],
                'turma' => $result_db[0]['turma'],
                'curso' => $result_db[0]['turma'],
                'ano' => $result_db[0]['ano']
            );
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                /* Adicionando */
                $ArrayCad = array(
                    'cod' => addslashes($_POST['nCod']),
                    'cod_instituicao' => $this->getCodInstituicao(),
                    'curso' => addslashes($_POST['nCurso']),
                    'turma' => addslashes($_POST['nTuma']),
                    'ano' => addslashes($_POST['nAno']),
                );
                $dados['cadForm'] = $ArrayCad;
                if (!empty($_POST['nTuma']) && !empty($_POST['nAno'])) {
                    $resultado = $crudModel->update('UPDATE turma SET cod_instituicao=:cod_instituicao, curso=:curso, turma=:turma, ano=:ano WHERE cod=:cod', $ArrayCad);
                    if ($resultado) {
                        $_SESSION['financa_acao'] = true;
                        $url = BASE_URL . "/editar/turma/" . $cod;
                        header("Location: " . $url);
                    }
                } else {
                    $dados['erro'] = array('class' => 'alert-danger', 'msg' => "Preenchar os campos obrigatórios.");
                }
            } else if (isset($_SESSION['financa_acao']) && !empty($_SESSION['financa_acao'])) {
                $_SESSION['financa_acao'] = false;
                $dados['erro'] = array('class' => 'alert-success', 'msg' => "<span class = 'glyphicon glyphicon-ok'></span> Alteração realizada com sucesso!");
            }
            $this->loadTemplate($viewName, $dados);
        } else {
            $url = BASE_URL . '/home';
            header("Location: " . $url);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controle nas ações de editar usuario e valida os campus preenchidos via formulário.
     * @param int $cod - código do usuario registrada no banco
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function usuario($cod)
    {
        if (($this->checkUser() && $cod == $_SESSION['usuario_sessao']['cod']) || ($this->checkUser() >= 3)) {
            $view = "usuario/editar";
            $dados = array();
            $usuarioModel = new usuario();
            //pesquisa usuário
            $result_usuario = $usuarioModel->read_specific("SELECT * FROM usuario WHERE cod_usuario=:cod", array('cod' => addslashes(trim($cod))));
            if ($result_usuario) {

                $dados['usuario'] = $result_usuario;

                if (isset($_POST['nSalvar'])) {
                    if ($result_usuario['nivel_acesso_usuario'] != 4) {
                        //codigo
                        $usuario = array('cod_usuario' => addslashes(trim($_POST['nCodUsuario'])));
                        //nome
                        if (!empty($_POST['nNome'])) {
                            $usuario['nome_usuario'] = addslashes($_POST['nNome']);
                        } else {
                            $dados['usuario_erro']['nome']['msg'] = 'Informe o nome';
                            $dados['usuario_erro']['nome']['class'] = 'has-error';
                        }
                        //sobrenome
                        if (!empty($_POST['nSobrenome'])) {
                            $usuario['sobrenome_usuario'] = addslashes($_POST['nSobrenome']);
                        } else {
                            $dados['usuario_erro']['sobrenome']['msg'] = 'Informe o sobrenome';
                            $dados['usuario_erro']['sobrenome']['class'] = 'has-error';
                        }
                        //sobrenome
                        if (!empty($_POST['nUsuario'])) {
                            $usuario['usuario_usuario'] = addslashes($_POST['nUsuario']);
                            if ($usuarioModel->read_specific('SELECT * FROM usuario WHERE usuario_usuario=:usuario AND cod_usuario != :cod ', array('usuario' => $usuario['usuario_usuario'], 'cod' => $usuario['cod_usuario']))) {
                                $dados['usuario_erro']['usuario']['msg'] = 'usuário já cadastrado';
                                $dados['usuario_erro']['usuario']['class'] = 'has-error';
                                $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível alterar um usuario para um nome de usuário já cadastrado, por favor informe outro nome de usuário';
                                $dados['erro']['class'] = 'alert-danger';
                                $usuario['usuario'] = null;
                            }
                        } else {
                            $dados['usuario_erro']['usuario']['msg'] = 'Informe o usuário';
                            $dados['usuario_erro']['usuario']['class'] = 'has-error';
                        }
                        //senha
                        if (!empty($_POST['nSenha']) && !empty($_POST['nRepetirSenha'])) {
                            //senha
                            if ($_POST['nSenha'] == $_POST['nRepetirSenha']) {
                                $usuario['senha_usuario'] = addslashes($_POST['nSenha']);
                            } else {
                                $dados['usuario_erro']['senha']['msg'] = "Os campos 'Nova Senha' e 'Repetir Nova Senha' não estão iguais! ";
                                $dados['usuario_erro']['senha']['class'] = 'has-error';
                            }
                        }
                        //cargo
                        if (!empty($_POST['nCargo'])) {
                            $usuario['cargo_usuario'] = addslashes($_POST['nCargo']);
                        } else {
                            $dados['usuario_info']['cargo']['msg'] = 'Informe o cargo, senão não será exibido o cargo';
                            $dados['usuario_info']['cargo']['class'] = 'has-warning';
                        }
                        //sexo
                        $usuario['genero_usuario'] = addslashes($_POST['nSexo']);

                        //nivel de acesso
                        if (!empty($_POST['tNivelDeAcesso'])) {
                            $usuario['nivel_acesso_usuario'] = addslashes($_POST['tNivelDeAcesso']);
                        } else {
                            $usuario['nivel_acesso_usuario'] = $result_usuario['nivel_acesso_usuario'];
                        }
                        //status
                        if (isset($_POST['nStatuUsuario']) && !empty($_POST['nStatuUsuario'])) {
                            $usuario['status_usuario'] = addslashes($_POST['nStatuUsuario']);
                        } else {
                            $usuario['status_usuario'] = 0;
                        }


                        //imagem
                        if (isset($_FILES['tImagem-1']) && $_FILES['tImagem-1']['error'] == 0) {
                            $usuario['imagem_usuario'] = $_FILES['tImagem-1'];
                            $usuario['img_atual'] = $result_usuario['imagem_usuario'];
                        } else if (!empty($_POST['nImagem-user'])) {
                            $usuario['imagem_usuario'] = addslashes($_POST['nImagem-user']);
                        } else {
                            $usuario['imagem_usuario'] = $result_usuario['imagem_usuario'];
                            $usuario['delete_img'] = true;
                        }

                        if (isset($dados['usuario_erro']) && !empty($dados['usuario_erro'])) {
                            $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos obrigatórios (*).';
                            $dados['erro']['class'] = 'alert-danger';
                        } else {
                            $resultado = $usuarioModel->update($usuario);
                            $dados['usuario'] = $resultado;

                            //SE O USUÁRIO EM EDIÇÃO E O MESMO QUE ESTÁ LOGADO NO SITEMA ELE VAI ALTERAR OS DADOS DO USUÁRIO LOGADO
                            if ($cod == $_SESSION['usuario_sessao']['cod'] && !empty($resultado)) {
                                //nome
                                $_SESSION['usuario_sessao']['nome'] = $resultado['nome_usuario'];
                                //sobrenome
                                $_SESSION['usuario_sessao']['sobrenome'] = $resultado['sobrenome_usuario'];
                                //cargo
                                $_SESSION['usuario_sessao']['cargo'] = $resultado['cargo_usuario'];
                                //img
                                $_SESSION['usuario_sessao']['imagem'] = $resultado['imagem_usuario'];
                                //nivel
                                $_SESSION['usuario_sessao']['nivel'] = $resultado['nivel_acesso_usuario'];
                                //statu
                                $_SESSION['usuario_sessao']['statu'] = $resultado['status_usuario'];
                            }

                            $dados['erro']['msg'] = " <span class = 'glyphicon glyphicon-ok'></span> Alteração realizada com sucesso!";
                            $dados['erro']['class'] = 'alert-success';
                            $_POST = array();
                        }
                    } else {
                        $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Este usuário não pode ser alterado.';
                        $dados['erro']['class'] = 'alert-danger';
                        $_POST = array();
                    }
                }
                $this->loadTemplate($view, $dados);
            } else {
                $url = BASE_URL . '/home';
                header("Location: " . $url);
            }
        } else {
            $url = BASE_URL . '/home';
            header("Location: " . $url);
        }
    }
}
