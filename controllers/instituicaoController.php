<?php

class instituicaoController extends controller {

    public function index($cod) {
        if ($this->checkUser() >= 3 && intval($cod) > 0) {
            $viewName = 'instituicao';
            $dados = array();
            $crudModel = new crud_db();
            $dados['cidade'] = $crudModel->read("SELECT * FROM instituicao WHERE cod=:cod", array('cod' => addslashes($cod)));
            $dados['cidade'] = $dados['cidade'][0];

            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                $formCad = array(
                    'nome_siglas' => addslashes($_POST['nAbrevicao']),
                    'nome_completo' => addslashes($_POST['nNome']),
                    'cnpj' => $_POST['nCNPJ'],
                    'endereco' => addslashes($_POST['nEndereco']),
                    'cep' => addslashes($_POST['nCEP']),
                    'telefone' => addslashes($_POST['nTelefone']),
                    'email' => addslashes($_POST['nEmail']),
                    'url_site' => addslashes($_POST['nUrl']),
                    'cod' => addslashes($cod)
                );
                $dados['cidade'] = $formCad;
                $resultado = $crudModel->create("UPDATE instituicao SET nome_siglas=:nome_siglas, nome_completo=:nome_completo, cnpj=:cnpj, endereco=:endereco, cep=:cep, telefone=:telefone, email=:email, url_site=:url_site WHERE cod=:cod", $formCad);
                if ($resultado) {
                    $_SESSION['cooperativa_acao'] = true;
                    $url = BASE_URL . '/instituicao/index/' . $cod;
                    header('location: ' . $url);
                }
            } else if (isset($_SESSION['cooperativa_acao']) && !empty($_SESSION['cooperativa_acao'])) {
                $_SESSION['cooperativa_acao'] = false;
                $dados['erro'] = array('class' => 'alert-success', 'msg' => "Alteração realizada com sucesso!");
            }
            if (!empty($dados['cidade'])) {
                $this->loadTemplate($viewName, $dados);
            } else {
                $url = BASE_URL . '/home';
                header('location: ' . $url);
            }
        } else {
            $url = BASE_URL . '/home';
            header('location: ' . $url);
        }
    }

}

?>