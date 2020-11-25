<?php

class ListarController
{
    public function index()
    {
        try{

            $lista = medico::selectAll();
            var_dump($lista);
            // var_dump($parametros);
            
            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('listar.html');

            $parametros = array();    
            
            // $parametros['id'] = $lista['id'];
            $parametros['lista'] =  $lista;
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
    public function consultas($params)
    {
        try{

            $lista = agendamento::selectAll();
            var_dump($lista);
            // var_dump($parametros);
            
            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('listar.html');

            $parametros = array();    
            
            // $parametros['id'] = $lista['id'];
            $parametros['lista'] =  $lista;
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
}