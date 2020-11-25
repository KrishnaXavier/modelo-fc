<?php

class AgendamentoController
{
    public function index($id)
    {
        try {

            $horarios_consultas = agendamento::selectById($id);
            var_dump($horarios_consultas);

            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('agendamento.html');

            $parametros = array();
            // $parametros['id'] = $postagem->id;
            // $parametros['titulo'] = $postagem->titulo;
            // $parametros['conteudo'] = $postagem->conteudo;
            // $parametros['comentarios'] = $postagem->comentarios;
            //var_dump($colecPostagens);

            $conteudo = $template->render($parametros);
            echo $conteudo;
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function alter($params){
        try{
            // var_dump($params);
            $horarios_consultas = agendamento::selectById($params);
            var_dump($horarios_consultas);
            
            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('agendamento.html');

            $parametros = array();    
            
            // $parametros['id'] = $lista['id'];
            $parametros['horarios_consultas'] =  $horarios_consultas;
            // $parametros['id_medico'] = $lista_consultas;
            // $parametros['email'] = $lista->email;
            // $parametros['data_criacao'] = $lista->data_criacao;
            // $parametros['horario_agendado'] = $lista->horario_agendado;
            // var_dump($parametros);

            $conteudo = $template->render($parametros);
            echo $conteudo;


        } catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function insert()
    {
        agendamento::insert($_POST);
    }
}
