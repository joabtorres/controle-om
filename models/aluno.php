<?php

/**
 * A classe 'cooperado' é responsável para efetiva comandos sql no banco de dados, como, insert, update, select, delete, count;
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2018, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package models
 * @example classe cooperado
 */
class aluno extends model {

    /**
     * String $numRows - referente q quantidade de linhas obtidas no select;
     * @access private
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    private $numRows;

    /**
     * Está função tem como objetivo retorna a quantidade de registro encontrados armazenados na variavel $numRows
     * @access public
     * @return int
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function getNumRows() {
        return 0;
    }

    /**
     * Está função é responsável para cadastrar novos registros;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return boolean 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function create($data) {
        try {
            $sql = $this->db->prepare('INSERT INTO aluno(cod, cod_instituicao, cod_turma, nome, nascimento, genero, altura, cor, pressao, frequencia_cardiaca, glicose, fumante, alergia, qual_alergia, doenca, qual_doenca, doenca_na_familia, qual_doenca_na_familia, lesao, qual_lesao, medicamento, qual_medicamento, refeicoes, bebidas, atividade_fisica, qual_atividade_fisica, intensidade_fisica, suplemento, qual_suplemento, objetivo, imagem) VALUES (:cod, :cod_instituicao, :cod_turma, :nome, :nascimento, :genero, :altura, :cor, :pressao, :frequencia_cardiaca, :glicose, :fumante, :alergia, :qual_alergia, :doenca, :qual_doenca, :doenca_na_familia, :qual_doenca_na_familia,:lesao, :qual_lesao, :medicamento, :qual_medicamento, :refeicoes, :bebidas, :atividade_fisica, :qual_atividade_fisica, :intensidade_fisica, :suplemento, :qual_suplemento, :objetivo, :imagem)');
            $sql->bindValue(":cod", $data['cod']);
            $sql->bindValue(":cod_instituicao", $data['cod_instituicao']);
            $sql->bindValue(":cod_turma", $data['cod_turma']);
            $sql->bindValue(":nome", $data['nome']);
            $sql->bindValue(":nascimento", $data['nascimento']);
            $sql->bindValue(":genero", $data['genero']);
            $sql->bindValue(":altura", $data['altura']);
            $sql->bindValue(":cor", $data['cor']);
            $sql->bindValue(":pressao", $data['pressao']);
            $sql->bindValue(":frequencia_cardiaca", $data['frequencia_cardiaca']);
            $sql->bindValue(":glicose", $data['glicose']);
            $sql->bindValue(":fumante", $data['fumante']);
            $sql->bindValue(":alergia", $data['alergia']);
            $sql->bindValue(":qual_alergia", $data['qual_alergia']);
            $sql->bindValue(":doenca", $data['doenca']);
            $sql->bindValue(":qual_doenca", $data['qual_doenca']);
            $sql->bindValue(":doenca_na_familia", $data['doenca_na_familia']);
            $sql->bindValue(":qual_doenca_na_familia", $data['qual_doenca_na_familia']);
            $sql->bindValue(":lesao", $data['lesao']);
            $sql->bindValue(":qual_lesao", $data['qual_lesao']);
            $sql->bindValue(":medicamento", $data['medicamento']);
            $sql->bindValue(":qual_medicamento", $data['qual_medicamento']);
            $sql->bindValue(":refeicoes", $data['refeicoes']);
            $sql->bindValue(":bebidas", $data['bebidas']);
            $sql->bindValue(":atividade_fisica", $data['atividade_fisica']);
            $sql->bindValue(":qual_atividade_fisica", $data['qual_atividade_fisica']);
            $sql->bindValue(":intensidade_fisica", $data['intensidade_fisica']);
            $sql->bindValue(":suplemento", $data['suplemento']);
            $sql->bindValue(":qual_suplemento", $data['qual_suplemento']);
            $sql->bindValue(":objetivo", $data['objetivo']);
            $sql->bindValue(":imagem", $data['imagem']);
            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo '<script>alert("' . $ex->getMessage() . '")</script>';
        }
    }

    /**
     * Está função é responsável para consultas no banco e retorna os resultados obtidos;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return array $sql->fetchAll() [caso encontre] | bollean FALSE [caso contrário] 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function read($sql_command, $data = array()) {
        if (!empty($data)) {
            $sql = $this->db->prepare($sql_command);
            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();
        } else {
            $sql = $this->db->query($sql_command);
        }
        if ($sql->rowCount() > 0) {
            $this->numRows = $sql->rowCount();
            return $sql->fetchAll();
        } else {
            $this->numRows = 0;
            return FALSE;
        }
    }

    /**
     * Está função é responsável para consultas no banco e retorna os resultados obtidos;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return array $sql->fetch() [caso encontre] | bollean FALSE [caso contrário] 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function read_specific($sql_command, $data = array()) {
        if (!empty($data)) {
            $sql = $this->db->prepare($sql_command);

            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();
        } else {
            $sql = $this->db->query($sql_command);
        }
        if ($sql->rowCount() > 0) {
            $this->numRows = $sql->rowCount();
            return $sql->fetch();
        } else {
            $this->numRows = 0;
            return FALSE;
        }
    }

    /**
     * Está função é responsável para altera um registro específico;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return bollean TRUE ou FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function update($data) {
        try {
            $sql = $this->db->prepare('UPDATE aluno SET cod_instituicao=:cod_instituicao, cod_turma=:cod_turma, nome=:nome, nascimento=:nascimento, genero=:genero, altura=:altura, cor=:cor, pressao=:pressao, frequencia_cardiaca=:frequencia_cardiaca, glicose=:glicose, fumante=:fumante, alergia=:alergia, qual_alergia=:qual_alergia, doenca=:doenca, qual_doenca=:qual_doenca, doenca_na_familia=:doenca_na_familia, qual_doenca_na_familia=:qual_doenca_na_familia, lesao=:lesao, qual_lesao=:qual_lesao, medicamento=:medicamento, qual_medicamento=:qual_medicamento, refeicoes=:refeicoes, bebidas=:bebidas, atividade_fisica=:atividade_fisica, qual_atividade_fisica=:qual_atividade_fisica, intensidade_fisica=:intensidade_fisica, suplemento=:suplemento, qual_suplemento=:qual_suplemento, objetivo=:objetivo, imagem=:imagem WHERE cod=:cod');
            $sql->bindValue(":cod_instituicao", $data['cod_instituicao']);
            $sql->bindValue(":cod_turma", $data['cod_turma']);
            $sql->bindValue(":nome", $data['nome']);
            $sql->bindValue(":nascimento", $data['nascimento']);
            $sql->bindValue(":genero", $data['genero']);
            $sql->bindValue(":altura", $data['altura']);
            $sql->bindValue(":cor", $data['cor']);
            $sql->bindValue(":pressao", $data['pressao']);
            $sql->bindValue(":frequencia_cardiaca", $data['frequencia_cardiaca']);
            $sql->bindValue(":glicose", $data['glicose']);
            $sql->bindValue(":fumante", $data['fumante']);
            $sql->bindValue(":alergia", $data['alergia']);
            $sql->bindValue(":qual_alergia", $data['qual_alergia']);
            $sql->bindValue(":doenca", $data['doenca']);
            $sql->bindValue(":doenca_na_familia", $data['doenca_na_familia']);
            $sql->bindValue(":qual_doenca_na_familia", $data['qual_doenca_na_familia']);
            $sql->bindValue(":qual_doenca", $data['qual_doenca']);
            $sql->bindValue(":lesao", $data['lesao']);
            $sql->bindValue(":qual_lesao", $data['qual_lesao']);
            $sql->bindValue(":medicamento", $data['medicamento']);
            $sql->bindValue(":qual_medicamento", $data['qual_medicamento']);
            $sql->bindValue(":refeicoes", $data['refeicoes']);
            $sql->bindValue(":bebidas", $data['bebidas']);
            $sql->bindValue(":atividade_fisica", $data['atividade_fisica']);
            $sql->bindValue(":qual_atividade_fisica", $data['qual_atividade_fisica']);
            $sql->bindValue(":intensidade_fisica", $data['intensidade_fisica']);
            $sql->bindValue(":suplemento", $data['suplemento']);
            $sql->bindValue(":qual_suplemento", $data['qual_suplemento']);
            $sql->bindValue(":objetivo", $data['objetivo']);
            $sql->bindValue(":imagem", $data['imagem']);
            $sql->bindValue(":cod", $data['cod']);
            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo '<script>alert("' . $ex->getMessage() . '")</script>';
        }
    }

    /**
     * Está é responsável excluir um registro específico
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return boolean TRUE or FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function remove($sql_command, $data) {
        $sql = $this->db->prepare($sql_command);
        foreach ($data as $indice => $valor) {
            $sql->bindValue(":" . $indice, $valor);
        }
        $sql->execute();
        return true;
    }

    /**
     * Está função é responsável para salva uma imágem no diretório uploads/cooperados/
     * @access public
     * @return boolean TRUE or FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function save_image($file) {
        $imagem = array();
        $largura = 150;
        $altura = 200;
        $imagem['temp'] = $file['tmp_name'];
        $imagem['extensao'] = explode(".", $file['name']);
        $imagem['extensao'] = strtolower(end($imagem['extensao']));
        $imagem['name'] = md5(rand(1000, 900000) . time()) . '.' . $imagem['extensao'];
        $imagem['diretorio'] = 'uploads/alunos';
        if ($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg' || $imagem['extensao'] == 'png') {

            list($larguraOriginal, $alturaOriginal) = getimagesize($imagem['temp']);

            $ratio = max($largura / $larguraOriginal, $altura / $alturaOriginal);
            $alturaOriginal = $altura / $ratio;
            $x = ($larguraOriginal - $largura / $ratio) / 2;
            $larguraOriginal = $largura / $ratio;

            $imagem_final = imagecreatetruecolor($largura, $altura);

            if ($imagem['extensao'] == 'jpg' || $imagem['extensao'] == 'jpeg') {
                $imagem_original = imagecreatefromjpeg($imagem['temp']);
                imagecopyresampled($imagem_final, $imagem_original, 0, 0, $x, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);
                imagejpeg($imagem_final, $imagem['diretorio'] . "/" . $imagem['name'], 90);
            } else if ($imagem['extensao'] == 'png') {
                $imagem_original = imagecreatefrompng($imagem['temp']);
                imagecopyresampled($imagem_final, $imagem_original, 0, 0, $x, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);
                imagepng($imagem_final, $imagem['diretorio'] . "/" . $imagem['name']);
            }
            return $imagem['diretorio'] . "/" . $imagem['name'];
        } else {
            return null;
        }
    }

    /**
     * Está é responsável excluir uma imagem de usuário;
     * @param String $url_image - diretório do arquivo;
     * @access private
     * @return boolean TRUE or FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function delete_image($url_image) {
        if (file_exists($url_image)) {
            unlink($url_image);
            return true;
        } else {
            FALSE;
        }
    }

}
