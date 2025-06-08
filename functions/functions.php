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

    $regexMap = json_decode(json_encode(array(
        "usuario" => "/^[a-zA-Z0-9. ]+$/",
        "nombre" => "/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑçÇàèìòùÀÈÌÒÙ\s]+$/",
        "apellidos" => "/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑçÇàèìòùÀÈÌÒÙ\s]+$/",
        "password" => "/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{6,}$/",
        "email" => "/^[^\s@]+@[^\s@]+\.[^\s@]+$/"
    )));

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

    /**
     * Returns rally data from its id
     * @param string $id
     * @return bool|object|null
     */
    function GetRally(string $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT * FROM `rally` WHERE `id` = $id");
        $rally = $mydb -> fastQuery();

        unset($mydb);
        return($rally);
    }

    /**
     * Returns all valid imgs
     * @return mysqli_result|null
     */
    function GetGalleryImgs() {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT * FROM `fotos` WHERE `estado` = 1");
        $fotos = $mydb -> fastResponse();

        unset($mydb);
        return($fotos);
    }

    /**
     * Returns all imgs for manage_requests.php
     * @return mysqli_result|null
     */
    function GetApprovalImgs() {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT * FROM `fotos` WHERE `estado` = 2");
        $fotos = $mydb -> fastResponse();

        unset($mydb);
        return($fotos);
    }

    /**
     * Returns every img from $user
     * @param string $user
     * @return mysqli_result|null
     */
    function GetUserImgs(string $user) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT * FROM `fotos` WHERE `participante` = '$user'");
        $fotos = $mydb -> fastResponse();

        unset($mydb);
        return($fotos);
    }

    /**
     * Returns an img data from its id
     * @param int $id
     * @return bool|object|null
     */
    function GetImg(int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT * FROM `fotos` WHERE `id` = $id");
        $img = $mydb -> fastQuery();

        unset($mydb);
        return($img);

    }

    function GetPublic(string $ip, int $rally) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT * FROM `votantes` WHERE `ip` = '$ip' AND `rally`= $rally");
        $public = $mydb -> fastQuery();

        unset($mydb);
        return($public);
    }

    function Vote(string $ip, int $rally) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter(
            "UPDATE `votantes` SET
            `votos` = `votos` - 1
            WHERE `ip` = '".$ip."'
            AND `rally`= ".$rally);
        $mydb -> fastQueryBool();
        
        unset($mydb);
        }
        
    /*
    function Unvote(string $ip, int $rally) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter(
            "UPDATE `votantes` SET
            `votos` = `votos` + 1
            WHERE `ip` = '".$ip."'
            AND `rally`= ".$rally);
        $mydb -> fastQueryBool();

        unset($mydb);
    }
    */
    
    /**
     * Returns number of registered participants
     * @return bool|object|null
     */
    /*
    function CountUsers() {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT COUNT(*) count FROM `participantes`");
        $user = $mydb -> fastQuery();

        unset($mydb);
        return($user);

    }
    */
    

    /**
     * Returns number of imgs
     * @param mixed $user
     * @return bool|object|null
     */
    /*
    function CountValidImgs() {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT COUNT(*) count FROM `fotos`");
        $userImgs = $mydb -> fastQuery();

        unset($mydb);
        return($userImgs);

    }
    */

    /**
     * Returns number of imgs
     * @param mixed $user
     * @return bool|object|null
     */
    /*
    function CountImgs() {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT COUNT(*) count FROM `fotos`");
        $userImgs = $mydb -> fastQuery();

        unset($mydb);
        return($userImgs);

    }
        */

    /**
     * Returns number of $user imgs
     * @param mixed $user
     * @return bool|object|null
     */
    function CountUserImgs($user) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT COUNT(*) count FROM `fotos` WHERE `participante` = '$user'");
        $userImgs = $mydb -> fastQuery();

        unset($mydb);
        return($userImgs);

    }

    function CountVotes() {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT SUM(votos) count FROM `fotos`");
        $votes = $mydb -> fastQuery();

        unset($mydb);
        return($votes);

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

    function GetRanking() {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT * FROM `fotos` WHERE `estado` = 1 ORDER BY `votos` DESC LIMIT 3");
        $winners = $mydb -> fastResponse();
        $ranking = [];
        while($img = $winners -> fetch_assoc()) {
            array_push($ranking, $img);
        }

        unset($mydb);
        return($ranking);
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
            "INSERT INTO `participantes`
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

        unset($mydb);
    }

    function CreateImg(object $img_data) {
        global $sql;
        $mydb = new mydb($sql["db"]);

        $mydb ->querySetter(
            "INSERT INTO `fotos`
            (`ruta`,
            `foto`,
            `participante`,
            `rally`,
            `ultima_actualizacion`)

            VALUES 
            ('".$img_data->ruta."', '"
            .$img_data->foto."', '"
            .$img_data->participante."', '"
            .$img_data->rally."', '"
            .date("Y/m/d H:i:s")."')");

        $mydb -> fastQueryBool();

        unset($mydb);
    }

    function CreateVotante(object $votante): void {
        global $sql;
        $mydb = new mydb($sql["db"]);

        $mydb ->querySetter(
            "INSERT INTO `votantes`
            (`ip`,
            `rally`,
            `votos`)

            VALUES 
            ('".$votante->ip."', '"
            .$votante->rally."', '"
            .$votante->votos."')");

        $mydb -> fastQueryBool();

        unset($mydb);
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
            "UPDATE `participantes` SET
            `usuario` = '".$user_data->usuario."',
            `password` = '".$user_data->password."',
            `nombre` = '".$user_data->nombre."',
            `apellidos` = '".$user_data->apellidos."',
            `email` = '".$user_data->email."',
            `ultima_actualizacion` = '".date("Y/m/d H:i:s")."',
            `ultimo_usuario` = '".$user_data->ultimo_usuario."'
            WHERE `id` = ".$user_data->id);
        $mydb -> fastQueryBool();

        unset($mydb);
    }
    
    /**
     * Sets 'participantes.baja' to $baja
     * @param int $id
     * @param int $baja
     * @return void
     */
    function UpdateUnsuscribed(int $id, int $baja, $admin) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter(
            "UPDATE `participantes` SET
            `ultima_actualizacion` = '".date("Y/m/d H:i:s")."',
            `ultimo_usuario` = '".$admin."',
            `baja` = ".$baja."
            WHERE `id` = ".$id);
        $mydb -> fastQueryBool();

        unset($mydb);
    } 

    function UpdateApproval(int $id, int $estado, string $admin) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter(
            "UPDATE `fotos` SET
            `ultima_actualizacion` = '".date("Y/m/d H:i:s")."',
            `admin` = '".$admin."',
            `estado` = '".$estado."'
            WHERE `id` = ".$id);
        $mydb -> fastQueryBool();

        unset($mydb);
    }

    function UpdateRally(object $rally) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter(
            "UPDATE `rally` SET
            `fecha_inicio_subidas` = '".$rally->fecha_inicio_subidas."',
            `fecha_fin_subidas` = '".$rally->fecha_fin_subidas."',
            `fecha_inicio_votaciones` = '".$rally->fecha_inicio_votaciones."',
            `fecha_fin_votaciones` = '".$rally->fecha_fin_votaciones."',
            `limite_fotos_participante` = '".$rally->limite_fotos_participante."',
            `ultima_actualizacion` = '".date("Y/m/d H:i:s")."'
            WHERE `id` = ".$rally->id);
        $mydb -> fastQueryBool();

        unset($mydb);
    }
    
    
    function IncreaseVotes(int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter(
            "UPDATE `fotos` SET
            `votos` = `votos` + 1,
            `ultima_actualizacion` = '".date("Y/m/d H:i:s")."'
            WHERE `id` = ".$id);
        $mydb -> fastQueryBool();

        unset($mydb);
    }
    
    /*
    function DecreaseVotes(int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter(
            "UPDATE `fotos` SET
            `votos` = `votos` - 1
            WHERE `id` = ".$id);
        $mydb -> fastQueryBool();

        unset($mydb);
    }
    */
    function DeleteUser(int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("DELETE FROM `participantes` WHERE `id` = ".$id);
        $mydb -> fastQueryBool();

        unset($mydb);
    }

    function DeleteImg(int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("DELETE FROM `fotos` WHERE `id` = ".$id);
        $mydb -> fastQueryBool();

        unset($mydb);
    }

    /**
     * Used for checking if any info should be refreshed on client side
     * @param string $table
     * @param int $id
     */
    function GetLastUpdate(string $table, int $id) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb ->querySetter("SELECT `ultima_actualizacion` FROM `".$table."` WHERE `id` = ".$id);
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
        $mydb ->querySetter("SELECT `baja` FROM `participantes` WHERE `id` = ".$id);
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
        $mydb ->querySetter("SELECT `ultimo_usuario` FROM `participantes` WHERE `id` = ".$id);
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
        $mydb ->querySetter("SELECT * FROM `".$table."` WHERE `id` = ".$id);
        $res = $mydb -> fastQuery();

        unset($mydb);
        return($res);
    }

    function CheckUploadsDir(): bool {
        $uploadsDir = __DIR__ . '/../uploads';

        if (!is_dir($uploadsDir)) {
            return mkdir($uploadsDir, 0755, true);
        }

        return true;
    }

    function GetIp() {
        return $_SERVER['REMOTE_ADDR'] ?? 'IP no detectada';
    }

    function GetVotante($ip) {
        global $sql;
        $mydb = new mydb($sql["db"]);
        $mydb -> querySetter("SELECT * FROM `votantes` WHERE `ip` = '$ip'");
        $votante = $mydb -> fastQuery();

        unset($mydb);
        return($votante);
    }

    function GetImgStatus($estado) {
        $status = [];
        switch ($estado) {
            case 0:
                $status['class'] = "rejected";
                $status['message'] = "Rechazada";
                return json_decode(json_encode($status));
            case 1:
                $status['class'] = "approved";
                $status['message'] = "Aprobada";
                return json_decode(json_encode($status));
            case 2:
                $status['class'] = "pending";
                $status['message'] = "Pendiente";
                return json_decode(json_encode($status));
        }
    }

    function ValidateUser(object $user_data, object $regexMap) {
        foreach ($regexMap as $field => $regex) {
            if (!isset($user_data->$field) || !preg_match($regex, $user_data->$field)) {
                return false;
            }
        }
        return true;
    }

    function ValidateImg($file) {
    if (
        $file['error'] !== UPLOAD_ERR_OK ||
        !in_array(strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png'])
    ) {
        return false;
    }

    $info = getimagesize($file['tmp_name']);
    if (!$info) return false;

    list($width, $height) = $info;
    $aspect = $width / $height;
    $p = 2 * ($width + $height);

    return ($aspect >= 1 && $aspect <= 2 && $p < 4000);
}
    /* * * END FUNCTIONS * * */
?>