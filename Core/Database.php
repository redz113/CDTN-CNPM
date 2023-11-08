<?php
    class Database
    {
        const DB_HOST = 'localhost';
        const DB_USER = 'root';
        const DB_PASSWORD = '';
        const DB_NAME = 'edu90minute';

        public function  connect(){
            $connect = mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASSWORD, self::DB_NAME);

            mysqli_set_charset($connect, 'utf8');

            if(mysqli_connect_errno() === 0){
                return $connect;
            }

            return false;
        }
    }