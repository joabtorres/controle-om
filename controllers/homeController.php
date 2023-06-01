<?php

/**
 * A classe 'homeController' é responsável para fazer o carregamento da página home do sistema
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe homeController
 */
class homeController extends controller
{

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/home.php, desde que o usuário esteja logado no sistema
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index()
    {
        if ($this->checkUser() >= 1) {
            $view = "home";
            $dados = array();
            $crudModel = new crud_db();
            // $dados['alunos'] = $crudModel->read('SELECT a.*, t.turma, t.curso, COUNT(*) as qtd FROM aluno as a INNER JOIN turma as t WHERE t.cod=a.cod_turma and a.cod_instituicao=:cod GROUP BY t.turma ORDER BY qtd DESC', array('cod' => $this->getCodInstituicao()));
            // $resultado = $crudModel->read_specific('SELECT COUNT(*) as qtd FROM aluno where cod_instituicao=:cod', array('cod' => $this->getCodInstituicao()));
            $dados['totalAluno'] = 0;
            if (!empty($resultado)) {
                $dados['totalAluno'] = $resultado['qtd'];
            }
            $this->loadTemplate($view, $dados);
        } else {
            $_SESSION = array();
            $url = BASE_URL . '/login';
            header("Location: " . $url);
        }
    }
}
