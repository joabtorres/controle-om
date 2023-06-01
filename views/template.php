<?php ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/gif" href="<?php echo BASE_URL ?>/assets/imagens/icon.png" sizes="32x32" />
    <meta property="ogg:title" content="<?php echo NAME_PROJECT ?>">
    <meta property="ogg:description" content="<?php echo NAME_PROJECT ?>">
    <title><?php echo NAME_PROJECT ?></title>
    <!-- Bootstrap -->
    <link href="<?php echo BASE_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/fontawesome-all.min.css">
    <!-- Date datepicker CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/estilo.css">
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="<?php echo BASE_URL ?>/assets/js/jquery-3.1.1.min.js"></script>
    <!-- Date datepicker JS -->
    <script src="<?php echo BASE_URL ?>/assets/js/jquery-ui.min.js"></script>
    <!-- select2 JS -->
    <script defer src="<?php echo BASE_URL ?>/assets/js/select2.min.js"></script>
    <script>
        var base_url = "<?php echo BASE_URL ?>";

        function mostrarConteudo() {
            var elemento = document.getElementById("tela_load");
            elemento.style.display = "none";

            var elemento = document.getElementById("tela_sistema");
            if (elemento) {
                elemento.style.display = "block";
            }

            var elemento = document.getElementById("interface_login");
            if (elemento) {
                elemento.style.display = "block";
            }
        }
    </script>
</head>

<body>
    <div id="tela_load">
        <img src="<?php echo BASE_URL ?>/assets/imagens/loading.gif" style="display: block; margin: auto; margin-top: 300px;">
    </div>
    <div id="tela_sistema">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="menu_sistema">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo BASE_URL ?>/"><img src="<?php echo BASE_URL ?>/assets/imagens/logo_menu.png" alt=""></a>
            </div>
            <!-- Top Menu Items -->

            <ul class="nav navbar-right top-nav">
                <li class="dropdown" id="submenu_usuario">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['usuario_sessao']['nome'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo BASE_URL ?>/editar/usuario/<?php echo $_SESSION['usuario_sessao']['cod'] ?>"><i class="fa fa-user"></i> Editar Perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo BASE_URL ?>/usuario/sair"><i class="fa fa-sign-out-alt "></i> Sair</a>
                        </li>

                    </ul>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <nav class="side-nav">
                    <figure>
                        <img src="<?php echo BASE_URL . '/' . $_SESSION['usuario_sessao']['imagem']; ?>" class="pull-left img-circle">
                        <figcaption>
                            <p class="text-uppercase"><?php echo $_SESSION['usuario_sessao']['nome'] . ' ' . $_SESSION['usuario_sessao']['sobrenome'] ?></p>
                            <p class="text-uppercase"><?php echo $_SESSION['usuario_sessao']['cargo']; ?></p>
                        </figcaption>
                    </figure>
                    <ul class="nav navbar-nav">

                        <li>
                            <a href="<?php echo BASE_URL ?>"><i class="fa fa-tachometer-alt "></i> Inicial</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#menu_cadastro"><i class="fa fa-plus-circle "></i> Cadastrar <i class="fa fa-fw fa-caret-down pull-right"></i></a>
                            <ul id="menu_cadastro" class="collapse">
                                <li>
                                    <a href="<?php echo BASE_URL ?>/cadastrar/manutencao"><i class="fa fa-plus-square"></i> Manutenção</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#menu_relatorio"><i class="fa fa-list-ul"></i> Relatórios <i class="fa fa-fw fa-caret-down pull-right"></i></a>
                            <ul id="menu_relatorio" class="collapse">
                                <li>
                                    <a href="<?php echo BASE_URL ?>/relatorio/manutencao"><i class="fa fa-list"></i> Manutenção</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#menu_usuario"><i class="fa fa-users"></i> Usuários <i class="fa fa-fw fa-caret-down pull-right"></i></a>
                            <ul id="menu_usuario" class="collapse">
                                <?php if (isset($_SESSION['usuario_sessao']['nivel']) && $_SESSION['usuario_sessao']['nivel'] >= 3) : ?>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/cadastrar/usuario"><i class="fa fa-user-plus"></i> Novo Usuário</a>
                                    </li>
                                <?php endif; ?>

                                <li>
                                    <a href="<?php echo BASE_URL ?>/editar/usuario/<?php echo $_SESSION['usuario_sessao']['cod'] ?>"><i class="fa fa-user"></i> Editar Perfil</a>
                                </li>
                                <?php if (isset($_SESSION['usuario_sessao']['nivel']) && $_SESSION['usuario_sessao']['nivel'] >= 3) : ?>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/usuario/index"><i class="fa fa-users"></i> Lista Usuários</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL . '/instituicao/index/' . $this->getCodInstituicao() ?>"><i class="fa fa-home"></i> Instituição</a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL ?>/usuario/sair"><i class="fa fa-sign-out-alt"></i> Sair</a>
                        </li>
                    </ul>
                </nav>
                <!-- FIM SIDE-NAV-->
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="conteudo_sistema">
            <div class="container-fluid">
                <?php $this->loadViewInTemplate($viewName, $viewData) ?>

                <div id="rodape">
                    <p class="text-right">&copy; Copyright 2023</p>
                </div>
                <!--FIM #rodape-->
            </div>
        </div>
        <!-- /#conteudo_sistema -->
    </div>
    <!-- /#tela_sistema -->
    <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
    <script src="<?php echo BASE_URL ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/js/jquery.mask.min.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/js/sig.js"></script>
</body>

</html>