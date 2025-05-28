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
        
        // SQL FILTERS
        /*
        "where" => array(
            "es_usuario_ofertante" => " uos.id_usuario = oes.id_ofertante ",
            "es_su_oferta" => " oes.id_ofertante = oas.id_ofertante AND oas.id_servicio = sos.id_servicio ",
            "es_su_solicitud" => " uos.id_usuario = ses.id_usuario AND ses.id_servicio = sos.id_servicio ",
        ),
        */
    );
    /* END VARIABLES */



    /* START FUNCTIONS */
    /**
     * Returns a participant`s username from its id
     * @param string $usuario
     * @return bool|object|null
     */
    function GetUserName(string $id_participante) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT usuario FROM participantes WHERE id_participante = '$id_participante'");
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

    function GetTableData() {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT `id_participante`, `nombre`, `apellidos`, `baja` FROM `participantes`");
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
            "ISERT INTO usuarios
            VALUES
            ('usuario', '".$user_data->usuario."'),
            ('password', '".$user_data->password."'),
            ('nombre', '".$user_data->nombre."'),
            ('apellidos', '".$user_data->apellidos."'),
            ('email', '".$user_data->email."'),
            ('fecha_registro', '".date("Y/m/d")."')");
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
            ultima_actualizacion = '".date("Y/m/d H:i:s")."'
            WHERE id_participante = ".$user_data->id_participante);
        $mydb -> fastQueryBool();


    }
    
    function DeleteUser(int $id_usuario) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("DELETE FROM usuarios WHERE id_usuario = ".$id_usuario);
        $mydb -> fastQueryBool();
    }

    function RefreshUser(int $id_usuario) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("SELECT `ultima_actualizacion` FROM `participantes` WHERE id_usuario = ".$id_usuario);
        $lastUpdate = $mydb -> fastQuery() -> ultima_actualizacion;

        unset($mydb);
        return($lastUpdate);
    }

    function RefreshRally(int $id_rally) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("SELECT `ultima_actualizacion` FROM `rally` WHERE id_rally = ".$id_rally);
        $lastUpdate = $mydb -> fastQuery() -> ultima_actualizacion;

        unset($mydb);
        return($lastUpdate);
    }

    function RefreshPhotos(int $id_foto) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("SELECT `ultima_actualizacion` FROM `fotos` WHERE id_foto = ".$id_foto);
        $lastUpdate = $mydb -> fastQuery() -> ultima_actualizacion;

        unset($mydb);
        return($lastUpdate);

    }
/*
    function CreateOferer(int $id_ofertante, string $usuario) {
        if(!CheckOferer($usuario)) {
            global $sql;
            $mydb = new mydb($sql["db"]);

            $mydb ->querySetter(
                "INSERT INTO `ofertantes`(`id_ofertante`, `usuario`) VALUES (".$id_ofertante.",'".$usuario."')");
            $mydb -> fastQueryBool();
        }
    }
*/
    /**
     * Summary of checkOfertante
     * @param string $usuario   User ID to check
     * @return bool|object|null
     */
    // function UpdateOferer(int $id_ofertante, string $usuario) {
    //     global $sql;
    //     $mydb = new mydb($sql["db"]);
    //     $mydb ->querySetter(
    //         "UPDATE usuarios SET
    //         usuario = '".$usuario."'
    //         WHERE id_usuario = ".$id_ofertante);
    //     $mydb -> fastQueryBool();
    // }

    // function DeleteOferer(int $id_ofertante) {
    //     global $sql;
    //     $mydb = new mydb($sql["db"]);
    //     $mydb ->querySetter("DELETE FROM ofertantes WHERE id_ofertante = ".$id_ofertante);
    //     $mydb -> fastQueryBool();
    // }


    /* * * END FUNCTIONS * * */
?>