<?php

class AgendamentoController
{
    public function index($params)
    {
        try {
            $postagem = agendamento::selectById($params);

            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('single.html');

            $parametros = array();
            $parametros['id'] = $postagem->id;
            $parametros['titulo'] = $postagem->titulo;
            $parametros['conteudo'] = $postagem->conteudo;
            $parametros['comentarios'] = $postagem->comentarios;
            //var_dump($colecPostagens);

            $conteudo = $template->render($parametros);
            echo $conteudo;
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
