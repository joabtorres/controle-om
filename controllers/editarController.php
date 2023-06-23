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
    public function desvio($cod)
    {
        if ($this->checkUser()) {
            $viewName = "manutencao/desvio/editar";
            $dados = array();
            $crudModel = new crud_db();
            $id = filter_var($cod, FILTER_SANITIZE_SPECIAL_CHARS);
            $resultado = $crudModel->read_specific("SELECT * FROM manutencao_desvio WHERE id =:id", ["id" => $id]);
            if (!is_array($resultado) && empty($resultado)) {
                $url = BASE_URL . '/home';
                header("Location: " . $url);
            }
            $aluno = $crudModel->read_specific("SELECT m.*, s.status, s.class_color FROM manutencao AS m INNER JOIN manutencao_status AS s WHERE m.status_id=s.id AND m.id=:id", ['id' => $resultado['manutencao_id']]);
            $dados['manutencao'] = $aluno;
            $dados['formCad'] = $resultado;
            $dados['tipo'] = $crudModel->read("SELECT * FROM manutencao_desvio_tipo");
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                $arrayCad = array();
                $arrayCad['id'] = $resultado['id'];
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
                    $resultado = $crudModel->update("UPDATE manutencao_desvio SET manutencao_id=:manutencao_id, ordem=:ordem, tipo=:tipo, duracao=:duracao, descricao=:descricao WHERE id=:id", $arrayCad);
                    if ($resultado) {
                        $crudModel->update("UPDATE manutencao SET status_id=3 WHERE id=:id", array("id" => $arrayCad['manutencao_id']));
                        $_SESSION['tipo_acao'] = true;
                        $url = BASE_URL . '/editar/desvio/' . $cod;
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
    public function encerrar($cod)
    {
        if ($this->checkUser()) {
            $viewName = "manutencao/encerrar/editar";
            $dados = array();
            $crudModel = new crud_db();
            $id = filter_var($cod, FILTER_SANITIZE_SPECIAL_CHARS);
            $resultado = $crudModel->read_specific("SELECT * FROM manutencao_encerra WHERE id=:id", ["id" => $id]);
            if (!is_array($resultado) && empty($resultado)) {
                $url = BASE_URL . '/home';
                header("Location: " . $url);
            }
            $aluno = $crudModel->read_specific("SELECT m.*, s.status, s.class_color FROM manutencao AS m INNER JOIN manutencao_status AS s WHERE m.status_id=s.id AND m.id=:id", ['id' => $resultado['manutencao_id']]);
            $dados['manutencao'] = $aluno;
            $dados['formCad'] = $resultado;
            $dados['manutencao'] = $aluno;
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                $arrayCad = array();
                $arrayCad['id'] = $resultado['id'];
                $arrayCad['manutencao_id'] =  filter_input(INPUT_POST, "nId", FILTER_VALIDATE_INT);
                $arrayCad['ordem'] =  filter_input(INPUT_POST, "nOrdem", FILTER_SANITIZE_SPECIAL_CHARS);
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
                    $resultado = $crudModel->update("UPDATE manutencao_encerra SET manutencao_id=:manutencao_id, ordem=:ordem, duracao=:duracao, descricao=:descricao WHERE id=:id", $arrayCad);
                    if ($resultado) {
                        $crudModel->update("UPDATE manutencao SET status_id=5 WHERE id=:id", array("id" => $arrayCad['manutencao_id']));
                        $_SESSION['tipo_acao'] = true;
                        $url = BASE_URL . '/editar/encerrar/' . $cod;
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
