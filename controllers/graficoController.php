<?php

class graficoController extends controller {

    public function aluno_objetivo() {
        if ($this->checkUser()) {
            $crud = new crud_db();
            $resultado = $crud->read("SELECT objetivo as label, COUNT(*) as data FROM aluno where cod_instituicao=:cod GROUP BY objetivo ", array('cod' => $this->getCodInstituicao()));
            echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
        }
    }

    public function aluno_genero() {
        if ($this->checkUser()) {
            $crud = new crud_db();
            $resultado = $crud->read("SELECT genero as label, COUNT(*) as data FROM aluno where cod_instituicao=:cod GROUP BY genero", array('cod' => $this->getCodInstituicao()));
            echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
        }
    }

}
