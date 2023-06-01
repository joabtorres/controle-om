<?php

/**
 * A classe 'cadastrarController' é responsável para fazer o gerenciamento no cadastro de cooperados, historico, carteirinha, mensalidade, lucro, despesa, investimento e usuario
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe cadastrarController
 */
class cadastrarController extends controller
{

    /**
     * Está função pertence a uma action do controle MVC, ela é chama a função cooperado();
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index()
    {
        $this->manutencao();
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra uma novo cooperado  e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function manutencao()
    {
        if ($this->checkUser()) {
            $viewName = "manutencao/cadastrar";
            $dados = array();
            $crudModel = new crud_db();
            $dados['celula'] = $crudModel->read("SELECT * FROM celula");
            $dados['status'] = $crudModel->read("SELECT * FROM manutencao_status");
            // $dados['turmas'] = $crudModel->read("SELECT * FROM turma WHERE cod_instituicao=:cod", array('cod' => $this->getCodInstituicao()));
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                $arrayCad = array();
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
                    $resultCad = $crudModel->create("INSERT INTO manutencao (manutencao, celula, responsavel, duracao, status_id) VALUES (:manutencao, :celula, :responsavel, :duracao, :status_id)", $arrayCad);
                    if ($resultCad) {
                        $_SESSION['cad_acao'] = true;
                        $url = BASE_URL . '/cadastrar/manutencao';
                        header("Location: " . $url);
                    }
                }
            } else if (isset($_SESSION['cad_acao']) && !empty($_SESSION['cad_acao'])) {
                $_SESSION['cad_acao'] = false;
                $dados['erro'] = array('class' => 'alert-success', 'msg' => "<span class = 'glyphicon glyphicon-ok'></span> Cadastro realizado com sucesso!");
            }
            $this->loadTemplate($viewName, $dados);
        } else {
            $url = BASE_URL . '/home';
            header("Location: " . $url);
        }
    }

    public function avaliacao_fisica($cod)
    {
        if ($this->checkUser() >= 2) {
            $viewName = "aluno/avaliacao_fisica/cadastrar";
            $dados = array();
            $crudModel = new crud_db();
            $aluno = $crudModel->read_specific("SELECT a.*, t.turma, t.curso FROM aluno as a INNER JOIN turma as t WHERE t.cod=a.cod_turma AND a.cod=:cod", array('cod' => $cod));
            if (!is_array($aluno) && empty($aluno)) {
                $url = BASE_URL . '/home';
                header("Location: " . $url);
            }
            $dados['aluno'] = $aluno;
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                $arrayCad = array();
                //npeso
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

                    $resultado = $crudModel->create('INSERT INTO avaliacao_fisica(cod_aluno, data, peso, braco_direito, braco_esquerdo, antebraco_direito, antebraco_esquerdo, abdomen, quadril, cintura, femu, punho, coxa_direita, coxa_esqueda, panturrilha_direita, panturrilha_esquerda, imc, deficit_calorico, tmb, massa_residual, massa_ossea, massa_muscular, massa_magra, massa_gorda) VALUES (:cod_aluno, :data, :peso, :braco_direito, :braco_esquerdo, :antebraco_direito, :antebraco_esquerdo, :abdomen, :quadril, :cintura, :femu, :punho,:coxa_direita, :coxa_esqueda, :panturrilha_direita, :panturrilha_esquerda,   :imc,  :deficit_calorico,  :tmb,  :massa_residual,  :massa_ossea,  :massa_muscular,  :massa_magra,  :massa_gorda)', $arrayCad);
                    if ($resultado) {
                        $_SESSION['tipo_acao'] = true;
                        $url = BASE_URL . '/cadastrar/avaliacao_fisica/' . $cod;
                        header("Location: " . $url);
                    }
                }
            } else if (isset($_SESSION['tipo_acao']) && !empty($_SESSION['tipo_acao'])) {
                $_SESSION['tipo_acao'] = false;
                $dados['erro'] = array('class' => 'alert-success', 'msg' => "<span class = 'glyphicon glyphicon-ok'></span> Cadastro realizado com sucesso!");
            }
            $this->loadTemplate($viewName, $dados);
        } else {
            $url = BASE_URL . '/home';
            header("Location: " . $url);
        }
    }

    public function turma()
    {
        if ($this->checkUser() >= 2) {
            $viewName = "turma/cadastrar";
            $dados = array();
            $crudModel = new crud_db();
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                /* Adicionando */
                $arrayCad = array(
                    'cod_instituicao' => $this->getCodInstituicao(),
                    'curso' => addslashes($_POST['nCurso']),
                    'turma' => addslashes($_POST['nTuma']),
                    'ano' => addslashes($_POST['nAno']),
                );
                $dados['formCad'] = $arrayCad;
                if (!empty($_POST['nTuma']) && !empty($_POST['nAno'])) {
                    $resultado = $crudModel->create('INSERT INTO turma (cod_instituicao, curso, turma, ano) VALUES (:cod_instituicao, :curso, :turma, :ano)', $arrayCad);
                    if ($resultado) {
                        $_SESSION['financa_acao'] = true;
                        $url = BASE_URL . '/cadastrar/turma';
                        header("Location: " . $url);
                    }
                } else {
                    $dados['erro'] = array('class' => 'alert-danger', 'msg' => "Preenchar os campos obrigatórios.");
                }
            } else if (isset($_SESSION['financa_acao']) && !empty($_SESSION['financa_acao'])) {
                $_SESSION['financa_acao'] = false;
                $dados['erro'] = array('class' => 'alert-success', 'msg' => "<span class = 'glyphicon glyphicon-ok'></span> Cadastro realizado com sucesso!");
            }
            $this->loadTemplate($viewName, $dados);
        } else {
            $url = BASE_URL . '/home';
            header("Location: " . $url);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controle nas ações de cadastra usuario e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function usuario()
    {
        if ($this->checkUser() >= 3) {
            $view = "usuario/cadastrar";
            $dados = array();
            $usuarioModel = new usuario();
            //Array que vai armazena os dados do usuário;
            $usuario = array();
            if (isset($_POST['nSalvar'])) {
                //nome
                if (!empty($_POST['nNome'])) {
                    $usuario['nome'] = addslashes($_POST['nNome']);
                } else {
                    $dados['usuario_erro']['nome']['msg'] = 'Informe o nome';
                    $dados['usuario_erro']['nome']['class'] = 'has-error';
                }
                //sobrenome
                if (!empty($_POST['nSobrenome'])) {
                    $usuario['sobrenome'] = addslashes($_POST['nSobrenome']);
                } else {
                    $dados['usuario_erro']['sobrenome']['msg'] = 'Informe o sobrenome';
                    $dados['usuario_erro']['sobrenome']['class'] = 'has-error';
                }
                //usuario
                if (!empty($_POST['nUsuario'])) {
                    $usuario['usuario'] = addslashes($_POST['nUsuario']);
                    if ($usuarioModel->read_specific('SELECT * FROM usuario WHERE usuario_usuario=:usuario', array('usuario' => $usuario['usuario']))) {
                        $dados['usuario_erro']['usuario']['msg'] = 'usuário já cadastrado';
                        $dados['usuario_erro']['usuario']['class'] = 'has-error';
                        $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar um usuario já cadastrado, por favor informe outro nome de usuário';
                        $dados['erro']['class'] = 'alert-danger';
                        $usuario['usuario'] = null;
                    }
                } else {
                    $dados['usuario_erro']['usuario']['msg'] = 'Informe o usuário';
                    $dados['usuario_erro']['usuario']['class'] = 'has-error';
                }
                //email
                if (!empty($_POST['nEmail'])) {
                    $usuario['email'] = addslashes($_POST['nEmail']);
                    if ($usuarioModel->read_specific('SELECT * FROM usuario WHERE email_usuario=:email', array('email' => $usuario['email']))) {
                        $dados['usuario_erro']['email']['msg'] = 'E-mail já cadastrado';
                        $dados['usuario_erro']['email']['class'] = 'has-error';
                        $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar um e-mail já cadastrado, por favor informe outro endereço de e-mail';
                        $dados['erro']['class'] = 'alert-danger';
                        $usuario['email'] = null;
                    }
                } else {
                    $dados['usuario_erro']['email']['msg'] = 'Informe o e-mail';
                    $dados['usuario_erro']['email']['class'] = 'has-error';
                }
                //email
                if (!empty($_POST['nSenha']) && !empty($_POST['nRepetirSenha'])) {
                    //senha
                    if ($_POST['nSenha'] == $_POST['nRepetirSenha']) {
                        $usuario['senha'] = $_POST['nSenha'];
                    } else {
                        $dados['usuario_erro']['senha']['msg'] = "Os campos 'Senha' e 'Repetir Senha' não estão iguais! ";
                        $dados['usuario_erro']['senha']['class'] = 'has-error';
                    }
                } else {
                    $dados['usuario_erro']['senha']['msg'] = "Os campos 'Senha' e 'Repetir Senha' devem ser preenchidos";
                    $dados['usuario_erro']['senha']['class'] = 'has-error';
                }
                //nucleo
                $usuario['cod_instituicao'] = $this->getCodInstituicao();
                //cargo
                if (!empty($_POST['nCargo'])) {
                    $usuario['cargo'] = addslashes($_POST['nCargo']);
                } else {
                    $dados['usuario_info']['cargo']['msg'] = 'Informe o cargo, senão não será exibido o cargo';
                    $dados['usuario_info']['cargo']['class'] = 'has-warning';
                }
                //sexo
                $usuario['sexo'] = addslashes($_POST['nSexo']);

                //nivel de acesso
                $usuario['nivel'] = addslashes($_POST['tNivelDeAcesso']);

                //imagem
                if (isset($_FILES['tImagem-1']) && $_FILES['tImagem-1']['error'] == 0) {
                    $usuario['imagem'] = $_FILES['tImagem-1'];
                }
                if (isset($dados['usuario_erro']) && !empty($dados['usuario_erro'])) {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos obrigatórios (*).';
                    $dados['erro']['class'] = 'alert-danger';
                } else {
                    $usuarioModel->create($usuario);
                    $dados['erro']['msg'] = "<span class = 'glyphicon glyphicon-ok'></span> Cadastro realizado com sucesso!";
                    $dados['erro']['class'] = 'alert-success';
                    $_POST = array();
                }
            }
            $dados['usuario'] = $usuario;
            $this->loadTemplate($view, $dados);
        } else {
            $url = BASE_URL . '/home';
            header("Location: " . $url);
        }
    }
}
