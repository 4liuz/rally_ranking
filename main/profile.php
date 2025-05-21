<?php
    $has_failed = isset($_SESSION['failed_sign_in'])?1:0;
    $user_data = GetUser($_SESSION['usuario']);
?>
<div class="card">
    <div class="card-head">
        <span><?php echo($_SESSION['usuario']);?></span>
    </div>
    <div class="card-body">
        <div class="full-body-form">
            <form action="controller/process_profile.php" method="post">
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
                    <label for="passwd">Contraseña:</label>
                    <input id="passwd" name="passwd" type="password" value="<?php echo $user_data->passwd;?>" />
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
                <div class="label-input-row-1">
                    <label for="telefono">Teléfono:</label>
                    <input id="telefono" name="telefono" type="text" value="<?php echo $user_data->telefono;?>" />
                </div>
                <?php
                    if($has_failed){
                ?>
                <div class="failed-form">
                    <span>El teléfono debe contener 9 dígitos</span>
                </div>
                <?php
                    }
                ?>
                <div class="d-flex justify-content-end">
                    <label for="ofertante">Quiero ser Ofertante:</label>
                    <input id="ofertante" name="ofertante" type="checkbox"<?php echo CheckOferer($user_data->usuario)?" checked":"";?> />
                </div>
                <div class="d-flex justify-content-end">
                    <input hidden id="id_usuario" name="id_usuario" type="text" value="<?php echo $user_data->id_usuario;?>" /> 
                    <button class="delete-button" <?php echo("onclick=\"location.href='controller/delete_user.php'\"");?>>Borrar Cuenta</button>
                    <button type="submit">Cambiar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
unset($user_data);
?>