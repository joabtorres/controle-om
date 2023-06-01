<?php

/*
 * config.php  - Este arquivo contem informações referente a: Conexão com banco de dados e URL Pádrão
 */

require 'environment.php';
//nome do projeto
define("NAME_PROJECT", "Controle de Ordem de Manutenção");
$config = array();
if (ENVIRONMENT == 'development') {
    //Raiz
    define("BASE_URL", "https://localhost/controle-om");
    //Nome do banco
    $config['dbname'] = 'control_om';
    //host
    $config['host'] = 'localhost';
    //usuario
    $config['dbuser'] = 'root';
    //senha
    $config['dbpass'] = '';
} else {
    //Raiz
    define("BASE_URL", "https://site.com.br");
    //Nome do banco
    $config['dbname'] = 'BANCO_DE_DADOS';
    //host
    $config['host'] = 'localhost';
    //usuario
    $config['dbuser'] = 'USUARIO_MYSQL';
    //senha
    $config['dbpass'] = 'SENHA_DO_USUÁRIO';
}
