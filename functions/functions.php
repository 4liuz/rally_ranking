<?php
    require_once("mydb.php");
    require_once("user_data.php");
    require_once("controller.php");

    /* START VARIABLES */
    $sql = array(
        // SQL DDBB ARRAY
        "db" => array(
            "host" => "localhost",
            "user" => "root",
            "pass" => "",
            "db" => "rally_ranking"
        )  
    );
    /* END VARIABLES */



    /* START FUNCTIONS */
    /**
     * Returns a participant`s username from its id
     * @param string $usuario
     * @return bool|object|null
     */
    function GetUserName(string $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT usuario FROM participantes WHERE id = '$id'");
        $user_name = $mydb -> fastQuery();

        unset($mydb);
        return($user_name->usuario);
    }

    /* START FUNCTIONS */
    /**
     * Returns a participant´s data from its username
     * @param string $usuario
     * @return bool|object|null
     */
    function GetUser(string $usuario) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT * FROM `participantes` WHERE `usuario` COLLATE utf8mb4_bin = '$usuario'");
        $user = $mydb -> fastQuery();

        unset($mydb);
        return($user);
    }

    function CountUsers() {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT COUNT(*) count FROM `participantes`");
        $user = $mydb -> fastQuery();

        unset($mydb);
        return($user);

    }

    function GetProfileManagerData() {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT `id`, `nombre`, `apellidos`, `baja` FROM `participantes`");
        $user = $mydb -> fastResponse();

        unset($mydb);
        return($user);
    }

    /**
     * Checks user and password for login screen
     * @param string $usuario   User ID to check
     * @param string $passwd    User password to check
     * @return bool
     */
    function CheckUserLogin(string $usuario, string $password): bool {
        
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter(" SELECT `password` FROM `participantes` WHERE `usuario` COLLATE utf8mb4_bin = '$usuario' ");
        
        if ($mydb->fastQuery()) {
            // Password check
            $login_matches = $mydb -> row -> password == $password;
        } else {
            // User missmatch
            $login_matches = false;
        }
        
        unset($mydb);
        return $login_matches;
    }

    /**
     * Checks user and password for login screen
     * @param string $usuario   User ID to check
     * @param string $password    User password to check
     * @return bool
     */
    function CheckAdminLogin(string $usuario, string $password): bool {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter(" SELECT `password` FROM `administradores` WHERE `usuario` COLLATE utf8mb4_bin = '$usuario' ");
        
        if ($mydb->fastQuery()) {
            // Password check
            $login_matches = $mydb -> row -> password == $password;
        } else {
            // User missmatch
            $login_matches = false;
        }
        
        unset($mydb);
        return $login_matches;
    }

    /**
     * Summary of checkOfertante
     * @param string $usuario   User ID to check
     * @return bool|object|null
     */
    function CreateUser(object $user_data) {
        global $sql;
        $mydb = new mydb($sql["db"]);

        $mydb ->querySetter(
            "INSERT INTO participantes
            (`usuario`,
            `password`,
            `nombre`,
            `apellidos`,
            `email`,
            `fecha_creacion`,
            `ultima_actualizacion`,
            `ultimo_usuario`)

            VALUES 
            ('".$user_data->usuario."', '"
            .$user_data->password."', '"
            .$user_data->nombre."', '"
            .$user_data->apellidos."', '"
            .$user_data->email."', '"
            .date("Y/m/d")."', '"
            .date("Y/m/d H:i:s")."', '"
            .$user_data->ultimo_usuario.")");

        $mydb -> fastQueryBool();
    }

    /**
     * Summary of checkOfertante
     * @param string $usuario   User ID to check
     * @return bool|object|null
     */
    function UpdateUser(object $user_data) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter(
            "UPDATE participantes SET
            usuario = '".$user_data->usuario."',
            password = '".$user_data->password."',
            nombre = '".$user_data->nombre."',
            apellidos = '".$user_data->apellidos."',
            email = '".$user_data->email."',
            ultima_actualizacion = '".date("Y/m/d H:i:s")."',
            ultimo_usuario = '".$user_data->ultimo_usuario."'
            WHERE id = ".$user_data->id);
        $mydb -> fastQueryBool();


    }
    
    function DeleteUser(int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("DELETE FROM usuarios WHERE id = ".$id);
        $mydb -> fastQueryBool();
    }

    function GetLastUpdate(string $table, int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("SELECT `ultima_actualizacion` FROM `".$table."` WHERE id = ".$id);
        $lastUpdate = $mydb -> fastQuery() -> ultima_actualizacion;

        unset($mydb);
        return($lastUpdate);
    }

    function GetLastUser(int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("SELECT `ultimo_usuario` FROM `participantes` WHERE id = ".$id);
        $lastUser = $mydb -> fastQuery() -> ultimo_usuario;

        unset($mydb);
        return($lastUser);
    }

    function SelectFrom(string $table, int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("SELECT * FROM `".$table."` WHERE id = ".$id);
        $res = $mydb -> fastQuery();

        unset($mydb);
        return($res);
    }

    /* * * END FUNCTIONS * * */
?>