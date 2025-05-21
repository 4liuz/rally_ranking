<?php
    class mydb {
        
        private ?mysqli $mysqli;
        private ?mysqli_result $result;
        private ?string $query;
        public bool|object|null $row;

        /**
         * 
         * @author arm
         * @date 21/10/2024
         */
        public function __construct(?array $db = null) {
            $this -> mysqli = new mysqli($db["host"], $db["user"], $db["pass"], $db["db"]) ?? $db;
            $this -> result = null;
            $this -> query = '';
            $this -> row = null;
        }
        
        /**
         * Creates a connection to DDBB $db
         * @author arm
         * @date 19/10/2024
         */
        public function connect(array $db) {
            $this -> mysqli = new mysqli($db["host"], $db["user"], $db["pass"], $db["db"]);
        }

        /**
         * Sets object -> query to $query 
         * @author arm
         * @date 19/10/2024
         */
        public function querySetter(string $newQuery) {
            $this -> query = $newQuery;
        }

        /**
         * Returns a string with properties values.
         * @author arm
         * @date 22/10/2024
         */
        public function testVars() {
            $test = "";
            foreach ($this as $key => $value){
                $test .= "$key => ".($value ?: "\"\"")."\n"; 
            }
            return $test;
        }

        /**
         * Sends actual query property to the DDBB to get an object format response.
         * @author arm
         * @date 22/10/2024
         */
        public function fastQuery() {
            try {
                // echo $this -> query."<br>";
                $this -> result =  $this -> mysqli -> query($this -> query);
                $this -> row = $this -> result -> fetch_object();
                return $this -> row;
            } catch (mysqli_error) {
                echo "<script defer>alert(\"Error al interactuar con la base de datos. Datos:\n\n";
                echo $this -> testVars();
                echo "\");</script>";
            }
        }

        /**
         * Sends actual query property to the DDBB to get an object format response.
         * @author arm
         * @date 22/10/2024
         */
        public function fastQueryBool() {
            try {
                $this -> mysqli -> query($this -> query);
            } catch (mysqli_error) {
                echo "<script defer>alert(\"Error al interactuar con la base de datos. Datos:\n\n";
                echo $this -> testVars();
                echo "\");</script>";
            }
        }
        /**
         * Cleans evry DDBB process, closes its conection and destroys the obj.
         * @author arm
         * @date 20/10/2024
         */
        public function __destruct() {
            // $this -> result != "" ?: $this -> result -> close();
            $this -> mysqli -> kill($this -> mysqli -> thread_id);
            $this -> mysqli -> close();
            unset($this -> mysqli, $this -> result, $this -> query, $this -> row);
        }
    }
?>