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
            "db" => "ceramicart"
        ),
        
        // SQL FILTERS
        "where" => array(
            "es_usuario_ofertante" => " uos.id_usuario = oes.id_ofertante ",
            "es_su_oferta" => " oes.id_ofertante = oas.id_ofertante AND oas.id_servicio = sos.id_servicio ",
            "es_su_solicitud" => " uos.id_usuario = ses.id_usuario AND ses.id_servicio = sos.id_servicio ",
        ),
    );
    /* END VARIABLES */



    /* START FUNCTIONS */
    /**
     * Summary of getUserName
     * @param string $usuario
     * @return bool|object|null
     */
    function GetUserName(string $usuario) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT usuario FROM usuarios WHERE id_usuario = '$usuario'");
        $user_name = $mydb -> fastQuery();

        unset($mydb);
        return($user_name->usuario);
    }

    /* START FUNCTIONS */
    /**
     * Summary of getUser
     * @param string $usuario
     * @return bool|object|null
     */
    function GetUser(string $usuario) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT * FROM usuarios WHERE usuario COLLATE utf8mb4_bin = '$usuario'");
        $user = $mydb -> fastQuery();

        unset($mydb);
        return($user);
    }

    /**
     * Checks user and password for login screen
     * @param string $usuario   User ID to check
     * @param string $passwd    User password to check
     * @return bool
     */
    function CheckLogin(string $usuario, string $passwd): bool {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter(" SELECT passwd FROM usuarios WHERE usuario COLLATE utf8mb4_bin = '$usuario' ");
        
        if ($mydb->fastQuery()) {
            // Password check
            $login_matches = $mydb -> row -> passwd == $passwd;
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
    function CheckOferer(string $usuario) {
        global $sql;
        $mydb = new mydb($sql["db"]);

        $mydb ->querySetter(
            "SELECT COUNT(*) count FROM usuarios uos, ofertantes oes
            WHERE uos.usuario = '".$usuario."'
            AND ".$sql['where']['es_usuario_ofertante']);
        $is_ofertante = $mydb -> fastQuery();
        
        return $is_ofertante->count;
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
            ('passwd', '".$user_data->passwd."'),
            ('nombre', '".$user_data->nombre."'),
            ('apellidos', '".$user_data->apellidos."'),
            ('email', '".$user_data->email."'),
            ('telefono', '".$user_data->telefono."'),
            ('fecha_registro', '".date("d/m/Y")."')");
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
            "UPDATE usuarios SET
            usuario = '".$user_data->usuario."',
            passwd = '".$user_data->passwd."',
            nombre = '".$user_data->nombre."',
            apellidos = '".$user_data->apellidos."',
            email = '".$user_data->email."',
            telefono = '".$user_data->telefono."'
            WHERE id_usuario = ".$user_data->id_usuario);
        $mydb -> fastQueryBool();


    }
    
    function DeleteUser(int $id_usuario) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("DELETE FROM usuarios WHERE id_usuario = ".$id_usuario);
        $mydb -> fastQueryBool();
    }


    function CreateOferer(int $id_ofertante, string $usuario) {
        if(!CheckOferer($usuario)) {
            global $sql;
            $mydb = new mydb($sql["db"]);

            $mydb ->querySetter(
                "INSERT INTO `ofertantes`(`id_ofertante`, `usuario`) VALUES (".$id_ofertante.",'".$usuario."')");
            $mydb -> fastQueryBool();
        }
    }

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

    function DeleteOferer(int $id_ofertante) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("DELETE FROM ofertantes WHERE id_ofertante = ".$id_ofertante);
        $mydb -> fastQueryBool();
    }


    /* * * END FUNCTIONS * * */
?>