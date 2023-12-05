<?php
    class Database{
        private $hostname = "localhost";
        private $username = "root";
        private $pass = '';
        private $databaseName = 'db2.0';
        private $conn = NULL;
        private $result = NULL;
        public function connect()
        {
            $this->conn = new mysqli($this->hostname, $this->username, $this->pass, $this->databaseName);
            if (!$this -> conn)
            {
                echo "Connect completely";
                exit();
            }   
            else
            {
                mysqli_set_charset($this->conn, 'utf8');
            }
            return $this -> conn;
        }
        // Execute query SQL
        public function execute($sql)
        {
            $this -> result = $this -> conn -> query($sql);
            return $this -> result;
        }
        // Procedure get data
        public function GetData()
        {
            if (!$this -> result)
            {
                $data = 0;
            }
            else 
            {
                $data = mysqli_fetch_array($this -> result);
            }
            return $data;
        }
        public function GetAllData()
        {
            if (!$this -> result) $data = 0;
            else
            {
                while ($datas = $this -> GetData())
                {
                    $data[] = $datas; //mảng không tuần tự
                }
            }
            return $data;
        }
        // public function InsertData($table, $data)
        // {
        //     $sql = "INSERT INTO $table()VALUES()";
        //      return $this -> execute(sql);
        // }
    }
?>