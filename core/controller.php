<?php

/**
 * A classe 'controller' é responsável por fazer o carregamento das views, concebe paginação e verifica nível de usuário
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2018, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package core
 * @example classe controller
 */
class controller
{

    /**
     * Está função verifica se a $_SESSION['usuario_sessao'] está inicializada, caso esteja então verifica se o usuario tem permissao de acesso e sua conta esteja ativa.
     * @return int 
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function checkUser()
    {
        if (isset($_SESSION['usuario_sessao']) && is_array($_SESSION['usuario_sessao']) && isset($_SESSION['usuario_sessao']['statu'])) {
            if ($_SESSION['usuario_sessao']['statu'] == 1) {
                return $_SESSION['usuario_sessao']['nivel'];
            }
        } else {
            $url = BASE_URL . '/login';
            header("Location: " . $url);
            return 0;
        }
    }

    public function ajustaHorario()
    {
        return 3600 * 5; //360 sec *  horas 
    }

    public function getporcentagem($valorInicial, $valorTotal)
    {
        return ($valorInicial / $valorTotal) * 100;
    }

    /**
     * Está função é responsável para carrega uma view;
     * @param String viewName - nome da view;
     * @param array $viewData - Dados para serem carregados na view
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function loadView($viewName, $viewData = array())
    {
        extract($viewData);
        include 'views/' . $viewName . ".php";
    }

    /**
     * Está função é responsável para carrega um template estático, a onde ela chama chama uma função lo;
     * @param String viewName - nome da view;
     * @param array $viewData - Dados para serem carregados na view
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function loadTemplate($viewName, $viewData = array())
    {
        include 'views/template.php';
    }

    /**
     * Está função é responsável para carrega uma view dinamica dentro de um template estático
     * @param String viewName - nome da view;
     * @param array $viewData - Dados para serem carregados na view
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function loadViewInTemplate($viewName, $viewData = array())
    {
        extract($viewData);
        include 'views/' . $viewName . ".php";
    }

    /**
     * Está função é responsável para converte uma data do padrão 'ano-mes-dia' para 'dia/mes/ano'
     * @param String $date - data solicitada pelo parametro
     * r
     * @access protected
     * @return $date - data formatada no padrão brasileiro
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function formatDateView($date)
    {
        $arrayDate = explode("-", $date);
        if (count($arrayDate) == 3) {
            return $arrayDate[2] . '/' . $arrayDate[1] . '/' . $arrayDate[0];
        } else {
            return false;
        }
    }

    protected function viewDateComplet($date)
    {
        $time = explode(" ", $date);
        $arrayDate = explode("-", $time[0]);
        if (count($arrayDate) == 3) {
            return $arrayDate[2] . '/' . $arrayDate[1] . '/' . $arrayDate[0] . ' ' . $time[1];
        } else {
            return false;
        }
    }

    /**
     * Está função é responsável para converte uma data do padrão 'dia/mes/ano' para 'ano-mes-dia'
     * @param String $date - data solicitada pelo parametro
     * r
     * @access protected
     * @return $date - data formatada no padrão banco MySQL
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function formatDateBD($date)
    {
        $arrayDate = explode("/", $date);
        if (count($arrayDate) == 3) {
            return $arrayDate[2] . '-' . $arrayDate[1] . '-' . $arrayDate[0];
        } else {
            return false;
        }
    }

    /**
     * Está função é responsável para retornar codigo da cooperativa;
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function getCodInstituicao()
    {
        if (isset($_SESSION['usuario_sessao']) && !empty($_SESSION['usuario_sessao']['cod_instituicao'])) {
            return $_SESSION['usuario_sessao']['cod_instituicao'];
        } else {
            return 0;
        }
    }
}
