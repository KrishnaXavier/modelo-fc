<?php

    class cadastroController
    {
        public function index()
        {
            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('cadastro.html');

            $parametros = array();

            $conteudo = $template->render($parametros);
            echo $conteudo;
        }

        // public function create()
		// {
		// 	$loader = new \Twig\Loader\FilesystemLoader('app/View');
		// 	$twig = new \Twig\Environment($loader);
		// 	$template = $twig->load('cadastro.html');

		// 	$parametros = array();

		// 	$conteudo = $template->render($parametros);
		// 	echo $conteudo;
		// }

        public function alter($id)
        {
            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('alter.html');

            $medico = medico::selectById($id);
            // var_dump($medico);
            $parametros = array();
            $parametros['medico']= $medico;
            $parametros['nome'] = $medico[0]->nome;
            $parametros['id'] = $medico[0]->id;

            // var_dump($parametros);
            $conteudo = $template->render($parametros);
            echo $conteudo;
        }

		public function insert()
		{
            medico::insert($_POST);
        }
        public function update()
		{
            try{
                medico::update($_POST);
            } catch(Exception $e){
                echo $e->getMessage();
            }

        }
        
}