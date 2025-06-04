<?php
if(!isset($_SESSION['rol'])){
?>
<div class="card">
    <div class="card-head">
        <span>¡Únete a la aventura!</span>
        <p>¡Regístrate como participante y demuestra que puedes ser el <strong>#1</strong> del ranking!</p>
    </div>
    <div class="card-body">
        <div class="full-body-form max-40-rem">
            <form id="sign-in-form" method="post">

                <div class="label-input-row-1">
                    <label for="usuario">Nombre de Usuario:</label>
                    <input id="usuario" name="usuario" type="text" />
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
                    <input id="nombre" name="nombre" type="text" />
                </div>
                <div id="error-nombre" class="failed-form d-none">
                    <span class="min-5-rem"></span>
                    <span>Sólo letras alfabéticas, letras con carácter especial y/o espacios. Ejemplos: José Miguel, François...</span>
                </div>

                <div class="label-input-row-1">
                    <label for="apellidos">Apellidos:</label>
                    <input id="apellidos" name="apellidos" type="text" />
                </div>
                <div id="error-apellidos" class="failed-form d-none">
                    <span class=" min-5-rem"></span>
                    <span class="min-10-rem">Sólo letras alfabéticas, letras con carácter especial y/o espacios.<br>Ejemplos: Núñez Burgos, Lévêque Ghesquière...</span>
                </div>

                <div class="label-input-row-1 align-items-center">
                    <label for="password">Contraseña:</label>
                    <input id="password" name="password" type="password" />

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
                    <input id="email" name="email" type="text" />
                </div>
                <div id="error-email" class="failed-form d-none">
                    <span class="min-5-rem"></span>
                    <span>El correo debe tener el formato "ejemplo@direccion.com"</span>
                </div>

                <div class="d-flex justify-content-end">
                    <input hidden id="ultimo_usuario" name="ultimo_usuario" type="text" value="" /> 
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