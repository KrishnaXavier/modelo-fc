<?php

    class Core
    {
        public function start($urlGet)
        {
            if (isset($urlGet['metodo'])) {
				$metodo = $urlGet['metodo'];
			} else {
				$metodo = 'index';
            }
            if(isset($urlGet['pagina'])){
                //uc first primeira letra maiuscula
                $controller = ucfirst($urlGet['pagina'].'Controller');
            } else {
                $controller = 'HomeController';
            }
            

            if(!class_exists($controller)) 
            {
                $controller = 'ErroController';
            }
            if(isset($urlGet['id'])&&$urlGet['id'] != null)
            {
                $id = $urlGet['id'];
            } else
            {
                $id = null;
            }
            //array vazio para n dar erros
            call_user_func_array(array(new $controller, $metodo), array('id'=> $id));
        }
    }
?>