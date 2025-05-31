<?php
if(!isset($_SESSION['rol'])){
    $has_failed = isset($_SESSION['failed_sign_in'])?1:0;
?>
<div class="card">
    <div class="card-head">
        <span>¡Únete a la aventura!</span>
        <p>¡Regístrate como participante y demuestra que puedes ser el <strong>#1</strong> del ranking!</p>
    </div>
    <div class="card-body">
        <div class="full-body-form">
            <form id="sign-in-form" method="post">
                <!-- START IF SIGN IN FAILED -->
                <div class="label-input-row-1">
                    <label for="usuario">Nombre de Usuario:</label>
                    <input id="usuario" name="usuario" type="text" />
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
                    <input id="nombre" name="nombre" type="text" />
                </div>
                <div class="label-input-row-1">
                    <label for="apellidos">Apellidos:</label>
                    <input id="apellidos" name="apellidos" type="text" />
                </div>
                <div class="label-input-row-1 align-items-center">
                    <label for="password">Contraseña:</label>
                    <input id="password" name="password" type="password" />
                    <!--
                    <button class="eye" onclick="">
                        <img id="eye" src="src/eye-ico.png" >
                    </button>
                    -->
                </div>
                <div class="label-input-row-1">
                    <label for="email">Email:</label>
                    <input id="email" name="email" type="text" />
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
                <div class="d-flex justify-content-end">
                    <input hidden id="ultimo_usuario" name="ultimo_usuario" type="text" value="<?php echo $_SESSION['usuario'];?>" /> 
                    <button type="submit">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="functions/create_user.js" defer></script>
<?php
} else {
    header("Location:index.php?id=".GetScreenIndex("home"));
}
?>