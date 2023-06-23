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
class excluirController extends controller
{

    /**
     * Está função pertence a uma action do controle MVC, ela é chama a função cooperado();
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index($cod)
    {
        $this->aluno($cod);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de excluir no cooperado.
     * @param int $cod- código do cooperado registrada no banco
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function aluno($cod)
    {
        if ($this->checkUser()) {
            $crudModel = new crud_db();
            $crudModel->remove("DELETE FROM manutencao_desvio WHERE manutencao_id=:cod", array('cod' => addslashes($cod)));
            $crudModel->remove("DELETE FROM manutencao_encerra WHERE manutencao_id=:cod", array('cod' => addslashes($cod)));
            $crudModel->remove("DELETE FROM manutencao WHERE id=:cod", array('cod' => addslashes($cod)));
            $url = BASE_URL . "/relatorio/manutencao";
            header("Location: " . $url);
        } else {
            $url = BASE_URL . '/home';
            header("Location: " . $url);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de excluir avaliação fisica.
     * @access public
     * @param int $cod_manutencao - código do historico registrada no banco
     * @param int $cod - código do historico registrada no banco
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function desvio($cod_manutencao, $cod)
    {
        if ($this->checkUser()) {
            $crudModel = new crud_db();
            $resultado = $crudModel->remove("DELETE FROM manutencao_desvio WHERE id=:cod", array('cod' => addslashes($cod)));
            if ($resultado) {
                $url = BASE_URL . "/manutencao/index/{$cod_manutencao}";
                header("Location: {$url}");
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
    public function encerrar($cod_manutencao, $cod)
    {
        if ($this->checkUser()) {
            $crudModel = new crud_db();
            $resultado = $crudModel->remove("DELETE FROM manutencao_encerra WHERE id=:cod", array('cod' => addslashes($cod)));
            if ($resultado) {
                $url = BASE_URL . "/manutencao/index/{$cod_manutencao}";
                header("Location: {$url}");
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
    public function usuario($cod_usuario)
    {
        if ($this->checkUser()) {
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
