<?php

/**
 * A classe 'relatorioController' é responsável para fazer o carregamento das views relacionado a relatorios e validações de exibição de campos
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe relatorioController
 */
class relatorioController extends controller
{

    /**
     * Está função pertence a uma action do controle MVC, ela chama a  função alunos();
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index()
    {
        $this->manutencao();
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responsável para mostra todas os manutencao.
     * @param int $page - paginação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function manutencao($page = 1)
    {
        if ($this->checkUser() >= 2) {
            $view = "manutencao/relatorio";
            $dados = array();
            $alunoModel = new aluno();
            $crudModel = new crud_db();
            $dados['celula'] = $crudModel->read("SELECT * FROM celula");
            $dados['status'] = $crudModel->read("SELECT * FROM manutencao_status");
            $dados['modo_exebicao'] = 1;
            $campos_buscar = array();
            if (isset($_POST['nBuscarBT'])) {
                $sql = "SELECT  m.*, s.status, s.class_color FROM manutencao AS m INNER JOIN manutencao_status AS s WHERE m.status_id=s.id ";
                $filtro = array();
                //curso
                if (isset($_POST['nCurso']) && !empty($_POST['nCurso'])) {
                    $sql = $sql . " AND t.curso = :curso ";
                    $filtro['curso'] = addslashes($_POST['nCurso']);
                    $campos_buscar['curso'] = addslashes($_POST['nCurso']);
                } else {
                    $campos_buscar['curso'] = 'Todos';
                }
                //turma
                if (isset($_POST['nTurma']) && !empty($_POST['nTurma'])) {
                    $sql = $sql . " AND a.cod_turma = :cod_turma ";
                    $filtro['cod_turma'] = addslashes($_POST['nTurma']);
                    $turma = $crudModel->read_specific('SELECT * FROM turma WHERE cod=:cod', array('cod' => $_POST['nTurma']));
                    $campos_buscar['turma'] = $turma['turma'];
                } else {
                    $campos_buscar['turma'] = 'Todas';
                }
                //nGenero
                if (isset($_POST['nGenero']) && !empty($_POST['nGenero'])) {
                    $sql = $sql . " AND a.genero = :genero ";
                    $filtro['genero'] = addslashes($_POST['nGenero']);
                    $campos_buscar['genero'] = addslashes($_POST['nGenero']);
                } else {
                    $campos_buscar['genero'] = 'Todos';
                }
                //nCor
                if (isset($_POST['nCor']) && !empty($_POST['nCor'])) {
                    $sql = $sql . " AND a.cor = :cor ";
                    $filtro['cor'] = addslashes($_POST['nCor']);
                    $campos_buscar['cor'] = addslashes($_POST['nCor']);
                } else {
                    $campos_buscar['cor'] = 'Todos';
                }
                //nIntensidadeFisica
                if (isset($_POST['nIntensidadeFisica']) && !empty($_POST['nIntensidadeFisica'])) {
                    $sql = $sql . " AND a.intensidade_fisica = :intensidade_fisica ";
                    $filtro['intensidade_fisica'] = addslashes($_POST['nIntensidadeFisica']);
                    $campos_buscar['intensidade_fisica'] = addslashes($_POST['nIntensidadeFisica']);
                } else {
                    $campos_buscar['intensidade_fisica'] = 'Todos';
                }
                //objetivo
                if (isset($_POST['nObjetivo']) && !empty($_POST['nObjetivo'])) {
                    $sql = $sql . " AND a.objetivo = :objetivo ";
                    $filtro['objetivo'] = addslashes($_POST['nObjetivo']);
                    $campos_buscar['objetivo'] = addslashes($_POST['nObjetivo']);
                } else {
                    $campos_buscar['objetivo'] = 'Todos';
                }

                if (isset($_POST['nPor']) && !empty($_POST['nPor']) && !empty($_POST['nBuscar'])) {
                    switch ($_POST['nPor']) {
                        case 'Nome':
                            $sql = $sql . " AND a.nome LIKE '%" . addslashes($_POST['nBuscar']) . "%' ";
                            break;
                        case 'Fumante':
                            $sql = $sql . " AND a.fumante LIKE '%" . addslashes($_POST['nBuscar']) . "%' ";
                            break;
                        case 'Alergico':
                            $sql = $sql . " AND a.alergia LIKE '%" . addslashes($_POST['nBuscar']) . "%' ";
                            break;
                        case 'Lesão':
                            $sql = $sql . " AND a.lesao LIKE '%" . addslashes($_POST['nBuscar']) . "%' ";
                            break;
                        case 'Medicamento Controlado':
                            $sql = $sql . " AND a.medicamento LIKE '%" . addslashes($_POST['nBuscar']) . "%' ";
                            break;
                        case 'Número de refeições diárias':
                            $sql = $sql . " AND a.refeicoes LIKE '%" . addslashes($_POST['nBuscar']) . "%' ";
                            break;
                        case 'Bebidas':
                            $sql = $sql . " AND a.bebidas LIKE '%" . addslashes($_POST['nBuscar']) . "%' ";
                            break;
                        case 'Praticante de atividades físicas semanais':
                            $sql = $sql . " AND a.atividade_fisica LIKE '%" . addslashes($_POST['nBuscar']) . "%' ";
                            break;
                        default:
                            break;
                    }
                    $campos_buscar['por'] = $_POST['nPor'];
                    $campos_buscar['campo'] = $_POST['nBuscar'];
                } else {
                    $campos_buscar['por'] = 'Todos';
                    $campos_buscar['campo'] = '';
                }
                $dados['manutencao'] = $alunoModel->read($sql, $filtro);
                //modo de exebição
                $dados['modo_exebicao'] = $_POST['nModoExibicao'];

                if ($_POST['nModoPDF'] == 1) {
                    $viewPDF = "aluno/relatorio_pdf";
                    $dadosPDF = array();
                    $dadosPDF['busca'] = $campos_buscar;
                    $dadosPDF['cidade'] = $crudModel->read_specific('SELECT * FROM instituicao WHERE cod=:cod', array('cod' => $this->getCodInstituicao()));
                    $dadosPDF['manutencao'] = $dados['alunos'];
                    ob_start();
                    $this->loadView($viewPDF, $dadosPDF);
                    $html = ob_get_contents();
                    ob_end_clean();
                    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
                    $mpdf->WriteHTML($html);
                    $arquivo = 'manutencao' . date('d_m_Y.') . 'pdf';
                    $mpdf->Output($arquivo, 'I');
                }
            } else {
                $dados['manutencao'] = $alunoModel->read('SELECT m.*, s.status, s.class_color FROM manutencao AS m INNER JOIN manutencao_status AS s WHERE m.status_id=s.id ORDER BY m.id DESC');
            }
            $this->loadTemplate($view, $dados);
        } else {
            $url = BASE_URL . '/home';
            header("Location: " . $url);
        }
    }
}
