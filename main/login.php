<?php
if (!isset($_SESSION['rol'])) {
?>
<div class="main-wrap login-bg-image">
    <div class="saturated h-100 d-flex justify-content-center align-items-center">
        <div class="login-div">
            <div class="login-title">
                <!-- <img src="src/logo.png" /> -->
                <span>Rally<br>Ranking</span>
            </div>
            <div class="login-box">
                <form action="controller/process_login.php" method="post">
                    <div class="label-input-row-1">
                        <label for="usuario">Usuario:</label>
                        <input id="usuario" name="usuario" type="text" />
                    </div>
                    <div class="label-input-row-1 align-items-center">
                        <label for="password">Contraseña:</label>
                        <input id="password" name="password" type="password" />
                    </div>


                    <!-- START IF LOGIN FAILED -->
                    <?php
                    if(isset($_SESSION['failed_login'])){
                        if($_SESSION['failed_login'] == 1){
                    ?>

                    <div class="failed-form">
                        <span>Usuario y/o contraseña incorrectos</span>
                    </div>

                    <?php
                        }
                    }
                    ?>
                    <!-- END IF LOGIN FAILED -->

                    <!-- START IF USER LOCKED -->
                    <?php
                    if(isset($_SESSION['user_locked'])){
                        if($_SESSION['user_locked'] == 1){
                    ?>

                    <div class="failed-form">
                        <span>Su usuario está dado de baja. Comuníquese con el administrador para volver a acceder</span>
                    </div>

                    <?php
                        }
                    }
                    ?>
                    <!-- END IF USER LOCKED -->

                    <div class="d-flex justify-content-end">
                        <button type="submit">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    unset($_SESSION['failed_login']);
} else {
    header("Location:index.php?id=".GetScreenIndex("home"));
}
?>