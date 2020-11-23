<?php

    class Core
    {
        public function start($urlGet)
        {
            $acao = 'index';
            // var_dump($urlGet);
            // var_dump($controller);
            
            if(isset($urlGet['pagina'])){
                //uc first primeira letra maiuscula
                $controller = ucfirst($urlGet['pagina'].'Controller');

            } else {
                $controller = 'HomeController';
                // var_dump($urlGet);
                // var_dump($controller);
            }

            if(!class_exists($controller)) 
            {
                $controller = 'Erro_Controller';
            }
            if(isset($urlGet['id'])&&$urlGet['id'] != null)
            {
                $id = $urlGet['id'];
            } else
            {
                $id = null;
            }
            //array vazio para n dar erros
            call_user_func_array(array(new $controller, $acao), array('id'=> $id));
        }
    }
?>