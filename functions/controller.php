<?php

$id = $_GET['id']??"4";

// "p" = Audience (público), "P" = Participant, "A" = Admin
$screens = array (
    "1"   => "login",
    "2"   => "sign_in",
    "3"   => "profile",
    "4"   => "home",
    "5"   => "gallery",           // "p": public gallery
    "6"   => "post",              // "p": photo voting page
    "7"   => "my_gallery",        // "P": self posted photos gallery 
    "8"   => "post_status",       // "P": photo status page
    // "9"   => "",               // "": 
    "10"  => "manage_rally",      // "A": rally config page
    "11"  => "manage_requests",   // "A": pending upload requests
    "12"  => "manage_profiles",   // "A": change participants data
    "13"  => "post_approval",     // "A": request approval page
    "14"  => "ranking",
    "200" => "header",
    "202" => "menu",
    "203" => "footer"
);

/**
 * Prints _$screen_ index from _$screens_
 * 
 * Useful for navigation path creation in HTML
 * @param mixed $screen Target screen name
 */
function EchoScreenIndex($screen) {
    global $screens;
    echo array_keys($screens,$screen, true)[0]?:"4";
}

/**
 * Returns _$screen_ index from _$screens_
 * 
 * Useful for navigation path creation in PHP
 * @param mixed $screen Target screen name
 */
function GetScreenIndex($screen) {
    global $screens;
    return array_keys($screens,$screen, true)[0]?:"4";
}

/**
 * Prints _$screen_ name from _$screens_
 * 
 * Useful for navigation path creation in HTML
 * @param mixed $screen Target screen index
 */
function EchoScreenName($index) {
    global $screens;
    return $screens[$index];
}

/**
 * Returns _$screen_ name from _$screens_
 * 
 * Useful for navigation path creation in PHP
 * @param mixed $index Target screen index
 */
function GetScreenName($index) {
    global $screens;
    return $screens[$index];
}

/**
 * Imports an specified file using "require_once" in the current screen
 * @param mixed $screen Sreen ID or name
 * @param mixed $root   File's base path
 * @param mixed $ext    File's extension
 * @return void
 */
function Launch($screen, $root = "main/", $ext = ".php") {
    global $screens;
    if (in_array($screen, $screens, true)) {
        // Screen name suplied
        require_once($root.$screen.$ext);
    } elseif(array_key_exists($screen, $screens) && $screen < 199) {
        // Screen id suplied
        require_once($root.$screens[$screen].$ext);
    } else {
        require_once("main/home.php");
    }
}

/* Continuar post proyecto
class Controller{
    private $screen_root, $screen_ext, $screens;

    public function __construct(
        array $screens = array (
            "1"   => "login",
            "2"   => "sign_in",
            "3"   => "profile",
            "4"   => "home",
            "5"   => "ofertar_servicio",
            "6"   => "mis_ofertas",
            "7"   => "solicitar_servicio",
            "8"   => "mis_solicitudes",
            "255" => "config",
            "256" => "es"
        )

    ) {
        $this->screens = $screens;
    }

    function showScreen(
        $screen = "",
        $screen_id = "",
        $root = "",
        $ext = ".php"
    ) {

        $is_in_array = (
            (
                ($screen != "")
                || ($screen_id != "")
            ) && (
                (in_array($screen, $this->screens, true))
                || (in_array($screen_id, $this->screens, true))
            )
        );

        if ($is_in_array) {
            if ($screen != "") {
                // Mostrar pantalla por nombre
                require_once($root."/".$screen.$ext);
                echo ($screen_id != "") ?: ("Screen name and screen id suplied. Showing by screen name.");
            } else {
                // Mostrar pantalla por id
                require_once($root."/".$this->screens[$screen_id].$ext);
            }
        } else {
            // No existe en $screens => Mostrar 404
            require_once($root."/404.php");
        }

    }
}

/* PHP ASYNC DATA
    $data = json_decode(file_get_contents("php://input"), true);

    switch ($data["order"]) {
        case "select":
            $data["record"] = $con->query(
                "SELECT *
                FROM AFFILIATE
                LIMIT 1
                OFFSET "
                .$data["offset"]
            )->fetch_assoc();

            break;


        case "update":
            $con->query(
                "UPDATE AFFILIATE
                SET
                name='{$data["record"]["name"]}',
                surnames='{$data["record"]["surnames"]}',
                birthdate = '{$data["record"]["birthdate"]}',
                email = '{$data["record"]["email"]}',
                phone = '{$data["record"]["phone"]}',
                sex = '{$data["record"]["sex"]}',
                allergies = {$data["record"]["allergies"]},
                shirt = {$data["record"]["shirt"]}
                WHERE
                id = {$data["record"]["id"]}"
            );

            $data["record"] = $con->query(
                "SELECT *
                FROM AFFILIATE
                WHERE id = {$data["record"]["id"]}"
            )->fetch_assoc();

            break;


        case "insert":
            $con->query(
                "INSERT INTO AFFILIATE
                (name, surnames, birthdate, email,
                phone, sex, allergies, shirt)
                VALUES
                ('{$data["record"]["name"]}', '{$data["record"]["surnames"]}',
                '{$data["record"]["birthdate"]}', '{$data["record"]["email"]}',
                '{$data["record"]["phone"]}', '{$data["record"]["sex"]}',
                {$data["record"]["allergies"]}, {$data["record"]["shirt"]})"
            );

            $data["record"] = $con->query(
                "SELECT *
                FROM AFFILIATE
                WHERE phone = {$data["record"]["phone"]}"
            )->fetch_assoc();
            
            break;


        default:

        
    }

    $data["totalRecords"] = $con->query("SELECT COUNT(*) FROM AFFILIATE")->fetch_row()[0];

    echo json_encode($data);
*/
?>