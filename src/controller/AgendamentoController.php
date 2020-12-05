<?php

class AgendamentoController
{
    public function index($id)
    {
            
            $horarios_consultas = agendamento::selectById($id);

            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('agendamento.html');
            $parametros = array();
            
            if($horarios_consultas) {
                $parametros['horarios_consultas'] = $horarios_consultas;
            } else {
                $parametros['erro'] = $horarios_consultas;
            }
            // var_dump($parametros);

            $conteudo = $template->render($parametros);
            echo $conteudo;
        

    }
    public function create($id){
        $loader = new \Twig\Loader\FilesystemLoader('src/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('agendamento.html');

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

    public function alter($id){
        try{
            // var_dump($id);
            $horarios_consultas = agendamento::selectById($id);
            // var_dump($horarios_consultas);

            $idMedico = $horarios_consultas[0]->id_medico;
            $nomeMedico = medico::selectNomeById($idMedico);

            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('alteragendamento.html');

            $parametros = array();    
            // var_dump($horarios_consultas[0]->data_horario);
            // $parametros['id'] = $lista['id'];
            $parametros['id'] =  $horarios_consultas[0]->id;
            $parametros['data_horario'] =  $horarios_consultas[0]->data_horario;
            $parametros['id_medico'] =  $horarios_consultas[0]->id_medico;
            $parametros['nome_medico'] =  $nomeMedico->nome;
            // var_dump($parametros['nome_medico']);
            // var_dump($nomeMedico);
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
        if(agendamento::insert($_POST))
        {
            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('sucesso.html');
            
            $conteudo = $template->render();
            echo $conteudo;
        }
    }
    public function agendar($id)
    {
        if(agendamento::agendar($id))
        {
            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('sucesso.html');
            
            $conteudo = $template->render();
            echo $conteudo;
        }
        
    }
    public function delete($id)
    {
        if(agendamento::deletar($id))
        {
            $loader = new \Twig\Loader\FilesystemLoader('src/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('sucesso.html');
            
            $conteudo = $template->render();
            echo $conteudo;
        }
    }
    public function update()
    {
        agendamento::update($_POST);
    }
}
