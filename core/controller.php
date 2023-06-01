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
class controller {

    /**
     * Está função verifica se a $_SESSION['usuario_sessao'] está inicializada, caso esteja então verifica se o usuario tem permissao de acesso e sua conta esteja ativa.
     * @return int 
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function checkUser() {
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

    public function ajustaHorario() {
        return 3600 * 5; //360 sec *  horas 
    }

    public function getporcentagem($valorInicial, $valorTotal) {
        return ($valorInicial / $valorTotal) * 100;
    }

    /**
     * Está função é responsável para carrega uma view;
     * @param String viewName - nome da view;
     * @param array $viewData - Dados para serem carregados na view
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function loadView($viewName, $viewData = array()) {
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
    public function loadTemplate($viewName, $viewData = array()) {
        include 'views/template.php';
    }

    /**
     * Está função é responsável para carrega uma view dinamica dentro de um template estático
     * @param String viewName - nome da view;
     * @param array $viewData - Dados para serem carregados na view
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function loadViewInTemplate($viewName, $viewData = array()) {
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
    protected function formatDateView($date) {
        $arrayDate = explode("-", $date);
        if (count($arrayDate) == 3) {
            return $arrayDate[2] . '/' . $arrayDate[1] . '/' . $arrayDate[0];
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
    protected function formatDateBD($date) {
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
    protected function getCodInstituicao() {
        if (isset($_SESSION['usuario_sessao']) && !empty($_SESSION['usuario_sessao']['cod_instituicao'])) {
            return $_SESSION['usuario_sessao']['cod_instituicao'];
        } else {
            return 0;
        }
    }

    protected function calcularIdade($dataNascimento) {
        $data = $dataNascimento;
        // separando yyyy, mm, ddd
        list($ano, $mes, $dia) = explode('-', $data);
        // data atual
        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        // Descobre a unix timestamp da data de nascimento do fulano
        $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
        // cálculo
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
        return "$idade anos";
    }

    protected function removeZeroEsquerda($valor) {
        $array = explode(" ", $valor);
        $array[0] = doubleval($array[0]);
        return $array[0] . ' ' . $array[1];
    }

    protected function calcularIMC($peso, $altura) {
        $array = explode(" ", $peso);
        $pesoIMC = doubleval($array[0]);
        $array = explode(" ", $altura);
        $alturaIMC = doubleval($array[0]);
        $imc = $pesoIMC / ($alturaIMC * $alturaIMC);
        return number_format($imc, 2, '.', '');
    }

    protected function calcularDeficitCalorico($genero, $idade, $peso) {
        $dc = 0;
        $arrayPeso = explode(" ", $peso);
        $arrayIdade = explode(" ", $idade);
        $peso = doubleval($arrayPeso[0]); //kg
        $idade = doubleval($arrayIdade[0]); //anos
        switch ($genero) {
            case 'Femenino':
                if ($idade >= 10 && $idade <= 18) {
                    $dc = (12.2 * $peso) + 746;
                } else if ($idade >= 19 && $idade <= 30) {
                    $dc = (14.7 * $peso) + 496;
                } else if ($idade >= 31 && $idade <= 60) {
                    $dc = (8.7 * $peso) + 829;
                } else if ($idade > 60) {
                    $dc = (10.5 * $peso) + 596;
                }
                break;
            default:
                if ($idade >= 10 && $idade <= 18) {
                    $dc = (17.5 * $peso) + 651;
                } else if ($idade >= 19 && $idade <= 30) {
                    $dc = (15.3 * $peso) + 679;
                } else if ($idade >= 31 && $idade <= 60) {
                    $dc = (11.6 * $peso) + 879;
                } else if ($idade > 60) {
                    $dc = (13.5 * $peso) + 487;
                }
                break;
        }
        return number_format($dc, 2, '.', '');
    }

    protected function calcularTaxaMetabolicaBasal($genero, $peso, $altura, $idade) {
        $tmb = 0;
        $arrayPeso = explode(" ", $peso);
        $arrayAltura = explode(" ", $altura);
        $arrayIdade = explode(" ", $idade);
        $valorpeso = doubleval($arrayPeso[0]); //kg
        $valoraltura = doubleval($arrayAltura[0]); //m
        $valorIdade = doubleval($arrayIdade[0]); //anos

        switch ($genero) {
            case 'Femenino':
                $tmb = 66 + (13.7 * $valorpeso) + (5.0 * $valoraltura) - (6.8 * $valorIdade);
                break;
            default:
                $tmb = 665 + (9.6 * $valorpeso) + (1.8 * $valoraltura) - (4.7 * $valorIdade);
                break;
        }
        return number_format($tmb, 2, '.', '');
    }

    protected function calcularMassaResidual($peso, $genero) {
        $array = explode(" ", $peso);
        $peso = doubleval($array[0]);
        $massaResidual = 0;
        switch ($genero) {
            case 'Femenino':
                $massaResidual = $peso * 0.209;
                break;
            default:
                $massaResidual = $peso * 0.241;
                break;
        }
        return number_format($massaResidual, 2, '.', '');
    }

    protected function calcularMassaOssea($altura, $diamentroPunho, $diametroFemu) {
        $massaOssea = 0;
        $arrayPunho = explode(" ", $diamentroPunho);
        $arrayFemu = explode(" ", $diametroFemu);
        $arrayAltura = explode(" ", $altura);
        $valorAltura = doubleval($arrayAltura[0]); //kg
        $valorPunho = doubleval($arrayPunho[0]); //cm
        $valorFemu = doubleval($arrayFemu[0]); //cmd
        $valorPunho = $valorPunho / 100; //m
        $valorFemu = $valorFemu / 100; //m

        $massaOssea = 3.02 * ((($valorAltura ** 2) * $valorPunho * $valorFemu * 400) ** 0.712);
        return number_format($massaOssea, 2, '.', '');
    }

    protected function calcularMassaMuscular($peso, $massaGorda, $massaOssea, $massaResidual) {
        $massaMuscular = 0;
        $arrayPeso = explode(" ", $peso);
        $peso = doubleval($arrayPeso[0]); // em m
        $massaMuscular = $peso - ($massaGorda + $massaOssea + $massaResidual);
        return number_format($massaMuscular, 2, '.', '');
    }

    protected function calcularMassaMagra($peso, $percentualGordura) {
        $massamagra = 0;
        $array = explode(" ", $peso);
        $peso = doubleval($array[0]);
        $array = explode(" ", $percentualGordura);
        $percentualGordura = doubleval($array[0]);
        $percentualGordura = $percentualGordura / 100; //converte de metro para cm
        $massamagra = $peso * $percentualGordura;
        $valorTotal = $peso - $massamagra;
        return number_format($valorTotal, 2, '.', '');
    }

    protected function calcularMassaGorda($peso, $percentualGordura) {
        $massaGorda = 0;
        $array = explode(" ", $peso);
        $peso = doubleval($array[0]);
        $array = explode(" ", $percentualGordura);
        $percentualGordura = doubleval($array[0]);
        $percentualGordura = $percentualGordura / 100; //converte de metro para cm
        $massaGorda = $peso * $percentualGordura;
        return number_format($massaGorda, 2, '.', '');
    }

    protected function percentualDeGorduraCorporal($imc, $idade, $genero) {
        $bt = 0;
        $array = explode(" ", $idade);
        $idade = doubleval($array[0]);
        $array = explode(" ", $imc);
        $imc = doubleval($array[0]);
        switch ($genero) {
            case 'Femenino':
                $bt = (1.20 * $imc) + (0.23 * $idade) - (10.8 * 0) - 5.4;
                break;
            default:
                $bt = (1.20 * $imc) + (0.23 * $idade) - (10.8 * 1) - 5.4;
                break;
        }
        return number_format($bt, 2, '.', '');
    }

}
