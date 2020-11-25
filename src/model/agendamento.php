<?php

    class agendamento{
        //lembre que static acessa o método sem precisar criar instância da classe
        public static function selectAll()
        {
            $con = Connection::getCon();

            $sql = "Select * from horario order by id";
            $sql = $con->prepare($sql);
            $sql -> execute();
            
            $resultado = array();

            while ($row = $sql->fetchObject('agendamento')){
                $resultado[] = $row;

            }
            if(!$resultado){
                throw new Exception("Sem Registros");
            } else{
                $resultado->medicos = medico::selectById($resultado);
            }
            return $resultado;
        }

        public static function selectById($params)
        {
            $con = Connection::getCon();

            $sql = "Select * from horario where id_medico = :id";
            $sql = $con->prepare($sql);
			$sql->bindValue(':id', $params, PDO::PARAM_INT);
            $sql -> execute();

            $resultado = array();

            while ($row = $sql->fetchObject('agendamento')){
                $resultado[] = $row;

            }
            if(!$resultado){
                throw new Exception("Sem Registros");
            }
            return $resultado;
        }
        public static function insert($dadosForm)
        {
            // var_dump($dadosForm);
            if(empty($dadosForm['id']||empty($dadosForm['data'])||empty($dadosForm['horario_agendado'])))
            {
                throw new Exception("Faltando Dados");
                return false;
            }
            $con = Connection::getCon();

            $sql = 'Insert into horario (id_medico, data_horario, horario_agendado) values (:id, :data, :horario_agendado)';
            
            $sql = $con->prepare($sql);
			$sql->bindValue(':id', $dadosForm['id']);
			$sql->bindValue(':data', $dadosForm['data']);
			$sql->bindValue(':horario_agendado', $dadosForm['horario_agendado']);
            $sql -> execute();

            // var_dump($sql);

        }
    }