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
     * Used alongside GetUserName() u can select a participant from its id
     * @param string $usuario
     * @return bool|object|null
     */
    function GetUser(string $usuario) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT * FROM `participantes` WHERE `usuario` COLLATE utf8mb4_bin = '$usuario'");
        try {
            $user = $mydb -> fastQuery();
        } catch(mysqli_sql_exception) {
            $user -> id = 0;
        }

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

    /**
     * Returns a mysqli_result object for profile_manager.php table
     * @return mysqli_result|null
     */
    function GetProfileManagerData() {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT `id`, `nombre`, `apellidos`, `baja` FROM `participantes` ORDER BY `nombre`");
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
     * Inserts a record into 'participantes' from a given object values
     * @param object $user_data
     * @return void
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
            .$user_data->ultimo_usuario."')");

        $mydb -> fastQueryBool();
    }

    /**
     * Changes an user info
     * @param object $user_data
     * @return void
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
    
        /**
     * Sets 'participantes.baja' to $baja
     * @param int $id
     * @param int $baja
     * @return void
     */
    function UpdateUnsuscribed(int $id, int $baja) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter(
            "UPDATE participantes SET
            baja = '".$baja."'
            WHERE id = ".$id);
        $mydb -> fastQueryBool();

    } 


    function DeleteUser(int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("DELETE FROM participantes WHERE id = ".$id);
        $mydb -> fastQueryBool();
    }

    /**
     * Used for checking if any info should be refreshed on client side
     * @param string $table
     * @param int $id
     */
    function GetLastUpdate(string $table, int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("SELECT `ultima_actualizacion` FROM `".$table."` WHERE id = ".$id);
        $lastUpdate = $mydb -> fastQuery() -> ultima_actualizacion;

        unset($mydb);
        return($lastUpdate);
    }

    /**
     * Checks if an user is unsuscribed to prevent its login
     * @param int $id
     */
    function GetUnsuscribed(int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("SELECT `baja` FROM `participantes` WHERE id = ".$id);
        $unsuscribed = $mydb -> fastQuery() -> baja;

        unset($mydb);
        return($unsuscribed);
    }

    /**
     * Used for checking if another user changed your profile
     * @param int $id
     */
    function GetLastUser(int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("SELECT `ultimo_usuario` FROM `participantes` WHERE id = ".$id);
        $lastUser = $mydb -> fastQuery() -> ultimo_usuario;

        unset($mydb);
        return($lastUser);
    }

    /**
     * Returns every searched record field
     * @param string $table DDBB table in which search is made
     * @param int $id Searched record id
     * @return bool|object|null
     */
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