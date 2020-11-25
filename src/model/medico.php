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
            return $resultado;

        }
        public static function selectNomeById($params){
            $con = Connection::getCon();

            $sql = "Select nome from medico where id = :id";
            $sql = $con->prepare($sql);
			$sql->bindValue(':id', $params, PDO::PARAM_INT);
            $sql -> execute();

            $resultado = $sql->fetchObject('agendamento');
            
            if(!$resultado){
                throw new Exception("Sem Registros");
            }
            return $resultado;
        }
        public static function selectById($id)
        {
            $con = Connection::getCon();

            $sql = "Select * from medico where id = :id";
            $sql = $con->prepare($sql);
			$sql->bindValue(':id', $id, PDO::PARAM_INT);
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
        public static function insert($dadosForm)
        {
            // var_dump($dadosForm);

            if(empty($dadosForm['email']||empty($dadosForm['nome'])||empty($dadosForm['senha'])))
            {
                throw new Exception("Faltando Dados");
                return false;
            }
            $dadosForm['senha'] = password_hash($dadosForm['senha'], PASSWORD_DEFAULT);

            var_dump($dadosForm);
            $con = Connection::getCon();

            $sql = 'Insert into medico (email, nome, senha) values (:email, :nome, :senha)';
            
            $sql = $con->prepare($sql);
			$sql->bindValue(':email', $dadosForm['email']);
			$sql->bindValue(':nome', $dadosForm['nome']);
			$sql->bindValue(':senha', $dadosForm['senha']);
            $sql -> execute();

            // var_dump($sql);

        }
        public static function update($dadosForm)
        {
            // var_dump($dadosForm);
            if(empty($dadosForm['nome'])||empty($dadosForm['senha'])||empty($dadosForm['id']))
            {
                throw new Exception("Faltando Dados");
                return false;
            }
            $dadosForm['senha'] = password_hash($dadosForm['senha'], PASSWORD_DEFAULT);
            var_dump($dadosForm);

            $con = Connection::getCon();

            $sql = 'Update medico set nome= :nome, senha= :senha, data_alteracao= CURRENT_TIMESTAMP where id= :id';
            
            $sql = $con->prepare($sql);
            $sql->bindValue(':nome', $dadosForm['nome']);
			$sql->bindValue(':senha', $dadosForm['senha']);
			$sql->bindValue(':id', $dadosForm['id']);
            $resultado = $sql -> execute();

            if($resultado == 0){
                throw new Exception("Falha na Alteração de Dados");
                return false;
            }
            return true;
        }
    }