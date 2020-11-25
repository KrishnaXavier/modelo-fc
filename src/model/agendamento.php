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
                $resultado->medicos = medico::selectById($resultado->id);
            }
            return $resultado;
        }

        public static function selectById($params)
        {
            $con = Connection::getCon();

            $id = $params;

            $sql = "Select * from horario where id = :id";
            $sql = $con->prepare($sql);
			$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
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
    }