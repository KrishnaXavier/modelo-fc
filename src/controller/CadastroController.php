<?php

    class cadastroController
    {
        public function index()
        {
            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('cadastro.html');

            $parametros = array();

            $conteudo = $template->render($parametros);
            echo $conteudo;
        }
}