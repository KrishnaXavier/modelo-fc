<?php
    
    class HomeController
    {
        public function index()
        {
            try{
                $medico = medico::selecionaTodos();
                var_dump($medico);
            }
            catch(Exception $e){
                echo $e->getMessage();
            }         

        }
    }