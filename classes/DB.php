<?php
    class DB {
        private static $_instance = null;
        private $_db,
                $_query,
                $_error = false,
                $_results,
                $_count = 0;


        public function __construct()
        {
            echo "<script>console.log(\"Strato server proberen\")</script>";
            $this->_db = mysqli_connect('rdbms.strato.de', 'U3571439', 'Myx0mat0s!s', 'DB3571439');
            if (mysqli_connect_errno()) {
              echo "<script>console.log(\"XAMPP proberen\")</script>";
              $this->_db = mysqli_connect('localhost', 'root', '', 'fifa');
              if (mysqli_connect_errno()) {
                    echo "<script>console.log(\"Niks werkt :(\")</script>";
                };
            };
        }

        public static function conn()
        {
            if (!isset(self::$_instance)) {
                self::$_instance = new DB();
            }
            return self::$_instance;
        }

        public function query($sql)
        {
            $result = $this->_db->query($sql);
            return $result;
        }
    }
