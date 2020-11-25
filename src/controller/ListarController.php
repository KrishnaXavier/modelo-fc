<?php

class ListarController
{
    public function index()
    {
        try{

            $lista = medico::selectAll();
            // var_dump($lista);
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
    public function consulta($params)
    {
        try{
            // var_dump($params);
            $lista_consultas = agendamento::selectById($params);
            // var_dump($lista_consultas);
            // var_dump($parametros);
            
            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('listar_consultas.html');

            $parametros = array();    
            
            // $parametros['id'] = $lista['id'];
            $parametros['lista_consultas'] =  $lista_consultas;
            $parametros['id_medico'] = $lista_consultas;
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