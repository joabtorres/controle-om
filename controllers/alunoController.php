<?php

/**
 * A classe 'unidadeController' é responsável para fazer o carregamento da unidade de forma detalhada
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe unidadeController
 */
class alunoController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/cooperado_detalhe.php com seus respectivos dados;
     * @param int $cod_unidade - código da unidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index($cod_aluno) {
        if ($this->checkUser() >= 2 && intval($cod_aluno) > 0) {
            $view = "aluno/perfil";
            $dados = array();
            $alunoModel = new aluno();
            $dados['aluno']['aluno'] = $alunoModel->read_specific('SELECT a.*, t.turma, t.curso FROM aluno as a INNER JOIN turma as t WHERE t.cod=a.cod_turma AND a.cod=:cod', array('cod' => addslashes($cod_aluno)));
            $dados['aluno']['avaliacao_fisica'] = $alunoModel->read('SELECT * FROM avaliacao_fisica where cod_aluno=:cod', array('cod' => addslashes($cod_aluno)));
            $this->loadTemplate($view, $dados);
        } else {
            header('Location: /home');
        }
    }

    public function pdf($cod_aluno) {
        if ($this->checkUser() && !empty($cod_aluno)) {
            $viewName = "aluno/perfil_pdf";
            $dados = array();
            $crudModel = new crud_db();
            $dados['cidade'] = $crudModel->read_specific('SELECT * FROM instituicao WHERE cod=:cod', array('cod' => $this->getCodInstituicao()));
            $dados['aluno'] = $crudModel->read_specific('SELECT a.*, t.turma, t.curso FROM aluno as a INNER JOIN turma as t WHERE t.cod=a.cod_turma AND a.cod=:cod', array('cod' => addslashes($cod_aluno)));
            $dados['aluno']['avaliacao_fisica'] = $crudModel->read('SELECT * FROM avaliacao_fisica where cod_aluno=:cod', array('cod' => addslashes($cod_aluno)));
            $this->loadView($viewName, $dados);
        } else {
            $url = "location: " . BASE_URL . "/home";
            header($url);
        }
    }

}
