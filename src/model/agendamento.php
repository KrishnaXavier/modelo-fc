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

        public static function selectByIdMedico($idMedico)
        {
            $con = Connection::getCon();

            $sql = "Select * from horario where id_medico = :id";
            $sql = $con->prepare($sql);
			$sql->bindValue(':id', $idMedico, PDO::PARAM_INT);
            $sql -> execute();

            $resultado = array();

            while ($row = $sql->fetchObject('agendamento')){
                $resultado[] = $row;

            }
            if(!$resultado){
                throw new Exception("Consulta inexistente");
                return false;
            }
            return $resultado;
        }
        public static function selectByIdMedicoDisponiveis($idMedico)
        {
            $con = Connection::getCon();

            $sql = "Select * from horario where id_medico = :id and data_horario > now()";
            $sql = $con->prepare($sql);
			$sql->bindValue(':id', $idMedico, PDO::PARAM_INT);
            $sql -> execute();

            $resultado = array();

            while ($row = $sql->fetchObject('agendamento')){
                $resultado[] = $row;

            }
            if(!$resultado){
                throw new Exception("Consulta inexistente");
                return false;
            }
            return $resultado;
        }

        public static function selectById($idHorario)
        {
            $con = Connection::getCon();

            $sql = "Select * from horario where id = :id";
            $sql = $con->prepare($sql);
			$sql->bindValue(':id', $idHorario, PDO::PARAM_INT);
            $sql -> execute();

            $resultado = array();

            while ($row = $sql->fetchObject('agendamento')){
                $resultado[] = $row;

            }
            if(!$resultado){
                throw new Exception("Consulta inexistente");
                return false;
            }
            return $resultado;
        }

        public static function insert($dadosForm)
        {
            // var_dump($dadosForm);
            if(empty($dadosForm['data']))
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
    
        public static function agendar($idHorario)
        {   
            // var_dump($idHorario);
            if(empty($idHorario))
            {
                throw new Exception("Faltando Dados");
                return false;
            }

            $con = Connection::getCon();

            $sql = 'Update horario set horario_agendado = :horario_agendado, data_alteracao= CURRENT_TIMESTAMP where id= :id';
            
            $sql = $con->prepare($sql);
			$sql->bindValue(':id', $idHorario);
			$sql->bindValue(':horario_agendado', 1);
            $sql -> execute();

            return true;
        }
        public static function deletar($id)
        {   
            // var_dump($idHorario);
            if(empty($id))
            {
                throw new Exception("Faltando Dados");
                return false;
            }

            $con = Connection::getCon();

            $sql = 'Delete from horario where id= :id';
            
            $sql = $con->prepare($sql);
			$sql->bindValue(':id', $id);
            $sql -> execute();

            return true;
        }
        public static function update($dadosForm)
        {
            // var_dump($dadosForm);
            if(empty($dadosForm['id']||empty($dadosForm['data'])||empty($dadosForm['horario_agendado'])))
            {
                throw new Exception("Faltando Dados");
                return false;
            }
            $con = Connection::getCon();

            $sql = 'Update horario set horario_agendado = :horario_agendado, data_alteracao= CURRENT_TIMESTAMP where id= :id';
            
            $sql = $con->prepare($sql);
			$sql->bindValue(':id', $dadosForm['id']);
			$sql->bindValue(':data', $dadosForm['data']);
			$sql->bindValue(':horario_agendado', $dadosForm['horario_agendado']);
            $sql -> execute();

            // var_dump($sql);

        }
    }