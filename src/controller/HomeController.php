<?php
    
    class HomeController
    {
        public function index()
        {
            // echo 'teste';
            medico::selecionaTodos();
        }
    }