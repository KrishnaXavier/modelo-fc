<?php
    abstract class Connection
    {
        public static $con;

        public static function getCon(){
            //verificação de existencia unica do objeto PDO
            if(self::$con==null){
                //sell é utilizado qd o atributo é estatico, diferente do this
                self::$con = new PDO('mysql: host= localhost; dbname=testefc;', 'root', '');
            }

            return self::$con;

        }
    }