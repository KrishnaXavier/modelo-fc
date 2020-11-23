<?php

    class medico{
        //lembre que static acessa o método sem precisar criar instância da classe
        public static function selectAll()
        {
            $con = Connection::getCon();

            $sql = "Select * from medico order by id";
            $sql = $con->prepare($sql);
            $sql -> execute();

            // var_dump($sql->fetchALL);
            
            while ($row = $sql->fetchObject('medico')){
                $resultado[] = $row;

            }
            if(!$resultado){
                throw new Exception("Sem Registros");
            }
            return $resultado;
        }

        public static function selectById($idPost)
        {
            $con = Connection::getCon();
            
            $sql = "Select * from medico where id = :id";
            $sql = $con->prepare($sql);
			$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql -> execute();

            $resultado = $sql->fetchObject('medico');

            if(!$resultado){
                throw new Exception("Sem Registros");
            }
            return $resultado;
        }
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
    }