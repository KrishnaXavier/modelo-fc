<?php
    
    class HomeController
    {
        public function index()
        {
            try{
                $medico = medico::selecionaTodos();
                
                $loader = new \Twig\Loader\FilesystemLoader('src/view');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('index.html');

                $parametros = array();
                // $parametros['nome'] = $

                $conteudo = $template->render($parametros);

                echo $conteudo;

            }
            catch(Exception $e){
                echo $e->getMessage();
            }         

        }
    }