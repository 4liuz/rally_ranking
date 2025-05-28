<?php
if (isset($_SESSION['rol'])) {
// Prevent Audience
    $has_failed = isset($_SESSION['failed_sign_in'])?1:0;
    if ($_SESSION['rol'] == "Participante"){
        $user_data = GetUser($_SESSION['usuario']);
    } elseif ($_SESSION['rol'] == "Administrador") {
        $user_data = GetUser(GetUserName($_POST['id_participante']));
    }
    // $user_data = new user_data();
?>
<div class="card">
    <div class="card-head">
        <!-- <span><?php echo($_SESSION['usuario']);?></span> -->
        <!-- Borrar en producción y descomentar arriba -->
        <span>
            <?php
                if ($_SESSION['rol'] == 'Participante') {
                    echo "Mi Perfil";
                } elseif ($_SESSION['rol'] == 'Administrador') {
                    echo "Perfil de " . $user_data -> nombre . $user_data -> apellidos;
                }
            ?>
        </span>
    </div>
    <div class="card-body">
        <div class="full-body-form">
            <form id="profile-form" method="post">
                <!-- START IF SIGN IN FAILED -->
                <div class="label-input-row-1">
                    <label for="usuario">Nombre de Usuario:</label>
                    <input id="usuario" name="usuario" type="text" value="<?php echo $user_data->usuario;?>" />
                </div>
                <?php
                    if($has_failed){
                ?>
                <div class="failed-form">
                    <span>El nombre de usuario ya existe</span>
                </div>
                <?php
                    }
                ?>
                <div class="label-input-row-1">
                    <label for="nombre">Nombre:</label>
                    <input id="nombre" name="nombre" type="text" value="<?php echo $user_data->nombre;?>" />
                </div>
                <div class="label-input-row-1">
                    <label for="apellidos">Apellidos:</label>
                    <input id="apellidos" name="apellidos" type="text" value="<?php echo $user_data->apellidos;?>" />
                </div>
                <div class="label-input-row-1 align-items-center">
                    <label for="password">Contraseña:</label>
                    <input id="password" name="password" type="text" value="<?php echo $user_data->password;?>" />
                    <!--
                    <button class="eye" onclick="">
                        <img id="eye" src="src/eye-ico.png" >
                    </button>
                    -->
                </div>
                <div class="label-input-row-1">
                    <label for="email">Email:</label>
                    <input id="email" name="email" type="text" value="<?php echo $user_data->email;?>" />
                </div>
                <?php
                    if($has_failed){
                ?>
                <div class="failed-form">
                    <span>El correo debe tener el formato "ejemplo@direccion.com"</span>
                </div>
                <?php
                    }
                ?>
                <div class="d-flex justify-content-end column-gap-5">
                    <input hidden id="id_participante" name="id_participante" type="text" value="<?php echo $user_data->id_participante;?>" /> 
                    <input hidden id="baja" name="baja" type="text" value="<?php echo $user_data->baja;?>" /> 
                    <button class="delete-button" <?php //echo("onclick=\"location.href='controller/delete_user.php'\"");?>>Borrar Cuenta</button>
                    <?php if ($_SESSION['rol'] == "Administrador"){ ?>
                    <button class="unsuscribe-button" <?php //echo("onclick=\"location.href='controller/unsuscribe_user.php'\"");?>>Baja</button>
                    <?php } ?>
                    <button type="submit">Cambiar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    unset($user_data);
} else {
    header("Location:index.php?id=".GetScreenIndex("home"));
}
?>
<script src="functions/profile_updater.js" defer></script>