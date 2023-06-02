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

    public function desvio($cod)
    {
        if ($this->checkUser()) {
            $viewName = "manutencao/desvio/cadastrar";
            $dados = array();
            $crudModel = new crud_db();
            $id = filter_var($cod, FILTER_SANITIZE_SPECIAL_CHARS);
            $aluno = $crudModel->read_specific("SELECT m.*, s.status, s.class_color FROM manutencao AS m INNER JOIN manutencao_status AS s WHERE m.status_id=s.id AND m.id=:id", ['id' => $id]);
            if (!is_array($aluno) && empty($aluno)) {
                $url = BASE_URL . '/home';
                header("Location: " . $url);
            }
            $dados['manutencao'] = $aluno;
            $dados['tipo'] = $crudModel->read("SELECT * FROM manutencao_desvio_tipo");
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                $arrayCad = array();
                $arrayCad['manutencao_id'] =  filter_input(INPUT_POST, "nId", FILTER_VALIDATE_INT);
                $arrayCad['ordem'] =  filter_input(INPUT_POST, "nOrdem", FILTER_SANITIZE_SPECIAL_CHARS);
                if (!empty($_POST['nTipo']) && isset($_POST['nTipo'])) {
                    $arrayCad['tipo'] = filter_input(INPUT_POST, "nTipo", FILTER_SANITIZE_SPECIAL_CHARS);
                } else {
                    $dados['formCad_error']['tipo']['msg'] = 'Informe o tipo ';
                    $dados['formCad_error']['tipo']['class'] = 'has-error';
                }
                if (!empty($_POST['nDuracao']) && isset($_POST['nDuracao'])) {
                    $arrayCad['duracao'] = $_POST['nDuracao'];
                } else {
                    $dados['formCad_error']['duracao']['msg'] = 'Informe a duração ';
                    $dados['formCad_error']['duracao']['class'] = 'has-error';
                }
                $arrayCad['descricao'] =  filter_input(INPUT_POST, "nDescricao", FILTER_SANITIZE_SPECIAL_CHARS);
                $dados['formCad'] = $arrayCad;
                if (isset($dados['formCad_error']) && !empty($dados['formCad_error'])) {
                    $dados['erro'] = array('class' => 'alert-danger', 'msg' => ' <span class = "glyphicon glyphicon-remove"></span> Preenchar os campos obrigatórios.');
                } else {
                    $resultado = $crudModel->create("INSERT INTO manutencao_desvio (manutencao_id, ordem, tipo, duracao, descricao) VALUES (:manutencao_id, :ordem, :tipo, :duracao, :descricao)", $arrayCad);
                    if ($resultado) {
                        $crudModel->update("UPDATE manutencao SET status_id=3 WHERE id=:id", array("id" => $arrayCad['manutencao_id']));
                        $_SESSION['tipo_acao'] = true;
                        $url = BASE_URL . '/cadastrar/desvio/' . $cod;
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
