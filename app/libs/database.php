<?php

    class database
    {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;
        private $con;
        private $stmt;
        private $error;

        public function __construct()
        {
            $dsn = 'mysql:host=localhost;dbname=instagram';
            $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            try
            {
                $this->con = new PDO($dsn, $this->user, $this->pass, $options);
            }
            catch(PDOException $e)
            {
                $this->error = $e->getMessage();
            }
        }
        public function query($sql)
        {
            $this->stmt = $this->con->prepare($sql);
        }
    
        public function execute($arr = [])
        {
            if (empty($arr))
                return $this->stmt->execute();
            return $this->stmt->execute($arr);
        }
        public function bind($param, $value, $type = null)
        {
            if(is_null($type)){
              switch(true){
                case is_int($value):
                  $type = PDO::PARAM_INT;
                  break;
                case is_bool($value):
                  $type = PDO::PARAM_BOOL;
                  break;
                case is_null($value):
                  $type = PDO::PARAM_NULL;
                  break;
                default:
                  $type = PDO::PARAM_STR;
              }
            }
            $this->stmt->bindValue($param, $value, $type);
        }
                                                                    /***   Get Result Set As Single Object    ***/               
        public function resultOne($arr = [])
        {
            $this->execute($arr);
            return $this->stmt->fetch();
        }
                                                                    /*** Get Result Set As array Of Objects   ***/
        public function resultArray($arr = [])
        {
            $this->execute($arr);
            return $this->stmt->fetchAll();
        }
                                                                    /***            Get Row Count             ***/
        public function rowCount()
        {
            return $this->stmt->rowCount();
        }
                                                                    /***      Get First Column From Row       ***/
        public function ftchColumn($arr = NULL)
        {
            $this->execute($arr);
            return $this->stmt->fetchColumn();
        }
    }

?>