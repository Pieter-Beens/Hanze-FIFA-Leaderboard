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
            echo "<script>console.log(\"XAMP proberem\")</script>";
            $this->_db = mysqli_connect('localhost', 'root', 'usbw', 'fifa');
            if (mysqli_connect_errno()) {
                echo "<script>console.log(\"Usbwebserver proberen\")</script>";
                $db = mysqli_connect('localhost', 'root', 'usbw', 'fifa');
                if (mysqli_connect_errno()) {
                    echo "<script>console.log(\"Niks werkt :(\")</script>";
                    $db = mysqli_connect('localhost', 'root', 'usbw', 'fifa');
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