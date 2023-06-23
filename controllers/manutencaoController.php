<?php

/**
 * A classe 'manutencaoController' é responsável para fazer o carregamento da unidade de forma detalhada
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe unidadeController
 */
class manutencaoController extends controller
{

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/cooperado_detalhe.php com seus respectivos dados;
     * @param int $cod_unidade - código da unidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index($id)
    {
        if ($this->checkUser()) {
            $view = "manutencao/perfil";
            $dados = array();
            $crudModel = new crud_db;
            $id = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
            $manutencao = $crudModel->read_specific("SELECT m.*, s.status, s.class_color FROM manutencao AS m INNER JOIN manutencao_status AS s WHERE m.status_id=s.id AND m.id=:id", ['id' => $id]);
            if (!empty($manutencao)) {
                $manutencao['desvio'] = $crudModel->read("SELECT * FROM manutencao_desvio WHERE manutencao_id='{$manutencao['id']}'");
                $manutencao['encerrar'] = $crudModel->read("SELECT * FROM manutencao_encerra WHERE manutencao_id='{$manutencao['id']}'");
                $dados['manutencao'] = $manutencao;
            } else {
                $url = "location: " . BASE_URL . "/home";
                header($url);
            }
            $this->loadTemplate($view, $dados);
        } else {
            header('Location: /home');
        }
    }

    public function pdf($id)
    {
        if ($this->checkUser() && !empty($id)) {
            $viewName = "aluno/perfil_pdf";
            $dados = array();
            $crudModel = new crud_db();
            $dados['cidade'] = $crudModel->read_specific('SELECT * FROM instituicao WHERE cod=:cod', array('cod' => $this->getCodInstituicao()));
            $dados['aluno'] = $crudModel->read_specific('SELECT a.*, t.turma, t.curso FROM aluno as a INNER JOIN turma as t WHERE t.cod=a.cod_turma AND a.cod=:cod', array('cod' => addslashes($id)));
            $dados['aluno']['avaliacao_fisica'] = $crudModel->read('SELECT * FROM avaliacao_fisica where cod_aluno=:cod', array('cod' => addslashes($id)));
            $this->loadView($viewName, $dados);
        } else {
            $url = "location: " . BASE_URL . "/home";
            header($url);
        }
    }
}
