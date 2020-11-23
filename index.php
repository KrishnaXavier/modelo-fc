<?php
    
    require_once 'src/core/Core.php';

    require_once 'src/config.php';

    require_once 'src/controller/HomeController.php';
    require_once 'src/controller/ErroController.php';
    require_once 'src/Controller/CadastroController.php';
    require_once 'src/Controller/AgendamentoController.php';
    require_once 'src/Controller/ListarController.php';

    require_once 'src/model/medico.php';
    require_once 'src/model/agendamento.php';

    require_once 'vendor/autoload.php';

    $template = file_get_contents('src/template/estrutura.html');

    ob_start();
        $core = new Core;
        $core->start($_GET);


        $saida = ob_get_contents();
    ob_end_clean();

    // var_dump($saida);
    $template_pronto = str_replace('{{area_dinamica}}', $saida, $template);
    echo $template_pronto;
?>

    <!-- if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	header('Location: '.$uri.'/modelo-fc/src/view/');
    exit; -->