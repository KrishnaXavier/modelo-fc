<?php

    class Core
    {
        public function start($urlGet)
        {
            if(isset($urlget['pagina'])){
                $controller = ucfirst($urlGet['pagina'].'Controller');
            } else {
                $controller = 'HomeController';
            }
            
            //uc first primeira letra maiuscula
            $acao = 'index';

            if(!class_exists($controller)) 
            {
                $controller = 'Erro_Controller';
            }
            //array vazio para n dar erros
            call_user_func_array(array(new $controller, $acao), array());
        }
    }
?>