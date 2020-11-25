<?php

    class medico{
        //lembre que static acessa o método sem precisar criar instância da classe
        public static function selectLista()
        {
            $con = Connection::getCon();

            $sql = "Select m.id, m.nome, m.email, m.data_criacao, h.id as id_consulta, h.horario_agendado from medico m, horario h WHERE m.id = h.id_medico order by m.id";
            $sql = $con->prepare($sql);
            $sql -> execute();

            $resultado = array();

            while ($row = $sql->fetchObject('medico')){
                $resultado[] = $row;
            }
            if(!$resultado){
                throw new Exception("Sem Registros");
            }
            
            return $resultado;

        }


        public static function selectAll()
        {
            $con = Connection::getCon();

            $sql = "Select * from medico order by id";
            $sql = $con->prepare($sql);
            $sql -> execute();

            while ($row = $sql->fetchObject('medico')){
                $resultado[] = $row;
            }
            if(!$resultado){
                throw new Exception("Sem Registros");
            }
            // var_dump($resultado);
            return $resultado;

        }

        // public static function selectById($idPost)
        // {
        //     $con = Connection::getCon();
            
        //     $sql = "Select * from medico where m.id = :id";
        //     $sql = $con->prepare($sql);
		// 	$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        //     $sql -> execute();

        //     $resultado = $sql->fetchObject('medico');

        //     if(!$resultado){
        //         throw new Exception("Sem Registros");
        //     } else{
        //         var_dump($resultado);
        //         $resultado->consultas = agendamento::selectById($resultado->id);
        //     }
        //     return $resultado;
        // }
        public static function insert($dadosForm)
        {
            var_dump($dadosForm);
            if(empty($dadosForm['email']||empty($dadosForm['nome'])||empty($dadosForm['senha'])))
            {
                throw new Exception("Faltando Dados");
                return false;
            }
            $con = Connection::getCon();

            $sql = 'Insert into medico (email, nome, senha) values (:email, :nome, :senha)';
            
            $sql = $con->prepare($sql);
			$sql->bindValue(':email', $dadosForm['email']);
			$sql->bindValue(':nome', $dadosForm['nome']);
			$sql->bindValue(':senha', $dadosForm['senha']);
            $sql -> execute();

            // var_dump($sql);

        }
        // public static function alter($dadosForm)
        // {
        //     var_dump($dadosForm);
        //     if(empty($dadosForm['email']||empty($dadosForm['nome'])||empty($dadosForm['senha'])))
        //     {
        //         throw new Exception("Faltando Dados");
        //         return false;
        //     }
        //     $con = Connection::getCon();

        //     $sql = 'Insert into medico (email, nome, senha) values (:email, :nome, :senha)';
            
        //     $sql = $con->prepare($sql);
		// 	$sql->bindValue(':email', $dadosForm['email']);
		// 	$sql->bindValue(':nome', $dadosForm['nome']);
		// 	$sql->bindValue(':senha', $dadosForm['senha']);
        //     $sql -> execute();

        //     // var_dump($sql);

        // }
    }