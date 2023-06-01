<?php

/**
 * A classe 'excluirrController' é responsável para fazer o gerenciamento na exclusão  de cooperados, historico, mensalidade, lucro, despesa, investimento e usuario
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe excluirController
 */
class excluirController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela é chama a função cooperado();
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index($cod) {
        $this->aluno($cod);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de excluir no cooperado.
     * @param int $cod- código do cooperado registrada no banco
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function aluno($cod) {
        if ($this->checkUser() >= 3 && intval($cod) > 0) {
            $coopeadoModel = new aluno();
            $aluno = $coopeadoModel->read_specific('SELECT * FROM aluno WHERE cod =:cod AND cod_instituicao=:cod_instituicao', array('cod' => addslashes($cod), 'cod_instituicao' => $this->getCodInstituicao()));
            $coopeadoModel->delete_image($aluno['imagem']);
            $coopeadoModel->remove("DELETE FROM avaliacao_fisica WHERE cod_aluno=:cod", array('cod' => addslashes($cod)));
            $coopeadoModel->remove("DELETE FROM aluno WHERE cod=:cod", array('cod' => addslashes($cod)));
            $url = BASE_URL . "/relatorio/aluno";
            header("Location: " . $url);
        } else {
            $url = BASE_URL . '/home';
            header("Location: " . $url);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de excluir avaliação fisica.
     * @access public
     * @param int $cod_aluno - código do historico registrada no banco
     * @param int $cod - código do historico registrada no banco
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function avaliacao_fisica($cod_aluno, $cod) {
        if ($this->checkUser() >= 3 && intval($cod) > 0) {
            $crudModel = new crud_db();
            $resultado = $crudModel->remove("DELETE FROM avaliacao_fisica WHERE cod=:cod", array('cod' => addslashes($cod)));
            if ($resultado) {
                $url = BASE_URL . "/aluno/index/" . $cod_aluno;
                header("Location: " . $url);
            }
        } else {
            $url = BASE_URL . '/home';
            header("Location: " . $url);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de excluir uma turma.
     * @param int $cod - código do lucro registrada no banco
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function turma($cod) {
        if ($this->checkUser() >= 3 && intval($cod) > 0) {
            $crudModel = new crud_db();
            $alunoModel = new aluno();
            $alunos = $alunoModel->read('SELECT * FROM aluno WHERE cod_turma =:cod and cod_instituicao=:cod_instituicao', array('cod' => addslashes($cod), 'cod_instituicao' => $this->getCodInstituicao()));
            if (!empty($alunos)) {
                foreach ($alunos as $index) {
                    $alunoModel->delete_image($index['imagem']);
                    $alunoModel->remove("DELETE FROM avaliacao_fisica WHERE cod_aluno=:cod", array('cod' => $index['cod']));
                }
            }
            $alunoModel->remove("DELETE FROM aluno WHERE cod_turma=:cod and cod_instituicao=:cod_instituicao", array('cod' => addslashes($cod), 'cod_instituicao' => $this->getCodInstituicao()));
            $removeFinanca = $crudModel->remove("DELETE FROM turma WHERE cod=:cod and cod_instituicao=:cod_instituicao", array('cod' => addslashes($cod), 'cod_instituicao' => $this->getCodInstituicao()));
            if ($removeFinanca) {
                $_SESSION['financa_atual'] = array();
                $url = BASE_URL . "/relatorio/turma";
                header("Location: " . $url);
            }
        } else {
            $url = BASE_URL . '/home';
            header("Location: " . $url);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controle nas ações de excluir usuario.
     * @param int $cod_usuario - código do usuario registrada no banco
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function usuario($cod_usuario) {
        if ($this->checkUser() >= 3 && intval($cod_usuario) > 0) {
            $usuarioModel = new usuario();
            $usuarioModel->remove(array('cod' => addslashes($cod_usuario)));
            $url = BASE_URL . "/usuario/index";
            header("Location: " . $url);
        } else {
            $url = BASE_URL . "/usuario/index";
            header("Location: " . $url);
        }
    }

}
