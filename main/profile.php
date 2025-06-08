<?php
if (isset($_SESSION['rol'])) {
// Prevent Audience
    $has_failed = isset($_SESSION['failed_sign_in'])?1:0;
    if ($_SESSION['rol'] == "Participante"){
        $user_data = GetUser($_SESSION['usuario']);
    } elseif ($_SESSION['rol'] == "Administrador") {
        $user_data = GetUser(GetUserName($_POST['id']));
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
                    echo "Perfil de " . $user_data -> nombre . "&nbsp;" . $user_data -> apellidos;
                }
            ?>
        </span>
    </div>
    <div class="card-body">
        <?php
            if($_SESSION['rol'] == "Administrador") {
        ?>
        <button
        class="navigate-back"
        title="Volver"
        <?php echo("onclick=\"location.href='index.php?id=".GetScreenIndex("manage_profiles")."'\"");?>
        >
        ←
        </button>
        <?php
            }
        ?>
        <div class="full-body-form max-40-rem">
            <form id="profile-form" method="post">

                <div class="label-input-row-1">
                    <label for="usuario">Nombre&nbsp;de Usuario:</label>
                    <input id="usuario" name="usuario" type="text" value="<?php echo $user_data->usuario;?>" />
                </div>
                <div id="user-exists" class="failed-form d-none">
                    <span></span>
                    <span>El nombre de usuario ya existe, prueba con otro</span>
                </div>
                <div id="error-usuario" class="failed-form d-none">
                    <span class="min-5-rem"></span>
                    <span>Sólo letras alfabéticas, espacios, números y/o puntos.<br>Ejemplo: ale.jandr2</span>
                </div>

                <div class="label-input-row-1">
                    <label for="nombre">Nombre:</label>
                    <input id="nombre" name="nombre" type="text" value="<?php echo $user_data->nombre;?>" />
                </div>
                <div id="error-nombre" class="failed-form d-none">
                    <span class="min-5-rem"></span>
                    <span>Sólo letras alfabéticas, letras con carácter especial y/o espacios. Ejemplos: José Miguel, François...</span>
                </div>

                <div class="label-input-row-1">
                    <label for="apellidos">Apellidos:</label>
                    <input id="apellidos" name="apellidos" type="text" value="<?php echo $user_data->apellidos;?>" />
                </div>
                <div id="error-apellidos" class="failed-form d-none">
                    <span class=" min-5-rem"></span>
                    <span class="min-10-rem">Sólo letras alfabéticas, letras con carácter especial y/o espacios.<br>Ejemplos: Núñez Burgos, Lévêque Ghesquière...</span>
                </div>

                <div class="label-input-row-1">
                    <label for="password">Contraseña:</label>
                    <input id="password" name="password" type="text" value="<?php echo $user_data->password;?>" />
                    <?php
                        // Asignar a variable para evitar error alert del editor
                        $false = false;
                        // No imprimir en la página para evitar posibles errores
                        if($false){
                    ?>
                    <!-- Botones Ocultar / Mostrar contraseña -->
                    <button title="Ocultar" id="eye" class="action-button d-none" onclick="">
                        <i class="fa">&#xf06e;</i>
                    </button>
                    <button title="Mostrar" id="eye-slash" class="action-button" onclick="false">
                        <i class="fa">&#xf070;</i>
                    </button>
                    <?php
                        }
                        unset($false);
                    ?>
                </div>
                <div id="error-password" class="failed-form d-none">
                    <span class="min-5-rem"></span>
                    <span>Al menos 6 caracteres, incluyendo un carácter especial, una mayúscula y un número<br>Ejemplo: Rally1!</span>
                </div>

                <div class="label-input-row-1">
                    <label for="email">Email:</label>
                    <input id="email" name="email" type="text" value="<?php echo $user_data->email;?>" />
                </div>
                <div id="error-email" class="failed-form d-none">
                    <span class="min-5-rem"></span>
                    <span>El correo debe tener el formato "ejemplo@direccion.com"</span>
                </div>

                <div class="d-flex justify-content-end column-gap-5">
                    <input hidden id="id" name="id" type="text" value="<?php echo $user_data->id;?>" /> 
                    <input hidden id="baja" name="baja" type="text" value="<?php echo $user_data->baja;?>" /> 
                    <input hidden id="ultimo_usuario" name="ultimo_usuario" type="text" value="<?php echo $_SESSION['usuario'];?>" /> 

                    <?php if ($_SESSION['rol'] == "Participante"){ ?>
                    <button class="delete-button">Borrar Cuenta</button>
                    <?php } ?>
                    <?php if ($_SESSION['rol'] == "Administrador"){ ?>
                    <button class="unsuscribe-button" onclick="UnsuscribeUserProfile(document.querySelector('#id').value, document.querySelector('#baja').value)"><?php echo ($user_data -> baja) ? "Alta" : "Baja"; ?></button>
                    <?php } ?>
                    <button type="submit">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="functions/refresh.js" defer></script>
<script src="functions/profile_updater.js" defer></script>
<?php
    if($_SESSION['rol'] == "Participante") {
?>
<script src="functions/profile_deleter.js" defer></script>
<?php
    }
?>
<?php
    unset($user_data);
} else {
    header("Location:index.php?id=".GetScreenIndex("home"));
}
?>